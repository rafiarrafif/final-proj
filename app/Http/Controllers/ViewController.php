<?php

namespace App\Http\Controllers;

use App\Models\DataSensor;
use App\Models\Plant;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class ViewController extends Controller
{
    public function index() {
        $plants = Plant::all();
        foreach ($plants as $plant) {   
            if ($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->updated_at)) < -60){
                $statuses[] = 'inactive';
            } elseif($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->updated_at)) > -60){
                $statuses[] = 'active';
            } elseif($plant->status == 'pending') {
                $statuses[] = 'pending';
            }
        }
        return view('home.index', compact('plants', 'statuses'));
    }
    
    public function pending() {
        if (!auth()->user() || auth()->user()->role != 'pending') {
            return redirect()->route('home');
        }
        return view('welcome.pending');
    }

    public function getData() {
        $data = DataSensor::where('id', 1)->first();
        return response()->json($data);
    }
    
    public function addData( $id, $air, $soil, $temp, $shower) {
        $data = Plant::where('id', $id)->first();
        if ($data) {
            $update = [
                "id" => $id,
                "air" => $air,
                "soil" => $soil,
                "temp" => $temp,
                "callback_shower" => $shower,
                "status" => "active",
                "updated_at" => now()
            ];
            
            try{
                $ip = FacadesRequest::ip();  
                $data->update($update);
                return response($ip);
                // return response($data->trigger_shower == true ? 'shower_on' : 'shower_off');
            } catch(Exception $e) {
                return response($e);
            }
        } else {
            return response("error: id driver not found");
        }
    }
}