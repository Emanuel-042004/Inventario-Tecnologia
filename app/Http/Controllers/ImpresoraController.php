<?php

namespace App\Http\Controllers;

use App\Models\Impresora;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ImpresoraController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:impresoras.index')->only('index');
        $this->middleware('can:impresoras.create')->only('create', 'store');
        $this->middleware('can:impresoras.edit')->only('edit', 'update');
        $this->middleware('can:impresoras.destroy')->only('destroy');
    
    }

    public function index(Request $request): View
    {
        $filtro = $request->get('filtro', 'todas'); 
        $impresorasQuery = Impresora::query();
    
       
        if ($filtro === 'propias') {
            $impresorasQuery->where('tipo', 'Propia')->latest()->paginate(12);
        } elseif ($filtro === 'alquiladas') {
            $impresorasQuery->where('tipo', 'Alquilada')->latest()->paginate(12);
        }
    
       
        $search = $request->input('search');
        $impresoras = $impresorasQuery->filter($search)->latest()->paginate(12);
    
        return view('impresoras.impresoras', ['impresoras' => $impresoras]);
    }
    

    public function create(): View
    {
        return view('create');

    }


    public function store(Request $request): RedirectResponse
    {
        Impresora::create($request->all());
        return redirect()->route('impresoras.index')->with('success', 'Impresora agregada con éxito')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');

    }

    public function show(Impresora $impresora)
    {

    }


    public function edit(Impresora $impresora)
    {
        return view('edit', ['impresora' => $impresora]);

    }


    public function update(Request $request, Impresora $impresora): RedirectResponse
    {
        $impresora->update($request->all());
        return redirect()->route('impresoras.index')->with('update_success', 'Equipo actualizado con éxito')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');

    }


    public function destroy(Impresora $impresora)
    {
        
        $impresora->delete();
        return redirect()->route('impresoras.index')->with('delete_success', 'Impresora Eliminada')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
}
