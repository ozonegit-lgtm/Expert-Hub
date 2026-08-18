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

            <div class="mt-3 flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-white shadow-sm">
                    <svg
                            class="h-6 w-6"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                </div>

                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        รายละเอียดสมาชิก
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        ข้อมูลบัญชีผู้ใช้งาน Expert-Hub
                    </p>
                </div>
            </div>
        </div>

        {{-- User Profile Card --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            {{-- Profile Header --}}
            <div class="border-b border-slate-200 px-5 py-6 sm:px-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                    {{-- Avatar --}}
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-blue-50 text-xl font-semibold text-blue-600 ring-4 ring-blue-50">
                        {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                    </div>

                    {{-- Name --}}
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 class="text-xl font-semibold text-slate-800">
                                {{ $user->name }}
                            </h2>

                            @if ($user->is_admin)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3.5 w-3.5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"
                                        />
                                    </svg>

                                    ผู้ดูแลระบบ
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3.5 w-3.5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 19a4 4 0 00-8 0m4-8a4 4 0 100-8 4 4 0 000 8zm9 4a3 3 0 00-3-3"
                                        />
                                    </svg>

                                    สมาชิก
                                </span>
                            @endif
                        </div>

                        <div class="mt-1 flex items-center gap-1.5 text-sm text-slate-500">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 shrink-0"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 8l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"
                                />
                            </svg>

                            <span class="break-all">
                                {{ $user->email }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            {{-- User Information --}}
            <div class="px-5 py-6 sm:px-6">

                <div class="mb-4 flex items-center gap-2">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
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
                                d="M9 12h6m-6 4h6M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                            />
                        </svg>
                    </div>

                    <h3 class="text-base font-semibold text-slate-800">
                        ข้อมูลบัญชี
                    </h3>
                </div>

                <div class="divide-y divide-slate-100 overflow-hidden rounded-lg border border-slate-200">

                    {{-- Name --}}
                    <div class="grid gap-3 px-4 py-4 sm:grid-cols-3 sm:gap-4">
                        <div class="flex items-center gap-2 text-sm font-medium text-slate-500">
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
                                    d="M15 19a4 4 0 00-8 0m4-8a4 4 0 100-8 4 4 0 000 8z"
                                />
                            </svg>

                            ชื่อสมาชิก
                        </div>

                        <div class="text-sm font-medium text-slate-800 sm:col-span-2">
                            {{ $user->name }}
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="grid gap-3 px-4 py-4 sm:grid-cols-3 sm:gap-4">
                        <div class="flex items-center gap-2 text-sm font-medium text-slate-500">
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
                                    d="M3 8l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"
                                />
                            </svg>

                            อีเมล
                        </div>

                        <div class="break-all text-sm text-slate-800 sm:col-span-2">
                            {{ $user->email }}
                        </div>
                    </div>

                    {{-- Role --}}
                    <div class="grid gap-3 px-4 py-4 sm:grid-cols-3 sm:gap-4">
                        <div class="flex items-center gap-2 text-sm font-medium text-slate-500">
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
                                    d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4z"
                                />
                            </svg>

                            สิทธิ์การใช้งาน
                        </div>

                        <div class="sm:col-span-2">
                            @if ($user->is_admin)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-600"></span>
                                    ผู้ดูแลระบบ
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                    สมาชิก
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Created At --}}
                    <div class="grid gap-3 px-4 py-4 sm:grid-cols-3 sm:gap-4">
                        <div class="flex items-center gap-2 text-sm font-medium text-slate-500">
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
                                    d="M8 2v4m8-4v4M3 10h18M5 4h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"
                                />
                            </svg>

                            วันที่สร้างบัญชี
                        </div>

                        <div class="text-sm text-slate-800 sm:col-span-2">
                            {{ $user->created_at?->format('d/m/Y H:i') ?? '-' }}
                        </div>
                    </div>

                    {{-- Updated At --}}
                    <div class="grid gap-3 px-4 py-4 sm:grid-cols-3 sm:gap-4">
                        <div class="flex items-center gap-2 text-sm font-medium text-slate-500">
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
                                    d="M12 6v6l4 2m5-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>

                            แก้ไขล่าสุด
                        </div>

                        <div class="text-sm text-slate-800 sm:col-span-2">
                            {{ $user->updated_at?->format('d/m/Y H:i') ?? '-' }}
                        </div>
                    </div>

                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-5 py-4 sm:flex-row sm:justify-end sm:px-6">

                {{-- Back --}}
                <a
                    href="{{ route('users.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
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

                    กลับ
                </a>

                {{-- Edit --}}
                <a
                    href="{{ route('users.edit', $user) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
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
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.5 16.153 6 17.5l1.347-4.5L16.862 4.487z"
                        />
                    </svg>

                    แก้ไขข้อมูล
                </a>

                {{-- Delete --}}
                @if ($user->id !== auth()->id())
                    <form
                        action="{{ route('users.destroy', $user) }}"
                        method="POST"
                        onsubmit="return confirm('คุณต้องการลบสมาชิกคนนี้ใช่หรือไม่?');"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-red-200 bg-white px-4 py-2.5 text-sm font-medium text-red-600 transition hover:bg-red-50 sm:w-auto"
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
                                    d="M6 7h12M9 7V4h6v3m-8 0l1 13h8l1-13M10 11v5m4-5v5"
                                />
                            </svg>

                            ลบสมาชิก
                        </button>
                    </form>
                @endif

            </div>

        </div>
    </div>
</div>
@endsection