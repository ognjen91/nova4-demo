<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ActivitiesInYourCity extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $salute;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $salute = 'Zdravo')
    {
        $this->user = $user;
        $this->salute = $salute;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.activities-in-your-city');
    }
}
