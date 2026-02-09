<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        return redirect(route('admin.orders.index'));
        // $data['number_of_customers'] = User::role('customer')->count();
        // $data['number_of_sales'] = Sale::where();
        // return view('admin.dashboard', $data);
    }
}
