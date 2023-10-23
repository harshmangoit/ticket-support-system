<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new message instance.
     */
    public function __construct($view, $data, $subject)
    {
        $this->view = $view;
        $this->data = $data;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->view,
            with: [
                'data' => $this->data
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    // public static function assign_email($ticket_no) {
    //     $data = array('ticket_no'=>$ticket_no);
     
    //     Mail::send(['html'=>'ticket.assignMail'], $data, function($message) {
    //        $message->to('abhishek.choudhary13062000@gmail.com', 'Agent')->subject
    //           ('New Ticket Assigned');
    //        $message->from('abhishek.choudhary13062000@gmail.com','Admin');
    //     });
    //  }
}
