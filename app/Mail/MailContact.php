<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\Contact;
use App\Model\AddressShop;

class MailContact extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $contact;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = AddressShop::find(1);
        return $this->from($this->contact->email)
                ->subject($this->contact->subject)
                ->view('emails.contact',['contact'=>  $this->contact,'address' => $address]);
    }
}
