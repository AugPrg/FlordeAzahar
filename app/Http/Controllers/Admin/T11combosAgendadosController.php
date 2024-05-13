<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\T10combos;
use App\Models\T11combosagendados;
use Carbon\Carbon;
use Illuminate\Http\Request;

class T11combosAgendadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = T10combos::where('t10vencimiento', '>=', Carbon::now()->format("Y-m-d") )
        ->get()
        ;

        $titulo = 'Calendario de Eventos';
        $events = [];
        foreach ($registros as $registro) {
            $events[] = [
                'title' => $registro->t10nombre,
                'start'=> $registro->t10vencimiento,
                'url' => 'https://google.com/',
            ];
        }

        // dd($events);
        return view('admin.combos.calendary', compact('titulo', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
