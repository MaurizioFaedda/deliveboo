<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\User;

class HomeController extends Controller
{
    public function index()
    {   $user_current = Auth::user()->id;
        $data=[
            'countRestaurants'=> Restaurant::where('user_id', $user_current)->count()
        ];
        // dd($data);
        return view('admin.home', $data);
    }
}
