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
    {{-- แถบค้นหาและกรองข้อมูล --}}
    <form
        method="GET"
        action="{{ route('show-expert') }}"
        class="
            mb-8 rounded-2xl border border-slate-200
            bg-white p-3 shadow-sm sm:p-4
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
                            border border-slate-200 bg-slate-50
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
            border border-slate-200 bg-slate-50
            py-3 pl-4 pr-14 text-sm text-slate-700
            outline-none transition
            hover:border-slate-300 hover:bg-white
            focus:border-blue-500 focus:bg-white
            focus:ring-4 focus:ring-blue-100
        "
    >
        <option value="">ทุกหมวดความเชี่ยวชาญ</option>

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
                        inline-flex h-12 min-w-0 flex-1
                        items-center justify-center gap-2
                        rounded-xl bg-blue-600 px-5
                        text-sm font-semibold text-white
                        shadow-sm transition
                        hover:bg-blue-700
                        focus:outline-none focus:ring-4
                        focus:ring-blue-200
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
                    request()->filled('search')
                    || request()->filled('category')
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
            request()->filled('search')
            || request()->filled('category')
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
        <div
            class="
                grid auto-rows-fr items-stretch gap-6
                sm:grid-cols-2 lg:grid-cols-3
            "
        >
            @foreach ($experts as $expert)
                <article
                    class="
                        group flex h-full min-h-[540px] flex-col
                        overflow-hidden rounded-2xl
                        border border-slate-200 bg-white
                        shadow-sm transition duration-200
                        hover:-translate-y-1 hover:shadow-lg
                    "
                >
                    {{-- รูปผู้เชี่ยวชาญ --}}
                    <div
                        class="
                            relative aspect-[4/3] w-full
                            shrink-0 overflow-hidden bg-slate-100
                        "
                    >
                        @if ($expert->profile_image)
                            <img
                                src="{{ Storage::disk('public')->url(
                                    $expert->profile_image
                                ) }}"
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
                                    flex h-full w-full items-center
                                    justify-center bg-slate-100
                                    text-sm text-slate-400
                                "
                            >
                                ไม่มีรูปประจำตัว
                            </div>
                        @endif
                    </div>

                    {{-- เนื้อหาการ์ด --}}
                    <div class="flex flex-1 flex-col p-5">
                        {{-- ข้อมูลทั่วไป --}}
                        <div class="min-h-[88px]">
                            <h2
                                class="
                                    line-clamp-2 text-xl font-bold
                                    leading-7 text-slate-900
                                "
                            >
                                {{ $expert->full_name }}
                            </h2>

                            <p
                                class="
                                    mt-1 truncate text-sm
                                    font-medium text-slate-600
                                "
                            >
                                {{ $expert->current_position
                                    ?: 'ไม่ระบุตำแหน่ง' }}
                            </p>

                            <p class="mt-1 truncate text-sm text-slate-500">
                                {{ $expert->workplace
                                    ?: 'ไม่ระบุสถานที่ทำงาน' }}
                            </p>
                        </div>

                        {{-- หมวดและความเชี่ยวชาญอื่น ๆ --}}
                        <div
                            class="
                                mt-4 flex min-h-[124px]
                                flex-col gap-3
                            "
                        >
                            @if ($expert->expertiseCategories->isNotEmpty())
                                <div class="flex flex-wrap content-start gap-2">
                                    @foreach (
                                        $expert->expertiseCategories
                                        as $category
                                    )
                                        <span
                                            class="
                                                inline-flex h-fit rounded-full
                                                bg-blue-50 px-3 py-1
                                                text-xs font-medium
                                                text-blue-700
                                            "
                                        >
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-slate-400">
                                    ไม่ระบุหมวดความเชี่ยวชาญ
                                </p>
                            @endif

                            @if (
                                $expert->other_expertise
                                && $expert->expertiseCategories
                                    ->contains('name', 'อื่นๆ')
                            )
                                <p
                                    class="
                                        line-clamp-2 text-sm
                                        leading-6 text-slate-600
                                    "
                                >
                                    <span class="font-semibold text-slate-700">
                                        อื่น ๆ:
                                    </span>

                                    {{ $expert->other_expertise }}
                                </p>
                            @endif
                        </div>

                        {{-- ล็อกปุ่มไว้ด้านล่าง --}}
                        <div
                            class="
                                mt-auto border-t
                                border-slate-100 pt-4
                            "
                        >
                            <a
                                href="{{ route('experts.show', $expert) }}"
                                class="
                                    inline-flex h-12 w-full
                                    items-center justify-center
                                    rounded-xl bg-blue-600 px-4
                                    text-sm font-semibold text-white
                                    transition hover:bg-blue-700
                                    focus:outline-none focus:ring-4
                                    focus:ring-blue-200
                                "
                            >
                                ดูรายละเอียด
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        @if ($experts->hasPages())
            <div class="mt-8">
                {{ $experts->links() }}
            </div>
        @endif
    @endif
@endsection