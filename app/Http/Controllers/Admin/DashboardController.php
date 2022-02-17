<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Models\Admin\Bingo;
use App\Models\Admin\Winner;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function dashboard()
    {
        $usuarios = User::count();
        $bingos = Bingo::count();
        $ganadores = Winner::count();

        return view('admin.dashboard.index', compact(
                                                    [
                                                        'usuarios',
                                                        'bingos',
                                                        'ganadores',
                                                    ]
                                                ));
    }
}
