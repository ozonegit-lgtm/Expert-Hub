<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>@yield('title', 'Expert Hub')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="
        min-h-screen bg-slate-100 font-sans
        text-slate-900 antialiased
    "
>
    <x-navbar />

    <x-alert />

    <main class="mx-auto w-full max-w-6xl px-4 py-8">
        @if ($errors->any())
            <div
                role="alert"
                class="
                    mb-6 rounded-xl border border-red-200
                    bg-red-50 px-4 py-3 text-red-800 shadow-sm
                "
            >
                <p class="font-semibold">
                    กรุณาตรวจสอบข้อมูล
                </p>

                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>