<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\ProfilKecamatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.user.index', [
            'title' => 'Users',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'users' => User::all()
        ]);
    }
    public function export()
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = now()->format('Y-m-d_His');
        $fileName = 'Users_' . $currentDateTime . '.xlsx';
        return Excel::download(new UsersExport, $fileName);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/admin/user')->with('success', 'Data User Berhasil Dihapus!');
    }
}
