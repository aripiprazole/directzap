<?php

namespace App\Mail;

use App\Activation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationEmail extends Mailable {
  use Queueable, SerializesModels;

  private $activation;

  /**
   * Create a new message instance.
   *
   * @param Activation $activation
   */
  public function __construct(Activation $activation) {
    $this->activation = $activation;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build(): ActivationEmail {
    return $this->view('mail.activation');
  }
}
