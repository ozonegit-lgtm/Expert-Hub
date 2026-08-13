@extends('layouts.app')

@section('title', $expert->full_name)

@section('content')
    <div class="mx-auto w-full max-w-5xl">
        {{-- ส่วนหัว --}}
        <header
            class="
                mb-8 flex flex-col gap-5
                sm:flex-row sm:items-start sm:justify-between
            "
        >
            <div>
                <a
                    href="{{ route('experts.index') }}"
                    class="
                        mb-4 inline-flex items-center gap-2
                        text-sm font-semibold text-slate-500
                        transition hover:text-blue-600
                    "
                >
                    <span aria-hidden="true">←</span>
                    กลับหน้ารายชื่อ
                </a>

                <h1
                    class="
                        text-2xl font-bold tracking-tight
                        text-slate-900 sm:text-3xl
                    "
                >
                    {{ $expert->full_name }}
                </h1>

                <p class="mt-2 text-slate-500">
                    {{ $expert->current_position ?: 'ไม่ระบุตำแหน่ง' }}
                </p>

                <div class="mt-4">
                    @if ($expert->is_published)
                        <span
                            class="
                                inline-flex rounded-full bg-emerald-100
                                px-3 py-1 text-xs font-semibold
                                text-emerald-700
                            "
                        >
                            เผยแพร่แล้ว
                        </span>
                    @else
                        <span
                            class="
                                inline-flex rounded-full bg-amber-100
                                px-3 py-1 text-xs font-semibold
                                text-amber-700
                            "
                        >
                            ข้อมูลแบบร่าง
                        </span>
                    @endif
                </div>
            </div>

            @auth
                @if (auth()->user()->is_admin)
                    <a
                        href="{{ route('experts.edit', $expert) }}"
                        class="
                            inline-flex items-center justify-center
                            rounded-xl bg-blue-600 px-5 py-3
                            text-sm font-semibold text-white shadow-sm
                            transition hover:bg-blue-700
                            focus:outline-none focus:ring-4
                            focus:ring-blue-200
                        "
                    >
                        แก้ไขข้อมูล
                    </a>
                @endif
            @endauth
        </header>

        {{-- รูปและข้อมูลทั่วไป --}}
        <div class="grid gap-6 lg:grid-cols-[2fr_3fr]">
            <section
                class="
                    overflow-hidden rounded-2xl border
                    border-slate-200 bg-white shadow-sm
                "
            >
                @if ($expert->profile_image)
                    <img
                        src="{{ Storage::url($expert->profile_image) }}"
                        alt="{{ $expert->full_name }}"
                        class="h-full max-h-[480px] min-h-[320px] w-full object-cover"
                    >
                @else
                    <div
                        class="
                            flex min-h-[320px] flex-col items-center
                            justify-center bg-slate-100 px-6
                            text-center text-slate-400
                        "
                    >
                        <span class="text-5xl" aria-hidden="true">👤</span>

                        <p class="mt-4 text-sm">
                            ไม่มีรูปประจำตัว
                        </p>
                    </div>
                @endif
            </section>

            <section
                class="
                    rounded-2xl border border-slate-200
                    bg-white p-6 shadow-sm
                "
            >
                <h2 class="text-lg font-bold text-slate-900">
                    ข้อมูลทั่วไป
                </h2>

                <dl class="mt-6 divide-y divide-slate-100">
                    <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-semibold text-slate-500">
                            การศึกษาสูงสุด
                        </dt>

                        <dd class="text-sm text-slate-900 sm:col-span-2">
                            {{ $expert->highest_education ?: '-' }}
                        </dd>
                    </div>

                    <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-semibold text-slate-500">
                            ตำแหน่งปัจจุบัน
                        </dt>

                        <dd class="text-sm text-slate-900 sm:col-span-2">
                            {{ $expert->current_position ?: '-' }}
                        </dd>
                    </div>

                    <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4">
                        <dt class="text-sm font-semibold text-slate-500">
                            สถานที่ทำงาน
                        </dt>

                        <dd class="text-sm text-slate-900 sm:col-span-2">
                            {{ $expert->workplace ?: '-' }}
                        </dd>
                    </div>

                    @auth
                        @if (auth()->user()->is_admin)
                            <div
                                class="
                                    grid gap-1 py-4
                                    sm:grid-cols-3 sm:gap-4
                                "
                            >
                                <dt
                                    class="
                                        text-sm font-semibold
                                        text-slate-500
                                    "
                                >
                                    ผู้บันทึก
                                </dt>

                                <dd
                                    class="
                                        text-sm text-slate-900
                                        sm:col-span-2
                                    "
                                >
                                    {{ $expert->creator?->name ?: 'ไม่ระบุ' }}
                                </dd>
                            </div>
                        @endif
                    @endauth
                </dl>
            </section>
        </div>

        {{-- รายละเอียดความเชี่ยวชาญ --}}
        <section
            class="
                mt-6 rounded-2xl border border-slate-200
                bg-white p-6 shadow-sm
            "
        >
            <h2 class="text-lg font-bold text-slate-900">
                รายละเอียดความเชี่ยวชาญ
            </h2>

            @if ($expert->expertise_details)
                <div
                    class="
                        mt-4 whitespace-pre-line leading-7
                        text-slate-700
                    "
                >{{ $expert->expertise_details }}</div>
            @else
                <p class="mt-4 text-sm text-slate-500">
                    ไม่มีรายละเอียดเพิ่มเติม
                </p>
            @endif

        <div class="mt-7 border-t border-slate-100 pt-6">
            <h3 class="text-sm font-semibold text-slate-700">
                หมวดความเชี่ยวชาญ
            </h3>

            <div class="mt-3 flex flex-wrap gap-2">
                @forelse ($expert->expertiseCategories as $category)
                    <span
                        class="
                            inline-flex rounded-full bg-blue-50
                            px-3 py-1.5 text-sm font-medium
                            text-blue-700
                        "
                    >
                        {{ $category->name }}
                    </span>
                @empty
                    <p class="text-sm text-slate-500">
                        ยังไม่ได้เลือกหมวดความเชี่ยวชาญ
                    </p>
                @endforelse
            </div>

            @if (
                $expert->other_expertise
                && $expert->expertiseCategories->contains(
                    'name',
                    'อื่นๆ'
                )
            )
                <div
                    class="
                        mt-5 rounded-xl border border-blue-100
                        bg-blue-50 p-4
                    "
                >
                    <p class="text-sm font-semibold text-blue-800">
                        ความเชี่ยวชาญอื่นๆ
                    </p>

                    <p
                        class="
                            mt-2 whitespace-pre-line
                            text-sm leading-6 text-slate-700
                        "
                    >{{ $expert->other_expertise }}</p>
                </div>
            @endif
        </div>
        </section>

        {{--
            ผู้เข้าชมเห็นข้อมูลติดต่อเฉพาะเมื่ออนุญาต
            ส่วนแอดมินเห็นได้เสมอเพื่อใช้จัดการข้อมูล
        --}}
        @if ($expert->show_contact || auth()->user()?->is_admin)
            <section
                class="
                    mt-6 rounded-2xl border border-slate-200
                    bg-white p-6 shadow-sm
                "
            >
                <div
                    class="
                        flex flex-col gap-3
                        sm:flex-row sm:items-center
                        sm:justify-between
                    "
                >
                    <h2 class="text-lg font-bold text-slate-900">
                        ข้อมูลติดต่อ
                    </h2>

                    @if (! $expert->show_contact)
                        <span
                            class="
                                inline-flex w-fit rounded-full
                                bg-amber-100 px-3 py-1
                                text-xs font-semibold text-amber-700
                            "
                        >
                            ซ่อนจากหน้าสาธารณะ
                        </span>
                    @endif
                </div>

                <dl class="mt-5 grid gap-4 md:grid-cols-3">
                    <div class="rounded-xl bg-slate-50 p-4">
                        <dt class="text-xs font-semibold text-slate-500">
                            โทรศัพท์
                        </dt>

                        <dd class="mt-2 text-sm font-medium text-slate-900">
                            {{ $expert->phone ?: '-' }}
                        </dd>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <dt class="text-xs font-semibold text-slate-500">
                            อีเมล
                        </dt>

                        <dd class="mt-2 break-all text-sm font-medium text-slate-900">
                            @if ($expert->email)
                                <a
                                    href="mailto:{{ $expert->email }}"
                                    class="text-blue-600 hover:underline"
                                >
                                    {{ $expert->email }}
                                </a>
                            @else
                                -
                            @endif
                        </dd>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <dt class="text-xs font-semibold text-slate-500">
                            LINE ID
                        </dt>

                        <dd class="mt-2 text-sm font-medium text-slate-900">
                            {{ $expert->line_id ?: '-' }}
                        </dd>
                    </div>
                </dl>
            </section>
        @endif

        {{-- ปุ่มลบสำหรับแอดมิน --}}
        @auth
            @if (auth()->user()->is_admin)
                <section
                    class="
                        mt-8 rounded-2xl border border-red-200
                        bg-red-50 p-5
                    "
                >
                    <div
                        class="
                            flex flex-col gap-4
                            sm:flex-row sm:items-center
                            sm:justify-between
                        "
                    >
                        <div>
                            <h2 class="font-semibold text-red-900">
                                ลบข้อมูลผู้เชี่ยวชาญ
                            </h2>

                            <p class="mt-1 text-sm text-red-700">
                                เมื่อลบแล้วจะไม่สามารถเรียกคืนข้อมูลได้
                            </p>
                        </div>

                        <form
                            method="POST"
                            action="{{ route('experts.destroy', $expert) }}"
                            onsubmit="
                                return confirm(
                                    'ยืนยันการลบข้อมูลผู้เชี่ยวชาญนี้หรือไม่?'
                                )
                            "
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="
                                    inline-flex items-center justify-center
                                    rounded-xl bg-red-600 px-5 py-3
                                    text-sm font-semibold text-white
                                    transition hover:bg-red-700
                                    focus:outline-none focus:ring-4
                                    focus:ring-red-200
                                "
                            >
                                ลบข้อมูล
                            </button>
                        </form>
                    </div>
                </section>
            @endif
        @endauth
    </div>
@endsection