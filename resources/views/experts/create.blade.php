@extends('layouts.app')

@section('title', 'เพิ่มผู้เชี่ยวชาญ')

@section('content')
    <div class="mx-auto w-full max-w-5xl">
        {{-- ส่วนหัว --}}
        <div class="mb-8">
            <div class="flex items-center gap-3">
                <a
                    href="{{ route('experts.index') }}"
                    class="
                        inline-flex size-10 items-center justify-center
                        rounded-xl border border-slate-300 bg-white
                        text-slate-600 shadow-sm transition
                        hover:bg-slate-50 hover:text-slate-900
                        focus:outline-none focus:ring-4
                        focus:ring-blue-100
                    "
                    aria-label="กลับหน้ารายชื่อผู้เชี่ยวชาญ"
                >
                    <span aria-hidden="true">←</span>
                </a>

                <div>
                    <h1
                        class="
                            text-2xl font-bold tracking-tight
                            text-slate-900 sm:text-3xl
                        "
                    >
                        เพิ่มผู้เชี่ยวชาญ
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        กรอกข้อมูลผู้เชี่ยวชาญเพื่อบันทึกเข้าสู่ระบบ
                    </p>
                </div>
            </div>
        </div>

        {{-- แบบฟอร์ม --}}
        <form
            method="POST"
            action="{{ route('experts.store') }}"
            enctype="multipart/form-data"
            class="
                rounded-2xl border border-slate-200
                bg-white p-5 shadow-sm sm:p-8
            "
        >
            @csrf

            @include('experts._form', [
                'submitLabel' => 'บันทึกข้อมูล',
            ])
        </form>
    </div>
@endsection