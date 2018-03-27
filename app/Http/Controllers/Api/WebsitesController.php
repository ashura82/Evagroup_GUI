<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Nginx;
use App\Helpers\Nginx\VhostHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class WebsitesController extends Controller
{

    public function addVhost(Input $input){
        $key = $input->get('key');
        $ip = $input->get('ip');
        $port = $input->get('port');
        $mail = $input->get('mail');
        $name = $input->get('name');
        try {
            return VhostHelper::add($key, $ip, $port, $mail, $name);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getVhosts(){
        try {
            $vhosts = VhostHelper::all();
            return view('api.websites.vhosts', compact('vhosts'));
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getVhost($key){
        try{
            $vhostInfos = VhostHelper::get($key);
            $conf = $vhostInfos->conf;
            $active = $vhostInfos->active;
            return view('api.websites.vhost', compact('conf', 'active', 'key'));
        } catch (\Exception $e){
            throw $e;
        }
    }

    public function getVhostForm($key){
        try{
            $vhost = VhostHelper::get($key);
            $conf = $vhost->conf;
            return view('api.websites.vhost_form', compact('conf', 'key'));
        } catch (\Exception $e){
            throw $e;
        }
    }

    public function postVhostForm(Input $input, $key){
        $conf = $input->get('conf');
        try {
            return VhostHelper::edit($key, $conf);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getStatus(){
        try{
            $status = Nginx\StatusHelper::get();
            dd($status);
            return view('websites.vhosts', compact('vhosts'));
        } catch (\Exception $e){
            dd($e);
        }
        return null;
    }

}
