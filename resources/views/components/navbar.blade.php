<header
    class="
        sticky top-0 z-40 border-b border-slate-800
        bg-slate-950 text-white shadow-lg shadow-slate-900/10
    "
>
    <nav
        class="
            mx-auto flex h-[72px] w-full max-w-6xl
            items-center justify-between gap-6 px-4
        "
    >
        {{-- Brand --}}
        <a
            href="{{ route('experts.index') }}"
            class="group flex shrink-0 items-center gap-3"
        >
            <span
                class="
                    flex h-10 w-10 items-center justify-center
                    rounded-xl bg-blue-600 text-lg font-bold
                    text-white shadow-sm transition
                    group-hover:bg-blue-500
                "
            >
                E
            </span>

            <span class="hidden sm:block">
                <span class="block text-base font-bold leading-tight text-white">
                    Expert Hub
                </span>

                <span class="block text-xs leading-tight text-slate-400">
                    ระบบข้อมูลผู้เชี่ยวชาญ
                </span>
            </span>
        </a>

        {{-- Menu --}}
        <div class="flex min-w-0 items-center gap-1">
            <a
                href="{{ route('show-expert') }}"
                class="
                    inline-flex h-10 items-center justify-center
                    rounded-lg px-3 text-sm font-medium transition
                    {{ request()->routeIs('show-expert')
                        ? 'bg-slate-800 text-white'
                        : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                    }}
                "
            >
                ผู้เชี่ยวชาญ
            </a>

            @auth
                @if (auth()->user()->is_admin)
                    <a
                        href="{{ route('experts.index') }}"
                        class="
                            hidden h-10 items-center justify-center
                            rounded-lg px-3 text-sm font-medium
                            transition sm:inline-flex
                            {{ request()->routeIs(
                                'experts.index',
                                'experts.show',
                                'experts.edit'
                            )
                                ? 'bg-slate-800 text-white'
                                : 'text-slate-300 hover:bg-slate-800 hover:text-white'
                            }}
                        "
                    >
                        จัดการข้อมูล
                    </a>

                    <span
                        aria-hidden="true"
                        class="mx-1 hidden h-6 w-px bg-slate-700 sm:block"
                    ></span>

                    <a
                        href="{{ route('experts.create') }}"
                        class="
                            inline-flex h-10 items-center justify-center
                            rounded-lg bg-blue-600 px-4
                            text-sm font-semibold text-white shadow-sm
                            transition hover:bg-blue-500
                            focus:outline-none focus:ring-2
                            focus:ring-blue-400 focus:ring-offset-2
                            focus:ring-offset-slate-950
                        "
                    >
                        <span class="mr-1 text-lg leading-none">+</span>

                        <span class="hidden sm:inline">
                            เพิ่มผู้เชี่ยวชาญ
                        </span>

                        <span class="sm:hidden">
                            เพิ่ม
                        </span>
                    </a>
                @endif

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="ml-1 shrink-0"
                >
                    @csrf

                    <button
                        type="submit"
                        class="
                            inline-flex h-10 items-center justify-center
                            rounded-lg px-3 text-sm font-medium
                            text-slate-400 transition
                            hover:bg-red-500/10 hover:text-red-300
                            focus:outline-none focus:ring-2
                            focus:ring-red-400
                        "
                    >
                        <span class="hidden sm:inline">
                            ออกจากระบบ
                        </span>

                        <span class="sm:hidden">
                            ออก
                        </span>
                    </button>
                </form>
            @else
                <a
                    href="{{ route('login') }}"
                    class="
                        ml-1 inline-flex h-10 items-center
                        justify-center rounded-lg bg-blue-600 px-4
                        text-sm font-semibold text-white transition
                        hover:bg-blue-500
                    "
                >
                    เข้าสู่ระบบ
                </a>
            @endauth
        </div>
    </nav>
</header>