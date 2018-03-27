<?php

namespace App\Http\Controllers;

class ChartsController extends Controller
{
    public function circle($value){
        $id = uniqid();
        return view('charts.circle', compact('value', 'id'));
    }
}
