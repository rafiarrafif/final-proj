<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Exception;
use Illuminate\Http\Request;

class ShowerController extends Controller
{
    public function index(Request $request) {
        if ($request->input('action') == 'turn-on'){
            $name = $request->input('name');
            try {
                $plant = Plant::where('slug', $name)->first();
                $plant->trigger_shower = true;
                $plant->updated_at = now();
                $plant->save();
                return response()->json([
                    'status' => 'success'
                ]);
            }catch (Exception $e) {
                return response()->json([
                    'error' => $e
                ]);
            }
            
        } elseif ($request->input('action') == 'turn-off') {
            $name = $request->input('name');
            try {
                $plant = Plant::where('slug', $name)->first();
                $plant->trigger_shower = false;
                $plant->updated_at = now();
                $plant->save();
                return response()->json([
                    'status' => 'success'
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'error' => $e
                ]);
            }
        }
    }
}