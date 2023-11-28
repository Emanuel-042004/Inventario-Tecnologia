<?php

namespace App\Http\Controllers;
use App\Models\Equipo;
use App\Models\Impresora;
use App\Models\Celular;
use App\Models\Telefono;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
{
    $search = $request->input('search');
    $equipos = Equipo::filter($search)->get();
    $impresoras = Impresora::filter($search)->get();
    $celulares = Celular::filter($search)->get();
    $telefonos = Telefono::filter($search)->get();
    
    $noResults = true;

    foreach (['equipos', 'impresoras', 'celulares', 'telefonos'] as $type) {
        if (count($$type) > 0) {
            $noResults = false;
            break;
        }
    }

    
    return view('search', compact('equipos', 'impresoras', 'celulares', 'telefonos', 'noResults'));
}//
}

