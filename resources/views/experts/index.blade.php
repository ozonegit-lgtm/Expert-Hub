@extends('layouts.app')

@section('title', 'รายชื่อผู้เชี่ยวชาญ')

@section('content')
    {{-- ส่วนหัว --}}
    <section
        class="
            mb-8 flex flex-col gap-4
            sm:flex-row sm:items-end sm:justify-between
        "
    >
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                รายชื่อผู้เชี่ยวชาญ
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                ค้นหาและดูข้อมูลผู้เชี่ยวชาญภายในระบบ
            </p>
        </div>

        @auth
            @if (auth()->user()->is_admin)
                <a
                    href="{{ route('experts.create') }}"
                    class="
                        inline-flex items-center justify-center rounded-xl
                        bg-blue-600 px-5 py-3 text-sm font-semibold
                        text-white shadow-sm transition hover:bg-blue-700
                        focus:outline-none focus:ring-4 focus:ring-blue-200
                    "
                >
                    เพิ่มผู้เชี่ยวชาญ
                </a>
            @endif
        @endauth
    </section>

{{-- ตัวกรอง: คงชื่อ field และการทำงานเดิม --}}
<form
    method="GET"
    action="{{ route('experts.index') }}"
    class="
        mb-8 rounded-2xl border border-slate-200
        bg-white p-4 shadow-sm
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
                class="mb-2 block text-sm font-semibold text-slate-700"
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
                    block h-12 w-full rounded-xl
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
                class="mb-2 block text-sm font-semibold text-slate-700"
            >
                หมวดความเชี่ยวชาญ
            </label>

            <select
                id="category"
                name="category"
                class="
                    block h-12 w-full rounded-xl
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
                            (string) request('category')
                            === (string) $category->id
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
                    inline-flex h-12 flex-1 items-center
                    justify-center rounded-xl bg-blue-600
                    px-6 text-sm font-semibold text-white
                    shadow-sm transition hover:bg-blue-700
                    focus:outline-none focus:ring-4
                    focus:ring-blue-200 md:flex-none
                "
            >
                ค้นหา
            </button>

            <a
                href="{{ route('experts.index') }}"
                class="
                    inline-flex h-12 items-center
                    justify-center rounded-xl
                    border border-slate-300 bg-white
                    px-4 text-sm font-semibold text-slate-600
                    transition hover:bg-slate-50
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
                rounded-2xl border border-dashed border-slate-300
                bg-white px-6 py-16 text-center shadow-sm
            "
        >
            <div
                class="
                    mx-auto flex h-14 w-14 items-center justify-center
                    rounded-full bg-slate-100 text-2xl
                "
            >
                👤
            </div>

            <h2 class="mt-5 text-xl font-bold text-slate-900">
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
                            mt-6 inline-flex items-center justify-center
                            rounded-xl bg-blue-600 px-5 py-3
                            text-sm font-semibold text-white shadow-sm
                            transition hover:bg-blue-700
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
                grid auto-rows-fr gap-5
                sm:grid-cols-2 xl:grid-cols-3
            "
        >
            @foreach ($experts as $expert)
                <article
                    class="
                        group flex h-full flex-col overflow-hidden
                        rounded-2xl border border-slate-200 bg-white
                        shadow-[0_6px_24px_rgb(15_23_42/0.06)]
                        transition duration-300
                        hover:-translate-y-1 hover:border-blue-200
                        hover:shadow-[0_18px_45px_rgb(37_99_235/0.14)]
                    "
                >
                    {{-- รูปประจำตัว --}}
                    <div
                        class="
                            relative aspect-[16/10] overflow-hidden
                            bg-slate-100
                        "
                    >
                        @if ($expert->profile_image)
                            <img
                                src="{{ Storage::url($expert->profile_image) }}"
                                alt="{{ $expert->full_name }}"
                                class="
                                    h-full w-full object-cover
                                    transition duration-500
                                    group-hover:scale-105
                                "
                            >
                        @else
                            <div
                                class="
                                    flex h-full items-center justify-center
                                    bg-gradient-to-br from-slate-100
                                    to-slate-200 text-5xl text-slate-400
                                "
                            >
                                👤
                            </div>
                        @endif

                        <div
                            class="
                                pointer-events-none absolute inset-0
                                bg-gradient-to-t from-slate-950/25
                                via-transparent to-transparent
                            "
                            aria-hidden="true"
                        ></div>

                        {{-- สถานะ --}}
                        <div class="absolute right-3 top-3">
                            @if ($expert->is_published)
                                <span
                                    class="
                                        inline-flex items-center gap-1.5
                                        rounded-full border border-white/70
                                        bg-emerald-50/95 px-3 py-1
                                        text-xs font-semibold
                                        text-emerald-700 shadow-sm
                                        backdrop-blur-sm
                                    "
                                >
                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                                    ></span>

                                    เผยแพร่
                                </span>
                            @else
                                <span
                                    class="
                                        inline-flex items-center gap-1.5
                                        rounded-full border border-white/70
                                        bg-amber-50/95 px-3 py-1
                                        text-xs font-semibold
                                        text-amber-700 shadow-sm
                                        backdrop-blur-sm
                                    "
                                >
                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-amber-500"
                                    ></span>

                                    แบบร่าง
                                </span>
                            @endif
                        </div>
                    </div>

                    <div
                        class="
                            flex flex-1 flex-col bg-white p-5
                        "
                    >
                        <h2
                            class="text-xl font-bold leading-7 text-slate-900"
                        >
                            {{ $expert->full_name }}
                        </h2>

                        <div class="mt-3 space-y-2">
                            @if ($expert->current_position)
                                <p
                                    class="flex min-w-0 items-center gap-2 text-sm font-medium text-slate-700"
                                >
                                    <svg
                                        class="h-4 w-4 shrink-0 text-blue-500"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 6V4h6v2 M4 8h16v11H4z M4 12h16"
                                        />
                                    </svg>

                                    <span class="min-w-0 break-words">
                                        {{ $expert->current_position }}
                                    </span>
                                </p>
                            @endif

                            @if ($expert->workplace)
                                <p
                                    class="flex min-w-0 items-center gap-2 text-sm text-slate-500"
                                >
                                    <svg
                                        class="h-4 w-4 shrink-0 text-slate-400"
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
                                        <circle cx="12" cy="10" r="2.5" />
                                    </svg>

                                    <span class="min-w-0 break-words">
                                        {{ $expert->workplace }}
                                    </span>
                                </p>
                            @endif
                        </div>

                        {{-- หมวดความเชี่ยวชาญ --}}
                        @if ($expert->expertiseCategories->isNotEmpty())
                            <div
                                class="mt-5 flex flex-wrap gap-x-4 gap-y-2 border-t border-slate-100 pb-5 pt-4"
                            >
                                @foreach ($expert->expertiseCategories->take(3) as $category)
                                    <span
                                        class="
                                            inline-flex items-center gap-1.5
                                            text-xs font-medium text-blue-700
                                        "
                                    >
                                        <span
                                            class="h-1.5 w-1.5 rounded-full bg-blue-500"
                                        ></span>

                                        {{ $category->name }}
                                    </span>
                                @endforeach

                                @if ($expert->expertiseCategories->count() > 3)
                                    <span
                                        class="
                                            inline-flex items-center text-xs
                                            font-medium text-slate-500
                                        "
                                        title="ยังมีอีก {{ $expert->expertiseCategories->count() - 3 }} หมวด"
                                    >
                                        +{{ $expert->expertiseCategories->count() - 3 }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        {{-- ปุ่มดำเนินการ --}}
                        <div
                            class="
                                mt-auto flex items-center gap-2
                                border-t border-slate-100 pt-5
                            "
                        >
                            <a
                                href="{{ route('experts.show', $expert) }}"
                                class="
                                    inline-flex h-11 flex-1 items-center
                                    justify-center gap-2 rounded-xl
                                    bg-blue-600 px-4 text-sm font-semibold
                                    text-white shadow-sm transition
                                    hover:bg-blue-700 focus:outline-none
                                    focus:ring-4 focus:ring-blue-100
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
                                            inline-flex h-11 w-11 items-center
                                            justify-center rounded-xl border
                                            border-slate-300 bg-white
                                            text-slate-700 transition
                                            hover:border-slate-400
                                            hover:bg-slate-50
                                        "
                                        aria-label="แก้ไข {{ $expert->full_name }}"
                                        title="แก้ไข"
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
                                                d="M12 20h9 M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"
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
                                                inline-flex h-11 w-11 items-center
                                                justify-center rounded-xl
                                                bg-red-50
                                                text-red-700 transition
                                                hover:bg-red-100
                                            "
                                            aria-label="ลบ {{ $expert->full_name }}"
                                            title="ลบ"
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
                    mt-8 flex items-center justify-between rounded-2xl
                    border border-slate-200 bg-white px-5 py-4
                    shadow-sm
                "
            >
                @if ($experts->onFirstPage())
                    <span
                        class="
                            cursor-not-allowed rounded-lg bg-slate-100
                            px-4 py-2 text-sm text-slate-400
                        "
                    >
                        ก่อนหน้า
                    </span>
                @else
                    <a
                        href="{{ $experts->previousPageUrl() }}"
                        class="
                            rounded-lg border border-slate-300
                            bg-white px-4 py-2 text-sm font-semibold
                            text-slate-700 transition hover:bg-slate-50
                        "
                    >
                        ก่อนหน้า
                    </a>
                @endif

                <span class="text-sm text-slate-600">
                    หน้า
                    <strong>{{ $experts->currentPage() }}</strong>
                    จาก
                    <strong>{{ $experts->lastPage() }}</strong>
                </span>

                @if ($experts->hasMorePages())
                    <a
                        href="{{ $experts->nextPageUrl() }}"
                        class="
                            rounded-lg border border-slate-300
                            bg-white px-4 py-2 text-sm font-semibold
                            text-slate-700 transition hover:bg-slate-50
                        "
                    >
                        ถัดไป
                    </a>
                @else
                    <span
                        class="
                            cursor-not-allowed rounded-lg bg-slate-100
                            px-4 py-2 text-sm text-slate-400
                        "
                    >
                        ถัดไป
                    </span>
                @endif
            </nav>
        @endif
    @endif
@endsection
