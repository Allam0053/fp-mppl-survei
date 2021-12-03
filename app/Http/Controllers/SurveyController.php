<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Response;
use App\Models\Survey;
use Carbon\Carbon;
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

    function getSurveyPage()
    {
        $surveys = Survey::get();
        return view('pages.isi-survey', compact(['surveys']));
    }

    function postSurveyResponses(Request $r)
    {
        // $r
        // dd($r);
        $customer = Customer::create([
            "name" => $r->name,
            "email" => $r->email,
            "occupation" => $r->occupation
        ]);

        $surveys = Survey::get();
        for ($it = 0; $it < count($r->survey_id); $it++) {
            $response = Response::create([
                "survey_id" => $r->survey_id[$it],
                "customer_id" => $customer->id,
                "response" => $r->response[$it],
            ]);
        }

        return redirect()->back()->with('success', 'response terekam, terima kasih telah mengisi survey');
    }

    function getSurveyResultPage()
    {
        $responses = Response::get();
        $stats = $this->getStats();
        // dd($stats);
        return view('pages.hasil-survey',  compact(['responses', 'stats']));
    }

    function getStats()
    {
        $stater = new Stats('new');
        // Today's Questions
        $q = $stater->total(Survey::class);
        // Today's Responses
        $r = $stater->todayCount(Response::class);
        // Today's New Customers responding
        $u = $stater->todayCount(Customer::class);
        // Total Reponses
        $r = $stater->total(Response::class);

        $newResponses = $stater->getNewStatOf(Response::class);
        $newCustomer = $stater->getNewStatOf(Customer::class);

        return [
            'today_questions' => $q,
            'today_questions_plus' => $stater->todayCount(Survey::class),
            'today_responses' => $r,
            'today_customer_responding' => $u,
            'total_responses' => $r,
            'graph_responses' => $newResponses,
            'graph_customer' => $newCustomer,
            'dates' => $stater->getNineDates('Y-m-d')
        ];
    }
}
