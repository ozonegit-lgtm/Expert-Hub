@extends('layouts.app')

@section('title', 'แก้ไข ' . $expert->full_name)

@section('content')
    <div class="mx-auto w-full max-w-6xl">
        {{-- หัวข้อและปุ่มย้อนกลับ --}}
        <div class="mb-6 flex items-center justify-between gap-4">
            <div class="min-w-0">
                <h1
                    class="
                        text-2xl font-bold tracking-tight
                        text-slate-900 sm:text-3xl
                    "
                >
                    แก้ไขข้อมูลผู้เชี่ยวชาญ
                </h1>

                <p class="mt-1 truncate text-sm text-slate-500">
                    {{ $expert->full_name }}
                </p>
            </div>

            <a
                href="{{ route('experts.show', $expert) }}"
                class="
                    inline-flex h-11 shrink-0 items-center
                    justify-center gap-2 rounded-xl
                    border border-slate-300 bg-white px-4
                    text-sm font-semibold text-slate-700
                    shadow-sm transition
                    hover:border-slate-400 hover:bg-slate-50
                    hover:text-slate-900
                    focus:outline-none focus:ring-4
                    focus:ring-blue-100
                "
                aria-label="ย้อนกลับไปหน้ารายละเอียดผู้เชี่ยวชาญ"
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
                        d="m15 18-6-6 6-6"
                    />
                </svg>

                <span class="hidden sm:inline">ย้อนกลับ</span>
            </a>
        </div>

        {{-- ส่วนหัวหน้าแก้ไข --}}
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
                    sm:flex-row sm:items-center
                    sm:justify-between
                "
            >
                <div class="min-w-0">
                    <div class="mb-4 flex flex-wrap items-center gap-2">
                        <span
                            class="
                                inline-flex items-center gap-2
                                rounded-full border border-blue-200
                                bg-blue-50 px-3 py-1.5
                                text-xs font-semibold text-blue-700
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
                                    d="M12 20h9"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"
                                />
                            </svg>

                            กำลังแก้ไขข้อมูล
                        </span>

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
                    </div>

                    <h1
                        class="
                            text-3xl font-bold tracking-tight
                            text-slate-900 sm:text-4xl
                        "
                    >
                        แก้ไขข้อมูลผู้เชี่ยวชาญ
                    </h1>

                    <p class="mt-3 break-words text-base text-slate-600">
                        {{ $expert->full_name }}
                    </p>
                </div>

                <a
                    href="{{ route('experts.show', $expert) }}"
                    class="
                        inline-flex h-11 w-full shrink-0
                        items-center justify-center gap-2
                        rounded-xl border border-slate-200
                        bg-white px-5 text-sm font-semibold
                        text-slate-700 shadow-sm transition
                        hover:border-blue-200 hover:bg-blue-50
                        hover:text-blue-700 focus:outline-none
                        focus:ring-4 focus:ring-blue-100
                        sm:w-auto
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
                            d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"
                        />

                        <circle cx="12" cy="12" r="3" />
                    </svg>

                    ดูหน้ารายละเอียด
                </a>
            </div>
        </header>

        {{-- คำแนะนำ --}}
        <div
            class="
                mb-6 flex items-start gap-3 rounded-2xl
                border border-blue-100 bg-blue-50/70
                px-5 py-4 text-sm text-blue-800
            "
        >
            <svg
                class="mt-0.5 h-5 w-5 shrink-0"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >
                <circle cx="12" cy="12" r="9" />

                <path
                    stroke-linecap="round"
                    d="M12 11v5m0-8h.01"
                />
            </svg>

            <p>
                ตรวจสอบข้อมูลให้ครบถ้วนก่อนบันทึก
                หากไม่ต้องการเผยแพร่ทันที สามารถเลือกสถานะข้อมูลแบบร่างได้
            </p>
        </div>

        {{-- แบบฟอร์มแก้ไข --}}
        <form
            method="POST"
            action="{{ route('experts.update', $expert) }}"
            enctype="multipart/form-data"
            class="
                overflow-hidden rounded-3xl
                border border-slate-200
                bg-white shadow-sm
            "
        >
            @csrf
            @method('PUT')

            {{-- หัวกล่องแบบฟอร์ม --}}
            <div
                class="
                    border-b border-slate-100
                    bg-slate-50/70 px-6 py-5
                    sm:px-8
                "
            >
                <div class="flex items-center gap-3">
                    <span
                        class="
                            flex h-10 w-10 items-center
                            justify-center rounded-xl
                            bg-blue-100 text-blue-600
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
                                d="M12 20h9"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"
                            />
                        </svg>
                    </span>

                    <div>
                        <h2 class="font-bold text-slate-900">
                            แบบฟอร์มข้อมูลผู้เชี่ยวชาญ
                        </h2>

                        <p class="mt-0.5 text-sm text-slate-500">
                            แก้ไขรายละเอียดที่ต้องการแล้วกดบันทึก
                        </p>
                    </div>
                </div>
            </div>

            {{-- ฟอร์มหลัก --}}
            <div class="p-5 sm:p-8">
                @include('experts._form', [
                    'submitLabel' => 'บันทึกการแก้ไข',
                ])
            </div>
        </form>
    </div>
@endsection