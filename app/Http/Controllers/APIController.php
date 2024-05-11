<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function allIndex() {
        $data = Plant::select('name', 'slug', 'status', 'air', 'soil', 'temp', 'updated_at')->get()->map(function ($plant){
            $plant->temp = intval($plant->temp); 
            $plant->updated_at_carbon = $plant->status == 'active' ? 'Terakhir diperbarui ' . Carbon::parse($plant->updated_at)->diffForHumans() : "Belum pernah terhubung dengan perangkat ESP";
            return $plant;
        });

        foreach ($data as $plant) {
            if ($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->updated_at)) < -30){
                $statuses[] = 'inactive';
            } elseif($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->updated_at)) > -30){
                $statuses[] = 'active';
            } elseif($plant->status == 'pending') {
                $statuses[] = 'pending';
            }
        }
        return response()->json([
            'plants' => $data,
            'statuses' => $statuses
        ]);
    }

    public function plantIndex(Plant $plant) {
        unset($plant->id);
        
        $plant->celcius = intval($plant->temp);
        $plant->fahrenheit = intval( intval($plant->temp) * 9/5 ) + 32;
        $plant->reamur = intval( intval($plant->temp) * 4/5 );
        $plant->kelvin = intval( intval($plant->temp) + 273,15 );
        $plant->soilPercent = intval( ($plant->soil/4095)*100 );
        $plant->lastUpdated = Carbon::parse($plant->updated_at)->diffForHumans();

        if ($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->updated_at)) < -30){
            $plant->connection = 'Terputus';
        } elseif($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->updated_at)) > -30){
            $plant->connection = 'Terhubung';
        } elseif($plant->status == 'pending') {
            $plant->connection = 'pending';
        }

        return response()->json([
            "plant" => $plant
        ]);
    }
}