<?php

namespace App\Http\Controllers;

use App\DTO\WeatherDTO;
use App\Http\Requests\InputRequest;
use Illuminate\Support\Facades\Http;

class InputController extends Controller
{
    public function showInputForm()
    {
        return view('inputForm');
    }

    public function InputForm(InputRequest $request)
    {
        $address = $request->validated()['address'];
        $url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $address . '&appid=' . env('API_KEY');
        $response = Http::withOptions([
            'verify' => false,
        ])->get($url);
        $data = $response->json();
        $weatherDTO = new WeatherDTO($data);
        return view('InputForm', [
            'wheatherDto' => $weatherDTO,
        ]);
    }
}
