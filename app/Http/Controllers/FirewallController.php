<?php

namespace App\Http\Controllers;

use App\Helpers\FirewallHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use nilsenj\Toastr\Facades\Toastr;

class FirewallController extends Controller
{
    public function index(){
        $active = FirewallHelper::getStatus();
        $actions = [
            [
                'code' => 'white-list',
                'titre' => "Autoriser une IP",
                'description' => "Permet d'ajouter une adresse IP ou un sous réseau CIDR dans la liste blanche du cluster.",
                'button_text' => "Ajouter",
                'button_color' => "success",
                'form_action' => "firewall.allow-csf-ip"
            ],
            [
                'code' => 'unwhite-list',
                'titre' => "Ne plus autoriser une IP",
                'description' => "Permet de supprimer une adresse IP ou un sous réseau CIDR dans la liste blanche du cluster.",
                'button_text' => "Supprimer",
                'button_color' => 'warning',
                'form_action' => "firewall.remove-csf-ip"
            ],
            [
                'code' => 'deny-ip',
                'titre' => "Bloquer une IP",
                'description' => "Permet d'ajouter une adresse IP ou un sous réseau CIDR dans la liste noire du cluster.",
                'button_text' => "Bloquer",
                'button_color' => 'success',
                'form_action' => "firewall.deny-csf-ip"
            ],
            [
                'code' => 'unlock-ip',
                'titre' => "Débloquer une IP",
                'description' => "Permet de supprimer une adresse IP ou un sous réseau CIDR dans la liste noire du cluster.",
                'button_text' => "Débloquer",
                'button_color' => 'warning',
                'form_action' => "firewall.unlock-csf-ip"
            ]
        ];
        return view('firewall.index', compact('active', 'actions'));
    }

    public function startCsf(){
        try {
            Toastr::info(FirewallHelper::startCsf());
            return redirect()->route('firewall.index');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function shutdownCsf(){
        try {
            Toastr::info(FirewallHelper::shutdownCsf());
            return redirect()->route('firewall.index');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function restartCsf(){
        try {
            Toastr::info(FirewallHelper::restartCsf());
            return redirect()->route('firewall.index');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function allowCsfIp(Input $input){
        try {
            $ip = $input->get('ip');
            Toastr::info(FirewallHelper::allowCsfIp($ip));
            return redirect()->route('firewall.index');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function removeCsfIp(Input $input){
        try {
            $ip = $input->get('ip');
            Toastr::info(FirewallHelper::removeCsfIp($ip));
            return redirect()->route('firewall.index');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function denyCsfIp(Input $input){
        try {
            $ip = $input->get('ip');
            Toastr::info(FirewallHelper::denyCsfIp($ip));
            return redirect()->route('firewall.index');
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function unlockCsfIp(Input $input){
        try {
            $ip = $input->get('ip');
            Toastr::info(FirewallHelper::unlockCsfIp($ip));
            return redirect()->route('firewall.index');
        } catch (\Exception $e) {
            return $e;
        }
    }
}
