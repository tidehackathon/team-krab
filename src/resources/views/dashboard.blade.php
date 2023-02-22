<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard</title>

    <link rel="stylesheet" href="/css/style.css">

    <script src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
    <script>
        var popUpWindows = ["#allCountriesTable"]
        $(document).ready(function () {
            //Скрыть PopUp при загрузке страницы
            PopUpHide();
            popUpWindows.forEach(function (item, index, array) {
                PopUpHide(item);
            });
        });

        //Функция отображения PopUp
        function PopUpShow(a) {
            $(a).show();
        }

        //Функция скрытия PopUp
        function PopUpHide(a) {
            $(a).hide();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
</head>
<body>

<div style="display:flex; height: fit-content;" class="main-page">
    <div style="width:17%;" class="block">
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
            <canvas id="overViewChart"></canvas>
        </div>

        <div style="position: relative;">
            <canvas id="testRatioData"></canvas>
        </div>

        <div style="position: relative;">
            <canvas id="numOfCap"></canvas>
        </div>
    </div>

    <div style="width:100%; display: flex;">
        <div style="width: 100%; display: flex; flex-direction: column">
            <div style="height:62%; margin-bottom:10px; margin-right:10px;" class="block">
                <h2 style="margin: auto">Capability information</h2>

                <div style="display: flex">
                    <div style="position: relative;">
                        <canvas id="capBySucc"></canvas>
                    </div>

                    <div style="position: relative;">
                        <canvas id="capByYear"></canvas>
                    </div>
                </div>

                <div style="position: relative;width:70%;">
                    <canvas id="resultByDomain"></canvas>
                </div>

            </div>

            <div class="block">
                <h2 style="margin: auto">Сountries interoperability</h2>
                <div style="display: flex">
                    <div style="display: flex">
                        <div class="canvas-block">
                            <h3 style="margin: auto">Сountry 1</h3>
                            <div id="Country1" class="percent">76,1%</div>
                        </div>
                        <div class="canvas-block">
                            <h3 style="margin: auto">Сountry 2</h3>
                            <div id="Country2" class="percent">81,4%</div>
                        </div>
                    </div>
                    <div style="position: relative;">
                        <canvas id="countryByRatio"></canvas>
                    </div>
                </div>

            </div>
        </div>

        <div style="width:45%;" class="block">
                <h2 style="margin: auto">Statistics</h2>

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

                <div class="j-map-trigger canvas-block">
                    <H3>Map</H3>
                </div>

                <div class="canvas-block" onclick="PopUpShow('#allCountriesTable')">
                    <H3>Open Chart</H3>
                </div>
                <div class="canvas-block" onclick="PopUpShow('#myTableTest')">
                    <H3>Open Table</H3>
                </div>

                <div style="display: flex; justify-content: flex-end">
                    <img src="/img/logo.png" alt="Logo KRAB" style="width: 150px">
                </div>
            </div>
    </div>
</div>

<div class="b-popup" id="allCountriesTable">
    <div class="b-popup-content">
        <div style="display: flex; justify-content: space-between" class="footer">
            <div class="tittle">Test cases detailed statistics</div>
            <div class="button" onClick="PopUpHide('#allCountriesTable')">X</div>
            <!--            <i class="fa-solid fa-xmark" onClick="PopUpHide('#allCountriesTable')"></i>-->
        </div>

        <div style="height:auto; width:auto">
            <canvas id="detailedRatio"></canvas>
        </div>
    </div>
</div>

<div class="b-popup" id="myTableTest">
    <div class="b-popup-content">
        <div style="display: flex; justify-content: space-between" class="footer">
            <div class="tittle">Test sort table</div>

            <div class="button" onClick="PopUpHide('#myTableTest')">X</div>
            <!--            <i class="fa-solid fa-xmark" onClick="PopUpHide('#allCountriesTable')"></i>-->
        </div>

        <div style="height:auto; width:auto">
            <table id="testTable" class="styled-table">
                <thead>
                <tr>
                    <th rowspan="2">
                        <a onclick="sortTable('testTable',0,2)">Nation</a>
                        <!--                            <input type="text" class="select-dropdown" id="myInput0" onkeyup="myFunction('testTable','myInput0',0)" placeholder="Search...">-->
                    </th>
                    <th colspan="5">
                        <!--                            <a onclick="sortTable('testTable',1)">Country</a>--> <a
                            onclick="">Numbers of tests</a>
                        <!--                            <input type="text" id="myInput1" onkeyup="myFunction('testTable','myInput1',1)" placeholder="Search...">-->
                    </th>
                    <th colspan="3">Number of capabilities tested</th>
                    <th rowspan="2">Tested domains</th>
                    <th rowspan="2">Involved warfare levels</th>
                    <th rowspan="2">
                        <a onclick="sortTable('testTable',11,2)">Overall interoperability level</a></th>
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
                <tr>
                    <td>Nation 1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                    <td>11</td>
                    <td>12</td>
                </tr>
                <tr>
                    <td>Aation 2</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                    <td>11</td>
                    <td>12</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="j-map map">
    <span class="j-map-trigger cross"></span>

    {{--    <script src="//cdn.amcharts.com/lib/4/core.js"></script>--}}
    {{--    <script src="//cdn.amcharts.com/lib/4/maps.js"></script>--}}
    {{--    <script src="//cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>--}}
    {{--    <script src="//www.amcharts.com/lib/4/themes/animated.js"></script>--}}

    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

    <script src="/js/map.js"></script>
    <h1>Click countries to select</h1>
    <div id="chartdiv"></div>
    <div id="info">Seletced countries: <span id="selected">-</span></div>

    <table id="comparing_countries" class="styled-table">
        <thead>
        <tr>
            <th rowspan="2">
                <a onclick="sortTable('testTable',0,2)">Nation</a>
                <!--                            <input type="text" class="select-dropdown" id="myInput0" onkeyup="myFunction('testTable','myInput0',0)" placeholder="Search...">-->
            </th>
            <th colspan="5">
                <!--                            <a onclick="sortTable('testTable',1)">Country</a>--> <a
                    onclick="">Numbers of tests</a>
                <!--                            <input type="text" id="myInput1" onkeyup="myFunction('testTable','myInput1',1)" placeholder="Search...">-->
            </th>
            <th colspan="3">Number of capabilities tested</th>
            <th rowspan="2">Tested domains</th>
            <th rowspan="2">Involved warfare levels</th>
            <th rowspan="2">
                <a onclick="sortTable('testTable',11,2)">Overall interoperability level</a></th>
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
            <tr class="j-compare-country" data-cc="{{ $item['cc'] }}" style="display: none">
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['success'] }}</td>
                <td>{{ $item['limited_success'] }}</td>
                <td>{{ $item['interop_issue'] }}</td>
                <td>{{ $item['not_tested'] }}</td>
                <td>{{ $item['pending'] }}</td>
                <td>{{ $item['single_domain'] }}</td>
                <td>{{ $item['multi_domain'] }}</td>
                <td>{{ $item['multi_standard'] }}</td>
                <td>{{ $item['tested_domains'] }}</td>
                <td>{{ $item['involved_w_l'] }}</td>
                <td>{{ $item['overall_level'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script src="/js/jquery-3.6.3.min.js"></script>
<script>
    var years = {!! json_encode($years) !!};
    var data_by_year = {!! json_encode($data_by_year) !!};
    console.log(data_by_year);
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

    function getConfigSuccessfulTestChartDatasetByCurrentYear() {
        return [
            data_by_year[current_year]['test_participants']['Success'],
            data_by_year[current_year]['test_participants']['Limited Success'],
            data_by_year[current_year]['test_participants']['Interoperability Issue'],
            data_by_year[current_year]['test_participants']['Not Tested'],
            data_by_year[current_year]['test_participants']['Pending'],
        ];
    }

    function getTestRatioDataChartDatasetByCurrentYear() {
        return [
            data_by_year[current_year]['test_participants']['Success'],
            data_by_year[current_year]['test_participants']['all'] - data_by_year[current_year]['test_participants']['Success']
        ];
    }

    function getConfigNumOfCapChartDatasetByCurrentYear() {
        return [
            data_by_year[current_year]['capabilities']['multidomain'],
            data_by_year[current_year]['capabilities']['single']
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
                label: 'Successful tests number',
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
                    text: 'Test ratio'
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
                    text: 'Successful tests number'
                }
            }
        },
    };

    var dataNumbOfCap = {
        labels: ['Multidomain', 'Unimodal'],
        datasets: [
            {
                label: 'Number of capability',
                data: getConfigNumOfCapChartDatasetByCurrentYear(),
                backgroundColor: BACKGROUND_COLOR,
                borderColor: BORDER_COLOR,
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
                    text: 'Number of capabilities'
                }
            }
        },
    };

    var dataCapBySuccRatio = {
        labels: ['Red', 'Orange', 'Yellow'],
        datasets: [{
            label: 'Capability by successful ratio',
            data: [65, 59, 80, 81, 56, 55, 40],
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
                    text: 'Number of capabilities'
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
                    text: 'Number of capabilities'
                },
                interaction: {
                    intersect: false,
                }
            }
        }
    };

    var dataIntIndOfSucc = {
        labels: ['Red', 'Orange', 'Yellow'],
        datasets: [
            {
                label: 'Number of capability ',
                data: [0, 15, 6],
                backgroundColor: BACKGROUND_COLOR,
                borderColor: BORDER_COLOR,
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

    var dataNumberOfCountries = {
        labels: ['Red', 'Orange', 'Yellow'],
        datasets: [
            {
                label: 'Number of countries',
                data: [0, 15, 6],
                backgroundColor: BACKGROUND_COLOR,
                borderColor: BORDER_COLOR,
            }
        ]
    };

    var configNumberOfCountries = {
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
                    text: 'Number of countries '
                }
            }
        },
    };

    var dataTestSuccRatio = {
        labels: ['Ukraine', 'USA', 'GB'],
        datasets: [
            {
                label: 'Limited Success',
                data: [11, 24, 12],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Interoperability Issue',
                data: [3, 11, 15],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Not Tested',
                data: [1, 5, 23],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Success',
                data: [80, 50, 40],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Pending',
                data: [10, 10, 10],
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
        labels: ['Ukraine', 'USA', 'GB'],
        datasets: [{
            label: 'Country by ratio',
            data: [11, 59, 80],
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
                    text: 'Test successful ratio'
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

    var dataResultByDomain = {
        labels: ['Land', 'Air', 'Land', 'Land', 'Land', 'Land'],
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
    $(document).ready(function () {
        //Hide all popup
        PopUpHide();
        popUpWindows.forEach(function (item, index, array) {
            console.log(item);
            PopUpHide(item);
        });
    });

    //show popup with class
    function PopUpShow(a) {
        $(a).show();
    }

    //Hide popup with class
    function PopUpHide(a) {
        $(a).hide();
    }
</script>

{{--<script src="/js/dashboard_charts.js"></script>--}}
<script src="/js/helper.js"></script>

</body>
</html>
