<header class="sticky top-0 z-40 w-full">
    <nav
        class="
            flex min-h-16 w-full
            items-center justify-between
            border-b border-slate-200
            bg-white px-5
            shadow-sm
        "
    >

        {{-- Logo --}}
        <a
            href="{{ route('show-expert') }}"
            class="group flex shrink-0 items-center gap-3"
        >
            <span
                class="
                    flex h-9 w-9 shrink-0
                    items-center justify-center
                    rounded-lg bg-blue-600
                    text-lg font-bold text-white
                    shadow-sm transition
                    group-hover:bg-blue-700
                "
            >
                E
            </span>

            <span class="hidden sm:block">
                <span
                    class="
                        block text-sm font-bold
                        leading-4 tracking-tight
                        text-slate-900
                    "
                >
                    Expert Hub
                </span>

                <span
                    class="
                        block text-[11px]
                        leading-4
                        text-slate-500
                    "
                >
                    ระบบข้อมูลผู้เชี่ยวชาญ
                </span>
            </span>
        </a>


        {{-- เมนู --}}
        <div class="flex items-center gap-1 sm:gap-2">

            @auth

                @if (auth()->user()->is_admin)

                    {{-- หน้าเว็บไซต์ --}}
                    <a
                        href="{{ route('show-expert') }}"
                        class="
                            hidden items-center gap-2
                            rounded-lg px-3 py-2
                            text-sm font-medium
                            transition
                            sm:inline-flex
                            {{ request()->routeIs('show-expert')
                                ? 'bg-blue-50 text-blue-700'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-blue-700'
                            }}
                        "
                    >
                        {{-- Home Icon --}}
                        <svg
                            class="h-4 w-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m2.25 12 9.204-7.054a.75.75 0 0 1 .914 0L21.75 12M4.5 10.5v8.25a.75.75 0 0 0 .75.75h4.5v-5.25h3v5.25h4.5a.75.75 0 0 0 .75-.75V10.5"
                            />
                        </svg>

                        <span>หน้าเว็บไซต์</span>
                    </a>


                    {{-- จัดการข้อมูล --}}
                    <a
                        href="{{ route('experts.index') }}"
                        class="
                            hidden items-center gap-2
                            rounded-lg px-3 py-2
                            text-sm font-medium
                            transition
                            md:inline-flex
                            {{ request()->routeIs('experts.index')
                                || request()->routeIs('experts.show')
                                || request()->routeIs('experts.edit')
                                    ? 'bg-blue-50 text-blue-700'
                                    : 'text-slate-600 hover:bg-slate-50 hover:text-blue-700'
                            }}
                        "
                    >
                        {{-- Users/Database Icon --}}
                        <svg
                            class="h-4 w-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 6.75c4.142 0 7.5-1.007 7.5-2.25S16.142 2.25 12 2.25 4.5 3.257 4.5 4.5 7.858 6.75 12 6.75Z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 4.5v7.5c0 1.243 3.358 2.25 7.5 2.25s7.5-1.007 7.5-2.25V4.5"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 12v7.5c0 1.243 3.358 2.25 7.5 2.25s7.5-1.007 7.5-2.25V12"
                            />
                        </svg>

                        <span>จัดการข้อมูล</span>
                    </a>


                    {{-- เพิ่มผู้เชี่ยวชาญ --}}
                    <a
                        href="{{ route('experts.create') }}"
                        class="
                            hidden items-center gap-2
                            rounded-lg px-3 py-2
                            text-sm font-medium
                            transition
                            lg:inline-flex
                            {{ request()->routeIs('experts.create')
                                ? 'bg-blue-50 text-blue-700'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-blue-700'
                            }}
                        "
                    >
                        {{-- User Plus Icon --}}
                        <svg
                            class="h-4 w-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19.5a6.75 6.75 0 0 0-13.5 0"
                            />
                            <circle
                                cx="8.25"
                                cy="8.25"
                                r="3.75"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 8.25v6.5M22.25 11.5h-6.5"
                            />
                        </svg>

                        <span>เพิ่มผู้เชี่ยวชาญ</span>
                    </a>


                    {{-- จัดการสมาชิก --}}
                    <a
                        href="{{ route('users.index') }}"
                        class="
                            hidden items-center gap-2
                            rounded-lg px-3 py-2
                            text-sm font-medium
                            transition
                            md:inline-flex
                            {{ request()->routeIs('users.*')
                                ? 'bg-blue-50 text-blue-700'
                                : 'text-slate-600 hover:bg-slate-50 hover:text-blue-700'
                            }}
                        "
                    >
                        {{-- Users Icon --}}
                        <svg
                            class="h-4 w-4 shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19.5a6.75 6.75 0 0 0-13.5 0"
                            />
                            <circle
                                cx="8.25"
                                cy="8.25"
                                r="3.75"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17.25 11.25a3 3 0 1 0 0-6M21.75 19.5a6.75 6.75 0 0 0-5.25-6.56"
                            />
                        </svg>

                        <span>จัดการสมาชิก</span>
                    </a>


                    {{-- ปุ่มเพิ่มผู้เชี่ยวชาญ --}}
                    


                    {{-- เส้นแบ่ง --}}
                    <span
                        class="
                            mx-1 hidden h-6 w-px
                            bg-slate-200
                            lg:block
                        "
                    ></span>


                    {{-- Logout --}}
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                        class="shrink-0"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="
                                inline-flex items-center gap-1.5
                                rounded-lg px-2.5 py-2
                                text-sm font-medium
                                text-slate-500
                                transition
                                hover:bg-red-50
                                hover:text-red-600
                            "
                            title="ออกจากระบบ"
                        >
                            {{-- Logout Icon --}}
                            <svg
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M18 8.25 21.75 12 18 15.75M21.75 12H9"
                                />
                            </svg>

                            <span class="hidden lg:inline">
                                ออกจากระบบ
                            </span>

                            <span class="lg:hidden">
                                ออก
                            </span>
                        </button>
                    </form>

                @else

                    {{-- User --}}
                    <a
                        href="{{ route('show-expert') }}"
                        class="
                            inline-flex items-center gap-2
                            rounded-lg px-3 py-2
                            text-sm font-medium
                            text-slate-600
                            transition
                            hover:bg-slate-50
                            hover:text-blue-700
                        "
                    >
                        {{-- Users Icon --}}
                        <svg
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19.5a6.75 6.75 0 0 0-13.5 0"
                            />
                            <circle
                                cx="8.25"
                                cy="8.25"
                                r="3.75"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17.25 11.25a3 3 0 1 0 0-6M21.75 19.5a6.75 6.75 0 0 0-5.25-6.56"
                            />
                        </svg>

                        <span>ผู้เชี่ยวชาญ</span>
                    </a>

                    <span
                        class="
                            hidden max-w-36 truncate
                            px-2 text-sm
                            text-slate-500
                            md:block
                        "
                    >
                        {{ auth()->user()->name }}
                    </span>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="
                                inline-flex items-center gap-2
                                rounded-lg px-3 py-2
                                text-sm font-medium
                                text-slate-500
                                transition
                                hover:bg-red-50
                                hover:text-red-600
                            "
                        >
                            {{-- Logout Icon --}}
                            <svg
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M18 8.25 21.75 12 18 15.75M21.75 12H9"
                                />
                            </svg>

                            <span>ออกจากระบบ</span>
                        </button>
                    </form>

                @endif

            @else

                {{-- ผู้ใช้งานทั่วไป --}}
                <a
                    href="{{ route('show-expert') }}"
                    class="
                        hidden items-center gap-2
                        rounded-lg px-3 py-2
                        text-sm font-medium
                        text-slate-600
                        transition
                        hover:bg-slate-50
                        hover:text-blue-700
                        sm:inline-flex
                    "
                >
                    {{-- Users Icon --}}
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19.5a6.75 6.75 0 0 0-13.5 0"
                        />
                        <circle
                            cx="8.25"
                            cy="8.25"
                            r="3.75"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M17.25 11.25a3 3 0 1 0 0-6M21.75 19.5a6.75 6.75 0 0 0-5.25-6.56"
                        />
                    </svg>

                    <span>ผู้เชี่ยวชาญ</span>
                </a>


                {{-- Login --}}
                <a
                    href="{{ route('login') }}"
                    class="
                        ml-1 inline-flex
                        items-center justify-center gap-2
                        rounded-full
                        bg-blue-600
                        px-4 py-2
                        text-sm font-semibold
                        text-white
                        transition
                        hover:bg-blue-700
                        focus:outline-none
                        focus:ring-2
                        focus:ring-blue-400
                        focus:ring-offset-2
                        focus:ring-offset-white
                    "
                >
                    {{-- Login Icon --}}
                    <svg
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M18 8.25 21.75 12 18 15.75M21.75 12H9"
                        />
                    </svg>

                    <span>เข้าสู่ระบบ</span>
                </a>

            @endauth

        </div>
    </nav>
</header>