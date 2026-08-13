@extends('layouts.app')

@section('title', 'ผู้เชี่ยวชาญทั้งหมด')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-slate-900">
            ผู้เชี่ยวชาญทั้งหมด
        </h1>

        <p class="mt-2 text-slate-500">
            รายชื่อผู้เชี่ยวชาญที่เผยแพร่ในระบบ
        </p>
    </div>

    @if ($experts->isEmpty())
        <div
            class="
                rounded-2xl border border-dashed border-slate-300
                bg-white px-6 py-16 text-center
            "
        >
            <p class="text-lg font-semibold text-slate-700">
                ยังไม่มีข้อมูลผู้เชี่ยวชาญ
            </p>

            <p class="mt-2 text-sm text-slate-500">
                ขณะนี้ยังไม่มีข้อมูลที่เผยแพร่
            </p>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($experts as $expert)
                <article
                    class="
                        overflow-hidden rounded-2xl border border-slate-200
                        bg-white shadow-sm transition
                        hover:-translate-y-1 hover:shadow-lg
                    "
                >
                    @if ($expert->profile_image)
                        <img
                            src="{{ Storage::disk('public')->url($expert->profile_image) }}"
                            alt="{{ $expert->full_name }}"
                            class="aspect-[4/3] w-full object-cover"
                        >
                    @else
                        <div
                            class="
                                flex aspect-[4/3] items-center justify-center
                                bg-slate-100 text-sm text-slate-400
                            "
                        >
                            ไม่มีรูปประจำตัว
                        </div>
                    @endif

                    <div class="p-5">
                        <h2 class="text-xl font-bold text-slate-900">
                            {{ $expert->full_name }}
                        </h2>

                        <p class="mt-1 text-sm text-slate-600">
                            {{ $expert->current_position ?: 'ไม่ระบุตำแหน่ง' }}
                        </p>

                        @if ($expert->workplace)
                            <p class="mt-1 text-sm text-slate-500">
                                {{ $expert->workplace }}
                            </p>
                        @endif

                        @if ($expert->expertiseCategories->isNotEmpty())
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach ($expert->expertiseCategories as $category)
                                    <span
                                        class="
                                            rounded-full bg-blue-50 px-3 py-1
                                            text-xs font-medium text-blue-700
                                        "
                                    >
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        @if (
                            $expert->other_expertise
                            && $expert->expertiseCategories->contains('name', 'อื่นๆ')
                        )
                            <p class="mt-3 text-sm text-slate-600">
                                <span class="font-semibold">อื่น ๆ:</span>
                                {{ $expert->other_expertise }}
                            </p>
                        @endif

                        <a
                            href="{{ route('experts.show', $expert) }}"
                            class="
                                mt-5 inline-flex w-full items-center
                                justify-center rounded-xl bg-blue-600
                                px-4 py-2.5 text-sm font-semibold
                                text-white transition hover:bg-blue-700
                                focus:outline-none focus:ring-4
                                focus:ring-blue-200
                            "
                        >
                            ดูรายละเอียด
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $experts->links() }}
        </div>
    @endif
@endsection