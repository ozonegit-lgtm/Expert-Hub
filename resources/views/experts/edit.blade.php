@extends('layouts.app')

@section('title', 'แก้ไข ' . $expert->full_name)

@section('content')
    <div class="mx-auto w-full max-w-5xl">
        {{-- ส่วนหัว --}}
        <header class="mb-8">
            <a
                href="{{ route('experts.show', $expert) }}"
                class="
                    mb-4 inline-flex items-center gap-2
                    text-sm font-semibold text-slate-500
                    transition hover:text-blue-600
                "
            >
                <span aria-hidden="true">←</span>
                กลับหน้ารายละเอียด
            </a>

            <div
                class="
                    flex flex-col gap-4
                    sm:flex-row sm:items-start sm:justify-between
                "
            >
                <div>
                    <h1
                        class="
                            text-2xl font-bold tracking-tight
                            text-slate-900 sm:text-3xl
                        "
                    >
                        แก้ไขข้อมูลผู้เชี่ยวชาญ
                    </h1>

                    <p class="mt-2 text-slate-500">
                        {{ $expert->full_name }}
                    </p>
                </div>

                @if ($expert->is_published)
                    <span
                        class="
                            inline-flex w-fit rounded-full
                            bg-emerald-100 px-3 py-1.5
                            text-xs font-semibold text-emerald-700
                        "
                    >
                        เผยแพร่แล้ว
                    </span>
                @else
                    <span
                        class="
                            inline-flex w-fit rounded-full
                            bg-amber-100 px-3 py-1.5
                            text-xs font-semibold text-amber-700
                        "
                    >
                        ข้อมูลแบบร่าง
                    </span>
                @endif
            </div>
        </header>

        {{-- แบบฟอร์มแก้ไข --}}
        <form
            method="POST"
            action="{{ route('experts.update', $expert) }}"
            enctype="multipart/form-data"
            class="
                rounded-2xl border border-slate-200
                bg-white p-5 shadow-sm sm:p-8
            "
        >
            @csrf
            @method('PUT')

            @include('experts._form', [
                'submitLabel' => 'บันทึกการแก้ไข',
            ])
        </form>
    </div>
@endsection