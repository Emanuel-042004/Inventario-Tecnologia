<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Mantenimiento;
use App\Models\Mantenible;

class MantenimientoCreado extends Mailable
{
    use Queueable, SerializesModels;

public $usuario;
public $mantenible;
public $mantenimiento;
public $tipoObjeto;
public $serial;

/**
 * Create a new message instance.
 */
public function __construct($usuario, Mantenimiento $mantenimiento, $tipoObjeto, $serial)
{
    $this->usuario = $usuario;
    $this->mantenible = $mantenimiento->mantenible;
    $this->mantenimiento = $mantenimiento;
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
        return $this->view('emails.mantenimiento-creado')
        ->subject('Nuevo mantenimiento creado para ' . $this->tipoObjeto . ': ' . $this->serial);
    }

    /**
     * Get the message envelope.
     */
   
}
