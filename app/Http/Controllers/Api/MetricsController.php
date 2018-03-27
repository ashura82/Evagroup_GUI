<?php

namespace App\Http\Controllers\Api;

use App\Helpers\MetricsHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetricsController extends Controller
{
    public function getCpu() {
        $value = round(MetricsHelper::getCpu(), 1);
        $id = uniqid();
        $unit = "%";
        $text = "Usage CPU";
        $valueText = $value;
        return view('api.metrics.cpu', compact('value', 'id', 'unit', 'text', 'valueText'));
    }

    public function getRam() {
        $id = uniqid();
        $mem_t = MetricsHelper::getMemoryTotal();
        $mem_u = MetricsHelper::getMemoryUsed();
        $value = round((($mem_u * 100) / $mem_t), 2);
        $valueText = $mem_u;
        $text = "Usage ram";
        $unit = "MiB";
        return view('api.metrics.ram', compact('value', 'id', 'unit', 'text', 'valueText'));
    }

    public function getDisk() {
        $id = uniqid();
        $disk_t = MetricsHelper::getDiskTotal();
        $disk_u = MetricsHelper::getDiskUsed();
        $value = round((($disk_u * 100) / $disk_t), 2);
        $valueText = $disk_u;
        $text = "Espace occupé";
        $unit = "GiB";
        return view('api.metrics.disk', compact('value', 'id', 'unit', 'text', 'valueText'));
    }

    public function getNetworkRx(){
        $net_r = MetricsHelper::getNetworkRx();
        return $net_r;
    }

    public function getNetworkTx(){
        $net_t = MetricsHelper::getNetworkTx();
        return $net_t;
    }

    public function getMemAndDisk(){
        $datas = MetricsHelper::getMemAndDisk();
        return $datas;
    }
}
