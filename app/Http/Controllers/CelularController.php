<?php

namespace App\Http\Controllers;

use App\Models\Celular;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class CelularController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:celulares.index')->only('index');
        $this->middleware('can:celulares.create')->only('create', 'store');
        $this->middleware('can:celulares.edit')->only('edit', 'update');
        $this->middleware('can:celulares.destroy')->only('destroy');
    
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        
        $celulares = Celular::filter($search)->latest()->paginate(12);
    
        return view('telefonos.celulares', ['celulares' => $celulares]);
    }
    


    public function create(): View
    {
        return view('create');
    }


    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        // Eliminar los elementos vacíos del array
        $data = array_filter($data);

        Celular::create($data);
        return redirect()->route('celulares.index')->with('success', 'Celular agregado con éxito')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }


    public function show(Celular $celular)
    {

    }


    public function edit(Celular $celular)
    {

        return view('edit', ['celular' => $celular]);
    }


    public function update(Request $request, Celular $celular): RedirectResponse
    {
        $data = $request->all();

        $data = array_filter($data);

        $celular->update($data);
        return redirect()->route('celulares.index')->with('success', 'Celular actualizado con éxito')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }


    public function destroy(Celular $celular)
    {
       
        $celular->delete();
        return redirect()->route('celulares.index')->with('delete_success', 'Celular eliminado con éxito')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
}
