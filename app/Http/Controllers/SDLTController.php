<?php

namespace App\Http\Controllers;

use App\Services\SdltCalculatorService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SDLTController extends Controller
{
    public function form(Request $request)
    {
        return view('sdlt');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getRates(Request $request): array
    {
        return config('sdlt.rates');
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $service = new SdltCalculatorService();

        $result = $service->calculate(
            (float) $validated['price'],
            $request->has('first_time_buyer'),
            $request->has('additional_property')
        );

        return view('sdlt', compact('result'));
    }
}
