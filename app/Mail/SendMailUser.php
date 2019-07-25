<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailUser extends Mailable
{
    use Queueable, SerializesModels;
    public $cupom;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cupom)
    {
        $this->cupom = $cupom;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Cupom para clientes - Ecommerce')->view('emails.test')
            ->with([
                'cupom' => $this->cupom,
            ]);
    }
}
