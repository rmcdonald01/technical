<?php

namespace App\Mail\Weather;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WeatherUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $weather;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employee, $weather)
    {
        $this->employee = $employee;
        $this->weather = $weather;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Weather Reminder")->markdown('emails.weather.update');
    }
}
