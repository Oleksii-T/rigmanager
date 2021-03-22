<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function userAccess()
    {
        return view('admin.user-access');
    }
    
    public function loginAs(Request $reqest)
    {
        auth()->loginUsingId($reqest->user);
        return redirect(loc_url(route('home')));
    }
    
    public function mailers()
    {
        return view('admin.mailers');
    }
    
    public function graphs()
    {
        return view('admin.graphs');
    }
    
    public function unverifiedPosts()
    {
        return view('admin.unverified-posts');
    }
}
