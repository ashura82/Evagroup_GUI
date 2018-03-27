<?php

namespace App\Http\Controllers;

use App\Helpers\Nginx\StatusHelper as StatusHelper;
use App\Helpers\Nginx\VhostHelper as VhostHelper;
use Illuminate\Support\Facades\Input;

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

    public function vhostEnable(Input $input, $key){
        try {
            VhostHelper::enableDisable($key, true);
        } catch (\Exception $e){

        } finally {
            $route = $input->get('referer') ? : route('websites.index');
            return redirect($route);
        }
    }

    public function vhostDisable(Input $input, $key){
        try {
            VhostHelper::enableDisable($key, false);
        } catch (\Exception $e){

        } finally {
            $route = $input->get('referer') ? : route('websites.index');
            return redirect($route);
        }
    }

    public function vhostDelete($key){
        try {
            VhostHelper::delete($key);
        } catch (\Exception $e){

        } finally {
            return redirect()->route('websites.index');
        }
    }
}
