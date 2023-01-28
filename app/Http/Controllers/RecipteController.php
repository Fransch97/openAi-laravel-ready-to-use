<?php

namespace App\Http\Controllers;

use App\Models\Pax;
use App\Models\Recipte;
use Illuminate\Http\Request;

class RecipteController extends Controller
{

    public function store(Request $request)
    {
        $languages = [
            'de' => "{$request['title']} Rezept für zwei Personen auf deutsch bitte",
            'it' => "Ricetta {$request['title']} per due persone in italiano perfavore",
            'en' => "{$request['title']} recipe for two people in english please",
            'fr' => "recette {$request['title']} pour deux personnes en français s'il vous plaît",
        ];

        $contents['title'] = $request['title'];
        foreach ($languages as $key => $language) {
            $gpt = app('gpt');
            $response = $gpt->askGpt($language);
            $string = json_decode($response)->choices[0]->text;
            $contents["content_{$key}"] = $string;
        }

        $recipe = Recipte::query()->create($contents);
        dd($recipe);
        return response("success", 201);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
