@extends('layouts.app')

@section('title', $expert->full_name)

@section('content')
    <div class="mx-auto w-full max-w-6xl">
        {{-- ปุ่มย้อนกลับ --}}
        <div class="mb-5">
            <a
                href="{{ auth()->user()?->is_admin
                    ? route('experts.index')
                    : route('show-expert') }}"
                class="
                    inline-flex items-center gap-2 rounded-lg
                    px-1 py-2 text-sm font-medium text-slate-500
                    transition hover:text-blue-600
                    focus:outline-none focus:ring-4
                    focus:ring-blue-100
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
                        d="m15 18-6-6 6-6"
                    />
                </svg>

                {{ auth()->user()?->is_admin
                    ? 'กลับหน้าจัดการ'
                    : 'กลับหน้ารายชื่อผู้เชี่ยวชาญ' }}
            </a>
        </div>

        {{-- ส่วนหัว --}}
        <header
            class="
                relative mb-6 overflow-hidden rounded-3xl
                border border-blue-100
                bg-gradient-to-br from-white
                via-blue-50 to-indigo-50
                px-6 py-8 shadow-sm
                sm:px-8 sm:py-10
            "
        >
            {{-- พื้นหลังตกแต่ง --}}
            <div
                class="
                    pointer-events-none absolute -right-20
                    -top-24 h-64 w-64 rounded-full
                    bg-blue-200/40 blur-3xl
                "
                aria-hidden="true"
            ></div>

            <div
                class="
                    pointer-events-none absolute -bottom-24
                    left-1/3 h-56 w-56 rounded-full
                    bg-indigo-200/30 blur-3xl
                "
                aria-hidden="true"
            ></div>

            <div
                class="
                    relative flex flex-col gap-6
                    sm:flex-row sm:items-end
                    sm:justify-between
                "
            >
                {{-- ข้อมูลส่วนหัว --}}
                <div class="min-w-0">
                    <div class="mb-4 flex flex-wrap items-center gap-3">
                        @if ($expert->is_published)
                            <span
                                class="
                                    inline-flex items-center gap-2
                                    rounded-full border
                                    border-emerald-200 bg-emerald-50
                                    px-3 py-1.5 text-xs font-semibold
                                    text-emerald-700
                                "
                            >
                                <span
                                    class="
                                        h-2 w-2 rounded-full
                                        bg-emerald-500
                                    "
                                ></span>

                                เผยแพร่แล้ว
                            </span>
                        @else
                            <span
                                class="
                                    inline-flex items-center gap-2
                                    rounded-full border
                                    border-amber-200 bg-amber-50
                                    px-3 py-1.5 text-xs font-semibold
                                    text-amber-700
                                "
                            >
                                <span
                                    class="
                                        h-2 w-2 rounded-full
                                        bg-amber-500
                                    "
                                ></span>

                                ข้อมูลแบบร่าง
                            </span>
                        @endif

                        @if ($expert->workplace)
                            <span
                                class="
                                    inline-flex items-center gap-1.5
                                    text-sm font-medium text-slate-500
                                "
                            >
                                <svg
                                    class="h-4 w-4 text-blue-500"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"
                                    />

                                    <circle cx="12" cy="10" r="2.5" />
                                </svg>

                                {{ $expert->workplace }}
                            </span>
                        @endif
                    </div>

                    <h1
                        class="
                            break-words text-3xl font-bold
                            tracking-tight text-slate-900
                            sm:text-4xl
                        "
                    >
                        {{ $expert->full_name }}
                    </h1>

                    <p class="mt-3 text-base text-slate-600 sm:text-lg">
                        {{ $expert->current_position
                            ?: 'ไม่ระบุตำแหน่ง' }}
                    </p>
                </div>

                {{-- ปุ่มจัดการสำหรับ Admin --}}
                @auth
                    @if (auth()->user()->is_admin)
                        <div
                            class="
                                flex w-full shrink-0 flex-col gap-2
                                sm:w-auto sm:flex-row
                            "
                        >
                            <a
                                href="{{ route('experts.edit', $expert) }}"
                                class="
                                    inline-flex h-11 items-center
                                    justify-center gap-2 rounded-xl
                                    bg-blue-600 px-5 text-sm
                                    font-semibold text-white shadow-sm
                                    transition hover:bg-blue-700
                                    focus:outline-none focus:ring-4
                                    focus:ring-blue-200
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
                                        d="M12 20h9"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"
                                    />
                                </svg>

                                แก้ไขข้อมูล
                            </a>

                            <form
                                method="POST"
                                action="{{ route(
                                    'experts.destroy',
                                    $expert
                                ) }}"
                                onsubmit="return confirm(
                                    'ยืนยันการลบข้อมูลผู้เชี่ยวชาญนี้หรือไม่? ข้อมูลที่ลบแล้วไม่สามารถเรียกคืนได้'
                                )"
                                class="sm:w-auto"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="
                                        inline-flex h-11 w-full
                                        items-center justify-center gap-2
                                        rounded-xl border border-red-200
                                        bg-white px-5 text-sm
                                        font-semibold text-red-600
                                        shadow-sm transition
                                        hover:border-red-600
                                        hover:bg-red-600 hover:text-white
                                        focus:outline-none focus:ring-4
                                        focus:ring-red-100 sm:w-auto
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
                                            d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            d="M10 11v5M14 11v5"
                                        />
                                    </svg>

                                    ลบข้อมูล
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </header>

        {{-- รูปและข้อมูลทั่วไป --}}
        <div
            class="
                grid items-stretch gap-6
                lg:grid-cols-[minmax(0,2fr)_minmax(0,3fr)]
            "
        >
            {{-- รูปประจำตัว --}}
            <section
                class="
                    overflow-hidden rounded-3xl
                    border border-slate-200
                    bg-white shadow-sm
                "
            >
                @if ($expert->profile_image)
                    <div class="aspect-[4/5] h-full min-h-[420px] w-full">
                        <img
                            src="{{ Storage::disk('public')->url(
                                $expert->profile_image
                            ) }}"
                            alt="{{ $expert->full_name }}"
                            class="h-full w-full object-cover"
                        >
                    </div>
                @else
                    <div
                        class="
                            flex h-full min-h-[420px] flex-col
                            items-center justify-center
                            bg-gradient-to-br from-slate-50
                            to-slate-200 px-6 text-center
                        "
                    >
                        <span
                            class="
                                flex h-20 w-20 items-center
                                justify-center rounded-3xl
                                bg-white text-slate-400 shadow-sm
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
                        </span>

                        <p class="mt-4 text-sm font-medium text-slate-500">
                            ไม่มีรูปประจำตัว
                        </p>
                    </div>
                @endif
            </section>

            {{-- ข้อมูลทั่วไป --}}
            <section
                class="
                    rounded-3xl border border-slate-200
                    bg-white p-6 shadow-sm sm:p-8
                "
            >
                <div class="flex items-center gap-3">
                    <span
                        class="
                            flex h-10 w-10 items-center
                            justify-center rounded-xl
                            bg-blue-50 text-blue-600
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
                            <circle cx="12" cy="8" r="4" />

                            <path
                                stroke-linecap="round"
                                d="M4 21a8 8 0 0 1 16 0"
                            />
                        </svg>
                    </span>

                    <div>
                        <h2 class="text-lg font-bold text-slate-900">
                            ข้อมูลทั่วไป
                        </h2>

                        <p class="text-sm text-slate-500">
                            ประวัติและข้อมูลการทำงาน
                        </p>
                    </div>
                </div>

                <dl class="mt-7 divide-y divide-slate-100">
                    <div
                        class="
                            grid gap-2 py-5
                            sm:grid-cols-[180px_1fr]
                        "
                    >
                        <dt class="text-sm font-medium text-slate-500">
                            การศึกษาสูงสุด
                        </dt>

                        <dd class="text-sm font-semibold text-slate-900">
                            {{ $expert->highest_education ?: '-' }}
                        </dd>
                    </div>

                    <div
                        class="
                            grid gap-2 py-5
                            sm:grid-cols-[180px_1fr]
                        "
                    >
                        <dt class="text-sm font-medium text-slate-500">
                            ตำแหน่งปัจจุบัน
                        </dt>

                        <dd class="text-sm font-semibold text-slate-900">
                            {{ $expert->current_position ?: '-' }}
                        </dd>
                    </div>

                    <div
                        class="
                            grid gap-2 py-5
                            sm:grid-cols-[180px_1fr]
                        "
                    >
                        <dt class="text-sm font-medium text-slate-500">
                            สถานที่ทำงาน
                        </dt>

                        <dd class="text-sm font-semibold text-slate-900">
                            {{ $expert->workplace ?: '-' }}
                        </dd>
                    </div>

                    @auth
                        @if (auth()->user()->is_admin)
                            <div
                                class="
                                    grid gap-2 py-5
                                    sm:grid-cols-[180px_1fr]
                                "
                            >
                                <dt class="text-sm font-medium text-slate-500">
                                    ผู้บันทึกข้อมูล
                                </dt>

                                <dd class="text-sm font-semibold text-slate-900">
                                    {{ $expert->creator?->name
                                        ?: 'ไม่ระบุ' }}
                                </dd>
                            </div>
                        @endif
                    @endauth
                </dl>
            </section>
        </div>

        {{-- รายละเอียดความเชี่ยวชาญ --}}
        <section
            class="
                mt-6 rounded-3xl border border-slate-200
                bg-white p-6 shadow-sm sm:p-8
            "
        >
            <div class="flex items-center gap-3">
                <span
                    class="
                        flex h-10 w-10 items-center
                        justify-center rounded-xl
                        bg-indigo-50 text-indigo-600
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
                            stroke-linejoin="round"
                            d="M12 3 3 8l9 5 9-5-9-5Z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m3 12 9 5 9-5M3 16l9 5 9-5"
                        />
                    </svg>
                </span>

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        รายละเอียดความเชี่ยวชาญ
                    </h2>

                    <p class="text-sm text-slate-500">
                        ประสบการณ์และสาขาที่เชี่ยวชาญ
                    </p>
                </div>
            </div>

            @if ($expert->expertise_details)
                <div
                    class="
                        mt-6 whitespace-pre-line rounded-2xl
                        bg-slate-50 p-5 text-sm
                        leading-7 text-slate-700
                    "
                >{{ $expert->expertise_details }}</div>
            @else
                <p
                    class="
                        mt-6 rounded-2xl bg-slate-50
                        p-5 text-sm text-slate-500
                    "
                >
                    ไม่มีรายละเอียดเพิ่มเติม
                </p>
            @endif

            <div class="mt-7 border-t border-slate-100 pt-6">
                <h3 class="text-sm font-semibold text-slate-900">
                    หมวดความเชี่ยวชาญ
                </h3>

                <div class="mt-3 flex flex-wrap gap-2">
                    @forelse ($expert->expertiseCategories as $category)
                        <span
                            class="
                                inline-flex rounded-full border
                                border-blue-100 bg-blue-50
                                px-3 py-1.5 text-sm
                                font-medium text-blue-700
                            "
                        >
                            {{ $category->name }}
                        </span>
                    @empty
                        <p class="text-sm text-slate-500">
                            ยังไม่ได้เลือกหมวดความเชี่ยวชาญ
                        </p>
                    @endforelse
                </div>

                @if (
                    $expert->other_expertise
                    && $expert->expertiseCategories
                        ->contains('name', 'อื่นๆ')
                )
                    <div
                        class="
                            mt-5 rounded-2xl border
                            border-indigo-100
                            bg-indigo-50/70 p-5
                        "
                    >
                        <p class="text-sm font-semibold text-indigo-900">
                            ความเชี่ยวชาญอื่น ๆ
                        </p>

                        <p
                            class="
                                mt-2 whitespace-pre-line
                                text-sm leading-7 text-slate-700
                            "
                        >{{ $expert->other_expertise }}</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- ข้อมูลติดต่อ --}}
        @if ($expert->show_contact || auth()->user()?->is_admin)
            <section
                class="
                    mt-6 rounded-3xl border border-slate-200
                    bg-white p-6 shadow-sm sm:p-8
                "
            >
                <div
                    class="
                        flex flex-col gap-3
                        sm:flex-row sm:items-center
                        sm:justify-between
                    "
                >
                    <div class="flex items-center gap-3">
                        <span
                            class="
                                flex h-10 w-10 items-center
                                justify-center rounded-xl
                                bg-emerald-50 text-emerald-600
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
                                    stroke-linejoin="round"
                                    d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.2a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2Z"
                                />
                            </svg>
                        </span>

                        <div>
                            <h2 class="text-lg font-bold text-slate-900">
                                ข้อมูลติดต่อ
                            </h2>

                            <p class="text-sm text-slate-500">
                                ช่องทางสำหรับติดต่อผู้เชี่ยวชาญ
                            </p>
                        </div>
                    </div>

                    @if (! $expert->show_contact)
                        <span
                            class="
                                inline-flex w-fit items-center gap-2
                                rounded-full bg-amber-50
                                px-3 py-1.5 text-xs font-semibold
                                text-amber-700
                            "
                        >
                            <span
                                class="
                                    h-2 w-2 rounded-full
                                    bg-amber-400
                                "
                            ></span>

                            ซ่อนจากหน้าสาธารณะ
                        </span>
                    @endif
                </div>

                <dl class="mt-6 grid gap-4 md:grid-cols-3">
                    <div
                        class="
                            rounded-2xl border border-slate-100
                            bg-slate-50 p-5
                        "
                    >
                        <dt class="text-xs font-semibold text-slate-500">
                            โทรศัพท์
                        </dt>

                        <dd class="mt-2 break-words font-medium text-slate-900">
                            @if ($expert->phone)
                                <a
                                    href="tel:{{ $expert->phone }}"
                                    class="transition hover:text-blue-600"
                                >
                                    {{ $expert->phone }}
                                </a>
                            @else
                                -
                            @endif
                        </dd>
                    </div>

                    <div
                        class="
                            rounded-2xl border border-slate-100
                            bg-slate-50 p-5
                        "
                    >
                        <dt class="text-xs font-semibold text-slate-500">
                            อีเมล
                        </dt>

                        <dd
                            class="
                                mt-2 break-all font-medium
                                text-slate-900
                            "
                        >
                            @if ($expert->email)
                                <a
                                    href="mailto:{{ $expert->email }}"
                                    class="
                                        text-blue-600 transition
                                        hover:text-blue-700
                                        hover:underline
                                    "
                                >
                                    {{ $expert->email }}
                                </a>
                            @else
                                -
                            @endif
                        </dd>
                    </div>

                    <div
                        class="
                            rounded-2xl border border-slate-100
                            bg-slate-50 p-5
                        "
                    >
                        <dt class="text-xs font-semibold text-slate-500">
                            LINE ID
                        </dt>

                        <dd
                            class="
                                mt-2 break-all font-medium
                                text-slate-900
                            "
                        >
                            {{ $expert->line_id ?: '-' }}
                        </dd>
                    </div>
                </dl>
            </section>
        @endif
    </div>
@endsection