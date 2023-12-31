<?php

namespace App\Http\Controllers;

use App\Models\Telefono;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class TelefonoController extends Controller
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
        $this->middleware('can:telefonos.index')->only('index');
        $this->middleware('can:telefonos.create')->only('create', 'store');
        $this->middleware('can:telefonos.edit')->only('edit', 'update');
        $this->middleware('can:telefonos.destroy')->only('destroy');
    
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        
        $telefonos = Telefono::filter($search)->latest()->paginate(12);
    
        return view('telefonos.telefonos', ['telefonos' => $telefonos]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('createTelefono');
    }


    public function store(Request $request): RedirectResponse
    {


        Telefono::create($request->all());
        return redirect()->route('telefonos.index')->with('success', 'Celular agregado con éxito')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
    /**
     * Display the specified resource.
     */
    public function show(Telefono $telefono)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Telefono $telefono)
    {
        return view('editTelefono', ['telefono' => $telefono]); //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Telefono $telefono): RedirectResponse
    {
        $telefono->update($request->all());
        return redirect()->route('telefonos.index')->with('update_success', 'Telefono actualizado con éxito')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Telefono $telefono)
    {
        
        $telefono->delete();
        return redirect()->route('telefonos.index')->with('delete_success', 'Celular eliminado con éxito')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
}
