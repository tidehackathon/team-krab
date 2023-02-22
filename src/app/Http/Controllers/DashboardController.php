<?php

namespace App\Http\Controllers;

use App\Models\Capability;
use App\Models\CapabilityOperationalDomain;
use App\Models\ResulTestParticipant;
use App\Models\ResultTestCapability;
use App\Models\TestParticipant;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{
    public function index() {
//        $this->count_success_capability();
//        return 1;
        $years = [
            '2021',
            '2022',
        ];

        $data_by_year = $years;
        $ResulTestParticipants = ResulTestParticipant::all();
        $ResultTestCapabilities = ResultTestCapability::all();

        foreach ($years as $year) {
            $ResulTestParticipant = $ResulTestParticipants->where('year', $year)->first();
            $data_by_year[$year]['test_participants'] = [
                'all' => $ResulTestParticipant->all_value,
                'Limited Success' => $ResulTestParticipant->limited_success,
                'Interoperability Issue' => $ResulTestParticipant->interoperability_issue,
                'Not Tested' => $ResulTestParticipant->not_tested,
                'Success' => $ResulTestParticipant->success,
                'Pending' => $ResulTestParticipant->pending,
            ];

            $ResultTestCapability = $ResultTestCapabilities->where('year', $year)->first();
            $data_by_year[$year]['capabilities'] = [
                'all' => $ResultTestCapability->all_value,
                'multidomain' => $ResultTestCapability->multidomain,
                'single' => $ResultTestCapability->single,
            ];
        }


        $country_compare_info = [
            [
                'cc' => 'UA',
                'name' => 'Nation 1',
                'success' => 1,
                'limited_success' => 4,
                'interop_issue' => 1,
                'not_tested' => 1,
                'pending' => 1,
                'single_domain' => 1,
                'multi_domain' => 1,
                'multi_standard' => 1,
                'tested_domains' => 1,
                'involved_w_l' => 1,
                'overall_level' => 3,
            ],
            [
                'cc' => 'US',
                'name' => 'Nation 2',
                'success' => 1,
                'limited_success' => 1,
                'interop_issue' => 1,
                'not_tested' => 1,
                'pending' => 1,
                'single_domain' => 1,
                'multi_domain' => 1,
                'multi_standard' => 1,
                'tested_domains' => 1,
                'involved_w_l' => 1,
                'overall_level' => 1,
            ],
            [
                'cc' => 'PL',
                'name' => 'Nation 3',
                'success' => 1,
                'limited_success' => 1,
                'interop_issue' => 1,
                'not_tested' => 1,
                'pending' => 1,
                'single_domain' => 1,
                'multi_domain' => 1,
                'multi_standard' => 1,
                'tested_domains' => 1,
                'involved_w_l' => 1,
                'overall_level' => 1,
            ],
        ];

//        DB::statement('CREATE TABLE result_test_capabilities (id SERIAL PRIMARY KEY, year integer, all_value integer, multidomain integer, single integer);');
//        DB::statement('CREATE TABLE result_test_participants (id SERIAL PRIMARY KEY, year integer, all_value integer, limited_success integer, interoperability_issue integer, not_tested integer, success integer, pending integer);');

        return view('dashboard')
            ->with([
                'years'                => $years,
                'data_by_year'         => $data_by_year,
                'country_compare_info' => $country_compare_info
            ]);
    }

    public function count() {
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

        foreach ($data_by_year as $year => $year_data) {
            ResulTestParticipant::updateOrInsert(
                ['year' => $year],
                [
                    "all_value" => $year_data['test_participants']['all'],
                    "limited_success" => $year_data['test_participants']['Limited Success'],
                    "interoperability_issue" => $year_data['test_participants']['Interoperability Issue'],
                    "not_tested" => $year_data['test_participants']['Not Tested'],
                    "success" => $year_data['test_participants']['Success'],
                    "pending" => $year_data['test_participants']['Pending'],
                ]
            );

            ResultTestCapability::updateOrInsert(
                ['year' => $year],
                [
                    "all_value" => $year_data['capabilities']['all'],
                    "multidomain" => $year_data['capabilities']['multidomain'],
                    "single" => $year_data['capabilities']['single'],
                ]
            );
        }

        return 'All data updated!';
    }

    public function count_success_capability() {
        $capabilities = Capability::all();
        $capabilities_success = [];

        foreach ($capabilities as $capability) {
            $capabilities_success[$capability->id] = [
                'name' => $capability->name,
                'success' => 0
            ];

            foreach ($capability->testParticipants as $testParticipant) {
                if($testParticipant->participant_result == 'Success') {
                    $capabilities_success[$capability->id]['success']++;
                }
            }
        }

        dd($capabilities_success);
    }

    public function percentTestedNations() {
        $testedNation = Capability::all()->groupBy('nation_id')->count();

        $allNation = Nation::all()->count();

        $result = (100/$allNation) * $testedNation;

        //dd($result,$testedNation,$allNation);

        return $result;
    }

    public function testCasesByNation() {
        $test_capability = Capability::all();

        $allNationId = $test_capability->groupBy('nation_id');

        foreach ($allNationId->keys() as $nationId) {
            $result[$nationId] = $test_capability->where('nation_id', $nationId);

            foreach ($result[$nationId] as $capByNation) {
                $super_result[$nationId][] = $capByNation->id;
            }
        }

        $operationalDomains = CapabilityOperationalDomain::all();

        foreach ($super_result as $key => $_res) {
            $super_result[$key]['md'] = 0;
            $super_result[$key]['sd'] = 0;

            foreach ($_res as $__res) {
                $domain_res = $operationalDomains->where('capability_id',$__res)->count();

                if ($domain_res>1)
                    $super_result[$key]['md']++;
                else if($domain_res===1)
                    $super_result[$key]['sd']++;

                $domain_res = 0;
            }
        }

        $test_participant = TestParticipant::all();
        //$test_participant = TestParticipant::limit(1000)->get();

        foreach ($super_result as $key => $res){
            $res_temp = $test_participant->whereIn('capability_id', $res);

            $res_nation[$key] = [];
            $res_nation[$key]['Not Tested'] = 0;
            $res_nation[$key]['Limited Success'] = 0;
            $res_nation[$key]['Interoperability Issue'] = 0;
            $res_nation[$key]['Success'] = 0;
            $res_nation[$key]['Pending'] = 0;
            $res_nation[$key]['ratio'] = 0;
            $res_nation[$key]['all'] = 0;

            foreach ($res_temp as $res_t){
                $res_nation[$key][$res_t->participant_result] ++;
            }

            $res_nation[$key]['ratio'] = ($res_nation[$key]['Success']+$res_nation[$key]['Limited Success']*0.5);
            $res_nation[$key]['all'] =  $res_nation[$key]['Not Tested']+
                $res_nation[$key]['Limited Success']+
                $res_nation[$key]['Interoperability Issue']+
                $res_nation[$key]['Success']+
                $res_nation[$key]['Pending'];
        }



        $maxTestCases = 0;

        foreach ($res_nation as $nation){
            if ($maxTestCases<$nation['all'])
                $maxTestCases = $nation['all'];
        }

        foreach ($res_nation as $nation){
            $nation['ratio'] /= $maxTestCases;
        }

        foreach ($super_result as $key => $result){
            $res_nation[$key]['Multidomain'] = $result['md'];
            $res_nation[$key]['Sigledomain'] = $result['sd'];
        }

        //dd($res_nation,$maxTestCases);

        return $res_nation;
    }

    public function integralIndicators() {
        $test_participant = TestParticipant::all();

        $allSuc = $test_participant
            ->where('participant_result','Success')
            ->count();

        $allLimSuc = $test_participant
            ->where('participant_result','Limited Success')
            ->count();

        $allTest = $test_participant->count();
        $result = (($allSuc+$allLimSuc*0.5)/$allTest)*100;
        $invResult = 100 - $result;

        //dd($result,$invResult);

        return $result;

    }
}
