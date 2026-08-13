@php
    $currentUser = auth()->user();
    $isAdmin = $currentUser?->is_admin === true;
@endphp

<footer
    class="
        mt-auto border-t border-slate-200
        bg-white
    "
>
    {{-- เนื้อหา Footer --}}
    <div
        class="
            mx-auto grid w-full max-w-6xl gap-8
            px-4 py-10
            sm:grid-cols-2 sm:px-6
            lg:grid-cols-[1.5fr_1fr_1fr]
        "
    >
        {{-- แบรนด์ --}}
        <div>
            <a
                href="{{ route('show-expert') }}"
                class="
                    group inline-flex items-center gap-3
                    rounded-xl focus:outline-none
                    focus:ring-4 focus:ring-blue-100
                "
            >
                <span
                    class="
                        flex h-11 w-11 shrink-0 items-center
                        justify-center rounded-xl
                        bg-gradient-to-br from-blue-600
                        to-indigo-600 text-lg font-bold
                        text-white shadow-sm transition
                        group-hover:scale-105
                    "
                >
                    E
                </span>

                <span>
                    <span
                        class="
                            block text-base font-bold
                            tracking-tight text-slate-900
                        "
                    >
                        Expert Hub
                    </span>

                    <span class="block text-xs text-slate-500">
                        ระบบข้อมูลผู้เชี่ยวชาญ
                    </span>
                </span>
            </a>

            <p
                class="
                    mt-4 max-w-md text-sm
                    leading-7 text-slate-500
                "
            >
                ศูนย์รวมข้อมูลผู้เชี่ยวชาญ ช่วยให้ค้นหา
                และเข้าถึงบุคลากรที่มีความรู้
                และประสบการณ์ในแต่ละสาขาได้สะดวกยิ่งขึ้น
            </p>
        </div>

        {{-- เมนูเว็บไซต์ --}}
        <div>
            <h2
                class="
                    text-sm font-semibold
                    text-slate-900
                "
            >
                เมนูเว็บไซต์
            </h2>

            <nav
                class="
                    mt-4 flex flex-col
                    items-start gap-3
                "
                aria-label="เมนูส่วนท้าย"
            >
                <a
                    href="{{ route('show-expert') }}"
                    class="
                        inline-flex items-center gap-2
                        text-sm text-slate-500 transition
                        hover:text-blue-600
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
                            d="M3 11.5 12 4l9 7.5"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 10v10h14V10"
                        />
                    </svg>

                    หน้ารายชื่อผู้เชี่ยวชาญ
                </a>

                @if ($isAdmin)
                    <a
                        href="{{ route('experts.index') }}"
                        class="
                            inline-flex items-center gap-2
                            text-sm text-slate-500 transition
                            hover:text-blue-600
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
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>

                        จัดการข้อมูล
                    </a>

                    <a
                        href="{{ route('experts.create') }}"
                        class="
                            inline-flex items-center gap-2
                            text-sm text-slate-500 transition
                            hover:text-blue-600
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
                                d="M12 5v14M5 12h14"
                            />
                        </svg>

                        เพิ่มผู้เชี่ยวชาญ
                    </a>
                @endif
            </nav>
        </div>

        {{-- สถานะบัญชี --}}
        <div>
            <h2 class="text-sm font-semibold text-slate-900">
                บัญชีผู้ใช้งาน
            </h2>

            <div class="mt-4">
                @auth
                    <div
                        class="
                            flex items-center gap-3 rounded-2xl
                            border border-slate-200
                            bg-slate-50 p-3
                        "
                    >
                        <span
                            class="
                                flex h-10 w-10 shrink-0
                                items-center justify-center
                                rounded-xl bg-blue-100
                                text-sm font-bold text-blue-700
                            "
                        >
                            {{ mb_strtoupper(
                                mb_substr($currentUser->name, 0, 1)
                            ) }}
                        </span>

                        <div class="min-w-0">
                            <p
                                class="
                                    truncate text-sm font-semibold
                                    text-slate-900
                                "
                            >
                                {{ $currentUser->name }}
                            </p>

                            <div class="mt-1 flex items-center gap-2">
                                <span
                                    class="
                                        h-2 w-2 rounded-full
                                        {{ $isAdmin
                                            ? 'bg-blue-500'
                                            : 'bg-emerald-500'
                                        }}
                                    "
                                ></span>

                                <span class="text-xs text-slate-500">
                                    {{ $isAdmin
                                        ? 'ผู้ดูแลระบบ'
                                        : 'ผู้ใช้งาน'
                                    }}
                                </span>
                            </div>
                        </div>
                    </div>
                @else
                    <p class="text-sm leading-6 text-slate-500">
                        ผู้ดูแลระบบสามารถเข้าสู่ระบบ
                        เพื่อเพิ่มและจัดการข้อมูลผู้เชี่ยวชาญ
                    </p>

                    <a
                        href="{{ route('login') }}"
                        class="
                            mt-4 inline-flex h-10
                            items-center justify-center gap-2
                            rounded-xl border border-slate-200
                            bg-white px-4 text-sm font-semibold
                            text-slate-700 transition
                            hover:border-blue-200 hover:bg-blue-50
                            hover:text-blue-700
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
                                d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m10 17 5-5-5-5M15 12H3"
                            />
                        </svg>

                        เข้าสู่ระบบ
                    </a>
                @endauth
            </div>
        </div>
    </div>

    {{-- แถบด้านล่าง --}}
    <div class="border-t border-slate-100">
        <div
            class="
                mx-auto flex w-full max-w-6xl
                flex-col gap-2 px-4 py-5
                text-xs text-slate-400
                sm:flex-row sm:items-center
                sm:justify-between sm:px-6
            "
        >
            <p>
                © {{ date('Y') }}
                {{ config('app.name', 'Expert Hub') }}.
                สงวนลิขสิทธิ์
            </p>

            <div class="flex items-center gap-2">
                <span
                    class="
                        h-2 w-2 rounded-full
                        bg-emerald-500
                    "
                ></span>

                <span>ระบบพร้อมให้บริการ</span>
            </div>
        </div>
    </div>
</footer>