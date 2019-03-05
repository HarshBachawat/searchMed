<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedShopHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:medshop','medshop.verified']);
    }

    /** 
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
