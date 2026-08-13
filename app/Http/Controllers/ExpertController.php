<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpertRequest;
use App\Http\Requests\UpdateExpertRequest;
use App\Models\Expert;
use App\Models\ExpertiseCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ExpertController extends Controller
{
    public function index(Request $request): View
    {
        $experts = Expert::query()
            ->with('expertiseCategories')

            // ผู้เข้าชมเห็นเฉพาะข้อมูลที่เผยแพร่
            ->when(
                ! $request->user()?->is_admin,
                fn ($query) => $query->where(
                    'is_published',
                    true
                )
            )

            // ค้นหาข้อมูลผู้เชี่ยวชาญ
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = $request
                        ->string('search')
                        ->toString();

                    $query->where(
                        function ($query) use ($search) {
                            $query
                                ->where(
                                    'full_name',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'current_position',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'workplace',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'expertise_details',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'other_expertise',
                                    'like',
                                    "%{$search}%"
                                );
                        }
                    );
                }
            )

            // กรองตามหมวดความเชี่ยวชาญ
            ->when(
                $request->filled('category'),
                fn ($query) => $query->whereHas(
                    'expertiseCategories',
                    fn ($query) => $query->whereKey(
                        $request->integer('category')
                    )
                )
            )
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = ExpertiseCategory::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'experts.index',
            compact('experts', 'categories')
        );
    }

    public function create(): View
    {
        $categories = ExpertiseCategory::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'experts.create',
            compact('categories')
        );
    }

    public function store(
        StoreExpertRequest $request
    ): RedirectResponse {
        $data = $request->validated();

        $categoryIds = $data[
            'expertise_category_ids'
        ] ?? [];

        unset($data['expertise_category_ids']);

        /*
         * หากไม่ได้เลือกหมวด "อื่นๆ"
         * จะไม่บันทึกรายละเอียด other_expertise
         */
        if (! $this->hasOtherCategory($categoryIds)) {
            $data['other_expertise'] = null;
        }

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request
                ->file('profile_image')
                ->store('experts', 'public');
        }

        $data['created_by'] = $request->user()->id;

        $expert = DB::transaction(
            function () use ($data, $categoryIds) {
                $expert = Expert::create($data);

                $expert
                    ->expertiseCategories()
                    ->sync($categoryIds);

                return $expert;
            }
        );

        return redirect()
            ->route('experts.show', $expert)
            ->with(
                'success',
                'เพิ่มข้อมูลผู้เชี่ยวชาญเรียบร้อยแล้ว'
            );
    }

    public function show(Expert $expert): View
    {
        /*
         * ข้อมูลแบบร่างเปิดดูได้เฉพาะแอดมิน
         */
        if (
            ! $expert->is_published
            && ! auth()->user()?->is_admin
        ) {
            abort(404);
        }

        $expert->load([
            'expertiseCategories',
            'creator',
        ]);

        return view(
            'experts.show',
            compact('expert')
        );
    }

    public function edit(Expert $expert): View
    {
        $expert->load('expertiseCategories');

        $categories = ExpertiseCategory::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'experts.edit',
            compact('expert', 'categories')
        );
    }

    public function update(
        UpdateExpertRequest $request,
        Expert $expert
    ): RedirectResponse {
        $data = $request->validated();

        $categoryIds = $data[
            'expertise_category_ids'
        ] ?? [];

        $oldImage = $expert->profile_image;

        unset($data['expertise_category_ids']);

        /*
         * หากยกเลิกหมวด "อื่นๆ"
         * ให้ลบรายละเอียดเดิมออกจากฐานข้อมูล
         */
        if (! $this->hasOtherCategory($categoryIds)) {
            $data['other_expertise'] = null;
        }

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request
                ->file('profile_image')
                ->store('experts', 'public');
        }

        DB::transaction(
            function () use (
                $expert,
                $data,
                $categoryIds
            ) {
                $expert->update($data);

                $expert
                    ->expertiseCategories()
                    ->sync($categoryIds);
            }
        );

        if (
            $request->hasFile('profile_image')
            && $oldImage
        ) {
            Storage::disk('public')->delete(
                $oldImage
            );
        }

        return redirect()
            ->route('experts.show', $expert)
            ->with(
                'success',
                'แก้ไขข้อมูลผู้เชี่ยวชาญเรียบร้อยแล้ว'
            );
    }

    public function destroy(
        Expert $expert
    ): RedirectResponse {
        $profileImage = $expert->profile_image;

        DB::transaction(
            fn () => $expert->delete()
        );

        if ($profileImage) {
            Storage::disk('public')->delete(
                $profileImage
            );
        }

        return redirect()
            ->route('experts.index')
            ->with(
                'success',
                'ลบข้อมูลผู้เชี่ยวชาญเรียบร้อยแล้ว'
            );
    }
    
    public function showExperts(): View
    {
        $experts = Expert::query()
            ->with('expertiseCategories')
            ->where('is_published', true)
            ->latest()
            ->paginate(12);

        return view('show_expert', compact('experts'));
    }

    /**
     * ตรวจว่ารายการหมวดมีหมวด "อื่นๆ" หรือไม่
     *
     * @param array<int|string> $categoryIds
     */
    private function hasOtherCategory(
        array $categoryIds
    ): bool {
        if ($categoryIds === []) {
            return false;
        }

        return ExpertiseCategory::query()
            ->whereIn('id', $categoryIds)
            ->where('name', 'อื่นๆ')
            ->exists();
    }
}