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
            if ($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->updated_at)) < -60){
                $statuses[] = 'inactive';
            } elseif($plant->status == 'active' && Carbon::now()->diffInSeconds(Carbon::parse($plant->updated_at)) > -60){
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
}