<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Core\Umkm;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $umkm = UMKM::orderBy('name')->paginate(9);
        return view('public.home', compact('umkm'));
    }

    public function showUmkm(Umkm $umkm)
    {
        return view('public.umkm-product')->withUmkm($umkm);
    }
}
