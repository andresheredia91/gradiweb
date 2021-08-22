<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marca;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\View;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('home', [
            'countUsers' => User::all()->count(),
            'countVehiculos'  => Vehiculo::all()->count(),
        ]);
    }
}
