<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class StaticPageController extends Controller
{
    public function about($lang = 'id')
    {
        App::setLocale($lang);

        return view('about', compact('lang'));
    }

    public function survey()
    {
        $surveyUrl = config('app.survey_url');

        return view('survey', compact('surveyUrl'));
    }
}
