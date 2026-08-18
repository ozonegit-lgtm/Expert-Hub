@extends('layouts.app')

@section('title', 'จัดการสมาชิก')

@section('content')

<div class="min-h-screen bg-[#f1f5f9] px-4 py-8 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-6xl">

        {{-- Header --}}
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="flex items-center gap-3">

                    {{-- Users Icon --}}
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
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
                        <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                            จัดการสมาชิก
                        </h1>

                        <p class="mt-1 text-sm text-slate-500">
                            จัดการข้อมูลผู้ใช้งานระบบ Expert Hub
                        </p>
                    </div>

                </div>
            </div>


            {{-- Add User --}}
            <a
                href="{{ route('users.create') }}"
                class="
                    inline-flex items-center justify-center gap-2
                    rounded-lg
                    bg-blue-600
                    px-4 py-2.5
                    text-sm font-semibold
                    text-white
                    shadow-sm
                    transition
                    hover:bg-blue-700
                    focus:outline-none
                    focus:ring-2
                    focus:ring-blue-500
                    focus:ring-offset-2
                "
            >

                {{-- Plus Icon --}}
                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M12 5v14" />
                    <path d="M5 12h14" />
                </svg>

                <span>
                    เพิ่มสมาชิก
                </span>

            </a>

        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="
                    mb-5 flex items-start gap-3
                    rounded-xl
                    border border-emerald-200
                    bg-emerald-50
                    px-4 py-3
                    text-sm text-emerald-700
                "
            >
                <svg
                    class="mt-0.5 h-5 w-5 shrink-0"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M20 6 9 17l-5-5" />
                </svg>

                <span>
                    {{ session('success') }}
                </span>
            </div>
        @endif


        {{-- Error Message --}}
        @if (session('error'))
            <div
                class="
                    mb-5 flex items-start gap-3
                    rounded-xl
                    border border-red-200
                    bg-red-50
                    px-4 py-3
                    text-sm text-red-700
                "
            >
                <svg
                    class="mt-0.5 h-5 w-5 shrink-0"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <circle cx="12" cy="12" r="9" />
                    <path d="M12 8v4" />
                    <path d="M12 16h.01" />
                </svg>

                <span>
                    {{ session('error') }}
                </span>
            </div>
        @endif


        {{-- Main Card --}}
        <div
            class="
                overflow-hidden
                rounded-2xl
                border border-slate-200
                bg-white
                shadow-sm
            "
        >

            {{-- Card Header --}}
            <div
                class="
                    flex flex-col gap-2
                    border-b border-slate-200
                    px-5 py-5
                    sm:flex-row sm:items-center sm:justify-between
                "
            >

                <div class="flex items-center gap-3">

                    {{-- List Icon --}}
                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M8 6h13" />
                            <path d="M8 12h13" />
                            <path d="M8 18h13" />
                            <path d="M3 6h.01" />
                            <path d="M3 12h.01" />
                            <path d="M3 18h.01" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="font-semibold text-slate-900">
                            รายชื่อสมาชิก
                        </h2>

                        <p class="text-sm text-slate-500">
                            สมาชิกทั้งหมด {{ $users->total() }} คน
                        </p>
                    </div>

                </div>

            </div>


            {{-- Desktop Table --}}
            <div class="hidden overflow-x-auto md:block">

                <table class="w-full text-left">

                    <thead class="bg-slate-50">
                        <tr class="border-b border-slate-200">

                            <th class="w-16 px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                #
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                ชื่อ
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                อีเมล
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                สิทธิ์
                            </th>

                            <th class="px-5 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">
                                วันที่สร้าง
                            </th>

                            <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                                จัดการ
                            </th>

                        </tr>
                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($users as $user)

                            <tr class="transition hover:bg-slate-50">

                                {{-- ID --}}
                                <td class="px-5 py-4 text-sm text-slate-500">
                                    {{ $users->firstItem() + $loop->index }}
                                </td>


                                {{-- Name --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="
                                                flex h-10 w-10 shrink-0
                                                items-center justify-center
                                                rounded-full
                                                bg-blue-50
                                                font-semibold
                                                text-blue-600
                                            "
                                        >
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">

                                            <p class="truncate font-medium text-slate-900">
                                                {{ $user->name }}
                                            </p>

                                            @if ($user->id === auth()->id())
                                                <p class="text-xs text-slate-400">
                                                    บัญชีของคุณ
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Email --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-2 text-sm text-slate-600">

                                        {{-- Email Icon --}}
                                        <svg
                                            class="h-4 w-4 shrink-0 text-slate-400"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
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

                                        <span>
                                            {{ $user->email }}
                                        </span>

                                    </div>

                                </td>


                                {{-- Role --}}
                                <td class="px-5 py-4">

                                    @if ($user->is_admin)

                                        <span
                                            class="
                                                inline-flex items-center gap-1.5
                                                rounded-full
                                                bg-blue-50
                                                px-2.5 py-1
                                                text-xs font-semibold
                                                text-blue-700
                                            "
                                        >
                                            <svg
                                                class="h-3.5 w-3.5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path d="M12 3 4 7v5c0 5 3.5 8 8 9 4.5-1 8-4 8-9V7l-8-4Z" />
                                            </svg>

                                            ผู้ดูแลระบบ
                                        </span>

                                    @else

                                        <span
                                            class="
                                                inline-flex items-center gap-1.5
                                                rounded-full
                                                bg-slate-100
                                                px-2.5 py-1
                                                text-xs font-semibold
                                                text-slate-600
                                            "
                                        >
                                            <svg
                                                class="h-3.5 w-3.5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <circle cx="12" cy="8" r="3" />
                                                <path d="M5 21a7 7 0 0 1 14 0" />
                                            </svg>

                                            ผู้ใช้งาน
                                        </span>

                                    @endif

                                </td>


                                {{-- Created --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-2 text-sm text-slate-500">

                                        {{-- Calendar Icon --}}
                                        <svg
                                            class="h-4 w-4 shrink-0 text-slate-400"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <rect
                                                x="3"
                                                y="4"
                                                width="18"
                                                height="17"
                                                rx="2"
                                            />
                                            <path d="M16 2v4" />
                                            <path d="M8 2v4" />
                                            <path d="M3 10h18" />
                                        </svg>

                                        {{ $user->created_at?->format('d/m/Y') }}

                                    </div>

                                </td>


                                {{-- Actions --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-end gap-1">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('users.show', $user) }}"
                                            class="
                                                inline-flex h-9 w-9
                                                items-center justify-center
                                                rounded-lg
                                                text-slate-500
                                                transition
                                                hover:bg-slate-100
                                                hover:text-slate-700
                                            "
                                            title="ดูข้อมูล"
                                        >
                                            <svg
                                                class="h-4.5 w-4.5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            class="
                                                inline-flex h-9 w-9
                                                items-center justify-center
                                                rounded-lg
                                                text-blue-600
                                                transition
                                                hover:bg-blue-50
                                                hover:text-blue-700
                                            "
                                            title="แก้ไข"
                                        >
                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                            </svg>
                                        </a>


                                        {{-- Delete --}}
                                        @if ($user->id !== auth()->id())

                                            <form
                                                method="POST"
                                                action="{{ route('users.destroy', $user) }}"
                                                onsubmit="return confirm('ต้องการลบสมาชิกคนนี้ใช่หรือไม่?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="
                                                        inline-flex h-9 w-9
                                                        items-center justify-center
                                                        rounded-lg
                                                        text-red-500
                                                        transition
                                                        hover:bg-red-50
                                                        hover:text-red-700
                                                    "
                                                    title="ลบ"
                                                >
                                                    <svg
                                                        class="h-4 w-4"
                                                        viewBox="0 0 24 24"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="1.8"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                    >
                                                        <path d="M3 6h18" />
                                                        <path d="M8 6V4h8v2" />
                                                        <path d="M19 6l-1 15H6L5 6" />
                                                        <path d="M10 11v6" />
                                                        <path d="M14 11v6" />
                                                    </svg>
                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="6"
                                    class="px-5 py-14 text-center"
                                >

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="
                                                mb-3 flex h-12 w-12
                                                items-center justify-center
                                                rounded-full
                                                bg-slate-100
                                                text-slate-400
                                            "
                                        >
                                            <svg
                                                class="h-6 w-6"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                                <circle cx="9" cy="7" r="4" />
                                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                            </svg>
                                        </div>

                                        <p class="font-medium text-slate-700">
                                            ยังไม่มีสมาชิก
                                        </p>

                                        <p class="mt-1 text-sm text-slate-400">
                                            เริ่มต้นด้วยการเพิ่มสมาชิกใหม่
                                        </p>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Mobile Cards --}}
            <div class="divide-y divide-slate-100 md:hidden">

                @forelse ($users as $user)

                    <div class="p-4">

                        <div class="flex items-start justify-between gap-3">

                            <div class="flex min-w-0 items-center gap-3">

                                <div
                                    class="
                                        flex h-10 w-10 shrink-0
                                        items-center justify-center
                                        rounded-full
                                        bg-blue-50
                                        font-semibold
                                        text-blue-600
                                    "
                                >
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>

                                <div class="min-w-0">

                                    <p class="truncate font-medium text-slate-900">
                                        {{ $user->name }}
                                    </p>

                                    <p class="truncate text-sm text-slate-500">
                                        {{ $user->email }}
                                    </p>

                                </div>

                            </div>


                            @if ($user->is_admin)
                                <span
                                    class="
                                        shrink-0 rounded-full
                                        bg-blue-50
                                        px-2 py-1
                                        text-xs font-semibold
                                        text-blue-700
                                    "
                                >
                                    ผู้ดูแลระบบ
                                </span>
                            @else
                                <span
                                    class="
                                        shrink-0 rounded-full
                                        bg-slate-100
                                        px-2 py-1
                                        text-xs font-semibold
                                        text-slate-600
                                    "
                                >
                                    ผู้ใช้งาน
                                </span>
                            @endif

                        </div>


                        <div class="mt-4 flex items-center justify-between">

                            <span class="text-xs text-slate-400">
                                {{ $user->created_at?->format('d/m/Y') }}
                            </span>

                            <div class="flex items-center gap-1">

                                <a
                                    href="{{ route('users.show', $user) }}"
                                    class="
                                        rounded-lg p-2
                                        text-slate-500
                                        hover:bg-slate-100
                                    "
                                    title="ดูข้อมูล"
                                >
                                    <svg
                                        class="h-4 w-4"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </a>

                                <a
                                    href="{{ route('users.edit', $user) }}"
                                    class="
                                        rounded-lg p-2
                                        text-blue-600
                                        hover:bg-blue-50
                                    "
                                    title="แก้ไข"
                                >
                                    <svg
                                        class="h-4 w-4"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path d="M12 20h9" />
                                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />
                                    </svg>
                                </a>

                                @if ($user->id !== auth()->id())

                                    <form
                                        method="POST"
                                        action="{{ route('users.destroy', $user) }}"
                                        onsubmit="return confirm('ต้องการลบสมาชิกคนนี้ใช่หรือไม่?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="
                                                rounded-lg p-2
                                                text-red-500
                                                hover:bg-red-50
                                            "
                                            title="ลบ"
                                        >
                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path d="M3 6h18" />
                                                <path d="M8 6V4h8v2" />
                                                <path d="M19 6l-1 15H6L5 6" />
                                            </svg>
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="px-5 py-14 text-center">

                        <p class="font-medium text-slate-700">
                            ยังไม่มีสมาชิก
                        </p>

                        <p class="mt-1 text-sm text-slate-400">
                            เริ่มต้นด้วยการเพิ่มสมาชิกใหม่
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- Pagination --}}
            @if ($users->hasPages())

                <div class="border-t border-slate-200 px-5 py-4">
                    {{ $users->links() }}
                </div>

            @endif

        </div>

    </div>

</div>

@endsection