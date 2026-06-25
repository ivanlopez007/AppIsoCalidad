<?php

namespace App\Notifications;

use App\Models\CambioDocumento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreacionSolicitudNotificacion extends Notification implements ShouldQueue
{
    use Queueable;

    protected $solicitud;

    /**
     * Create a new notification instance.
     */
    public function __construct(CambioDocumento $solicitud)
    {
        // Pasamos la solicitud recién creada
        $this->solicitud = $solicitud;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // Cargamos relaciones en caso de que no se hayan cargado en el controlador
        $this->solicitud->load(['usuario.infoUsuario', 'nivel', 'subnivel']);

        $nombreSolicitante = $this->solicitud->usuario->infoUsuario->nombre ?? 'Colaborador';
        $apellidoSolicitante = $this->solicitud->usuario->infoUsuario->apellido_paterno ?? '';

        return (new MailMessage)
            ->subject('Nueva Solicitud de Cambio Pendiente de Aprobación - Folio #' . $this->solicitud->folio)
            ->greeting('Hola, ' . ($notifiable->infoUsuario->nombre ?? 'Aprobador'))
            ->line('Se ha registrado una nueva solicitud de procedimiento en el sistema que requiere de su revisión y aprobación.')
            ->line('**Detalles de la Solicitud:**')
            ->line('• **Folio:** #' . $this->solicitud->folio)
            ->line('• **Procedimiento:** ' . $this->solicitud->nombre_documento)
            ->line('• **Solicitante:** ' . $nombreSolicitante . ' ' . $apellidoSolicitante)
            ->line('• **Estructura Nivel:** ' . ($this->solicitud->nivel->descripcion ?? 'N/A'))
            ->line('• **Subnivel Asociado:** ' . ($this->solicitud->subnivel->descripcion ?? 'N/A'))
            ->line('• **Fecha de Creación:** ' . $this->solicitud->created_at->format('d/m/Y H:i'))
            ->line('• **Localidad:** ' . ($this->solicitud->usuario->infoUsuario->localidad ?? 'N/A'))
            ->line('• **Área:** ' . ($this->solicitud->usuario->infoUsuario->area ?? 'N/A'))
            ->action('Ir al Panel de Aprobaciones', route('admin.revision'))
            ->line('Por favor, ingrese al panel para evaluar los detalles técnicos y emitir su resolución.')
            ->salutation('Saludos cordiales, Sistema AppIsoCalidad');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'solicitud_id' => $this->solicitud->id,
            'folio' => $this->solicitud->folio
        ];
    }
}