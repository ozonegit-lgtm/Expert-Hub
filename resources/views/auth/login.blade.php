@extends('layouts.app')

@section('title', 'เข้าสู่ระบบ')

@section('content')
    <div class="mx-auto w-full max-w-md py-8 sm:py-12">
        <div class="mb-8 text-center">
            {{-- <div
                class="
                    mx-auto mb-4 flex h-14 w-14 items-center
                    justify-center rounded-2xl bg-blue-100
                    text-2xl text-blue-700
                "
            >
                🔐
            </div> --}}

            <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                เข้าสู่ระบบ
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                กรอกอีเมลและรหัสผ่านของผู้ดูแลระบบ
            </p>
        </div>

        <form
            method="POST"
            action="{{ route('login.store') }}"
            class="
                rounded-2xl border border-slate-200 bg-white
                p-6 shadow-sm sm:p-8
            "
        >
            @csrf

            <div class="space-y-6">
                <div>
                    <label
                        for="email"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        อีเมล
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        placeholder="admin@example.com"
                        autofocus
                        required
                        class="
                            block w-full rounded-xl border border-slate-300
                            bg-white px-4 py-3 text-slate-900
                            placeholder:text-slate-400
                            focus:border-blue-500 focus:outline-none
                            focus:ring-4 focus:ring-blue-100
                            @error('email')
                                border-red-400 focus:border-red-500
                                focus:ring-red-100
                            @enderror
                        "
                    >

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label
                        for="password"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        รหัสผ่าน
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        placeholder="กรอกรหัสผ่าน"
                        required
                        class="
                            block w-full rounded-xl border border-slate-300
                            bg-white px-4 py-3 text-slate-900
                            placeholder:text-slate-400
                            focus:border-blue-500 focus:outline-none
                            focus:ring-4 focus:ring-blue-100
                            @error('password')
                                border-red-400 focus:border-red-500
                                focus:ring-red-100
                            @enderror
                        "
                    >

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <label
                    class="
                        inline-flex cursor-pointer items-center
                        gap-3 text-sm text-slate-600
                    "
                >
                    <input
                        name="remember"
                        type="checkbox"
                        value="1"
                        @checked(old('remember'))
                        class="
                            h-4 w-4 rounded border-slate-300
                            text-blue-600 focus:ring-blue-500
                        "
                    >

                    <span>จดจำการเข้าสู่ระบบ</span>
                </label>

                <button
                    type="submit"
                    class="
                        inline-flex w-full items-center justify-center
                        rounded-xl bg-blue-600 px-4 py-3
                        font-semibold text-white shadow-sm
                        transition hover:bg-blue-700
                        focus:outline-none focus:ring-4 focus:ring-blue-200
                    "
                >
                    เข้าสู่ระบบ
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a
                href="{{ route('experts.index') }}"
                class="
                    text-sm font-medium text-slate-500
                    transition hover:text-blue-600
                "
            >
                ← กลับหน้ารายชื่อผู้เชี่ยวชาญ
            </a>
        </div>
    </div>
@endsection