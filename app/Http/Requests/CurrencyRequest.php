<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CurrencyRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'rate' => 'required|numeric|min:0'
        ];
    }
}