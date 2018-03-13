<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginCredentials extends Mailable
{
    use Queueable, SerializesModels;
    
    // Definimos los parametros como publicos 
    // para tener accesos a estos en la vista.
    public $user;
    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.login-credentials')
                    ->subject('Tus credenciales de acceso a '.config('app.name'));
    }
}
