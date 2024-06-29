<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.dashboard.index', [
            'title' => 'Dashboard',
            'desa' => Desa::all(),
            'profil_kecamatan' => ProfilKecamatan::all()->find(1)
        ]);
    }
}
