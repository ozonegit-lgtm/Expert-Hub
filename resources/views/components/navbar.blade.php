<header
    class="
        sticky top-0 z-40 border-b border-slate-200
        bg-white/95 shadow-sm backdrop-blur
    "
>
    <nav
        class="
            mx-auto flex h-16 w-full max-w-6xl
            items-center justify-between gap-4 px-4
        "
    >
        {{-- Logo --}}
        <a
            href="{{ route('show-expert') }}"
            class="
                group flex min-w-0 shrink-0 items-center
                gap-3 rounded-xl focus:outline-none
                focus:ring-4 focus:ring-blue-100
            "
        >
            <span
                class="
                    flex h-10 w-10 shrink-0 items-center
                    justify-center rounded-xl bg-gradient-to-br
                    from-blue-600 to-indigo-600 text-lg
                    font-bold text-white shadow-sm
                    transition duration-200
                    group-hover:scale-105
                "
            >
                E
            </span>

            <span class="hidden min-w-0 sm:block">
                <span
                    class="
                        block truncate text-base font-bold
                        leading-5 tracking-tight text-slate-900
                    "
                >
                    Expert Hub
                </span>

                <span
                    class="
                        block truncate text-xs
                        leading-4 text-slate-500
                    "
                >
                    ระบบข้อมูลผู้เชี่ยวชาญ
                </span>
            </span>
        </a>

        {{-- เมนูด้านขวา --}}
        <div class="flex min-w-0 items-center gap-1 sm:gap-2">
            @auth
                @if (auth()->user()->is_admin)
                    {{-- Admin: หน้าเว็บไซต์ --}}
                    <a
                        href="{{ route('show-expert') }}"
                        class="
                            hidden h-10 items-center justify-center
                            gap-2 rounded-xl px-3 text-sm
                            font-medium transition sm:inline-flex
                            {{ request()->routeIs('show-expert')
                                ? 'bg-blue-50 text-blue-700'
                                : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'
                            }}
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
                                d="M5 10v10h14V10M9 20v-6h6v6"
                            />
                        </svg>

                        หน้าเว็บไซต์
                    </a>

                    {{-- Admin: จัดการข้อมูล --}}
                    <a
                        href="{{ route('experts.index') }}"
                        class="
                            inline-flex h-10 items-center justify-center
                            gap-2 rounded-xl px-3 text-sm
                            font-medium transition
                            {{ request()->routeIs(
                                'experts.index',
                                'experts.edit'
                            )
                                ? 'bg-blue-50 text-blue-700'
                                : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900'
                            }}
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
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>

                        <span class="hidden sm:inline">
                            จัดการข้อมูล
                        </span>

                        <span class="sm:hidden">
                            จัดการ
                        </span>
                    </a>



                    {{-- Admin: เพิ่มผู้เชี่ยวชาญ --}}
                    <a
                        href="{{ route('experts.create') }}"
                        class="
                            inline-flex h-10 shrink-0 items-center
                            justify-center gap-2 rounded-xl
                            bg-blue-600 px-3 text-sm font-semibold
                            text-white shadow-sm transition
                            hover:bg-blue-700 hover:shadow
                            focus:outline-none focus:ring-4
                            focus:ring-blue-100
                        "
                    >
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                d="M12 5v14M5 12h14"
                            />
                        </svg>

                        <span class="hidden md:inline">
                            เพิ่มผู้เชี่ยวชาญ
                        </span>

                        <span class="md:hidden">
                            เพิ่ม
                        </span>
                    </a>
                        {{-- เส้นแบ่ง --}}
                        <span
                            class="
                                mx-1 hidden h-6 w-px
                                bg-slate-200 md:block
                            "
                            aria-hidden="true"
                        >
                        </span>
                    {{-- Admin: ออกจากระบบ --}}
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        class="shrink-0"
                    >
                        @csrf

                        <button
                            type="submit"
                            title="ออกจากระบบ"
                            class="
                                inline-flex h-10 items-center
                                justify-center gap-2 rounded-xl
                                px-3 text-sm font-medium
                                text-slate-500 transition
                                hover:bg-red-50 hover:text-red-600
                                focus:outline-none focus:ring-4
                                focus:ring-red-100
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
                                    d="M10 17l5-5-5-5M15 12H3"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14 4h5a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-5"
                                />
                            </svg>

                            <span class="hidden lg:inline">
                                ออกจากระบบ
                            </span>
                        </button>
                    </form>
                @else
                    {{-- User ที่ Login แล้ว --}}
                    <a
                        href="{{ route('show-expert') }}"
                        class="
                            inline-flex h-10 items-center
                            justify-center rounded-xl bg-blue-50
                            px-3 text-sm font-medium text-blue-700
                        "
                    >
                        ผู้เชี่ยวชาญ
                    </a>

                    <span
                        class="
                            hidden max-w-36 truncate px-2
                            text-sm font-medium text-slate-600
                            md:block
                        "
                    >
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="
                                inline-flex h-10 items-center
                                justify-center rounded-xl px-3
                                text-sm font-medium text-slate-500
                                transition hover:bg-red-50
                                hover:text-red-600
                            "
                        >
                            ออกจากระบบ
                        </button>
                    </form>
                @endif
            @else
                {{-- ผู้ใช้งานทั่วไป --}}
                <a
                    href="{{ route('show-expert') }}"
                    class="
                        inline-flex h-10 items-center justify-center
                        gap-2 rounded-xl bg-blue-50 px-3
                        text-sm font-medium text-blue-700
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
                            d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                        />

                        <circle cx="9" cy="7" r="4" />

                        <path
                            stroke-linecap="round"
                            d="M19 8v6M22 11h-6"
                        />
                    </svg>

                    <span class="hidden sm:inline">
                        ผู้เชี่ยวชาญ
                    </span>

                    <span class="sm:hidden">
                        รายชื่อ
                    </span>
                </a>

                <a
                    href="{{ route('login') }}"
                    class="
                        inline-flex h-10 items-center justify-center
                        gap-2 rounded-xl bg-slate-900 px-4
                        text-sm font-semibold text-white
                        shadow-sm transition hover:bg-slate-800
                        focus:outline-none focus:ring-4
                        focus:ring-slate-200
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
                            d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3"
                        />
                    </svg>

                    เข้าสู่ระบบ
                </a>
            @endauth
        </div>
    </nav>
</header>