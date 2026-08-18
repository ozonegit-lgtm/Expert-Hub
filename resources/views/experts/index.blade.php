@extends('layouts.app')

@section('title', 'รายชื่อผู้เชี่ยวชาญ')

@section('content')
    {{-- ส่วนหัว --}}
    <section
        class="
            mb-7 flex flex-col gap-4
            sm:flex-row sm:items-end sm:justify-between
        "
    >
        <div>
            <h1
                class="
                    text-2xl font-bold tracking-tight
                    text-slate-900 sm:text-3xl
                "
            >
                รายชื่อผู้เชี่ยวชาญ
            </h1>

            <p class="mt-1.5 text-sm text-slate-500">
                ค้นหาและดูข้อมูลผู้เชี่ยวชาญภายในระบบ
            </p>
        </div>

        @auth
            @if (auth()->user()->is_admin)
                <a
                    href="{{ route('experts.create') }}"
                    class="
                        inline-flex items-center justify-center
                        rounded-xl bg-blue-600 px-5 py-2.5
                        text-sm font-semibold text-white
                        shadow-sm transition
                        hover:bg-blue-700
                        focus:outline-none focus:ring-4
                        focus:ring-blue-200
                    "
                >
                    เพิ่มผู้เชี่ยวชาญ
                </a>
            @endif
        @endauth
    </section>

    {{-- ตัวกรอง --}}
    <form
        method="GET"
        action="{{ route('experts.index') }}"
        class="
            mb-7 rounded-2xl
            border border-slate-200
            bg-white p-4
            shadow-sm
        "
    >
        <div
            class="
                grid grid-cols-1 gap-3
                md:grid-cols-[minmax(0,1fr)_300px_auto]
                md:items-end
            "
        >
            {{-- ค้นหา --}}
            <div class="min-w-0">
                <label
                    for="search"
                    class="
                        mb-1.5 block
                        text-sm font-semibold text-slate-700
                    "
                >
                    ค้นหา
                </label>

                <input
                    id="search"
                    name="search"
                    type="search"
                    value="{{ request('search') }}"
                    placeholder="ชื่อ ตำแหน่ง หรือสถานที่ทำงาน"
                    class="
                        block h-11 w-full rounded-xl
                        border border-slate-300 bg-white
                        px-4 text-sm text-slate-900
                        outline-none transition
                        placeholder:text-slate-400
                        focus:border-blue-500
                        focus:ring-4 focus:ring-blue-100
                    "
                >
            </div>

            {{-- หมวดความเชี่ยวชาญ --}}
            <div class="min-w-0">
                <label
                    for="category"
                    class="
                        mb-1.5 block
                        text-sm font-semibold text-slate-700
                    "
                >
                    หมวดความเชี่ยวชาญ
                </label>

                <select
                    id="category"
                    name="category"
                    class="
                        block h-11 w-full rounded-xl
                        border border-slate-300 bg-white
                        px-4 text-sm text-slate-900
                        outline-none transition
                        focus:border-blue-500
                        focus:ring-4 focus:ring-blue-100
                    "
                >
                    <option value="">ทุกหมวด</option>

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
            </div>

            {{-- ปุ่ม --}}
            <div class="flex gap-2">
                <button
                    type="submit"
                    class="
                        inline-flex h-11 flex-1
                        items-center justify-center
                        rounded-xl bg-blue-600
                        px-6 text-sm font-semibold
                        text-white shadow-sm transition
                        hover:bg-blue-700
                        focus:outline-none focus:ring-4
                        focus:ring-blue-200
                        md:flex-none
                    "
                >
                    ค้นหา
                </button>

                <a
                    href="{{ route('experts.index') }}"
                    class="
                        inline-flex h-11 items-center
                        justify-center rounded-xl
                        border border-slate-300 bg-white
                        px-4 text-sm font-semibold
                        text-slate-600 transition
                        hover:bg-slate-50
                        hover:text-slate-900
                    "
                >
                    ล้าง
                </a>
            </div>
        </div>
    </form>

    @if ($experts->isEmpty())

        {{-- ไม่พบข้อมูล --}}
        <section
            class="
                rounded-2xl
                border border-dashed border-slate-300
                bg-white px-6 py-16
                text-center shadow-sm
            "
        >
            <div
                class="
                    mx-auto flex h-14 w-14
                    items-center justify-center
                    rounded-2xl bg-slate-100
                    text-2xl
                "
            >
                👤
            </div>

            <h2
                class="
                    mt-5 text-xl font-bold
                    text-slate-900
                "
            >
                ยังไม่มีข้อมูลผู้เชี่ยวชาญ
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                ยังไม่พบข้อมูลที่ตรงกับเงื่อนไขการค้นหา
            </p>

            @auth
                @if (auth()->user()->is_admin)
                    <a
                        href="{{ route('experts.create') }}"
                        class="
                            mt-6 inline-flex
                            items-center justify-center
                            rounded-xl bg-blue-600
                            px-5 py-2.5
                            text-sm font-semibold
                            text-white shadow-sm transition
                            hover:bg-blue-700
                        "
                    >
                        เพิ่มผู้เชี่ยวชาญ
                    </a>
                @endif
            @endauth
        </section>

    @else

        {{-- รายการผู้เชี่ยวชาญ --}}
        <div
            class="
                grid gap-4
                sm:grid-cols-2
                xl:grid-cols-3
            "
        >
            @foreach ($experts as $expert)

                {{-- Card ผู้เชี่ยวชาญ --}}
                <article
                    class="
                        group flex
                        flex-col overflow-hidden
                        rounded-2xl
                        rounded-2xl
                        border border-slate-200
                        bg-white
                        shadow-[0_4px_18px_rgba(15,23,42,0.05)]
                        transition-all duration-300
                        hover:-translate-y-1
                        hover:border-blue-200
                        hover:shadow-[0_14px_35px_rgba(37,99,235,0.12)]
                    "
                >
                    {{-- รูปประจำตัว --}}
                    <div
                        class="
                            relative aspect-[4/3]
                            shrink-0 overflow-hidden
                            bg-slate-100
                        "
                    >
                        @if ($expert->profile_image)
                            <img
                                src="{{ Storage::url($expert->profile_image) }}"
                                alt="{{ $expert->full_name }}"
                                class="
                                    h-full w-full
                                    object-cover object-[center_25%]
                                    transition duration-500
                                    group-hover:scale-[1.03]
                                "
                            >
                        @else
                            <div
                                class="
                                    flex h-full w-full
                                    items-center justify-center
                                    bg-gradient-to-br
                                    from-blue-50 via-slate-50 to-indigo-100
                                "
                            >
                                <span
                                    class="
                                        flex h-16 w-16
                                        items-center justify-center
                                        rounded-full bg-white
                                        text-2xl shadow-md
                                    "
                                >
                                    👤
                                </span>
                            </div>
                        @endif

                        {{-- ไล่เงาด้านล่างรูป --}}
                        <div
                            class="
                                pointer-events-none absolute inset-0
                                bg-gradient-to-t
                                from-slate-950/30
                                via-transparent
                                to-transparent
                            "
                            aria-hidden="true"
                        ></div>

                        {{-- สถานะ --}}
                        <div class="absolute right-3 top-3">
                            @if ($expert->is_published)
                                <span
                                    class="
                                        inline-flex items-center gap-1.5
                                        rounded-full
                                        border border-white/70
                                        bg-emerald-50/95
                                        px-2.5 py-1
                                        text-[11px] font-semibold
                                        text-emerald-700
                                        shadow-sm backdrop-blur-sm
                                    "
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    เผยแพร่
                                </span>
                            @else
                                <span
                                    class="
                                        inline-flex items-center gap-1.5
                                        rounded-full
                                        border border-white/70
                                        bg-amber-50/95
                                        px-2.5 py-1
                                        text-[11px] font-semibold
                                        text-amber-700
                                        shadow-sm backdrop-blur-sm
                                    "
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    แบบร่าง
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- เนื้อหา --}}
                    <div
                        class="
                            flex min-h-0
                            flex-1 flex-col
                            px-4 pb-4 pt-3.5
                        "
                    >
                        {{-- ชื่อ --}}
                        <div class="shrink-0">
                            <h2
                                class="
                                    line-clamp-1
                                    text-base font-bold
                                    leading-6 text-slate-900
                                    transition-colors
                                    group-hover:text-blue-600
                                "
                                title="{{ $expert->full_name }}"
                            >
                                {{ $expert->full_name }}
                            </h2>

                            {{-- ตำแหน่ง --}}
                            @if ($expert->current_position)
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
                                            rounded-md bg-blue-50
                                            text-blue-600
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
                                                d="M9 6V4h6v2M4 8h16v11H4zM4 12h16"
                                            />
                                        </svg>
                                    </span>

                                    <span
                                        class="
                                            line-clamp-1
                                            min-w-0
                                            text-xs font-medium
                                            text-slate-600
                                        "
                                        title="{{ $expert->current_position }}"
                                    >
                                        {{ $expert->current_position }}
                                    </span>
                                </div>
                            @endif

                            {{-- สถานที่ --}}
                            @if ($expert->workplace)
                                <div
                                    class="
                                        mt-1.5 flex min-w-0
                                        items-center gap-1.5
                                    "
                                >
                                    <svg
                                        class="
                                            h-3.5 w-3.5
                                            shrink-0
                                            text-slate-400
                                        "
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"
                                        />
                                        <circle
                                            cx="12"
                                            cy="10"
                                            r="2.5"
                                        />
                                    </svg>

                                    <span
                                        class="
                                            line-clamp-1
                                            min-w-0
                                            text-[11px]
                                            text-slate-400
                                        "
                                        title="{{ $expert->workplace }}"
                                    >
                                        {{ $expert->workplace }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Divider --}}
                        <div
                            class="
                                my-3 h-px w-full
                                bg-slate-100
                            "
                        ></div>

                        {{-- หมวดความเชี่ยวชาญ --}}
                        <div class="min-h-0 flex-1 overflow-hidden">
                            @if ($expert->expertiseCategories->isNotEmpty())
                                <div
                                    class="
                                        mb-2 flex
                                        items-center justify-between
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

                                    <span
                                        class="
                                            text-[10px]
                                            font-medium
                                            text-slate-400
                                        "
                                    >
                                        {{ $expert->expertiseCategories->count() }}
                                        หมวด
                                    </span>
                                </div>

                                <div
                                    class="
                                        flex max-h-[72px]
                                        flex-wrap content-start
                                        gap-1.5 overflow-hidden
                                    "
                                >
                                    @foreach (
                                        $expert->expertiseCategories->take(4)
                                        as $category
                                    )
                                        <span
                                            class="
                                                inline-flex items-center
                                                rounded-md
                                                border border-blue-100
                                                bg-blue-50/70
                                                px-2 py-1
                                                text-[10px]
                                                font-medium
                                                text-blue-700
                                                transition
                                                group-hover:border-blue-200
                                                group-hover:bg-blue-50
                                            "
                                        >
                                            {{ $category->name }}
                                        </span>
                                    @endforeach

                                    @if (
                                        $expert->expertiseCategories->count() > 4
                                    )
                                        <span
                                            class="
                                                inline-flex items-center
                                                rounded-md
                                                bg-slate-100
                                                px-2 py-1
                                                text-[10px]
                                                font-medium
                                                text-slate-500
                                            "
                                        >
                                            +{{ $expert->expertiseCategories->count() - 4 }}
                                        </span>
                                    @endif
                                </div>
                            @else
                                <div
                                    class="
                                        rounded-lg
                                        border border-dashed
                                        border-slate-200
                                        bg-slate-50
                                        px-3 py-2.5
                                        text-center
                                        text-[11px]
                                        text-slate-400
                                    "
                                >
                                    ไม่ระบุหมวดความเชี่ยวชาญ
                                </div>
                            @endif
                        </div>

                        {{-- ปุ่ม --}}
                        <div
                            class="
                                mt-3 flex items-center gap-2
                                border-t border-slate-100
                                pt-3
                            "
                        >
                            <a
                                href="{{ route('experts.show', $expert) }}"
                                class="
                                    inline-flex h-9 flex-1
                                    items-center justify-center
                                    gap-1.5 rounded-lg
                                    bg-blue-600 px-3
                                    text-xs font-semibold
                                    text-white shadow-sm
                                    transition
                                    hover:bg-blue-700
                                    focus:outline-none
                                    focus:ring-4
                                    focus:ring-blue-100
                                "
                            >
                                <svg
                                    class="h-3.5 w-3.5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.25 12s3.5-6 9.75-6 9.75 6 9.75 6-3.5 6-9.75 6S2.25 12 2.25 12Z M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                    />
                                </svg>

                                ดูข้อมูล
                            </a>

                            @auth
                                @if (auth()->user()->is_admin)
                                    <a
                                        href="{{ route('experts.edit', $expert) }}"
                                        class="
                                            inline-flex h-9 w-9
                                            items-center justify-center
                                            rounded-lg
                                            border border-slate-200
                                            bg-white
                                            text-slate-600
                                            transition
                                            hover:border-slate-300
                                            hover:bg-slate-50
                                            hover:text-slate-900
                                        "
                                        aria-label="แก้ไข {{ $expert->full_name }}"
                                        title="แก้ไข"
                                    >
                                        <svg
                                            class="h-3.5 w-3.5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            aria-hidden="true"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"
                                            />
                                        </svg>
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'experts.destroy',
                                            $expert
                                        ) }}"
                                        onsubmit="
                                            return confirm(
                                                'ยืนยันการลบข้อมูลนี้หรือไม่?'
                                            )
                                        "
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="
                                                inline-flex h-9 w-9
                                                items-center justify-center
                                                rounded-lg
                                                bg-red-50
                                                text-red-600
                                                transition
                                                hover:bg-red-100
                                                hover:text-red-700
                                            "
                                            aria-label="ลบ {{ $expert->full_name }}"
                                            title="ลบ"
                                        >
                                            <svg
                                                class="h-3.5 w-3.5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6M10 11v5M14 11v5"
                                                />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($experts->hasPages())
            <nav
                aria-label="การแบ่งหน้า"
                class="
                    mt-7 flex items-center justify-between
                    rounded-2xl
                    border border-slate-200
                    bg-white px-4 py-3
                    shadow-sm
                "
            >
                @if ($experts->onFirstPage())
                    <span
                        class="
                            cursor-not-allowed rounded-lg
                            bg-slate-100 px-3 py-1.5
                            text-xs text-slate-400
                        "
                    >
                        ก่อนหน้า
                    </span>
                @else
                    <a
                        href="{{ $experts->previousPageUrl() }}"
                        class="
                            rounded-lg
                            border border-slate-300
                            bg-white px-3 py-1.5
                            text-xs font-semibold
                            text-slate-700 transition
                            hover:bg-slate-50
                        "
                    >
                        ก่อนหน้า
                    </a>
                @endif

                <span class="text-xs text-slate-500">
                    หน้า
                    <strong class="text-slate-700">
                        {{ $experts->currentPage() }}
                    </strong>
                    /
                    <strong class="text-slate-700">
                        {{ $experts->lastPage() }}
                    </strong>
                </span>

                @if ($experts->hasMorePages())
                    <a
                        href="{{ $experts->nextPageUrl() }}"
                        class="
                            rounded-lg
                            border border-slate-300
                            bg-white px-3 py-1.5
                            text-xs font-semibold
                            text-slate-700 transition
                            hover:bg-slate-50
                        "
                    >
                        ถัดไป
                    </a>
                @else
                    <span
                        class="
                            cursor-not-allowed rounded-lg
                            bg-slate-100 px-3 py-1.5
                            text-xs text-slate-400
                        "
                    >
                        ถัดไป
                    </span>
                @endif
            </nav>
        @endif
    @endif
@endsection