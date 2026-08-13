@php
    $selectedCategories = old(
        'expertise_category_ids',
        isset($expert)
            ? $expert->expertiseCategories->pluck('id')->all()
            : []
    );

    $publishedStatus = (string) old(
        'is_published',
        isset($expert) ? (int) $expert->is_published : 0
    );

    $contactVisibility = (string) old(
        'show_contact',
        isset($expert) ? (int) $expert->show_contact : 0
    );

    $normalizedSelectedCategories = array_map(
        'intval',
        (array) $selectedCategories
    );

    $otherCategory = $categories->firstWhere('name', 'อื่นๆ');

    $showOtherExpertise = $otherCategory
        && in_array(
            (int) $otherCategory->id,
            $normalizedSelectedCategories,
            true
        );

    $inputClass = '
        mt-2 block w-full rounded-xl border border-slate-300 bg-white
        px-4 py-3 text-sm text-slate-900 shadow-sm outline-none
        transition placeholder:text-slate-400
        focus:border-blue-500 focus:ring-4 focus:ring-blue-100
    ';

    $labelClass = 'block text-sm font-semibold text-slate-700';
@endphp

<div class="space-y-8">
    {{-- ข้อมูลทั่วไป --}}
    <section>
        <div class="mb-5">
            <h2 class="text-lg font-bold text-slate-900">
                ข้อมูลทั่วไป
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                กรอกข้อมูลพื้นฐานของผู้เชี่ยวชาญ
            </p>
        </div>

        <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            <div>
                <label for="full_name" class="{{ $labelClass }}">
                    ชื่อผู้เชี่ยวชาญ
                    <span class="text-red-500">*</span>
                </label>

                <input
                    id="full_name"
                    name="full_name"
                    type="text"
                    value="{{ old('full_name', $expert->full_name ?? '') }}"
                    class="{{ $inputClass }}"
                    placeholder="กรอกชื่อและนามสกุล"
                    required
                >

                @error('full_name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="highest_education" class="{{ $labelClass }}">
                    การศึกษาสูงสุด
                </label>

                <input
                    id="highest_education"
                    name="highest_education"
                    type="text"
                    value="{{ old(
                        'highest_education',
                        $expert->highest_education ?? ''
                    ) }}"
                    class="{{ $inputClass }}"
                    placeholder="เช่น ปริญญาเอก วิศวกรรมศาสตร์"
                >

                @error('highest_education')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="current_position" class="{{ $labelClass }}">
                    ตำแหน่งปัจจุบัน
                </label>

                <input
                    id="current_position"
                    name="current_position"
                    type="text"
                    value="{{ old(
                        'current_position',
                        $expert->current_position ?? ''
                    ) }}"
                    class="{{ $inputClass }}"
                    placeholder="เช่น อาจารย์ นักวิจัย"
                >

                @error('current_position')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="workplace" class="{{ $labelClass }}">
                    สถานที่ทำงาน
                </label>

                <input
                    id="workplace"
                    name="workplace"
                    type="text"
                    value="{{ old('workplace', $expert->workplace ?? '') }}"
                    class="{{ $inputClass }}"
                    placeholder="ชื่อหน่วยงานหรือสถานที่ทำงาน"
                >

                @error('workplace')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="{{ $labelClass }}">
                    อีเมล
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $expert->email ?? '') }}"
                    class="{{ $inputClass }}"
                    placeholder="example@email.com"
                >

                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="{{ $labelClass }}">
                    โทรศัพท์
                </label>

                <input
                    id="phone"
                    name="phone"
                    type="tel"
                    value="{{ old('phone', $expert->phone ?? '') }}"
                    class="{{ $inputClass }}"
                    placeholder="เช่น 0812345678"
                >

                @error('phone')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="line_id" class="{{ $labelClass }}">
                    LINE ID
                </label>

                <input
                    id="line_id"
                    name="line_id"
                    type="text"
                    value="{{ old('line_id', $expert->line_id ?? '') }}"
                    class="{{ $inputClass }}"
                    placeholder="กรอก LINE ID"
                >

                @error('line_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

           {{-- รูปประจำตัว --}}
            <div class="md:col-span-2 lg:col-span-3">
                <label for="profile_image" class="{{ $labelClass }}">
                    รูปประจำตัว
                </label>

                <p class="mt-1 text-xs text-slate-500">
                    รองรับ JPG, PNG และ WEBP ขนาดไม่เกิน 10 MB
                    สามารถปรับตำแหน่ง ย่อ ขยาย และหมุนรูปได้
                </p>

                <div
                    class="
                        mt-3 grid gap-5 rounded-2xl
                        border-2 border-dashed border-slate-300
                        bg-slate-50 p-5
                        sm:grid-cols-[160px_1fr]
                    "
                >
                    {{-- ตัวอย่างรูป --}}
                    <div
                        class="
                            relative aspect-square overflow-hidden
                            rounded-2xl border border-slate-200
                            bg-white shadow-sm
                        "
                    >
                        <img
                            id="profile-image-preview"
                            src="{{ isset($expert) && $expert->profile_image
                                ? Storage::disk('public')->url($expert->profile_image)
                                : '' }}"
                            alt="ตัวอย่างรูปประจำตัว"
                            class="
                                {{ isset($expert) && $expert->profile_image
                                    ? ''
                                    : 'hidden' }}
                                h-full w-full object-cover
                            "
                        >

                        <div
                            id="profile-image-placeholder"
                            class="
                                {{ isset($expert) && $expert->profile_image
                                    ? 'hidden'
                                    : '' }}
                                absolute inset-0 flex flex-col
                                items-center justify-center
                                text-center text-slate-400
                            "
                        >
                            <svg
                                class="h-10 w-10"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                aria-hidden="true"
                            >
                                <circle cx="12" cy="8" r="4" />

                                <path
                                    stroke-linecap="round"
                                    d="M4 21a8 8 0 0 1 16 0"
                                />
                            </svg>

                            <span class="mt-2 text-xs">
                                ยังไม่ได้เลือกรูป
                            </span>
                        </div>
                    </div>

                    {{-- ส่วนเลือกไฟล์ --}}
                    <div class="flex flex-col justify-center">
                        <input
                            id="profile_image"
                            name="profile_image"
                            type="file"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                            class="sr-only"
                        >

                        <label
                            for="profile_image"
                            class="
                                inline-flex w-fit cursor-pointer
                                items-center justify-center gap-2
                                rounded-xl bg-blue-600 px-5 py-3
                                text-sm font-semibold text-white
                                shadow-sm transition hover:bg-blue-700
                                focus-within:ring-4 focus-within:ring-blue-100
                            "
                        >
                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 16V4m0 0-4 4m4-4 4 4"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 15v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4"
                                />
                            </svg>

                            เลือกรูปภาพ
                        </label>

                        <p
                            id="profile-image-name"
                            class="mt-3 break-all text-sm text-slate-500"
                        >
                            @if (isset($expert) && $expert->profile_image)
                                มีรูปประจำตัวอยู่แล้ว
                            @else
                                ยังไม่ได้เลือกไฟล์
                            @endif
                        </p>

                        <button
                            id="profile-image-edit"
                            type="button"
                            class="
                                mt-3 hidden w-fit text-sm
                                font-semibold text-blue-600
                                transition hover:text-blue-700
                            "
                        >
                            ปรับตำแหน่งรูปอีกครั้ง
                        </button>
                    </div>
                </div>

                @error('profile_image')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- หน้าต่าง Crop รูป --}}
            <div
                id="image-crop-modal"
                class="
                    fixed inset-0 z-[200] hidden
                    items-center justify-center
                    bg-slate-950/70 p-4 backdrop-blur-sm
                "
                role="dialog"
                aria-modal="true"
                aria-labelledby="image-crop-title"
            >
                <div
                    class="
                        flex max-h-[calc(100vh-2rem)] w-full
                        max-w-3xl flex-col overflow-hidden
                        rounded-3xl bg-white shadow-2xl
                    "
                >
                    {{-- หัว Modal --}}
                    <div
                        class="
                            flex items-center justify-between
                            border-b border-slate-200 px-5 py-4
                        "
                    >
                        <div>
                            <h2
                                id="image-crop-title"
                                class="font-bold text-slate-900"
                            >
                                ปรับรูปประจำตัว
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                ลากรูปและย่อหรือขยายเพื่อเลือกบริเวณที่ต้องการ
                            </p>
                        </div>

                        <button
                            id="image-crop-close"
                            type="button"
                            class="
                                inline-flex h-10 w-10 items-center
                                justify-center rounded-xl text-slate-400
                                transition hover:bg-slate-100
                                hover:text-slate-700
                            "
                            aria-label="ปิดหน้าต่าง"
                        >
                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    d="M6 6l12 12M18 6 6 18"
                                />
                            </svg>
                        </button>
                    </div>

                    {{-- พื้นที่ Crop --}}
                    <div class="min-h-0 flex-1 overflow-auto bg-slate-900 p-4">
                        <div class="mx-auto max-h-[60vh] max-w-2xl">
                            <img
                                id="image-crop-source"
                                src=""
                                alt="รูปสำหรับปรับตำแหน่ง"
                                class="block max-h-[60vh] max-w-full"
                            >
                        </div>
                    </div>

                    {{-- ปุ่มควบคุม --}}
                    <div
                        class="
                            flex flex-col gap-3 border-t
                            border-slate-200 px-5 py-4
                            sm:flex-row sm:items-center
                            sm:justify-between
                        "
                    >
                        <div class="flex items-center gap-2">
                            <button
                                id="image-crop-zoom-out"
                                type="button"
                                class="
                                    inline-flex h-10 w-10 items-center
                                    justify-center rounded-xl border
                                    border-slate-300 bg-white text-lg
                                    font-bold text-slate-700
                                    transition hover:bg-slate-50
                                "
                                aria-label="ย่อรูป"
                            >
                                −
                            </button>

                            <button
                                id="image-crop-zoom-in"
                                type="button"
                                class="
                                    inline-flex h-10 w-10 items-center
                                    justify-center rounded-xl border
                                    border-slate-300 bg-white text-lg
                                    font-bold text-slate-700
                                    transition hover:bg-slate-50
                                "
                                aria-label="ขยายรูป"
                            >
                                +
                            </button>

                            <button
                                id="image-crop-rotate"
                                type="button"
                                class="
                                    inline-flex h-10 items-center
                                    justify-center rounded-xl border
                                    border-slate-300 bg-white px-4
                                    text-sm font-semibold text-slate-700
                                    transition hover:bg-slate-50
                                "
                            >
                                หมุนรูป
                            </button>
                        </div>

                        <div class="flex gap-2">
                            <button
                                id="image-crop-cancel"
                                type="button"
                                class="
                                    inline-flex h-10 flex-1 items-center
                                    justify-center rounded-xl border
                                    border-slate-300 bg-white px-5
                                    text-sm font-semibold text-slate-700
                                    transition hover:bg-slate-50
                                    sm:flex-none
                                "
                            >
                                ยกเลิก
                            </button>

                            <button
                                id="image-crop-apply"
                                type="button"
                                class="
                                    inline-flex h-10 flex-1 items-center
                                    justify-center rounded-xl bg-blue-600
                                    px-5 text-sm font-semibold text-white
                                    transition hover:bg-blue-700
                                    sm:flex-none
                                "
                            >
                                ใช้รูปนี้
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="border-slate-200">

    {{-- รายละเอียดความเชี่ยวชาญ --}}
    <section>
        <label for="expertise_details" class="{{ $labelClass }}">
            รายละเอียดความเชี่ยวชาญ
        </label>

        <textarea
            id="expertise_details"
            name="expertise_details"
            rows="6"
            class="{{ $inputClass }} resize-y"
            placeholder="อธิบายประสบการณ์ ผลงาน และความเชี่ยวชาญ"
        >{{ old(
            'expertise_details',
            $expert->expertise_details ?? ''
        ) }}</textarea>

        @error('expertise_details')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </section>

    {{-- หมวดความเชี่ยวชาญ --}}
    <section>
        <h2 class="text-lg font-bold text-slate-900">
            หมวดความเชี่ยวชาญ
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            สามารถเลือกได้มากกว่าหนึ่งหมวด
        </p>

        <div class="mt-4 flex flex-wrap gap-3">
            @forelse ($categories as $category)
                <label
                    for="expertise-category-{{ $category->id }}"
                    class="
                        inline-flex cursor-pointer items-center gap-3
                        rounded-xl border border-slate-200 bg-white
                        px-4 py-3 text-sm text-slate-700 shadow-sm
                        transition hover:border-blue-400 hover:bg-blue-50
                    "
                >
                    <input
                        id="expertise-category-{{ $category->id }}"
                        name="expertise_category_ids[]"
                        type="checkbox"
                        value="{{ $category->id }}"
                        class="
                            h-4 w-4 rounded border-slate-300
                            text-blue-600 focus:ring-blue-500
                        "
                        @checked(in_array(
                            (int) $category->id,
                            $normalizedSelectedCategories,
                            true
                        ))
                    >

                    <span>{{ $category->name }}</span>
                </label>
            @empty
                <div
                    class="
                        w-full rounded-xl border border-amber-200
                        bg-amber-50 px-4 py-3 text-sm text-amber-800
                    "
                >
                    ยังไม่มีหมวดความเชี่ยวชาญ
                    สามารถเพิ่มข้อมูลโดยไม่เลือกหมวดได้
                </div>
            @endforelse
        </div>

        @error('expertise_category_ids')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror

        @error('expertise_category_ids.*')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror

        @if ($otherCategory)
            <div
                id="other-expertise-field"
                class="{{ $showOtherExpertise ? 'mt-5' : 'mt-5 hidden' }}"
            >
                <label for="other_expertise" class="{{ $labelClass }}">
                    ระบุความเชี่ยวชาญอื่นๆ
                    <span class="text-red-500">*</span>
                </label>

                <textarea
                    id="other_expertise"
                    name="other_expertise"
                    rows="4"
                    maxlength="1000"
                    class="{{ $inputClass }} resize-y"
                    placeholder="กรุณาระบุความเชี่ยวชาญเพิ่มเติม"
                    @required($showOtherExpertise)
                >{{ old(
                    'other_expertise',
                    $expert->other_expertise ?? ''
                ) }}</textarea>

                <p class="mt-2 text-xs text-slate-500">
                    ระบุความเชี่ยวชาญที่ไม่มีอยู่ในรายการด้านบน
                </p>

                @error('other_expertise')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>
        @endif
    </section>

    <hr class="border-slate-200">

    {{-- การเผยแพร่ --}}
    <section>
        <h2 class="text-lg font-bold text-slate-900">
            สถานะข้อมูล
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            กำหนดว่าข้อมูลจะแสดงในหน้าสาธารณะหรือไม่
        </p>

        <div class="mt-4 grid gap-3 md:grid-cols-2">
            <label
                class="
                    flex cursor-pointer items-start gap-3 rounded-xl
                    border border-slate-200 p-4 transition
                    hover:border-emerald-400 hover:bg-emerald-50
                "
            >
                <input
                    name="is_published"
                    type="radio"
                    value="1"
                    class="
                        mt-1 h-4 w-4 border-slate-300
                        text-emerald-600 focus:ring-emerald-500
                    "
                    @checked($publishedStatus === '1')
                >

                <span>
                    <span class="block font-semibold text-slate-900">
                        เผยแพร่ข้อมูล
                    </span>

                    <span class="mt-1 block text-sm text-slate-500">
                        ผู้เข้าชมสามารถค้นหาและเปิดดูข้อมูลนี้ได้
                    </span>
                </span>
            </label>

            <label
                class="
                    flex cursor-pointer items-start gap-3 rounded-xl
                    border border-slate-200 p-4 transition
                    hover:border-amber-400 hover:bg-amber-50
                "
            >
                <input
                    name="is_published"
                    type="radio"
                    value="0"
                    class="
                        mt-1 h-4 w-4 border-slate-300
                        text-amber-600 focus:ring-amber-500
                    "
                    @checked($publishedStatus === '0')
                >

                <span>
                    <span class="block font-semibold text-slate-900">
                        บันทึกข้อมูลแบบร่าง
                    </span>

                    <span class="mt-1 block text-sm text-slate-500">
                        เก็บข้อมูลไว้ในระบบ แต่ยังไม่แสดงต่อสาธารณะ
                    </span>
                </span>
            </label>
        </div>

        @error('is_published')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </section>

    {{-- การแสดงข้อมูลติดต่อ --}}
    <section>
        <h2 class="text-lg font-bold text-slate-900">
            การแสดงข้อมูลติดต่อ
        </h2>

        <p class="mt-1 text-sm text-slate-500">
            ควบคุมการแสดงโทรศัพท์ อีเมล และ LINE ID
        </p>

        <div class="mt-4 grid gap-3 md:grid-cols-2">
            <label
                class="
                    flex cursor-pointer items-start gap-3 rounded-xl
                    border border-slate-200 p-4 transition
                    hover:border-blue-400 hover:bg-blue-50
                "
            >
                <input
                    name="show_contact"
                    type="radio"
                    value="1"
                    class="
                        mt-1 h-4 w-4 border-slate-300
                        text-blue-600 focus:ring-blue-500
                    "
                    @checked($contactVisibility === '1')
                >

                <span>
                    <span class="block font-semibold text-slate-900">
                        แสดงข้อมูลติดต่อ
                    </span>

                    <span class="mt-1 block text-sm text-slate-500">
                        ผู้เข้าชมสามารถเห็นข้อมูลติดต่อได้
                    </span>
                </span>
            </label>

            <label
                class="
                    flex cursor-pointer items-start gap-3 rounded-xl
                    border border-slate-200 p-4 transition
                    hover:border-slate-400 hover:bg-slate-50
                "
            >
                <input
                    name="show_contact"
                    type="radio"
                    value="0"
                    class="
                        mt-1 h-4 w-4 border-slate-300
                        text-slate-600 focus:ring-slate-500
                    "
                    @checked($contactVisibility === '0')
                >

                <span>
                    <span class="block font-semibold text-slate-900">
                        ซ่อนข้อมูลติดต่อ
                    </span>

                    <span class="mt-1 block text-sm text-slate-500">
                        ข้อมูลยังถูกบันทึก แต่ไม่แสดงต่อผู้เข้าชม
                    </span>
                </span>
            </label>
        </div>

        @error('show_contact')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </section>

    {{-- ปุ่มดำเนินการ --}}
    <div
        class="
            flex flex-col-reverse gap-3 border-t border-slate-200
            pt-6 sm:flex-row sm:justify-end
        "
    >
        <a
            href="{{ route('experts.index') }}"
            class="
                inline-flex items-center justify-center rounded-xl
                border border-slate-300 bg-white px-6 py-3
                text-sm font-semibold text-slate-700 shadow-sm
                transition hover:bg-slate-50
            "
        >
            ยกเลิก
        </a>

        <button
            type="submit"
            class="
                inline-flex items-center justify-center rounded-xl
                bg-blue-600 px-6 py-3 text-sm font-semibold
                text-white shadow-sm transition
                hover:bg-blue-700 focus:outline-none
                focus:ring-4 focus:ring-blue-200
            "
        >
            {{ $submitLabel }}
        </button>
    </div>
</div>

@if ($otherCategory)
    <script>
        (() => {
            const checkbox = document.getElementById(
                'expertise-category-{{ $otherCategory->id }}'
            );
            const field = document.getElementById('other-expertise-field');
            const textarea = document.getElementById('other_expertise');

            if (!checkbox || !field || !textarea) {
                return;
            }

            const toggleOtherExpertise = () => {
                const selected = checkbox.checked;

                field.classList.toggle('hidden', !selected);
                textarea.required = selected;

                if (!selected) {
                    textarea.value = '';
                }
            };

            checkbox.addEventListener('change', toggleOtherExpertise);
            toggleOtherExpertise();
        })();
    </script>
@endif
