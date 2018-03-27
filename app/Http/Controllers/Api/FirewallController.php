<?php

namespace App\Http\Controllers\Api;

use App\Helpers\FirewallHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class FirewallController extends Controller
{
    public function getListe(){
        try {
            return FirewallHelper::getListe();
        } catch (\Exception $e){
            return $e;
        }
    }

    public function postRechercheIp(Input $input){
        $ip = $input->get('ip');
        try {
            return FirewallHelper::rechercheIp($ip);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getPingIps(){
        try {
            return FirewallHelper::pingIps();
        } catch (\Exception $e) {
            return $e;
        }
    }
}
