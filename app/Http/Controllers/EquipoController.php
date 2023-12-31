<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Mantenimiento;
use Illuminate\Support\Facades\Auth;
class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:equipos.index')->only('index');
        $this->middleware('can:equipos.create')->only('create', 'store');
        $this->middleware('can:equipos.edit')->only('edit', 'update');
        $this->middleware('can:equipos.destroy')->only('destroy');
    }
 
    public function index(Request $request): View
{
    $filtro = $request->get('filtro', 'todos'); 
    $equiposQuery = Equipo::query();

    
    if ($filtro === 'propios') {
        $equiposQuery->where('tipo_equipo', 'Propio');
    } elseif ($filtro === 'alquilados') {
        $equiposQuery->where('tipo_equipo', 'Alquilado');
    }

    
    $search = $request->input('search');
    $equipos = $equiposQuery->filter($search)->latest()->paginate(12);

    return view('equipos.equipos', ['equipos' => $equipos]);
}


   

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('equipos.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {

        Equipo::create($request -> all()); 
        return redirect()->route('equipos.index')->with('success', 'Equipo agregado con éxito')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        return view('equipos.edit', ['equipo' => $equipo]); //
    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipo): RedirectResponse
    {
        $equipo->update($request ->all());
        return redirect()->route('equipos.index')->with('update_success', 'Equipo actualizado con éxito')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo): RedirectResponse
    {
       /* \DB::table('historial')->where('serial', $equipo->serial)->delete();*/
       
        $equipo->delete();

        return redirect()->route('equipos.index')->with('delete_success', 'Equipo Eliminado')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0'); //
    }



    
}
