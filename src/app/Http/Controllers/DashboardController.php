<?php

namespace App\Http\Controllers;

use App\Models\Capability;
use App\Models\CapabilityOperationalDomain;
use App\Models\CapabilityWafarelevel;
use App\Models\Nation;
use App\Models\OperationalDomain;
use App\Models\RankByDomain;
use App\Models\ResultByNation;
use App\Models\ResulTestParticipant;
use App\Models\ResultTestCapability;
use App\Models\TestParticipant;
use App\Models\WarfareLevel;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{
    public function index() {
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

        $country_compare_info = ResultByNation::orderBy('rank','desc')->get();
        $rankByDomain = RankByDomain::all();
        $warfareLevels = WarfareLevel::pluck('name','id')->toArray();
        $domains = OperationalDomain::pluck('name','id')->toArray();

        return view('dashboard')
            ->with([
                'years'                => $years,
                'data_by_year'         => $data_by_year,

                'country_compare_info' => $country_compare_info,
                'rankByDomain'         => $rankByDomain,

                'success_capability_sorted' => $this->count_success_capability(),

                'percentTestedNations' => $this->percentTestedNations(),
                'integralIndicators'   => $this->integralIndicators(),

                'domains'     => $domains,
                'domainsKeys' => array_keys($domains),

                'warfareLevels'     => $warfareLevels,
                'warfareLevelsKeys' => array_keys($warfareLevels),
            ]);
    }

    public function createTables() {
//        DB::statement('CREATE TABLE result_test_capabilities (id SERIAL PRIMARY KEY, year integer, all_value integer, multidomain integer, single integer);');
//        DB::statement('CREATE TABLE result_test_participants (id SERIAL PRIMARY KEY, year integer, all_value integer, limited_success integer, interoperability_issue integer, not_tested integer, success integer, pending integer);');

//        DB::statement('CREATE TABLE result_by_nations (id SERIAL PRIMARY KEY, year integer, nation_id integer, limited_success integer, interoperability_issue integer, not_tested integer, success integer,pending integer, all_value integer, ratio float, md integer, sd integer, capab_count integer, domains_id text, rank float, warvares text);');

//        DB::statement('CREATE TABLE indicators_by_nations (id SERIAL PRIMARY KEY, year integer, integral_indicators float, tested_nations float);');
//        DB::statement('CREATE TABLE rank_by_domains (id SERIAL PRIMARY KEY, year integer, domain_id integer, limited_success integer, interoperability_issue integer, not_tested integer, success integer,pending integer);');
    }

    static function getCCByNation($nationId) {
        $temp[2]='AL';
        $temp[3]='BE';
        $temp[4]='BG';
        $temp[5]='CA';
        $temp[6]='HR';
        $temp[7]='CZ';
        $temp[8]='DK';
        $temp[9]='EE';
        $temp[10]='FR';
        $temp[11]='DE';
        $temp[12]='GR';
        $temp[13]='HU';
        $temp[14]='IS';
        $temp[15]='IT';
        $temp[16]='LV';
        $temp[17]='LT';
        $temp[18]='LU';
        $temp[19]='MK';
        $temp[20]='ME';
        $temp[21]='NL';
        $temp[22]='NO';
        $temp[23]='PL';
        $temp[24]='PT';
        $temp[25]='RO';
        $temp[26]='SK';
        $temp[27]='SI';
        $temp[28]='ES';
        $temp[29]='TR';
        $temp[30]='GB';
        $temp[31]='US';
        $temp[32]='UA';
        $temp[33]='IE';
        $temp[34]='IL';
        $temp[35]='JP';
        $temp[36]='KZ';
        $temp[37]='KR';
        $temp[38]='KG';
        $temp[39]='MT';
        $temp[40]='MD';
        $temp[41]='BA';
        $temp[42]='CO';
        $temp[43]='FI';
        $temp[44]='GE';
        $temp[45]='AU';
        $temp[46]='AT';

        return $temp[$nationId];
    }

    static function getNationByCC($ccid) {
        $temp['AL']='2';
        $temp['BE']='3';
        $temp['BG']='4';
        $temp['CA']='5';
        $temp['HR']='6';
        $temp['CZ']='7';
        $temp['DK']='8';
        $temp['EE']='9';
        $temp['FR']='10';
        $temp['DE']='11';
        $temp['GR']='12';
        $temp['HU']='13';
        $temp['IS']='14';
        $temp['IT']='15';
        $temp['LV']='16';
        $temp['LT']='17';
        $temp['LU']='18';
        $temp['MK']='19';
        $temp['ME']='20';
        $temp['NL']='21';
        $temp['NO']='22';
        $temp['PL']='23';
        $temp['PT']='24';
        $temp['RO']='25';
        $temp['SK']='26';
        $temp['SI']='27';
        $temp['ES']='28';
        $temp['TR']='29';
        $temp['GB']='30';
        $temp['US']='31';
        $temp['UA']='32';
        $temp['IE']='33';
        $temp['IL']='34';
        $temp['JP']='35';
        $temp['KZ']='36';
        $temp['KR']='37';
        $temp['KG']='38';
        $temp['MT']='39';
        $temp['MD']='40';
        $temp['BA']='41';
        $temp['CO']='42';
        $temp['FI']='43';
        $temp['GE']='44';
        $temp['AU']='45';
        $temp['AT']='46';

        return $temp[$ccid];
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

        foreach ($capabilities as $capability) {
            $capabilities_success[$capability->id] = [
                'name' => $capability->name,
                'success' => 0
            ];
        }

        $test_participants = TestParticipant::select('capability_id')->where('participant_result','Success')->get();

        foreach ($test_participants as $res) {
            $capabilities_success[$res->capability_id]['success']++;
        }

        usort($capabilities_success, function ($a, $b) {
            return $b['success'] <=> $a['success'];
        });

        return $capabilities_success;
    }

    public function testCasesByNation() {
        //public function myTest() {
        $test_capability = Capability::all();

        $super_result_capability = [];
        $allNationId = $test_capability->groupBy('nation_id');

        foreach ($allNationId->keys() as $nationId) {
            $result[$nationId] = $test_capability->where('nation_id', $nationId);

            foreach ($result[$nationId] as $capByNation) {
                $super_result[$nationId][] = $capByNation->id;
                $super_result_capability[$nationId][] = $capByNation->id;
            }
        }

        foreach ($super_result as $key => $_res) {
            $cap_count[$key] = count($super_result[$key]);
        }

        $all_warvares = CapabilityWafarelevel::all();

        foreach ($super_result as $key => $_res) {
            foreach ($_res as $__res) {
                $warvares = CapabilityWafarelevel::select('warfarelevel_id')->where('capability_id',$__res)->distinct()->pluck('warfarelevel_id');
                $super_result[$key]['warvares'] = $warvares;
            }
        }

        $operationalDomains = CapabilityOperationalDomain::all();

        foreach ($super_result as $key => $_res) {
            foreach ($_res as $__res) {
                $domain_res = $operationalDomains->where('capability_id',$__res);
                foreach ($domain_res as $domain_id) {
                    $super_result[$key]['domains'][] = $domain_id->operational_domain_id;
                }
                $super_result[$key]['domains'] = array_unique($super_result[$key]['domains']);
            }
        }

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
//        $test_participant = TestParticipant::limit(1000)->get();

        foreach ($super_result as $key => $res){
            $res_temp = $test_participant->whereIn('capability_id', $super_result_capability[$key]);

            $res_nation[$key] = [];
            $res_nation[$key]['Not Tested'] = 0;
            $res_nation[$key]['Limited Success'] = 0;
            $res_nation[$key]['Interoperability Issue'] = 0;
            $res_nation[$key]['Success'] = 0;
            $res_nation[$key]['Pending'] = 0;
            $res_nation[$key]['ratio'] = 0;
            $res_nation[$key]['all_value'] = 0;

            foreach ($res_temp as $res_t){
                $res_nation[$key][$res_t->participant_result] ++;
            }

            $res_nation[$key]['ratio'] = ($res_nation[$key]['Success']+$res_nation[$key]['Limited Success']*0.5);
            $res_nation[$key]['all_value'] = 	$res_nation[$key]['Not Tested']+
                $res_nation[$key]['Limited Success']+
                $res_nation[$key]['Interoperability Issue']+
                $res_nation[$key]['Success']+
                $res_nation[$key]['Pending'];
        }

        foreach ($super_result as $key => $result){
            $res_nation[$key]['Multidomain'] = $result['md'];
            $res_nation[$key]['Singledomain'] = $result['sd'];
            $res_nation[$key]['domains'] = $result['domains'];
            $res_nation[$key]['cap_count'] = $result['md'] + $result['sd'];
            $res_nation[$key]['warvares'] = json_encode($result['warvares']);
        }

        foreach ($cap_count as $key => $_res) {
            $res_nation[$key]['cap_count'] = $cap_count[$key];
        }

        foreach ($res_nation as $key => $result){
            if ($res_nation[$key]['Success']===0){
                $succ_rank =0 ;
            } else {
                $succ_rank = (($res_nation[$key]['Success']/$res_nation[$key]['all_value'])*0.5);
            }

            if ($res_nation[$key]['Success']===0){
                $md_rank = 0;
            } else {
                $md_rank   = (($res_nation[$key]['Multidomain']/$res_nation[$key]['cap_count'])*0.3);
            }

            if ($res_nation[$key]['Success']===0){
                $sd_rank = 0;
            } else {
                $sd_rank   = (($res_nation[$key]['Singledomain']/$res_nation[$key]['cap_count'])*0.2);
            }

            $rank = $succ_rank + $md_rank + $sd_rank;

            $res_nation[$key]['rank'] = $rank;
        }

        foreach ($res_nation as $nation_id => $nation_data) {
            ResultByNation::updateOrInsert(
                ['nation_id' => $nation_id],
                [
                    "year" => "2022",
                    "not_tested" => $nation_data['Not Tested'],
                    "limited_success" => $nation_data['Limited Success'],
                    "interoperability_issue" => $nation_data['Interoperability Issue'],
                    "success" => $nation_data['Success'],
                    "pending" => $nation_data['Pending'],
                    "ratio" => $nation_data['ratio'],
                    "md" => $nation_data['Multidomain'],
                    "sd" => $nation_data['Singledomain'],
                    "capab_count" => $nation_data['cap_count'],
                    "all_value" => $nation_data['all_value'],
                    "domains_id" => json_encode($nation_data['domains']),
                    "rank" => $nation_data['rank'],
                    "warvares" => $nation_data['warvares'],
                ]
            );
        }

        return $res_nation;
    }
    public function integralIndicators() {
        $years = [
            '2021',
            '2022',
        ];

//        $data_by_year[$year]['test_participants']

        $test_participant = TestParticipant::all();

        $allSuc = $test_participant
            ->where('participant_result','Success')
//                ->where('exercise_cycle','CWIX ' . $year)
            ->count();

        $allLimSuc = $test_participant
            ->where('participant_result','Limited Success')
            ->count();

        $allTest = $test_participant->count();
        $result = (($allSuc+$allLimSuc*0.5)/$allTest)*100;
//        $invResult = 100 - $result;

        return $result;
    }

    public function percentTestedNations() {
        $testedNation = Capability::all()->groupBy('nation_id')->count();

        $allNation = Nation::all()->count();

        $result = (100/$allNation) * $testedNation;

        //dd($result,$testedNation,$allNation);

        return $result;
    }

    public function rankByDomain() {
        $result = CapabilityOperationalDomain::all()->groupBy('operational_domain_id');

        $f_result = [];

        foreach ($result as $capByDom) {
            foreach ($capByDom as $cap) {
                $f_result[$cap->operational_domain_id][] = $cap->capability_id;
                $m_result[$cap->operational_domain_id] = [];
            }
        }

        $all_cap_result = TestParticipant::select('capability_id', 'participant_result')->get();
        //$all_cap_result = TestParticipant::limit(500);

        foreach ($f_result as $key => $capArray) {
            $domain_success_result[$key]['Not Tested'] = $all_cap_result->whereIn('capability_id', $capArray)->where('participant_result','Not Tested')->count();
            $domain_success_result[$key]['Limited Success'] = $all_cap_result->whereIn('capability_id', $capArray)->where('participant_result','Limited Success')->count();
            $domain_success_result[$key]['Interoperability Issue'] = $all_cap_result->whereIn('capability_id', $capArray)->where('participant_result','Interoperability Issue')->count();
            $domain_success_result[$key]['Success'] = $all_cap_result->whereIn('capability_id', $capArray)->where('participant_result','Success')->count();
            $domain_success_result[$key]['Pending'] = $all_cap_result->whereIn('capability_id', $capArray)->where('participant_result','Pending')->count();
        }

        foreach ($domain_success_result as $domain_id => $domain_data) {
            RankByDomain::updateOrInsert(
                ['domain_id' => $domain_id],
                [
                    "year" => "2022",
                    "not_tested" => $domain_data['Not Tested'],
                    "limited_success" => $domain_data['Limited Success'],
                    "interoperability_issue" => $domain_data['Interoperability Issue'],
                    "success" => $domain_data['Success'],
                    "pending" => $domain_data['Pending']
                ]
            );
        }

        return $domain_success_result;
    }
}
