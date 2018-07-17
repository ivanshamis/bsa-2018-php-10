<?php

namespace App\Http\Controllers;

use App\Entity\Currency;
use App\User;
use App\Http\Requests\CurrencyRequest;
use Illuminate\Support\Facades\Gate;
use App\Jobs\SendRateChangedEmail;
use Illuminate\Support\Facades\Auth;

class ApiCurrencyController extends Controller
{
    public function put(CurrencyRequest $request, int $id) {
        $currency = Currency::findOrFail($id);
        if (Gate::allows('currency.put', $currency)) {
            $oldRate = $currency->rate;
            $currency->rate = $request->input('rate');
            $currency->save();

            $emailUsers = User::where('id', '<>', Auth::user()->id) -> get();
            foreach ($emailUsers as $user) {
                SendRateChangedEmail::dispatch($user, $currency, $oldRate)->onQueue('notification');
            }
            return response()->json(['Ok' => 'Currency rate updated!']);
        }
        else {
            return response()->json(['Error' => 'Unauthorized action!']);
        }
    }
}