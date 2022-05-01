<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class notifiTraTotalUser extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    public $user;
    public $type;
    public $total;
    public $balance;
    public $valotTotal;
    public $encanje;
    public $traslados;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message, $user, $type,
     $total, $balance, $valotTotal, $encanje, $traslados)
    {
        $this->message = $message;        
        $this->user = $user;
        $this->type = $type;
        $this->total = $total;
        $this->balance = $balance;
        $this->valotTotal = $valotTotal;
        $this->encanje = $encanje;
        $this->traslados = $traslados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->markdown('mails.notificationTraTotalUser');
    }
}
