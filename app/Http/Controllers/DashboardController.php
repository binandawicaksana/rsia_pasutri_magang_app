<?php
namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /** Arahkan user ke dashboard sesuai rolenya */
    public function __invoke()
    {
        return match (auth()->user()->role) {
            'admin'      => redirect()->route('admin.dashboard'),
            'pembimbing' => redirect()->route('pembimbing.dashboard'),
            default      => redirect()->route('peserta.dashboard'),
        };
    }
}
