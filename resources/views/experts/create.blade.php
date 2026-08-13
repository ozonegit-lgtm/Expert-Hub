@extends('layouts.app')

@section('title', 'เพิ่มผู้เชี่ยวชาญ')

@section('content')
    <div class="mx-auto w-full max-w-5xl">
        {{-- ส่วนหัว --}}
        <div class="mb-8 flex items-center justify-between gap-4">
            <div class="flex min-w-0 items-center gap-3">
                <span
                    class="inline-flex size-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600"
                    aria-hidden="true"
                >
                    <svg
                        class="size-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19.1a9.4 9.4 0 0 0 2.6.4 9.3 9.3 0 0 0 4.1-1 4.1 4.1 0 0 0-7.5-2.5M15 19.1v.1A12.3 12.3 0 0 1 8.6 21c-2.3 0-4.4-.6-6.3-1.7a6.7 6.7 0 0 1-.1-1.1c0-3.3 2.7-6 6-6 2.2 0 4.1 1.2 5.2 2.9M12 6.8a3.8 3.8 0 1 1-7.5 0 3.8 3.8 0 0 1 7.5 0Z"
                        />
                    </svg>
                </span>

                <div class="min-w-0">
                    <h1
                        class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl"
                    >
                        เพิ่มผู้เชี่ยวชาญ
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        กรอกข้อมูลผู้เชี่ยวชาญเพื่อบันทึกเข้าสู่ระบบ
                    </p>
                </div>
            </div>

            <a
                href="{{ route('experts.index') }}"
                class="inline-flex h-11 shrink-0 items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-400 hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-4 focus:ring-blue-100"
                aria-label="ย้อนกลับไปหน้ารายชื่อผู้เชี่ยวชาญ"
            >
                <svg
                    class="size-5"
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

        {{-- แบบฟอร์ม --}}
        <form
            method="POST"
            action="{{ route('experts.store') }}"
            enctype="multipart/form-data"
            class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8"
        >
            @csrf

            @include('experts._form', [
                'submitLabel' => 'บันทึกข้อมูล',
            ])
        </form>
    </div>
@endsection
