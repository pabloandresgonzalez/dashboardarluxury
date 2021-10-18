<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\wallet_transactions;

class TransactionSentMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $Wallet;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(wallet_transactions $Wallet)
    {
        $this->Wallet = $Wallet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->markdown('mails.createdwallet_transactions');
    }
}
