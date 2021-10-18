<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\UserMembership;

class MembershipPurchaseMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $membership;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserMembership $membership)
    {
        $this->membership = $membership;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->markdown('mails.createduser');
    }
}
