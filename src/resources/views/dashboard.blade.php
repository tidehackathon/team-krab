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
        $(document).ready(function(){
            //Скрыть PopUp при загрузке страницы
            PopUpHide();
            popUpWindows.forEach(function(item, index, array) {
                PopUpHide(item);
            });
        });
        //Функция отображения PopUp
        function PopUpShow(a){
            $(a).show();
        }
        //Функция скрытия PopUp
        function PopUpHide(a){
            $(a).hide();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
</head>
<body>

<div style="display:flex; height: fit-content;" class="main-page">
    <div style="width:12vw;" class="block">
        <h2 style="margin: auto">
            Overview by
            <select class="j-select-year">
                <option value="2021">2021</option>
                <option value="2022" selected>2022</option>
            </select>
        </h2>

        <div style="position: relative; height:25vh; width:40vw">
            <canvas id="overViewChart"></canvas>
        </div>

        <div style="position: relative; height:25vh; width:40vw">
            <canvas id="testRatioData"></canvas>
        </div>

        <div style="position: relative; height:25vh; width:40vw">
            <canvas id="numOfCap"></canvas>
        </div>
    </div>

    <div style="">
        <div style="display:flex;">
            <div style="">
                <div style="width:52vw; margin-bottom:10px; margin-right:10px;" class="block">
                    <h2 style="margin: auto">Capability information</h2>

                    <div style="display: flex">
                        <div style="position: relative; height:22vh; width:40vw">
                            <canvas id="capBySucc"></canvas>
                        </div>

                        <div style="position: relative; height:22vh; width:40vw">
                            <canvas id="capByYear"></canvas>
                        </div>
                    </div>
                </div>

                <div class="block">
                    <h2 style="margin: auto">Сountries interoperability</h2>
                    <div class="canvas-block" onclick="PopUpShow('#allCountriesTable')">
                        <H3>Open table</H3>
                    </div>

                    <div style="display: flex">
                        <div  >
                            <div class="canvas-block">
                                <h3 style="margin: auto">Сountry 1</h3>
                                <div id="Country1" class="percent">76,1%</div>
                            </div>
                            <div class="canvas-block">
                                <h3 style="margin: auto">Сountry 2</h3>
                                <div id="Country2" class="percent">81,4%</div>
                            </div>
                        </div>
                        <div style="position: relative; height:20vh; width:40vw">
                            <canvas id="countryByRatio"></canvas>
                        </div>
                    </div>

                </div>
            </div>

            <div style="width:26vw;" class="block">
                <h2 style="margin: auto">Statistics</h2>

                <div style="display: flex; margin-bottom:10px;">
                    <div style="position: relative;  height:25vh; width:40vw">
                        <canvas id="intIndOfSucc"></canvas>
                    </div>
                    <div style="position: relative;  height:25vh; width:40vw">
                        <canvas id="numbOfCountries"></canvas>
                    </div>
                </div>

                <div style="position: relative; width:26vw">
                    <canvas id="testSuccRatio"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<!--<a href="javascript:PopUpShow('#allCountriesTable')">Show popup</a>-->

<div class="b-popup" id="allCountriesTable">
    <div class="footer">
        <div class="tittle">Tittle</div>
        <div class="button" onClick="PopUpHide('#allCountriesTable')">X</div>
        <!--            <i class="fa-solid fa-xmark"></i>-->
    </div>

    <div class="b-popup-content">


        <h2>Test cases detailed statistics</h2>
        <div style=" height:20vh; width:40vw">
            <canvas id="detailedRatio"></canvas>
        </div>
    </div>
</div>

<script src="/js/jquery-3.6.3.min.js"></script>
<script>
    var years = {!! json_encode($years) !!};
    var data_by_year = {!! json_encode($data_by_year) !!};
    console.log(data_by_year);
    var current_year = $('.j-select-year').val();

    $('.j-select-year').change(function (){
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
    const BACKGROUND_COLOR = '#0081aa';
    const BORDER_COLOR = '#0051AA';
    const TEXT_COLOR = '#eee';

    Chart.defaults.color = TEXT_COLOR;
    Chart.register(ChartDataLabels);

    var dataSuccessfulTest = {
        labels: ['Success', 'Limited Success', 'Interoperability Issue', 'Not Tested', 'Pending'],
        datasets: [
            {
                label: 'Successful tests number',
                data: getConfigSuccessfulTestChartDatasetByCurrentYear(),
                backgroundColor: BACKGROUND_COLOR,
                borderColor: BORDER_COLOR ,
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
                backgroundColor: BACKGROUND_COLOR,
                borderColor: BORDER_COLOR ,
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
                borderColor: BORDER_COLOR ,
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
            backgroundColor: BACKGROUND_COLOR ,
            borderColor: BORDER_COLOR ,
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
    // data_by_year[current_year]['capabilities']['all']
    console.log(years);
    var dataCapByYear = {
        labels: years,
        datasets: [
            {
                label: 'Dataset',
                data: dataCapByYearData,
                borderColor: BORDER_COLOR ,
                backgroundColor: BACKGROUND_COLOR ,
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
                borderColor: BORDER_COLOR ,
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

    var dataNumberOfCountries  = {
        labels: ['Red', 'Orange', 'Yellow'],
        datasets: [
            {
                label: 'Number of countries',
                data: [0, 15, 6],
                backgroundColor: BACKGROUND_COLOR,
                borderColor: BORDER_COLOR ,
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
                data: [11,24,12],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Interoperability Issue',
                data: [3,11,15],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Not Tested',
                data: [1,5,23],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Success',
                data: [80,50,40],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Pending',
                data: [10,10,10],
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
                    display:false,
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
            backgroundColor: BACKGROUND_COLOR ,
            borderColor: BORDER_COLOR ,
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
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    var dataDetailedRatio = {
        labels: ['Ukraine', 'USA', 'GB'],
        datasets: [
            {
                label: 'Limited Success',
                data: [11,11,11],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Interoperability Issue',
                data: [11,11,11],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Not Tested',
                data: [11,11,11],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Success',
                data: [11,11,11],
                borderColor: BORDER_COLOR,
                backgroundColor: BACKGROUND_COLOR,
            },
            {
                label: 'Pending',
                data: [11,11,11],
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
                    display:true,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Detailed test cases statistics'
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

</script>
{{--<script src="/js/dashboard_charts.js"></script>--}}

</body>
</html>
