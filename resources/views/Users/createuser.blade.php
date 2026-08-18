@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f1f5f9] px-4 py-6 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-3xl">

        {{-- Header --}}
        <div class="mb-6">

            {{-- Back --}}
            <div class="mb-3">
                <a
                    href="{{ route('users.index') }}"
                    class="
                        inline-flex items-center gap-2
                        text-sm font-medium text-slate-500
                        transition hover:text-blue-600
                    "
                >
                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M15 19l-7-7 7-7" />
                    </svg>

                    กลับไปหน้าสมาชิก
                </a>
            </div>

            {{-- Page Title --}}
            <div class="flex items-start gap-3">

                <div
                    class="
                        flex h-11 w-11 shrink-0
                        items-center justify-center
                        rounded-xl bg-blue-50
                        text-blue-600
                    "
                >
                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path
                            d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                        />
                        <circle cx="9" cy="7" r="4" />
                        <path
                            d="M22 21v-2a4 4 0 0 0-3-3.87"
                        />
                        <path
                            d="M16 3.13a4 4 0 0 1 0 7.75"
                        />
                    </svg>
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        เพิ่มสมาชิก
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        เพิ่มบัญชีผู้ใช้งานใหม่เข้าสู่ระบบ Expert-Hub
                    </p>
                </div>

            </div>
        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())
            <div
                class="
                    mb-5 rounded-xl
                    border border-red-200
                    bg-red-50 px-4 py-4
                "
            >
                <div class="flex gap-3">

                    <div
                        class="
                            flex h-8 w-8 shrink-0
                            items-center justify-center
                            rounded-lg bg-red-100
                            text-red-600
                        "
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 8v5" />
                            <path d="M12 16h.01" />
                        </svg>
                    </div>

                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-red-700">
                            กรุณาตรวจสอบข้อมูล
                        </p>

                        <ul
                            class="
                                mt-1 list-disc pl-5
                                text-sm text-red-600
                            "
                        >
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        @endif


        {{-- Form Card --}}
        <div
            class="
                overflow-hidden rounded-xl
                border border-slate-200
                bg-white shadow-sm
            "
        >

            {{-- Card Header --}}
            <div
                class="
                    border-b border-slate-200
                    bg-white px-5 py-4
                    sm:px-6
                "
            >
                <div class="flex items-center gap-3">

                    <div
                        class="
                            flex h-9 w-9 shrink-0
                            items-center justify-center
                            rounded-lg bg-slate-100
                            text-slate-600
                        "
                    >
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path
                                d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                            />
                            <circle cx="9" cy="7" r="4" />
                            <path
                                d="M22 21v-2a4 4 0 0 0-3-3.87"
                            />
                            <path
                                d="M16 3.13a4 4 0 0 1 0 7.75"
                            />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-base font-semibold text-slate-800">
                            ข้อมูลสมาชิก
                        </h2>

                        <p class="mt-0.5 text-sm text-slate-500">
                            กรอกข้อมูลสำหรับสร้างบัญชีผู้ใช้งาน
                        </p>
                    </div>

                </div>
            </div>


            {{-- Form --}}
            <form
                action="{{ route('users.store') }}"
                method="POST"
                class="px-5 py-6 sm:px-6"
            >
                @csrf

                <div class="space-y-6">

                    {{-- Name --}}
                    <div>
                        <label
                            for="name"
                            class="
                                mb-2 flex items-center gap-2
                                text-sm font-medium
                                text-slate-700
                            "
                        >
                            <svg
                                class="h-4 w-4 text-slate-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <circle cx="12" cy="8" r="4" />
                                <path d="M4 21a8 8 0 0 1 16 0" />
                            </svg>

                            ชื่อสมาชิก
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            maxlength="255"
                            autocomplete="name"
                            placeholder="กรอกชื่อสมาชิก"
                            class="
                                block w-full rounded-lg
                                border border-slate-300
                                bg-white px-3.5 py-2.5
                                text-sm text-slate-800
                                outline-none transition
                                placeholder:text-slate-400
                                focus:border-blue-500
                                focus:ring-2 focus:ring-blue-100
                            "
                        >

                        @error('name')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Email --}}
                    <div>
                        <label
                            for="email"
                            class="
                                mb-2 flex items-center gap-2
                                text-sm font-medium
                                text-slate-700
                            "
                        >
                            <svg
                                class="h-4 w-4 text-slate-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <rect
                                    x="3"
                                    y="5"
                                    width="18"
                                    height="14"
                                    rx="2"
                                />
                                <path d="m3 7 9 6 9-6" />
                            </svg>

                            อีเมล
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            maxlength="255"
                            autocomplete="email"
                            placeholder="example@email.com"
                            class="
                                block w-full rounded-lg
                                border border-slate-300
                                bg-white px-3.5 py-2.5
                                text-sm text-slate-800
                                outline-none transition
                                placeholder:text-slate-400
                                focus:border-blue-500
                                focus:ring-2 focus:ring-blue-100
                            "
                        >

                        @error('email')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Password --}}
                    <div>
                        <label
                            for="password"
                            class="
                                mb-2 flex items-center gap-2
                                text-sm font-medium
                                text-slate-700
                            "
                        >
                            <svg
                                class="h-4 w-4 text-slate-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <rect
                                    x="4"
                                    y="10"
                                    width="16"
                                    height="10"
                                    rx="2"
                                />
                                <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                            </svg>

                            รหัสผ่าน
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            minlength="8"
                            autocomplete="new-password"
                            placeholder="อย่างน้อย 8 ตัวอักษร"
                            class="
                                block w-full rounded-lg
                                border border-slate-300
                                bg-white px-3.5 py-2.5
                                text-sm text-slate-800
                                outline-none transition
                                placeholder:text-slate-400
                                focus:border-blue-500
                                focus:ring-2 focus:ring-blue-100
                            "
                        >

                        <p class="mt-1.5 text-xs text-slate-400">
                            รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร
                        </p>

                        @error('password')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Confirm Password --}}
                    <div>
                        <label
                            for="password_confirmation"
                            class="
                                mb-2 flex items-center gap-2
                                text-sm font-medium
                                text-slate-700
                            "
                        >
                            <svg
                                class="h-4 w-4 text-slate-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <circle cx="12" cy="12" r="9" />
                                <path d="m8.5 12 2.3 2.3 4.7-4.7" />
                            </svg>

                            ยืนยันรหัสผ่าน
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            minlength="8"
                            autocomplete="new-password"
                            placeholder="กรอกรหัสผ่านอีกครั้ง"
                            class="
                                block w-full rounded-lg
                                border border-slate-300
                                bg-white px-3.5 py-2.5
                                text-sm text-slate-800
                                outline-none transition
                                placeholder:text-slate-400
                                focus:border-blue-500
                                focus:ring-2 focus:ring-blue-100
                            "
                        >
                    </div>


                    {{-- Role --}}
                    <div>
                        <label
                            for="is_admin"
                            class="
                                mb-2 flex items-center gap-2
                                text-sm font-medium
                                text-slate-700
                            "
                        >
                            <svg
                                class="h-4 w-4 text-slate-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <path d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z" />
                                <path d="m9 12 2 2 4-4" />
                            </svg>

                            สิทธิ์การใช้งาน
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="is_admin"
                            name="is_admin"
                            required
                            class="
                                block w-full rounded-lg
                                border border-slate-300
                                bg-white px-3.5 py-2.5
                                text-sm text-slate-800
                                outline-none transition
                                focus:border-blue-500
                                focus:ring-2 focus:ring-blue-100
                            "
                        >
                            <option value="">
                                เลือกสิทธิ์การใช้งาน
                            </option>

                            <option
                                value="0"
                                @selected(old('is_admin') === '0')
                            >
                                สมาชิก
                            </option>

                            <option
                                value="1"
                                @selected(old('is_admin') === '1')
                            >
                                ผู้ดูแลระบบ
                            </option>
                        </select>

                        <p class="mt-1.5 text-xs text-slate-400">
                            ผู้ดูแลระบบสามารถจัดการข้อมูลสมาชิกและข้อมูลผู้เชี่ยวชาญได้
                        </p>

                        @error('is_admin')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>


                {{-- Actions --}}
                <div
                    class="
                        mt-8 flex flex-col-reverse gap-3
                        border-t border-slate-200
                        pt-5 sm:flex-row sm:justify-end
                    "
                >

                    {{-- Cancel --}}
                    <a
                        href="{{ route('users.index') }}"
                        class="
                            inline-flex items-center
                            justify-center gap-2
                            rounded-lg
                            border border-slate-300
                            bg-white px-4 py-2.5
                            text-sm font-medium
                            text-slate-700
                            transition
                            hover:bg-slate-50
                            focus:outline-none
                            focus:ring-2
                            focus:ring-slate-200
                        "
                    >
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M6 6l12 12M6 18L18 6" />
                        </svg>

                        ยกเลิก
                    </a>


                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="
                            inline-flex items-center
                            justify-center gap-2
                            rounded-lg
                            bg-blue-600 px-4 py-2.5
                            text-sm font-medium
                            text-white shadow-sm
                            transition
                            hover:bg-blue-700
                            focus:outline-none
                            focus:ring-2
                            focus:ring-blue-500
                            focus:ring-offset-2
                        "
                    >
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M12 5v14" />
                            <path d="M5 12h14" />
                        </svg>

                        เพิ่มสมาชิก
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>
@endsection