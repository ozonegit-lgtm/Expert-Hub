@extends('layouts.app')

@section('title', 'ผู้เชี่ยวชาญทั้งหมด')

@section('content')
    <div
        class="
            relative left-1/2 -mt-9 mb-8 flex w-screen
            -translate-x-1/2 overflow-hidden bg-[#022ABE]
            px-6 py-10 text-white
            shadow-lg shadow-blue-950/15 sm:px-10 sm:py-14
        "
    >
        {{-- วงกลมตกแต่งมุมขวาบน --}}
        <div
            class="
                pointer-events-none absolute -right-24 -top-32
                h-80 w-80 rounded-full border-[18px]
                border-white/15
            "
            aria-hidden="true"
        ></div>

        <div
            class="
                pointer-events-none absolute -right-12 -top-16
                h-44 w-44 rounded-full bg-indigo-950/10
            "
            aria-hidden="true"
        ></div>

        {{-- วงกลมตกแต่งมุมซ้ายล่าง --}}
        <div
            class="
                pointer-events-none absolute -bottom-28 -left-24
                h-64 w-64 rounded-full bg-sky-300/20
            "
            aria-hidden="true"
        ></div>

        <div
            class="
                relative z-10 mx-auto flex w-full
                max-w-7xl flex-col items-center
                justify-center text-center
            "
        >
            <h1
                class="
                    max-w-4xl text-3xl font-extrabold
                    tracking-tight text-white
                    drop-shadow-sm sm:text-5xl sm:leading-tight
                "
            >
                ค้นหาผู้เชี่ยวชาญที่ใช่สำหรับคุณ
            </h1>

            {{-- แถบค้นหาและกรองข้อมูล --}}
            <form
                method="GET"
                action="{{ route('show-expert') }}"
                class="
                    relative z-10 mt-10 w-full rounded-2xl
                    border border-white/30 bg-white p-3 text-left
                    shadow-xl shadow-blue-950/20 sm:p-4
                "
            >
                <div
                    class="
                        grid grid-cols-1 gap-3
                        lg:grid-cols-12 lg:items-center
                    "
                >
                    {{-- ช่องค้นหา --}}
                    <div class="min-w-0 lg:col-span-6">
                        <label for="search" class="sr-only">
                            ค้นหาผู้เชี่ยวชาญ
                        </label>

                        <div class="relative">
                            <svg
                                class="
                                    pointer-events-none absolute left-4 top-1/2
                                    z-10 h-5 w-5 -translate-y-1/2
                                    text-slate-400
                                "
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true"
                            >
                                <circle cx="11" cy="11" r="7" />
                                <path
                                    stroke-linecap="round"
                                    d="m20 20-4-4"
                                />
                            </svg>

                            <input
                                id="search"
                                name="search"
                                type="search"
                                value="{{ request('search') }}"
                                placeholder="ค้นหาชื่อ ตำแหน่ง สถานที่ หรือความเชี่ยวชาญ"
                                class="
                                    block h-12 w-full rounded-xl
                                    border border-slate-200 bg-slate-50/80
                                    py-3 pl-12 pr-4 text-sm text-slate-900
                                    outline-none transition
                                    placeholder:text-slate-400
                                    hover:border-slate-300 hover:bg-white
                                    focus:border-blue-500 focus:bg-white
                                    focus:ring-4 focus:ring-blue-100
                                "
                            >
                        </div>
                    </div>

                    {{-- เลือกหมวด --}}
                    <div class="min-w-0 lg:col-span-3">
                        <label for="category" class="sr-only">
                            หมวดความเชี่ยวชาญ
                        </label>

                        <div class="relative">
                            <select
                                id="category"
                                name="category"
                                class="
                                    block h-12 w-full appearance-none rounded-xl
                                    border border-slate-200 bg-slate-50/80
                                    py-3 pl-4 pr-14 text-sm text-slate-700
                                    outline-none transition
                                    hover:border-slate-300 hover:bg-white
                                    focus:border-blue-500 focus:bg-white
                                    focus:ring-4 focus:ring-blue-100
                                "
                            >
                                <option value="">
                                    ทุกหมวดความเชี่ยวชาญ
                                </option>

                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        @selected(
                                            (string) request('category') ===
                                            (string) $category->id
                                        )
                                    >
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <span
                                class="
                                    pointer-events-none absolute right-5 top-1/2
                                    flex -translate-y-1/2 items-center
                                    text-slate-500
                                "
                                aria-hidden="true"
                            >
                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m7 10 5 5 5-5"
                                    />
                                </svg>
                            </span>
                        </div>
                    </div>

                    {{-- ปุ่มดำเนินการ --}}
                    <div
                        class="
                            flex min-w-0 gap-2
                            lg:col-span-3 lg:justify-end
                        "
                    >
                        <button
                            type="submit"
                            class="
                                inline-flex h-11 min-w-0 flex-1
                                items-center justify-center gap-2
                                rounded-xl bg-gradient-to-r
                                from-emerald-600 to-teal-600 px-4
                                text-sm font-semibold text-white
                                shadow-md shadow-emerald-600/20 transition
                                hover:-translate-y-0.5
                                hover:from-emerald-700 hover:to-teal-700
                                focus:outline-none focus:ring-4
                                focus:ring-emerald-200
                            "
                        >
                            <svg
                                class="h-4 w-4 shrink-0"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true"
                            >
                                <circle cx="11" cy="11" r="7" />
                                <path
                                    stroke-linecap="round"
                                    d="m20 20-4-4"
                                />
                            </svg>

                            ค้นหา
                        </button>

                        @if (
                            request()->filled('search') ||
                            request()->filled('category')
                        )
                            <a
                                href="{{ route('show-expert') }}"
                                title="ล้างตัวกรอง"
                                aria-label="ล้างตัวกรอง"
                                class="
                                    inline-flex h-12 w-12 shrink-0
                                    items-center justify-center rounded-xl
                                    border border-slate-200 bg-white
                                    text-slate-500 transition
                                    hover:border-red-200 hover:bg-red-50
                                    hover:text-red-600
                                    focus:outline-none focus:ring-4
                                    focus:ring-red-100
                                "
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
                            </a>
                        @endif
                    </div>
                </div>

                {{-- สรุปผลการค้นหา --}}
                @if (
                    request()->filled('search') ||
                    request()->filled('category')
                )
                    <div
                        class="
                            mt-3 flex flex-wrap items-center gap-2
                            border-t border-slate-100 px-1 pt-3
                        "
                    >
                        <span class="text-xs font-medium text-slate-500">
                            พบ {{ number_format($experts->total()) }} รายการ
                        </span>

                        @if (request()->filled('search'))
                            <span
                                class="
                                    inline-flex max-w-full items-center
                                    rounded-full bg-blue-50 px-3 py-1
                                    text-xs font-medium text-blue-700
                                "
                            >
                                <span class="truncate">
                                    คำค้นหา: {{ request('search') }}
                                </span>
                            </span>
                        @endif

                        @if (request()->filled('category'))
                            @php
                                $selectedCategory = $categories->firstWhere(
                                    'id',
                                    (int) request('category')
                                );
                            @endphp

                            @if ($selectedCategory)
                                <span
                                    class="
                                        inline-flex max-w-full items-center
                                        rounded-full bg-indigo-50 px-3 py-1
                                        text-xs font-medium text-indigo-700
                                    "
                                >
                                    <span class="truncate">
                                        หมวด: {{ $selectedCategory->name }}
                                    </span>
                                </span>
                            @endif
                        @endif
                    </div>
                @endif
            </form>

            <nav
                class="mt-7 text-sm font-medium text-white sm:text-base"
                aria-label="Breadcrumb"
            >
                <a
                    href="{{ url('/') }}"
                    class="transition hover:text-blue-200"
                >
                    หน้าหลัก
                </a>

                <span class="mx-2 text-white/70" aria-hidden="true">
                    »
                </span>

                <span>ผู้เชี่ยวชาญทั้งหมด</span>
            </nav>
        </div>
    </div>

    @if ($experts->isEmpty())
        <div
            class="
                rounded-3xl border border-dashed border-slate-300
                bg-gradient-to-b from-white to-slate-50
                px-6 py-20 text-center
            "
        >
            <div
                class="
                    mx-auto mb-4 flex h-14 w-14 items-center
                    justify-center rounded-2xl
                    bg-blue-50 text-blue-600
                "
            >
                <svg
                    class="h-7 w-7"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    aria-hidden="true"
                >
                    <circle cx="11" cy="11" r="7" />
                    <path
                        stroke-linecap="round"
                        d="m20 20-4-4"
                    />
                </svg>
            </div>

            <p class="text-lg font-semibold text-slate-800">
                ยังไม่มีข้อมูลผู้เชี่ยวชาญ
            </p>

            <p class="mt-2 text-sm text-slate-500">
                ขณะนี้ยังไม่มีข้อมูลที่เผยแพร่
            </p>
        </div>
    @else

        {{-- Grid ผู้เชี่ยวชาญ --}}
        <div
            class="
                mx-auto grid w-full max-w-7xl
                grid-cols-1 gap-4
                sm:grid-cols-2
                lg:grid-cols-3
                xl:grid-cols-4
            "
        >
            @foreach ($experts as $expert)
                {{-- Card ผู้เชี่ยวชาญ --}}
                <article
                    class="
                        group relative flex h-[400px] flex-col
                        overflow-hidden rounded-2xl
                        border border-slate-200/80
                        bg-white
                        shadow-[0_4px_18px_rgba(15,23,42,0.05)]
                        transition-all duration-300 ease-out
                        hover:-translate-y-1
                        hover:border-blue-200
                        hover:shadow-[0_14px_35px_rgba(2,42,190,0.11)]
                    "
                >
                    {{-- รูปผู้เชี่ยวชาญ --}}
                    <div
                        class="
                            relative h-[185px] w-full shrink-0
                            overflow-hidden bg-slate-100
                        "
                    >
                        @if ($expert->profile_image)
                            <img
                                src="{{ Storage::disk('public')->url($expert->profile_image) }}"
                                alt="{{ $expert->full_name }}"
                                class="
                                    h-full w-full object-cover
                                    transition duration-700 ease-out
                                    group-hover:scale-[1.045]
                                "
                            >
                        @else
                            <div
                                class="
                                    flex h-full w-full flex-col
                                    items-center justify-center
                                    bg-gradient-to-br
                                    from-blue-50 via-slate-50 to-indigo-100
                                "
                            >
                                <span
                                    class="
                                        flex h-16 w-16 items-center justify-center
                                        rounded-full
                                        bg-white
                                        text-2xl font-bold
                                        text-[#022ABE]
                                        shadow-md shadow-blue-900/10
                                        ring-4 ring-white/60
                                    "
                                >
                                    {{ mb_substr($expert->full_name, 0, 1) }}
                                </span>

                                <span
                                    class="
                                        mt-2 text-[11px] font-medium
                                        text-slate-400
                                    "
                                >
                                    ไม่มีรูปประจำตัว
                                </span>
                            </div>
                        @endif

                        {{-- Gradient ด้านล่างรูป --}}
                        <div
                            class="
                                pointer-events-none absolute inset-x-0 bottom-0
                                h-20
                                bg-gradient-to-t
                                from-slate-950/40
                                via-slate-950/10
                                to-transparent
                            "
                            aria-hidden="true"
                        ></div>

                        {{-- Badge --}}
                        <div
                            class="
                                absolute left-3 top-3
                                inline-flex items-center gap-1.5
                                rounded-full
                                border border-white/40
                                bg-white/90
                                px-2.5 py-1
                                text-[11px] font-semibold
                                text-slate-700
                                shadow-sm
                                backdrop-blur-md
                            "
                        >
                            <span
                                class="
                                    h-1.5 w-1.5 rounded-full
                                    bg-emerald-500
                                "
                            ></span>

                            ผู้เชี่ยวชาญ
                        </div>
                    </div>

                    {{-- เนื้อหาการ์ด --}}
                    <div
                        class="
                            flex min-h-0 flex-1 flex-col
                            px-4 pb-4 pt-3.5
                        "
                    >
                        {{-- ชื่อ + ตำแหน่ง --}}
                        <div class="shrink-0">
                            <h2
                                class="
                                    line-clamp-1
                                    text-base font-bold
                                    leading-6
                                    text-slate-900
                                    transition-colors duration-200
                                    group-hover:text-[#022ABE]
                                "
                                title="{{ $expert->full_name }}"
                            >
                                {{ $expert->full_name }}
                            </h2>

                            {{-- ตำแหน่ง --}}
                            <div
                                class="
                                    mt-1.5 flex min-w-0
                                    items-center gap-1.5
                                "
                            >
                                <span
                                    class="
                                        flex h-6 w-6 shrink-0
                                        items-center justify-center
                                        rounded-md
                                        bg-blue-50
                                        text-[#022ABE]
                                    "
                                >
                                    <svg
                                        class="h-3.5 w-3.5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 6h6m-7 4h8m-9 9h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"
                                        />
                                    </svg>
                                </span>

                                <span
                                    class="
                                        truncate text-xs
                                        font-medium text-slate-600
                                    "
                                    title="{{ $expert->current_position ?: 'ไม่ระบุตำแหน่ง' }}"
                                >
                                    {{ $expert->current_position ?: 'ไม่ระบุตำแหน่ง' }}
                                </span>
                            </div>

                            {{-- สถานที่ทำงาน --}}
                            <div
                                class="
                                    mt-1.5 flex min-w-0
                                    items-center gap-1.5
                                "
                            >
                                <svg
                                    class="h-3.5 w-3.5 shrink-0 text-slate-400"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 21s6-5.1 6-11a6 6 0 1 0-12 0c0 5.9 6 11 6 11Z"
                                    />
                                    <circle
                                        cx="12"
                                        cy="10"
                                        r="2"
                                    />
                                </svg>

                                <span
                                    class="
                                        truncate text-[11px]
                                        text-slate-400
                                    "
                                    title="{{ $expert->workplace ?: 'ไม่ระบุสถานที่ทำงาน' }}"
                                >
                                    {{ $expert->workplace ?: 'ไม่ระบุสถานที่ทำงาน' }}
                                </span>
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="my-3 h-px w-full bg-slate-100"></div>

                        {{-- ความเชี่ยวชาญ --}}
                        <div class="min-h-0 flex-1 overflow-hidden">
                            <div
                                class="
                                    mb-2 flex items-center
                                    justify-between
                                "
                            >
                                <span
                                    class="
                                        text-[11px] font-bold
                                        uppercase tracking-wide
                                        text-slate-500
                                    "
                                >
                                    ความเชี่ยวชาญ
                                </span>

                                @if ($expert->expertiseCategories->isNotEmpty())
                                    <span
                                        class="
                                            text-[10px]
                                            font-medium text-slate-400
                                        "
                                    >
                                        {{ $expert->expertiseCategories->count() }}
                                        หมวด
                                    </span>
                                @endif
                            </div>

                            @if ($expert->expertiseCategories->isNotEmpty())
                                <div
                                    class="
                                        flex max-h-[68px]
                                        flex-wrap content-start
                                        gap-1.5 overflow-hidden
                                    "
                                >
                                    @foreach ($expert->expertiseCategories as $category)
                                        <span
                                            class="
                                                inline-flex items-center
                                                rounded-md
                                                border border-blue-100
                                                bg-blue-50/70
                                                px-2 py-1
                                                text-[10px] font-medium
                                                text-[#022ABE]
                                                transition
                                                group-hover:border-blue-200
                                                group-hover:bg-blue-50
                                            "
                                        >
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <div
                                    class="
                                        rounded-lg
                                        border border-dashed
                                        border-slate-200
                                        bg-slate-50
                                        px-3 py-2
                                        text-center
                                        text-[11px] text-slate-400
                                    "
                                >
                                    ไม่ระบุหมวดความเชี่ยวชาญ
                                </div>
                            @endif

                            {{-- รายละเอียดอื่น ๆ --}}
                            @if (
                                $expert->other_expertise &&
                                $expert->expertiseCategories->contains('name', 'อื่นๆ')
                            )
                                <div
                                    class="
                                        mt-2 rounded-lg
                                        border border-amber-100
                                        bg-amber-50/60
                                        px-2.5 py-2
                                    "
                                >
                                    <p
                                        class="
                                            line-clamp-2
                                            text-[10px] leading-4
                                            text-slate-600
                                        "
                                    >
                                        <span
                                            class="
                                                font-semibold
                                                text-slate-700
                                            "
                                        >
                                            อื่น ๆ:
                                        </span>

                                        {{ $expert->other_expertise }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        {{-- ปุ่มรายละเอียด --}}
                        <div
                            class="
                                mt-3 shrink-0
                                border-t border-slate-100
                                pt-3
                            "
                        >
                            <a
                                href="{{ route('experts.show', $expert) }}"
                                class="
                                    group/button
                                    inline-flex h-9 w-full
                                    items-center justify-center
                                    gap-1.5 rounded-lg
                                    bg-slate-50
                                    px-3
                                    text-xs font-semibold
                                    text-slate-700
                                    ring-1 ring-inset
                                    ring-slate-200
                                    transition-all duration-200
                                    hover:bg-[#022ABE]
                                    hover:text-white
                                    hover:ring-[#022ABE]
                                    focus:outline-none
                                    focus:ring-4
                                    focus:ring-blue-100
                                "
                            >
                                <span>ดูรายละเอียด</span>

                                <svg
                                    class="
                                        h-3.5 w-3.5
                                        transition-transform duration-200
                                        group-hover/button:translate-x-1
                                    "
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m9 18 6-6-6-6"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($experts->hasPages())
            <div class="mt-8">
                {{ $experts->links() }}
            </div>
        @endif
    @endif
@endsection
