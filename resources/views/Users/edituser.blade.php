@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f1f5f9] px-4 py-6 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-3xl">

        {{-- Header --}}
        <div class="mb-6">
            <a
                href="{{ route('users.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-blue-600"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                กลับไปหน้าสมาชิก
            </a>

            <div class="mt-4 flex items-start gap-3">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"
                        />
                    </svg>
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        แก้ไขข้อมูลสมาชิก
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        แก้ไขข้อมูลบัญชีของ {{ $user->name }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-4">
                <div class="flex gap-3">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13A2 2 0 004.52 20h14.96a2 2 0 001.73-3.14l-7.5-13a2 2 0 00-3.42 0z"
                        />
                    </svg>

                    <div>
                        <p class="text-sm font-semibold text-red-700">
                            กรุณาตรวจสอบข้อมูล
                        </p>

                        <ul class="mt-1 list-disc pl-5 text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form Card --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Card Header --}}
            <div class="border-b border-slate-200 px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">

                    {{-- Avatar --}}
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-50 text-sm font-semibold text-blue-600">
                        {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0">
                        <h2 class="truncate text-base font-semibold text-slate-800">
                            {{ $user->name }}
                        </h2>

                        <div class="mt-0.5 flex items-center gap-1.5 text-sm text-slate-500">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-3.5 w-3.5 shrink-0"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615A2.25 2.25 0 012.25 6.993V6.75"
                                />
                            </svg>

                            <span class="truncate">
                                {{ $user->email }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Form --}}
            <form
                action="{{ route('users.update', $user) }}"
                method="POST"
                class="px-5 py-6 sm:px-6"
            >
                @csrf
                @method('PUT')

                <div class="space-y-6">

                    {{-- Name --}}
                    <div>
                        <label
                            for="name"
                            class="mb-2 flex items-center gap-2 text-sm font-medium text-slate-700"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"
                                />
                            </svg>

                            ชื่อสมาชิก
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                            maxlength="255"
                            autocomplete="name"
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
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
                            class="mb-2 flex items-center gap-2 text-sm font-medium text-slate-700"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615A2.25 2.25 0 012.25 6.993V6.75"
                                />
                            </svg>

                            อีเมล
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            maxlength="255"
                            autocomplete="email"
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >

                        @error('email')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Password Section --}}
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4 sm:p-5">

                        <div class="mb-4 flex items-start gap-3">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white text-slate-500 shadow-sm">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 00-9 0v3.75m-.75 0h10.5A1.75 1.75 0 0119 12.25v7A1.75 1.75 0 0117.25 21h-10.5A1.75 1.75 0 015 19.25v-7a1.75 1.75 0 011.75-1.75z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-sm font-semibold text-slate-800">
                                    เปลี่ยนรหัสผ่าน
                                </h3>

                                <p class="mt-1 text-xs text-slate-500">
                                    หากไม่ต้องการเปลี่ยนรหัสผ่าน ให้เว้นช่องนี้ว่างไว้
                                </p>
                            </div>
                        </div>

                        <div class="space-y-5">

                            {{-- New Password --}}
                            <div>
                                <label
                                    for="password"
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    รหัสผ่านใหม่
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    minlength="8"
                                    autocomplete="new-password"
                                    placeholder="กรอกรหัสผ่านใหม่"
                                    class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                >

                                <p class="mt-1.5 text-xs text-slate-400">
                                    อย่างน้อย 8 ตัวอักษร
                                </p>

                                @error('password')
                                    <p class="mt-1.5 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Confirm New Password --}}
                            <div>
                                <label
                                    for="password_confirmation"
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    ยืนยันรหัสผ่านใหม่
                                </label>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    minlength="8"
                                    autocomplete="new-password"
                                    placeholder="กรอกรหัสผ่านใหม่อีกครั้ง"
                                    class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                >
                            </div>

                        </div>
                    </div>

                    {{-- Role --}}
                    <div>
                        <label
                            for="is_admin"
                            class="mb-2 flex items-center gap-2 text-sm font-medium text-slate-700"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-400"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75m-3-7.5a9 9 0 110 18 9 9 0 010-18z"
                                />
                            </svg>

                            สิทธิ์การใช้งาน
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="is_admin"
                            name="is_admin"
                            required
                            class="block w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        >
                            <option
                                value="0"
                                @selected(old('is_admin', $user->is_admin ? '1' : '0') === '0')
                            >
                                สมาชิก
                            </option>

                            <option
                                value="1"
                                @selected(old('is_admin', $user->is_admin ? '1' : '0') === '1')
                            >
                                ผู้ดูแลระบบ
                            </option>
                        </select>

                        <p class="mt-1.5 text-xs text-slate-400">
                            ผู้ดูแลระบบสามารถจัดการสมาชิกและข้อมูลผู้เชี่ยวชาญได้
                        </p>

                        @error('is_admin')
                            <p class="mt-1.5 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                {{-- Actions --}}
                <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('users.show', $user) }}"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>

                        ยกเลิก
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        บันทึกการเปลี่ยนแปลง
                    </button>

                </div>
            </form>
        </div>

    </div>
</div>
@endsection