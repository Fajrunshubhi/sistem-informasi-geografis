<?php

namespace App\Http\Middleware;

use App\Models\PusatKesehatan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDesa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil semua parameter rute
        $routeParameters = $request->route()->parameters();
        // Periksa parameter rute untuk model yang relevan
        foreach ($routeParameters as $key => $value) {
            // Jika parameter adalah laporan_kesehatan
            if ($key === 'pusat_kesehatan') {
                // Periksa apakah desa pengguna sesuai dengan desa data
                if (Auth::user()->desa->nama_desa != $value->desa->nama_desa) {
                    // Jika tidak sesuai, kembali dengan error
                    return abort(404);
                }
            }

            if ($key === 'fasilitas_kesehatan') {
                // Periksa apakah desa pengguna sesuai dengan desa data
                if (Auth::user()->desa->nama_desa != $value->desa->nama_desa) {
                    // Jika tidak sesuai, kembali dengan error
                    return abort(404);
                }
            }

            if ($key === 'layanan_kesehatan') {
                // Periksa apakah desa pengguna sesuai dengan desa data
                if (Auth::user()->desa->nama_desa != $value->desa->nama_desa) {
                    // Jika tidak sesuai, kembali dengan error
                    return abort(404);
                }
            }
            if ($key === 'kondisi_kesehatan') {
                // Periksa apakah desa pengguna sesuai dengan desa data
                if (Auth::user()->desa->nama_desa != $value->pasien->desa->nama_desa) {
                    // Jika tidak sesuai, kembali dengan error
                    return abort(404);
                }
            }

            if ($key === 'pasien') {
                // Periksa apakah desa pengguna sesuai dengan desa data
                if (Auth::user()->desa->nama_desa != $value->desa->nama_desa) {
                    // Jika tidak sesuai, kembali dengan error
                    return abort(404);
                }
            }

            if ($key === 'pemantauan') {
                // Periksa apakah desa pengguna sesuai dengan desa data
                if (Auth::user()->desa->nama_desa != $value->kondisi_kesehatan->pasien->desa->nama_desa) {
                    // Jika tidak sesuai, kembali dengan error
                    return abort(404);
                }
            }

            if ($key === 'laporan_kesehatan') {
                // Periksa apakah desa pengguna sesuai dengan desa data
                if (Auth::user()->desa->nama_desa != $value->desa->nama_desa) {
                    // Jika tidak sesuai, kembali dengan error
                    return abort(404);
                }
            }

            if ($key === 'desa') {
                // Periksa apakah desa pengguna sesuai dengan desa data
                if (Auth::user()->desa->nama_desa != $value->nama_desa) {
                    // Jika tidak sesuai, kembali dengan error
                    return abort(404);
                }
            }

            if ($key === 'berita_informasi') {
                // Periksa apakah desa pengguna sesuai dengan desa data
                if (Auth::user()->desa->nama_desa != $value->user->desa->nama_desa) {
                    // Jika tidak sesuai, kembali dengan error
                    return abort(404);
                }
            }
        }
        return $next($request);
    }
}
