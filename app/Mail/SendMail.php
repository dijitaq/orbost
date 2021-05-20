<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $data )
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ( $this->data['request'] == "send_contact" ) {
            return $this->from( $this->data['email'] )
                ->subject( 'New message from: ' . $this->data['first_name'] . ' ' . $this->data['last_name'] )
                ->view( 'frontend.layout.contact' )
                ->with( 'data', $this->data );

        } else if ( $this->data['request'] == "send_appraisal" ) {
            return $this->from( $this->data['email'] )
                ->subject( 'New appraisal request from: ' . $this->data['first_name'] . ' ' . $this->data['last_name'] )
                ->view( 'frontend.layout.appraisal' )
                ->with( 'data', $this->data );
        }
    }
}
