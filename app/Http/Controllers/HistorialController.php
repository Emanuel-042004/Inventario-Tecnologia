<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\Equipo;
use App\Models\Impresora;
use App\Models\Celular;
use App\Models\Telefono;

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
    
        $historiales = $historiable->historial()->get();
        $historiales = $historiable->historial()->paginate(5);
    
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
            // Agrega más casos según tus modelos
            default:
                abort(404); // Manejar el caso en que el tipo no coincide con ningún modelo
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

        // Lógica para almacenar el nuevo mantenimiento en la base de datos
        $historial = new Historial;
        $historial->descripcion = $request->input('descripcion');
        $historial->fecha = $request->input('fecha');
        // Otras propiedades del mantenimiento según tu modelo

        // Asociar el mantenimiento al modelo mantenido (Equipo, Impresora, etc.)
        $historiable->historial()->save($historial);

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

        // Lógica para actualizar el mantenimiento en la base de datos
        $historial->descripcion = $request->input('descripcion');
        $historial->fecha = $request->input('fecha');
        // Otras propiedades del mantenimiento según tu modelo

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
    
        // Eliminar el mantenimiento de la base de datos
        $historial->delete();
    
        return redirect()->route('historiales.index', ['tipo' => $tipo, 'id' => $id])
            ->with('delete_success', 'Historial eliminado exitosamente')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
}
