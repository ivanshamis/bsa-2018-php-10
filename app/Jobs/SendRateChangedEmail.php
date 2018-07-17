<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Jobs\Job;
use App\User;
use App\Entity\Currency;
use App\Mail\RateChanged;
use Illuminate\Support\Facades\Mail;

class SendRateChangedEmail extends Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $currency;
    public $oldRate;
    
    public function __construct(User $user, Currency $currency, float $oldRate)
    {
        $this->user = $user;
        $this->currency = $currency;
        $this->oldRate = $oldRate;
    }

    public function handle()
    {
        $message  = new RateChanged($this->user, $this->currency, $this->oldRate);
        Mail::to($this->user)->send($message);
    }
}