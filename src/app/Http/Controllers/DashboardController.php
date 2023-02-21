<?php

namespace App\Http\Controllers;

use App\Models\Capability;
use App\Models\CapabilityOperationalDomain;
use App\Models\TestParticipant;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{

    public function index2() {


        return view('dashboard');
    }

    public function index() {
        $test_participants = TestParticipant::all();

        $exercise_cycles = TestParticipant::select('exercise_cycle')->distinct()->pluck('exercise_cycle');
        $participant_results_obj = TestParticipant::select('participant_result')->distinct()->pluck('participant_result');

        $participant_results = [];

        foreach ($participant_results_obj as $participant_result_obj) {
            $participant_results[] = $participant_result_obj;
        }

        $data_by_year = [];
        $years = [];
        foreach ($exercise_cycles as $exercise_cycle) {
            $year = preg_replace('/\D/', '', $exercise_cycle);
            $years[] = $year;
            $data_by_year[$year]['test_participants'] = [
                'all' => $test_participants->where('exercise_cycle','CWIX ' . $year)->count(),
            ];

            foreach ($participant_results as $participant_result) {
                $data_by_year[$year]['test_participants'][$participant_result] = $test_participants
                    ->where('exercise_cycle','CWIX ' . $year)
                    ->where('participant_result', $participant_result)
                    ->count();
            }

            $capabilities = Capability::join('test_participants', 'capabilities.id', '=', 'test_participants.capability_id')
                ->where('test_participants.exercise_cycle','CWIX ' . $year)
                ->get()
                ->groupBy('id');

            $capabilities_multidomain = 0;

            foreach ($capabilities as $capability) {
                $capabilityOperationalDomain = $capability[0]->capabilityOperationalDomain;
                if($capabilityOperationalDomain && $capabilityOperationalDomain->count() > 1) {
                    $capabilities_multidomain++;
                }
            }

            $data_by_year[$year]['capabilities'] = [
                'all' => $capabilities->count(),
                'multidomain' => $capabilities_multidomain,
                'single' => $capabilities->count() - $capabilities_multidomain
            ];
        }

//        dd($data_by_year);

        return view('dashboard')->with([
            'participant_results' => $participant_results,
            'years'               => $years,
            'data_by_year'        => $data_by_year
        ]);
    }

}
