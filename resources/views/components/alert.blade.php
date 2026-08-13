@php
    $type = null;
    $message = null;

    if (session('success')) {
        $type = 'success';
        $message = session('success');
    } elseif (session('error')) {
        $type = 'error';
        $message = session('error');
    } elseif (session('warning')) {
        $type = 'warning';
        $message = session('warning');
    } elseif (session('info')) {
        $type = 'info';
        $message = session('info');
    } elseif (session('status')) {
        $type = 'success';
        $message = session('status');
    }

    $styles = [
        'success' => [
            'icon' => 'bg-emerald-100 text-emerald-600',
            'progress' => 'bg-emerald-500',
            'title' => 'ดำเนินการสำเร็จ',
        ],
        'error' => [
            'icon' => 'bg-red-100 text-red-600',
            'progress' => 'bg-red-500',
            'title' => 'ไม่สามารถดำเนินการได้',
        ],
        'warning' => [
            'icon' => 'bg-amber-100 text-amber-600',
            'progress' => 'bg-amber-500',
            'title' => 'โปรดตรวจสอบ',
        ],
        'info' => [
            'icon' => 'bg-blue-100 text-blue-600',
            'progress' => 'bg-blue-500',
            'title' => 'แจ้งให้ทราบ',
        ],
    ];

    $currentStyle = $styles[$type] ?? $styles['info'];
@endphp

@if ($message)
    <div
        data-app-alert
        role="{{ $type === 'error' ? 'alert' : 'status' }}"
        aria-live="{{ $type === 'error' ? 'assertive' : 'polite' }}"
        class="
            fixed left-1/2 top-5 z-[100]
            w-[calc(100%-2rem)] max-w-md
            -translate-x-1/2 -translate-y-5
            rounded-2xl border border-slate-200
            bg-white p-4 text-slate-900
            opacity-0 shadow-2xl shadow-slate-900/20
            transition-all duration-300 ease-out
        "
    >
        <div class="flex items-start gap-3">
            <div
                class="
                    flex size-10 shrink-0 items-center
                    justify-center rounded-xl
                    {{ $currentStyle['icon'] }}
                "
            >
                @if ($type === 'success')
                    <svg
                        class="size-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m5 12 4 4L19 6"
                        />
                    </svg>
                @elseif ($type === 'error')
                    <svg
                        class="size-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            d="M6 6l12 12M18 6 6 18"
                        />
                    </svg>
                @elseif ($type === 'warning')
                    <svg
                        class="size-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v4m0 4h.01M10.3 4.5 2.7 18a2 2 0 0 0 1.7 3h15.2a2 2 0 0 0 1.7-3L13.7 4.5a2 2 0 0 0-3.4 0Z"
                        />
                    </svg>
                @else
                    <svg
                        class="size-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        aria-hidden="true"
                    >
                        <circle cx="12" cy="12" r="9" />

                        <path
                            stroke-linecap="round"
                            d="M12 11v5m0-8h.01"
                        />
                    </svg>
                @endif
            </div>

            <div class="min-w-0 flex-1">
                <p class="font-semibold text-slate-900">
                    {{ $currentStyle['title'] }}
                </p>

                <p class="mt-1 break-words text-sm text-slate-600">
                    {{ $message }}
                </p>
            </div>

            <button
                type="button"
                data-alert-close
                class="
                    shrink-0 rounded-lg p-1 text-slate-400
                    transition hover:bg-slate-100
                    hover:text-slate-700 focus:outline-none
                    focus:ring-2 focus:ring-slate-300
                "
                aria-label="ปิดการแจ้งเตือน"
            >
                <svg
                    class="size-5"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        d="M6 6l12 12M18 6 6 18"
                    />
                </svg>
            </button>
        </div>

        <div
            class="
                mt-3 h-1 overflow-hidden
                rounded-full bg-slate-100
            "
        >
            <div
                data-alert-progress
                class="
                    h-full w-full origin-left rounded-full
                    {{ $currentStyle['progress'] }}
                "
                style="animation: app-alert-progress 5s linear forwards;"
            ></div>
        </div>
    </div>

    <style>
        @keyframes app-alert-progress {
            from {
                transform: scaleX(1);
            }

            to {
                transform: scaleX(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            [data-app-alert],
            [data-alert-progress] {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>

    <script>
        (() => {
            const alertElement = document.querySelector(
                '[data-app-alert]'
            );

            if (!alertElement) {
                return;
            }

            let closeTimer;
            let isClosing = false;

            const showAlert = () => {
                alertElement.classList.remove(
                    '-translate-y-5',
                    'opacity-0'
                );

                alertElement.classList.add(
                    'translate-y-0',
                    'opacity-100'
                );
            };

            const closeAlert = () => {
                if (isClosing) {
                    return;
                }

                isClosing = true;
                window.clearTimeout(closeTimer);

                alertElement.classList.remove(
                    'translate-y-0',
                    'opacity-100'
                );

                alertElement.classList.add(
                    '-translate-y-5',
                    'opacity-0'
                );

                window.setTimeout(() => {
                    alertElement.remove();
                }, 300);
            };

            window.requestAnimationFrame(() => {
                window.requestAnimationFrame(showAlert);
            });

            alertElement
                .querySelector('[data-alert-close]')
                ?.addEventListener('click', closeAlert);

            closeTimer = window.setTimeout(
                closeAlert,
                5000
            );
        })();
    </script>
@endif