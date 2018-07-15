<?php

namespace App\Http\Controllers;

class ApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function put(CurrenciesRequest $request) {

    }
}
