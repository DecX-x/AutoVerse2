<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $pendingSellers = User::where('seller', 'pending')->get();
        $approvedSellers = User::where('seller', 'approved')->get();
        return view('admin.dashboard', compact('pendingSellers', 'approvedSellers'));
    }

    public function approveSeller($id)
    {
        $user = User::findOrFail($id);
        $user->seller = 'approved';
        $user->save();
        return back()->with('success', 'Seller approved successfully');
    }

    public function rejectSeller($id)
    {
        $user = User::findOrFail($id);
        $user->seller = 'false';
        $user->save();
        return back()->with('success', 'Seller rejected successfully');
    }
}