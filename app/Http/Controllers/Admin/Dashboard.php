<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index () {
    	return view('admin/index');
    }
}
