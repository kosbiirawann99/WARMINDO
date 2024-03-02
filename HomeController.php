<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\makanan;


class HomeController extends Controller
{
    public function index()
    {
        $data=\App\Models\makanan::all();
        return view("home", compact("data"));
    }
    public function redirects()
    {
        $data=\App\Models\makanan::all();
        $usertype= Auth::user()->usertype;

        if($usertype=='1')
        {
            return view("admin.adminhome");
        }
        else
        {
            return view("home", compact("data"));
        }
    }

}
