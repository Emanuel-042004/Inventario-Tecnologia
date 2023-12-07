<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Historial;
use App\Models\Historiable;

class HistorialCreado extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
public $historiable;
public $historial;
public $tipoObjeto;
public $serial;
    /**
     * Create a new message instance.
     */
    public function __construct($usuario, Historial $historial, $tipoObjeto, $serial)
    {
        $this->usuario = $usuario;
        $this->historiable = $historial->mantenible;
        $this->historial = $historial;
        $this->serial = $serial;
        $tipoObjeto = ucfirst(substr($tipoObjeto, 0, -1));
        $this->tipoObjeto = $tipoObjeto;
    }


    /**
     * Build the message.
     *
     * @return $this
     */

     public function build()
     {
         return $this->view('emails.historial-creado')
         ->subject('Nuevo Historial creado para ' . $this->tipoObjeto . ': ' . $this->serial);
     }
 
}
