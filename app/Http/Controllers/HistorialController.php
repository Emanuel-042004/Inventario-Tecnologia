<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\Equipo;
use App\Models\Impresora;
use App\Models\Celular;
use App\Models\Telefono;
use App\Mail\HistorialCreado;
use Illuminate\Support\Facades\Mail;

class HistorialController extends Controller
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
    }
    public function index($tipo, $id)
{
    $historiable = $this->getHistoriable($tipo, $id);

    if (auth()->user()->hasRole('Admin')) {
        // El usuario es un administrador, muestra todos los registros de historial
        $historiales = $historiable->historial()->paginate(5);
    } else if (auth()->user()->hasRole('Proveedor')) {
        // El usuario es un proveedor, muestra solo los registros de historial que él mismo hizo
        $historiales = $historiable->historial()->where('user_id', auth()->id())->paginate(5);
    } else {
        // El usuario no tiene un rol reconocido, muestra una lista de historial vacía
        $historiales = collect([]);
    }

    return view('historiales.historiales', compact('historiable', 'historiales', 'tipo', 'id'));
}
    
    private function getHistoriable($tipo, $id)
    {
        switch ($tipo) {
            case 'equipos':
                return Equipo::find($id);
            case 'impresoras':
                return Impresora::find($id);
            case 'celulares':
                return Celular::find($id);
            case 'telefonos':
                return Telefono::find($id);
           
            default:
                abort(404);
        }
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
    public function store(Request $request, $tipo, $id)
{
    $historiable = $this->getHistoriable($tipo, $id);

    
    $historial = new Historial;
    $historial->descripcion = $request->input('descripcion');
    $historial->fecha = $request->input('fecha');
    $historial->user_id = auth()->id();
    $historiable->historial()->save($historial);

    $destinatarioEmail = ['auxiliarsistemas@losretales.co', 'charagomezemanuel@gmail.com'];
    
        // Envío del correo electrónico al destinatario específico
        Mail::to($destinatarioEmail)->send(new HistorialCreado(auth()->user(), $historial, $tipo, $historiable->serial));

    return redirect()->route('historiales.index', ['tipo' => $tipo, 'id' => $id])
        ->with('success', 'Historial creado exitosamente')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
}
    /**
     * Display the specified resource.
     */
    public function show(Historial $historial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($tipo, $id, $historialId)
    {
        $historiable = $this->getHistoriable($tipo, $id);
        $historial = Historial::findOrFail($historialId);
        return view('historiales.edit', compact('historiable', 'historial', 'tipo', 'id'));
    }

    public function update(Request $request, $tipo, $id, $historialId)
    {
        $historiable = $this->getHistoriable($tipo, $id);
        $historial = Historial::findOrFail($historialId);
        $historial->descripcion = $request->input('descripcion');
        $historial->fecha = $request->input('fecha');
        $historial->save();

        return redirect()->route('historiales.index', ['tipo' => $tipo, 'id' => $id])
            ->with('success', 'Historial actualizado exitosamente')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($tipo, $id, $historialId)
    {
        $historiable = $this->getHistoriable($tipo, $id);
        $historial = Historial::findOrFail($historialId);
        $historial->delete();
    
        return redirect()->route('historiales.index', ['tipo' => $tipo, 'id' => $id])
            ->with('delete_success', 'Historial eliminado exitosamente')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
}
