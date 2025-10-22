<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    // ================== DASHBOARD DAN ROLE ==================
    public function index()
    {
        return view('panel.manage.index');
    }

    public function manager()
    {
        return view('panel.manage.index');
    }

    public function supervisor()
    {
       return view('panel.manage.index');
    }

    public function employee()
    {
        return view('panel.manage.index');
    }

    // ================== MENU LAIN ==================
    public function hyariHatto()
{
    // Ambil data dari tabel DB
    $perilaku_tidak_aman = DB::table('perilaku_tidak_aman')->get();
    $kondisi_tidak_aman  = DB::table('kondisi_tidak_aman')->get();
    $potensi_bahaya      = DB::table('potensi_bahaya')->get();

    // Kirim ke view
    return view('panel.manage.hyari-hatto', compact(
        'perilaku_tidak_aman',
        'kondisi_tidak_aman',
        'potensi_bahaya'
    ));
}


    public function laporInsiden()
    {
        return view('panel.manage.laporinsiden');
    }

    public function laporAccident()
    {
        return view('panel.manage.laporaccident');
    }

    public function komitmenK3()
    {
        return view('panel.manage.komitmenk3');
    }

    public function safetyPatrol()
    {
        return view('panel.manage.safetypatrol');
    }

    public function safetyRiding()
    {
        return view('panel.manage.safetyriding');
    }

    // ================== MASTER DATA PERILAKU TIDAK AMAN ==================
    public function perilakuTidakAman()
    {
        return view('panel.manage.perilakutidakaman');
    }

    public function getPerilakuTidakAman()
    {
        $data = DB::table('perilaku_tidak_aman')->orderBy('id', 'asc')->get();
        return response()->json($data);
    }

    public function storePerilakuTidakAman(Request $request)
{
    try {
        // Validasi input
        $request->validate([
            'nama_perilaku' => 'required|string|max:150',
        ]);

        $id = $request->input('id');
        $status = $request->has('status') ? 1 : 0;

        if ($id) {
            // 🔹 Kalau ada ID → Update data
            DB::table('perilaku_tidak_aman')->where('id', $id)->update([
                'nama_perilaku' => $request->nama_perilaku,
                'status' => $status,
                'updated_at' => now(),
            ]);

            $message = 'Data perilaku tidak aman berhasil diperbarui!';
        } else {
            // 🔹 Kalau tidak ada ID → Insert data baru
            DB::table('perilaku_tidak_aman')->insert([
                'nama_perilaku' => $request->nama_perilaku,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $message = 'Data perilaku tidak aman berhasil disimpan!';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}

    public function showPerilakuTidakAman($id)
    {
        $data = DB::table('perilaku_tidak_aman')->where('id', $id)->first();
        return response()->json($data);
    }

    public function deletePerilakuTidakAman($id)
    {
        DB::table('perilaku_tidak_aman')->where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data perilaku tidak aman berhasil dihapus!'
        ]);
    }

    // === KONDISI TIDAK AMAN ===
public function kondisiTidakAman()
{
    return view('panel.manage.kondisitidakaman');
}

public function dataKondisiTidakAman()
{
    $data = DB::table('kondisi_tidak_aman')->get();
    return response()->json($data);
}

public function storeKondisiTidakAman(Request $request)
{
    try {
        $request->validate([
            'nama_kondisi' => 'required|string|max:150',
        ]);

        DB::table('kondisi_tidak_aman')->updateOrInsert(
            ['id' => $request->id],
            [
                'nama_kondisi' => $request->nama_kondisi,
                'status' => $request->has('status'),
                'updated_at' => now(),
                'created_at' => $request->id ? DB::raw('created_at') : now()
            ]
        );

        return response()->json([
            'success' => true,
            'message' => $request->id ? 'Data berhasil diperbarui!' : 'Data berhasil disimpan!'
        ]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
    }
}

public function showKondisiTidakAman($id)
{
    $data = DB::table('kondisi_tidak_aman')->where('id', $id)->first();
    return response()->json($data);
}

public function deleteKondisiTidakAman($id)
{
    DB::table('kondisi_tidak_aman')->where('id', $id)->delete();
    return response()->json(['success' => true, 'message' => 'Data berhasil dihapus!']);
}

// === POTENSI BAHAYA ===
public function potensiBahaya()
{
    return view('panel.manage.potensibahaya');
}

public function dataPotensiBahaya()
{
    $data = DB::table('potensi_bahaya')->get();
    return response()->json($data);
}

public function storePotensiBahaya(Request $request)
{
    try {
        $request->validate([
            'nama_potensi' => 'required|string|max:150',
        ]);

        DB::table('potensi_bahaya')->updateOrInsert(
            ['id' => $request->id],
            [
                'nama_potensi' => $request->nama_potensi,
                'status' => $request->has('status'),
                'updated_at' => now(),
                'created_at' => $request->id ? DB::raw('created_at') : now()
            ]
        );

        return response()->json([
            'success' => true,
            'message' => $request->id ? 'Data berhasil diperbarui!' : 'Data berhasil disimpan!'
        ]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
    }
}

public function showPotensiBahaya($id)
{
    $data = DB::table('potensi_bahaya')->where('id', $id)->first();
    return response()->json($data);
}

public function deletePotensiBahaya($id)
{
    DB::table('potensi_bahaya')->where('id', $id)->delete();
    return response()->json(['success' => true, 'message' => 'Data berhasil dihapus!']);
}

    // ================== ADD USER ==================
    public function addUser()
    {
        return view('panel.manage.add-user');
    }

    public function storeUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/',
                'role_id' => 'required|integer|between:1,4',
            ]);

            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil ditambahkan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getUsers()
    {
        $users = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.id', 'users.name', 'users.email', 'users.role_id', 'roles.name as role_name')
            ->get();
        return response()->json($users);
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'role_id' => 'required|integer|between:1,4',
                'password' => 'nullable|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/',
            ]);

            $updateData = [
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'updated_at' => now(),
            ];

            // Only update password if provided
            if ($request->filled('password')) {
                $updateData['password'] = bcrypt($request->password);
            }

            DB::table('users')->where('id', $id)->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            DB::table('users')->where('id', $id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'User berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

}
