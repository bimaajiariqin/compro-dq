<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * List all admin accounts.
     */
    public function index(): View
    {
        $users = User::orderByDesc('created_at')->paginate(10);

        return view('Admin.users.index', compact('users'));
    }

    /**
     * Show the form to add a new admin.
     */
    public function create(): View
    {
        return view('Admin.users.create');
    }

    /**
     * Store a new admin account.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email'    => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email ini sudah terdaftar sebagai admin.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'email'    => $validated['email'],
            'password' => $validated['password'], // auto-hashed via the model's 'hashed' cast
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin baru berhasil ditambahkan.');
    }

    /**
     * Show a single admin — redirects to edit since there is no separate detail page.
     */
    public function show(User $user): RedirectResponse
    {
        return redirect()->route('admin.users.edit', $user);
    }

    /**
     * Show the form to edit an existing admin.
     */
    public function edit(User $user): View
    {
        return view('Admin.users.edit', compact('user'));
    }

    /**
     * Update an admin account. Password is only changed if a new one is provided.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'email'    => ['required', 'email', 'max:150', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email ini sudah terdaftar sebagai admin.',
            'password.min'       => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->email = $validated['email'];

        if (! empty($validated['password'])) {
            $user->password = $validated['password'];
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Data admin berhasil diperbarui.');
    }

    /**
     * Delete an admin account.
     * Guards: can't delete your own account, and can't delete the last remaining admin.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        if (User::count() <= 1) {
            return back()->with('error', 'Tidak bisa menghapus admin terakhir yang tersisa.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Admin berhasil dihapus.');
    }
}