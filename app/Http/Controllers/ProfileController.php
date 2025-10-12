<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna yang sedang login.
     */
    public function show()
    {
        // Mengambil data pengguna yang sedang terautentikasi
        $user = Auth::user();

        // Mengirim data pengguna ke view 'profile.show'
        return view('profile.show', compact('user'));
    }
}