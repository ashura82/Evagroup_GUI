<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsitesController extends Controller
{
    public function index(){
        return view('websites.index');
    }
}
