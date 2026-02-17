<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // ========== DEBUGGING ==========
        // Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            // Email tidak ditemukan
            return back()->withErrors([
                'email' => 'Email tidak terdaftar dalam sistem.',
            ])->onlyInput('email');
        }
        
        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            // Password salah
            return back()->withErrors([
                'email' => 'Password salah. Coba lagi.',
            ])->onlyInput('email');
        }
        
        // Cek status aktif
        if (!$user->is_active) {
            return back()->withErrors([
                'email' => 'Akun Anda tidak aktif. Hubungi administrator.',
            ])->onlyInput('email');
        }
        
        // Coba login
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $user = Auth::user();
            $user->update(['last_login_at' => Carbon::now()]);
            
            $request->session()->regenerate();
            
            return redirect()->intended('/dashboard');
        }
        
        return back()->withErrors([
            'email' => 'Terjadi kesalahan saat login.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}