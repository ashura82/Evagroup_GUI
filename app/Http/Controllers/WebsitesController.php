<?php

namespace App\Http\Controllers;

use App\Helpers\Nginx\StatusHelper as StatusHelper;
use App\Helpers\Nginx\VhostHelper as VhostHelper;

class WebsitesController extends Controller
{
    public function index(){
        return view('websites.index');
    }

    public function vhost($key){
        return view('websites.vhost', compact('key'));
    }

    public function vhostAdd(){
        return view('websites.add');
    }

    public function vhostEdit($key){
        return view('websites.edit', compact('key'));
    }

    public function getStatus(){
        try{
            $status = StatusHelper::get();
            dd($status);
            return view('websites.vhosts', compact('vhosts'));
        } catch (\Exception $e){
            dd($e);
        }
        return null;
    }
}
