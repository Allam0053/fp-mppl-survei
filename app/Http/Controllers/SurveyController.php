<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Exception;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    function getSurveyDataPage()
    {
        $surveys = Survey::get();

        return view('pages.survey-data', compact(['surveys']));
    }

    function getSurveyDataAddForm()
    {
        return view('pages.survey-data-form');
    }

    function postSurveyData(Request $request)
    {
        $request->validate(['question' => 'required|max:255']);
        try {
            Survey::create(['question' => $request->question]);

            $message = 'Berhasil menambahkan data pertanyaan survei';

            return redirect()->route('survey-data')->with('success', $message);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    function getSurveyDataEditForm($id)
    {
        $survey = Survey::find($id);

        return view('pages.survey-data-form-edit', compact(['survey']));
    }

    function putSurveyData($id, Request $request)
    {
        $request->validate(['question' => 'required|max:255']);

        try {
            Survey::where('id', $id)->update(['question' => $request->question]);

            $message = 'Berhasil mengubah data pertanyaan survei';

            return redirect()->route('survey-data')->with('success', $message);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
