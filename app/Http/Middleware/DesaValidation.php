<?php

namespace App\Http\Middleware;

use App\Models\Pasien;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DesaValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $inputDesa = $request->input('desa_id');


        if ($user && $inputDesa && $user->desa_id != $inputDesa) {
            return redirect()->back()->withInput()->withErrors(['desa_id' => 'Anda hanya dapat memasukkan data sesuai dengan nama desa Anda.']);
        }

        $pasien_id = $request->input('pasien_id');
        if ($pasien_id) {
            $pasien = Pasien::find($pasien_id);
            if ($pasien && $pasien->desa_id != $user->desa_id) {
                return redirect()->back()->withInput()->withErrors(['pasien_id' => 'Pasien tidak berasal dari desa Anda.']);
            }
        }
        return $next($request);
    }
}
