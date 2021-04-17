<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        if (Auth::user()->role == 'super admin') {
            return redirect('superadmin/home');
        } else if (Auth::user()->role == 'admin') {
            return redirect('admin/home');
        } else if (Auth::user()->role == 'merchant') {
            return redirect('merchant/home');
        } else if (Auth::user()->role == 'wali santri') {
            return redirect('wali/home');
        } else if (Auth::user()->role == 'bendahara') {
            return redirect('bendahara/home');
        } else {
            return redirect('/');
        }
    }

    public function superadminHome()
    {
        return view('superadmin.home');
    }

    public function adminHome()
    {
        return view('admin.home');
    }

    public function merchantHome()
    {
        return view('merchant.home');
    }

    public function waliHome()
    {
        return view('wali.home');
    }

    public function bendaharaHome()
    {
        return view('bendahara.home');
    }
}
