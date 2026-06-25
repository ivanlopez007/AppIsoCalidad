<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CorreoPruebaNotification extends Notification
{
    use Queueable;

    // Puedes pasarle datos dinámicos a la clase a través del constructor
    protected string $nombreUsuario;

    public function __construct($nombreUsuario = 'Usuario')
    {
        $this->nombreUsuario = $nombreUsuario;
    }

    /**
     * Determina por qué canales se enviará la notificación.
     * En este caso, solo usaremos 'mail'.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Construye el mensaje de correo electrónico.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('¡Hola desde mi app en Laravel!') // Asunto del correo
                    ->greeting('¡Hola, ' . $this->nombreUsuario . '!') // Saludo inicial
                    ->line('Esta es una prueba de correo utilizando el sistema de notificaciones de Laravel.')
                    ->line('Si estás viendo esto en Mailtrap, ¡tu configuración funciona perfectamente!')
                    ->action('Visitar mi sitio web', url('/')) // Botón de acción
                    ->line('Gracias por usar nuestra aplicación de pruebas.'); // Línea final
    }

    /**
     * Versión en array (por si en el futuro decides guardarla en Base de Datos).
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}