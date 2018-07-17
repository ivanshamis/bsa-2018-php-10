<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Entity\Currency;


class RateChanged extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $currency;
    protected $oldRate;

    public function __construct(User $user, Currency $currency, float $oldRate)
    {
        $this->user = $user;
        $this->currency = $currency;
        $this->oldRate = $oldRate;
    }

    public function build()
    {
        return $this->view('rate-changed-email')
            ->with([
                'userName' => $this->user->name,
                'currencyName' => $this->currency->name,
                'oldRate' => $this->oldRate,
                'newRate' => $this->currency->rate,
            ]);
    }
}