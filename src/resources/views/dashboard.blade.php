<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KRAB - Dashboard</title>

    <link rel="stylesheet" href="/css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
</head>
<body>

<div class="d-print" style="display: none;">
    <div style="display: flex; flex-direction: column; align-items: center; margin: 15cm auto 22cm">
        <h1 style="text-align: center; margin-bottom: 20px">CWIX Event Report</h1>
        <img src="/img/logo.png" alt="Logo KRAB" style="width: 150px">
    </div>
</div>

<div style="display:flex; height: fit-content; flex-wrap: wrap" class="main-page">
    <div class="main-page__1-column block">
        <h2 style="margin: auto; display: flex; justify-content: center; align-items: center">
            <span style="margin-right: 5px">
                Overview by
            </span>
            <div class="select">
                <select class="j-select-year">
                    <option value="2021">2021</option>
                    <option value="2022" selected>2022</option>
                </select>
            </div>
        </h2>

        <div style="position: relative;">
            <span class="j-testRatio-all chart-value">-</span>
            <canvas id="testRatioData"></canvas>
        </div>

        <div style="position: relative;">
            <span class="j-configSuccessfulTest-all chart-value" style="top: 66%">-</span>
            <canvas id="overViewChart"></canvas>
        </div>


        <div style="position: relative;">
            <span class="j-numOfCap-all chart-value">-</span>
            <canvas id="numOfCap"></canvas>
        </div>
    </div>
    <div class="main-page__2-column">
        <div style="height: min-content; margin-bottom:10px; margin-right:10px;" class="block">
            <h2 style="margin: auto">Capability information</h2>

            <div style="display: flex; justify-content: space-between">
                <div style="position: relative; width: 49%">
                    <canvas id="capBySucc"></canvas>
                </div>

                <div style="position: relative; width: 49%">
                    <canvas id="capByYear"></canvas>
                </div>
            </div>

            <div style="position: relative; margin: auto; width:100%;" class="full-width-canvas">
                <canvas style="margin: 5px 0" width="100%" id="resultByDomain"></canvas>
            </div>
        </div>

        <div class="block d-no-print">
            <div style="display: flex;">
                <div class="j-map-trigger d-no-print canvas-block btn" style="margin-right: 10px; padding: 5px 30px">
                    <H3>Country comparing</H3>
                </div>

                <div class="j-rec-trigger d-no-print canvas-block btn" style="margin-right: 10px; padding: 5px 30px">
                    <H3>Recommendations</H3>
                </div>

                <div class="canvas-block d-no-print btn" onclick="window.print();" style="padding: 5px 30px">
                    <H3>Print</H3>
                </div>


                <div style="display: flex; justify-content: flex-end; margin-left: auto" class="d-no-print">
                    <img src="/img/logo.png" alt="Logo KRAB" style="width: 150px">
                </div>
            </div>
        </div>
    </div>
    <div class="main-page__3-column">
        <div class="block" style="margin-bottom: 20px">
            <h2 style="margin: 0 auto">Tests Statistics</h2>

            <div style="display: flex; margin-bottom:10px;">
                <div style="position: relative;  width:49%;">
                    <canvas id="intIndOfSucc"></canvas>
                </div>
                <div style="position: relative;  width:49%;">
                    <canvas id="numbOfCountries"></canvas>
                </div>
            </div>

            <div style="position: relative; width:99%;">
                <canvas id="testSuccRatio"></canvas>
            </div>
        </div>

        <div class="block">
            <h2 style="margin: auto">Сountries interoperability</h2>
            <div style="display: flex; flex-direction: column">
                <div style="display: flex; flex-direction: column; width: 100%">
                    <span class="select-title-comparing" style="margin-top: 15px">Select countries for comparing</span>
                    <div style="display: flex; ">
                        <div class="canvas-block" style="width: 100%">
                            <h3 style="margin: auto">
                                <div class="select" style="width: 100%; text-align: center">
                                    <select class="j-compare-select-1" style="width: 100%; text-align: center">
                                        @foreach($country_compare_info->sortBy('nation_id') as $key => $nation)
                                            @if($nation['rank'])
                                                <option value="{{ $key }}">Nation {{ $nation['nation_id'] + 1 }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </h3>
                            <div class="j-compare-value-1 percent"></div>
                        </div>
                        <div class="canvas-block" style="width: 100%">
                            <h3 style="margin: auto">
                                <div class="select" style="width: 100%; text-align: center">
                                    <select class="j-compare-select-2" style="width: 100%; text-align: center">
                                        @foreach($country_compare_info->sortBy('nation_id') as $key => $nation)
                                            <option value="{{ $key }}">Nation {{ $nation['nation_id'] + 1 }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </h3>
                            <div class="j-compare-value-2 percent"></div>
                        </div>
                    </div>
                </div>
                <div style="position: relative; margin-left: auto; width: 100%">
                    <canvas id="countryByRatio"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Country comparing -->
<div class="j-map d-print map">
    <span class="j-map-trigger cross d-no-print"></span>

    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

    <script src="/js/map.js"></script>
    <h1 class="d-print">Statistics per country</h1>
    <h2 class="d-no-print">Click countries to select</h2>
    <div id="chartdiv" class="d-no-print"></div>
    {{--    <div id="info" class="d-no-print">Selected countries: <span id="selected">-</span></div>--}}

    <table id="comparing_countries" class="styled-table">
        <thead>
        <tr>
            <th rowspan="2">
                <a onclick="sortTable('testTable',0,2)">Nation</a>
            </th>
            <th colspan="5" style="text-align: center">
                <a onclick="" style="text-align: center">Numbers of tests</a>
            </th>
            <th colspan="3" style="text-align: center">Number of capabilities tested</th>
            <th rowspan="2">Tested domains</th>
            <th rowspan="2">Involved warfare levels</th>
            <th rowspan="2">
                <a onclick="sortTable('testTable',11,2)">Overall interoperability level</a>
            </th>
        </tr>
        <tr>
            <th>Success</th>
            <th>Limited Success</th>
            <th>Interoperability Issue</th>
            <th>Not Tested</th>
            <th>Pending</th>
            <th>Single-domain</th>
            <th>Multi-domain</th>
            <th>Multi-standart</th>
        </tr>
        </thead>
        <tbody>
        @foreach($country_compare_info as $item)
            <tr class="j-compare-country d-print-table-row" data-cc="{{ \App\Http\Controllers\DashboardController::getCCByNation($item['nation_id']) }}" style="display: none">
                <td>Nation {{ $item['nation_id'] + 1 }}</td>
                <td>{{ $item['success'] }}</td>
                <td>{{ $item['limited_success'] }}</td>
                <td>{{ $item['interoperability_issue'] }}</td>
                <td>{{ $item['not_tested'] }}</td>
                <td>{{ $item['pending'] }}</td>
                <td>{{ $item['sd'] }}</td>
                <td>{{ $item['md'] }}</td>
                <td>-</td>
                <td>
                    @if(json_decode($item['domains_id']))
                        @foreach(json_decode($item['domains_id']) as $domain_id)
                            {{ $domains[$domain_id] . ', ' }}
                        @endforeach
                    @endif
                </td>
                <td>
                    @if(json_decode($item['warvares']))
                        @foreach(json_decode($item['warvares']) as $warfare_id)
                            {{ $warfareLevels[$warfare_id] . ', ' }}
                        @endforeach
                    @endif
                </td>
                <td>{{ round($item['rank'],3) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- !Country comparing -->

<!-- Recommendations -->
<div class="j-rec d-print map">
    <span class="j-rec-trigger cross d-no-print"></span>

    <h1 style="text-align: center">Recommendations for the next CWIX exercise cycle</h1>
    <table id="rec_table" class="styled-table">
        <thead>
            <tr>
                <th colspan="2" style="text-align: center">General recommendations</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Existing capabilities to be tested</td>
                <td>
                    @php
                    $key = array_key_last($success_capability_sorted);
                    @endphp
                    {{ $success_capability_sorted[$key - 1]['name'] }},
                    {{ $success_capability_sorted[$key - 2]['name'] }},
                    {{ $success_capability_sorted[$key - 3]['name'] }},
                    {{ $success_capability_sorted[$key - 4]['name'] }},
                    {{ $success_capability_sorted[$key - 5]['name'] }}
                </td>
            </tr>
            <tr>
                <td>Capabilities to be deployed (from NDPP list)</td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <table id="rec_table" class="styled-table">
        <thead>
            <tr>
                <th colspan="7" style="text-align: center">Recommendations for the nations
                </th>
            </tr>
            <tr>
                <th rowspan="3">
                    <a onclick="sortTable('testTable',0,2)">Nation</a>
                    <!--                            <input type="text" class="select-dropdown" id="myInput0" onkeyup="myFunction('testTable','myInput0',0)" placeholder="Search...">-->
                </th>
                <th colspan="6" style="text-align: center">
                    List of national parameters
                </th>
            </tr>
            <tr>
                <th rowspan="2">Number of tests</th>
                <th colspan="3" style="text-align: center">Number of capabilities tested</th>
                <th rowspan="2">Tested domains</th>
                <th rowspan="2">Involved warfare levels</th>
            </tr>
            <tr>
                <th>Unidomain</th>
                <th>Multidomain</th>
                <th>Multistandard</th>
            </tr>
        </thead>
        <tbody>

{{--        If <15, then “To increase”--}}
{{--        Otherwise “Normal level”--}}

{{--        If <5, then “To increase”--}}
{{--        Otherwise “Normal level”--}}

{{--        If <3, then “To increase”--}}
{{--        Otherwise “Normal level”--}}

{{--        If <3, then “To increase”--}}
{{--        Otherwise “Normal level”--}}

{{--        To include --}}
{{--        not tested--}}

{{--        To include --}}
{{--        not tested--}}

        @foreach($country_compare_info as $item)
            <tr>
                <td>Nation {{ $item['nation_id'] + 1 }}</td>
                <td class="{{ $item['success'] < 15 ? 'td-bad' : 'td-good' }}">{{ $item['success'] < 15 ? 'To increase' : 'Normal level' }}</td>
                <td class="{{ $item['sd'] < 5 ? 'td-bad' : 'td-good' }}">{{ $item['sd'] < 5 ? 'To increase' : 'Normal level' }}</td>
                <td class="{{ $item['md'] < 3 ? 'td-bad' : 'td-good' }}">{{ $item['md'] < 3 ? 'To increase' : 'Normal level' }}</td>
{{--                <td class="{{ $item['not_tested'] < 3 ? 'td-bad' : 'td-good' }}">{{ $item['not_tested'] < 3 ? 'To increase' : 'Normal level' }}</td>--}}
                <td>...</td>
                @php
                    $needed_domains = '';
                    $domains_array = json_decode($item['domains_id'],true);

                    if($domains_array && count($domains_array)) {
                        foreach ($domains_array as $domain_id) {
                            if(in_array($domain_id, $domainsKeys)) {
                                $needed_domains .= $domains[$domain_id] . ', ';
                            }
                        }
                    }

                    if(!$needed_domains) {
                        $needed_domains = '-';
                    }
                @endphp

                <td>{{ $needed_domains }}</td>

                @php
                    $needed_warvares = '';
                    $warfares_array = json_decode($item['warvares'],true);

                    if($warfares_array && count($warfares_array)) {
                        foreach ($warfares_array as $warfare_id) {
                            if(in_array($warfare_id, $warfareLevelsKeys)) {
                                $needed_warvares .= $warfareLevels[$warfare_id] . ', ';
                            }
                        }
                    }

                    if(!$needed_warvares) {
                        $needed_warvares = '-';
                    }
                @endphp

                <td>{{ $needed_warvares }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- !Recommendations -->

<script src="/js/jquery-3.6.3.min.js"></script>
<script>
    var years = {!! json_encode($years) !!};
    var data_by_year = {!! json_encode($data_by_year) !!};
    var country_compare_info = {!! json_encode($country_compare_info) !!};
    var rankByDomain = {!! json_encode($rankByDomain) !!};
    var success_capability_sorted = {!! json_encode($success_capability_sorted) !!};

    var current_year = $('.j-select-year').val();


    $('.j-select-year').change(function () {
        current_year = $(this).val();

        configSuccessfulTestChart.data.datasets[0].data = getConfigSuccessfulTestChartDatasetByCurrentYear();
        configSuccessfulTestChart.update();

        testRatioDataChart.data.datasets[0].data = getTestRatioDataChartDatasetByCurrentYear();
        testRatioDataChart.update();

        configNumOfCapChart.data.datasets[0].data = getConfigNumOfCapChartDatasetByCurrentYear();
        configNumOfCapChart.update();
    });


    $('.j-compare-value-1').html((Math.round(country_compare_info[$('.j-compare-select-1').val()]['rank'] * 10000) / 100) + '%');
    $('.j-compare-value-2').html((Math.round(country_compare_info[$('.j-compare-select-2').val()]['rank'] * 10000) / 100) + '%');

    $('.j-compare-select-1').change(function () {
        $('.j-compare-value-1').html((Math.round(country_compare_info[$(this).val()]['rank'] * 10000) / 100) + '%');
    });

    $('.j-compare-select-2').change(function () {
        $('.j-compare-value-2').html((Math.round(country_compare_info[$(this).val()]['rank'] * 10000) / 100) + '$');
    });



    function getConfigSuccessfulTestChartDatasetByCurrentYear() {
        let all_value = data_by_year[current_year]['test_participants']['Success'] +
            data_by_year[current_year]['test_participants']['Limited Success'] +
            data_by_year[current_year]['test_participants']['Interoperability Issue'] +
            data_by_year[current_year]['test_participants']['Not Tested'] +
            data_by_year[current_year]['test_participants']['Pending'];

        let success_val = parseInt((data_by_year[current_year]['test_participants']['Success'] / all_value) * 100, 10);
        let limited_success_val = parseInt((data_by_year[current_year]['test_participants']['Limited Success'] / all_value) * 100, 10);
        let inter_issue_val = parseInt((data_by_year[current_year]['test_participants']['Interoperability Issue'] / all_value) * 100, 10);
        let not_tested_val = parseInt((data_by_year[current_year]['test_participants']['Not Tested'] / all_value) * 100, 10);
        let pending_val = parseInt((data_by_year[current_year]['test_participants']['Pending'] / all_value) * 100, 10);

        $('.j-configSuccessfulTest-all').html(all_value);

        return [
            success_val,
            100 - inter_issue_val - not_tested_val - pending_val - success_val,
            inter_issue_val,
            not_tested_val,
            pending_val,
        ];
    }

    function getTestRatioDataChartDatasetByCurrentYear() {
        $('.j-testRatio-all').html(data_by_year[current_year]['test_participants']['all']);

        let success_val = parseInt((data_by_year[current_year]['test_participants']['Success'] / data_by_year[current_year]['test_participants']['all']) * 100, 10);

        return [
            success_val,
            100 - success_val
        ];
    }

    function getConfigNumOfCapChartDatasetByCurrentYear() {
        $('.j-numOfCap-all').html(data_by_year[current_year]['capabilities']['all']);

        let single_val = parseInt((data_by_year[current_year]['capabilities']['single'] / data_by_year[current_year]['capabilities']['all']) * 100, 10);
        return [
            100 - single_val,
            single_val
        ];
    }
</script>
<script>
    const BACKGROUND_COLOR = ['#10103F', '#15155B', '#5252D7', '#6565F6', '#7979EB'];
    const BORDER_COLOR = ['#0C0C30', '#101048', '#2C2CBD', '#2020F2', '#3939E1'];
    const TEXT_COLOR = '#eee';

    const BACKGROUND_COLOR_TRUE_FALSE = ['#136906', '#8C0000'];
    const BORDER_COLOR_TRUE_FALSE = ['#0F5005', '#710000'];

    Chart.defaults.color = TEXT_COLOR;
    Chart.register(ChartDataLabels);

    var dataSuccessfulTest = {
        labels: ['Success', 'Limited Success', 'Interoperability Issue', 'Not Tested', 'Pending'],
        datasets: [
            {
                label: 'Percent',
                data: getConfigSuccessfulTestChartDatasetByCurrentYear(),
                backgroundColor: BACKGROUND_COLOR,
                borderColor: BORDER_COLOR,
            }
        ]
    };

    var configSuccessfulTest = {
        type: 'doughnut',
        data: dataSuccessfulTest,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Detailed tests statistics'
                },
            }
        },
    };

    var dataTestRatio = {
        labels: ['Successful', 'Not successful'],
        datasets: [
            {
                label: 'Test ratio',
                data: getTestRatioDataChartDatasetByCurrentYear(),
                backgroundColor: BACKGROUND_COLOR_TRUE_FALSE,
                borderColor: BORDER_COLOR_TRUE_FALSE,
            }
        ]
    };

    var configTestRatio = {
        type: 'doughnut',
        data: dataTestRatio,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Successful tests ratio'
                }
            }
        },
    };

    var dataNumbOfCap = {
        labels: ['Multidomain', 'Unimodal'],
        datasets: [
            {
                label: 'Percent',
                data: getConfigNumOfCapChartDatasetByCurrentYear(),
                backgroundColor: BACKGROUND_COLOR_TRUE_FALSE,
                borderColor: BORDER_COLOR_TRUE_FALSE,
            }
        ]
    };

    var configNumOfCap = {
        type: 'doughnut',
        data: dataNumbOfCap,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Capabilities tested statistics'
                }
            }
        },
    };


    var dataCapBySuccRatio = {
        labels: [
            success_capability_sorted[0]['name'],
            success_capability_sorted[1]['name'],
            success_capability_sorted[2]['name'],
            success_capability_sorted[3]['name'],
            success_capability_sorted[4]['name'],
            success_capability_sorted[5]['name'],
            success_capability_sorted[6]['name'],
        ],
        datasets: [{
            label: 'Capability by successful ratio',
            data: [
                success_capability_sorted[0]['success'],
                success_capability_sorted[1]['success'],
                success_capability_sorted[2]['success'],
                success_capability_sorted[3]['success'],
                success_capability_sorted[4]['success'],
                success_capability_sorted[5]['success'],
                success_capability_sorted[6]['success'],
            ],
            backgroundColor: BACKGROUND_COLOR,
            borderColor: BORDER_COLOR,
            borderWidth: 1
        }]
    };

    var configCapBySuccRatio = {
        type: 'bar',
        data: dataCapBySuccRatio,
        options: {
            plugins: {
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Capabilities with the highest rank'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    var dataCapByYearData = [];
    years.forEach(function (year) {
        dataCapByYearData.push(
            data_by_year[year]['capabilities']['all']
        );
    });

    var dataCapByYear = {
        labels: years,
        datasets: [
            {
                label: 'Dataset',
                data: dataCapByYearData,
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
                fill: false
            }
        ]
    };

    var configCapByYear = {
        type: 'line',
        data: dataCapByYear,
        options: {
            plugins: {
                legend: {
                    display: false,
                    position: 'top',
                },
                filler: {
                    propagate: false,
                },
                title: {
                    display: true,
                    text: 'Number of capabilities tested'
                },
                interaction: {
                    intersect: false,
                }
            }
        }
    };

    var dataIntIndOfSuccValue = parseInt({{ $integralIndicators }},10);

    var dataIntIndOfSucc = {
        labels: ['', ''],
        datasets: [
            {
                label: '',
                data: [
                    dataIntIndOfSuccValue,
                    100 - dataIntIndOfSuccValue
                ],
                backgroundColor: BACKGROUND_COLOR_TRUE_FALSE,
                borderColor: BORDER_COLOR_TRUE_FALSE,
            }
        ]
    };

    var configIntIndOfSucc = {
        type: 'doughnut',
        data: dataIntIndOfSucc,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Integral indicator of success'
                }
            }
        },
    };

    var dataNumberOfCountriesValue = parseInt({{ $percentTestedNations }},10);

    var dataNumberOfCountries = {
        labels: ['Involved', 'Not involved'],
        datasets: [
            {
                label: 'Percent',
                data: [
                    dataNumberOfCountriesValue,
                    100 - dataNumberOfCountriesValue
                ],
                backgroundColor: BACKGROUND_COLOR_TRUE_FALSE,
                borderColor: BORDER_COLOR_TRUE_FALSE,
            }
        ]
    };

    var configNumberOfCountries = {
        type: 'doughnut',
        data: dataNumberOfCountries,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Number of countries involved'
                }
            }
        },
    };

    var dataTestSuccRatio = {
        labels: [
            'Nation ' + country_compare_info[0]['nation_id'],
            'Nation ' + country_compare_info[1]['nation_id'],
            'Nation ' + country_compare_info[2]['nation_id']
        ],
        datasets: [
            {
                label: 'Limited Success',
                data: [
                    country_compare_info[0]['limited_success'],
                    country_compare_info[1]['limited_success'],
                    country_compare_info[2]['limited_success'],
                ],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Interoperability Issue',
                data: [
                    country_compare_info[0]['interoperability_issue'],
                    country_compare_info[1]['interoperability_issue'],
                    country_compare_info[2]['interoperability_issue'],
                ],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Not Tested',
                data: [
                    country_compare_info[0]['not_tested'],
                    country_compare_info[1]['not_tested'],
                    country_compare_info[2]['not_tested'],
                ],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Success',
                data: [
                    country_compare_info[0]['success'],
                    country_compare_info[1]['success'],
                    country_compare_info[2]['success'],
                ],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Pending',
                data: [
                    country_compare_info[0]['pending'],
                    country_compare_info[1]['pending'],
                    country_compare_info[2]['pending'],
                ],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
        ]
    };

    var configTestSuccRatio = {
        type: 'bar',
        data: dataTestSuccRatio,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Test successful ratio'
                },
            }
        },
    };

    var dataCountryByRatio = {
        labels: [
            'Nation ' + country_compare_info[0]['nation_id'],
            'Nation ' + country_compare_info[1]['nation_id'],
            'Nation ' + country_compare_info[2]['nation_id'],
            'Nation ' + country_compare_info[3]['nation_id'],
            'Nation ' + country_compare_info[4]['nation_id'],
        ],
        datasets: [{
            label: 'Country by ratio',
            data: [
                Math.round(country_compare_info[0]['rank'] * 100) / 100,
                Math.round(country_compare_info[1]['rank'] * 100) / 100,
                Math.round(country_compare_info[2]['rank'] * 100) / 100,
                Math.round(country_compare_info[3]['rank'] * 100) / 100,
                Math.round(country_compare_info[4]['rank'] * 100) / 100,
            ],
            backgroundColor: BACKGROUND_COLOR,
            borderColor: BORDER_COLOR,
            borderWidth: 1
        }]
    };

    var configCountryByRatio = {
        type: 'bar',
        data: dataCountryByRatio,
        options: {
            plugins: {
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Integral interoperability value'
                },
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            },

        },
    };

    var dataDetailedRatio = {
        labels: ['Ukraine', 'USA', 'GB'],
        datasets: [
            {
                label: 'Limited Success',
                data: [11, 11, 11],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Interoperability Issue',
                data: [11, 11, 11],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Not Tested',
                data: [11, 11, 11],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Success',
                data: [11, 11, 11],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Pending',
                data: [11, 11, 11],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
        ]
    };

    var configDetailedRatio = {
        type: 'bar',
        data: dataDetailedRatio,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Detailed test cases statistics'
                }
            }
        }
    };


    console.log(rankByDomain);
    var dataResultByDomain = {
        labels: [
            '{{ $domains[$rankByDomain[0]['domain_id']] }}',
            '{{ $domains[$rankByDomain[1]['domain_id']] }}',
            '{{ $domains[$rankByDomain[2]['domain_id']] }}',
            '{{ $domains[$rankByDomain[3]['domain_id']] }}',
            '{{ $domains[$rankByDomain[4]['domain_id']] }}',
            '{{ $domains[$rankByDomain[5]['domain_id']] }}'
        ],
        datasets: [
            {
                label: 'Limited Success',
                data: [
                    rankByDomain[0]['limited_success'],
                    rankByDomain[1]['limited_success'],
                    rankByDomain[2]['limited_success'],
                    rankByDomain[3]['limited_success'],
                    rankByDomain[4]['limited_success'],
                    rankByDomain[5]['limited_success']
                ],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Interoperability Issue',
                data: [
                    rankByDomain[0]['interoperability_issue'],
                    rankByDomain[1]['interoperability_issue'],
                    rankByDomain[2]['interoperability_issue'],
                    rankByDomain[3]['interoperability_issue'],
                    rankByDomain[4]['interoperability_issue'],
                    rankByDomain[5]['interoperability_issue']
                ],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Not Tested',
                data: [
                    rankByDomain[0]['not_tested'],
                    rankByDomain[1]['not_tested'],
                    rankByDomain[2]['not_tested'],
                    rankByDomain[3]['not_tested'],
                    rankByDomain[4]['not_tested'],
                    rankByDomain[5]['not_tested']
                ],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Success',
                data: [
                    rankByDomain[0]['success'],
                    rankByDomain[1]['success'],
                    rankByDomain[2]['success'],
                    rankByDomain[3]['success'],
                    rankByDomain[4]['success'],
                    rankByDomain[5]['success']
                ],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Pending',
                data: [
                    rankByDomain[0]['pending'],
                    rankByDomain[1]['pending'],
                    rankByDomain[2]['pending'],
                    rankByDomain[3]['pending'],
                    rankByDomain[4]['pending'],
                    rankByDomain[5]['pending']
                ],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
        ]
    };

    var configResultByDomain = {
        type: 'bar',
        data: dataResultByDomain,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Test results by domain'
                }
            }
        }
    };

    var testRatioDataChart = new Chart(
        document.getElementById('testRatioData'),
        configTestRatio,
    );

    var configSuccessfulTestChart = new Chart(
        document.getElementById('overViewChart'),
        configSuccessfulTest,
    );

    var configNumOfCapChart = new Chart(
        document.getElementById('numOfCap'),
        configNumOfCap,
    );

    new Chart(
        document.getElementById('capByYear'),
        configCapByYear,
    );

    new Chart(
        document.getElementById('capBySucc'),
        configCapBySuccRatio,
    );

    new Chart(
        document.getElementById('intIndOfSucc'),
        configIntIndOfSucc,
    );

    new Chart(
        document.getElementById('numbOfCountries'),
        configNumberOfCountries,
    );

    new Chart(
        document.getElementById('testSuccRatio'),
        configTestSuccRatio,
    );

    new Chart(
        document.getElementById('countryByRatio'),
        configCountryByRatio,
    );

    new Chart(
        document.getElementById('detailedRatio'),
        configDetailedRatio,
    );

    new Chart(
        document.getElementById('resultByDomain'),
        configResultByDomain,
    );

</script>

<script>
    //All popup classes
    var popUpWindows = ["#allCountriesTable", "#myTableTest"]
</script>

{{--<script src="/js/dashboard_charts.js"></script>--}}
<script src="/js/helper.js"></script>

</body>
</html>
