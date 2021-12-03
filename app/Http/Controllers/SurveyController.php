<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    function getSurveyDataPage()
    {
        return view('pages.survey-data');
    }
}
