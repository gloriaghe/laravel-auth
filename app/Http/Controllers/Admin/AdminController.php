<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    //NON è NECESSARIO SE METTIAMO il MIDDLEWARE in WEB.PHP
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function dashboard()
    {
        $user = Auth::user();
        return view('admin.dashbord');
    }

    // public function temp()
    // {
    //     return view('admin.temp');
    // }


}
