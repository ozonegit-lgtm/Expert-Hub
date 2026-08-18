<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller{
    public function index():view {
        $users = User::query()->latest()->paginate(10);
        return view('Users.indexuser', compact('users'));
    }

    public function create(): view {
        return view('Users.createuser');
    }

    public function store(Request $request):RedirectResponse {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users,email'],
            'password' => ['required','string','min:8','confirmed'],
            'is_admin' => ['required','boolean'],
        ]);
        User::create($validated);
        return redirect()->route('users.index')->with('success', 'เพิ่มสมาชิกเรียบร้อยแล้ว');
    }

    public function show(User $user):view {
        return view('Users.showuser', compact('user'));
    }

    public function edit(User $user):view {
        return view('Users.edituser', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse{
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255',Rule::unique('users', 'email')->ignore($user->id),],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_admin' => ['required','boolean'] 
        ]);
        if (blank($validated['password'] ?? null )) {
            unset($validated['password']);
        }
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'แก้ไขข้อมูลสมาชิกเรียบร้อยแล้ว');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'ไม่สามารถลบบัญชีที่กำลังใช้งานอยู่ได้');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'ลบสมาชิกเรียบร้อยแล้ว');
    }
}