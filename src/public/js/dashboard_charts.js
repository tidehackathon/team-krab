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
            data: [80, 5, 5, 5, 5],
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
                display: false,
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
            data: [43, 15],
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
            data: [ 15, 6],
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

var dataCapByYear = {
    labels: ['Red', 'Orange', 'Yellow'],
    datasets: [
        {
            label: 'Dataset',
            data: [65, 59, 80, 81, 56, 55, 40],
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

new Chart(
    document.getElementById('testRatioData'),
    configTestRatio,
);

new Chart(
    document.getElementById('overViewChart'),
    configSuccessfulTest,
);

new Chart(
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
