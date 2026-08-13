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

    {{-- ตัวกรอง --}}
    <form
        method="GET"
        action="{{ route('experts.index') }}"
        class="
            mb-8 rounded-2xl border border-slate-200
            bg-white p-5 shadow-sm sm:p-6
        "
    >
        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label
                    for="search"
                    class="block text-sm font-semibold text-slate-700"
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
                        mt-2 block w-full rounded-xl border
                        border-slate-300 bg-white px-4 py-3
                        text-sm text-slate-900 shadow-sm outline-none
                        transition placeholder:text-slate-400
                        focus:border-blue-500 focus:ring-4
                        focus:ring-blue-100
                    "
                >
            </div>

            <div>
                <label
                    for="category"
                    class="block text-sm font-semibold text-slate-700"
                >
                    หมวดความเชี่ยวชาญ
                </label>

                <select
                    id="category"
                    name="category"
                    class="
                        mt-2 block w-full rounded-xl border
                        border-slate-300 bg-white px-4 py-3
                        text-sm text-slate-900 shadow-sm outline-none
                        transition focus:border-blue-500
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
        </div>

        <div class="mt-5 flex flex-wrap items-center gap-3">
            <button
                type="submit"
                class="
                    inline-flex items-center justify-center rounded-xl
                    bg-blue-600 px-5 py-2.5 text-sm font-semibold
                    text-white shadow-sm transition hover:bg-blue-700
                    focus:outline-none focus:ring-4 focus:ring-blue-200
                "
            >
                ค้นหา
            </button>

            <a
                href="{{ route('experts.index') }}"
                class="
                    inline-flex items-center justify-center rounded-xl
                    border border-slate-300 bg-white px-5 py-2.5
                    text-sm font-semibold text-slate-700 shadow-sm
                    transition hover:bg-slate-50
                "
            >
                ล้างตัวกรอง
            </a>
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
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($experts as $expert)
                <article
                    class="
                        group flex flex-col overflow-hidden rounded-2xl
                        border border-slate-200 bg-white shadow-sm
                        transition duration-200 hover:-translate-y-1
                        hover:shadow-lg
                    "
                >
                    {{-- รูปประจำตัว --}}
                    <div class="relative h-52 overflow-hidden bg-slate-100">
                        @if ($expert->profile_image)
                            <img
                                src="{{ Storage::url($expert->profile_image) }}"
                                alt="{{ $expert->full_name }}"
                                class="
                                    h-full w-full object-cover
                                    transition duration-300
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

                        {{-- สถานะ --}}
                        <div class="absolute right-3 top-3">
                            @if ($expert->is_published)
                                <span
                                    class="
                                        inline-flex rounded-full
                                        bg-emerald-100 px-3 py-1
                                        text-xs font-semibold
                                        text-emerald-700 shadow-sm
                                    "
                                >
                                    เผยแพร่
                                </span>
                            @else
                                <span
                                    class="
                                        inline-flex rounded-full
                                        bg-amber-100 px-3 py-1
                                        text-xs font-semibold
                                        text-amber-700 shadow-sm
                                    "
                                >
                                    แบบร่าง
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-1 flex-col p-5">
                        <h2 class="text-lg font-bold text-slate-900">
                            {{ $expert->full_name }}
                        </h2>

                        <div class="mt-2 min-h-12 space-y-1">
                            @if ($expert->current_position)
                                <p class="text-sm font-medium text-slate-700">
                                    {{ $expert->current_position }}
                                </p>
                            @endif

                            @if ($expert->workplace)
                                <p class="text-sm text-slate-500">
                                    {{ $expert->workplace }}
                                </p>
                            @endif
                        </div>

                        {{-- หมวดความเชี่ยวชาญ --}}
                        <div class="mt-4 flex min-h-8 flex-wrap gap-2">
                            @foreach ($expert->expertiseCategories as $category)
                                <span
                                    class="
                                        inline-flex rounded-full bg-blue-50
                                        px-3 py-1 text-xs font-medium
                                        text-blue-700
                                    "
                                >
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>

                        {{-- ปุ่มดำเนินการ --}}
                        <div
                            class="
                                mt-6 flex flex-wrap items-center gap-2
                                border-t border-slate-100 pt-4
                            "
                        >
                            <a
                                href="{{ route('experts.show', $expert) }}"
                                class="
                                    inline-flex flex-1 items-center
                                    justify-center rounded-lg bg-blue-600
                                    px-4 py-2.5 text-sm font-semibold
                                    text-white transition hover:bg-blue-700
                                "
                            >
                                ดูข้อมูล
                            </a>

                            @auth
                                @if (auth()->user()->is_admin)
                                    <a
                                        href="{{ route('experts.edit', $expert) }}"
                                        class="
                                            inline-flex items-center
                                            justify-center rounded-lg
                                            border border-slate-300 bg-white
                                            px-4 py-2.5 text-sm font-semibold
                                            text-slate-700 transition
                                            hover:bg-slate-50
                                        "
                                    >
                                        แก้ไข
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
                                                inline-flex items-center
                                                justify-center rounded-lg
                                                bg-red-50 px-4 py-2.5
                                                text-sm font-semibold
                                                text-red-700 transition
                                                hover:bg-red-100
                                            "
                                        >
                                            ลบ
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