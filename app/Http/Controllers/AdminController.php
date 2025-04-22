<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class AdminController extends Controller
{
    //
    public function admindash()
    {
        return view('adminview.dashboard');
    }

   
    public function encode()
    {
        $videos = Video::all();
        return view('adminview.encode',compact('videos'));
    }
}
