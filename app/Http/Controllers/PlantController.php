<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambahkan Tanaman";
        return view('plants.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'max:100|required',
            'notes' => 'max:255'
        ]);
        $data = [
            'name' => $request->input('name'),
            'slug' => SlugService::createSlug(Plant::class, 'slug', $request->input('name')),
            'notes' => $request->input('notes') ?? null,
            'temp' => 0,
            'soil' => 0,
            'air' => 0,
            'status' => 'pending',
            'created_by' => auth()->user()->id,
        ];
        Plant::create($data);

        return redirect()->route('plant.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant)
    {
        $plant->fahrenheit = ( intval($plant->temp) * 9/5) + 32;
        $title = "Atur " . $plant->name . " | Suratno Tech";
        return view('plants.view', compact('title', 'plant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plant $plant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plant $plant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
        //
    }
}