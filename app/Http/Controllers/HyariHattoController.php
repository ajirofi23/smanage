<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HyariHattoController extends Controller
{
    public function index()
    {
        // Fetch data for the form checkboxes
        $perilaku_tidak_aman = DB::table('perilaku_tidak_aman')
            ->where('status', 1)
            ->orderBy('nama_perilaku')
            ->get();

        $kondisi_tidak_aman = DB::table('kondisi_tidak_aman')
            ->where('status', 1)
            ->orderBy('nama_kondisi')
            ->get();

        $potensi_bahaya = DB::table('potensi_bahaya')->orderBy('nama_potensi')->get();

        return view('panel.manage.hyari-hatto', compact('perilaku_tidak_aman', 'kondisi_tidak_aman', 'potensi_bahaya'));
    }
}
