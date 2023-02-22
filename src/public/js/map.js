/**
 * Create the map
 */
var current_selected_cc = [];
var map = AmCharts.makeChart("chartdiv", {
    "type": "map",
    "theme": "light",
    "projection": "eckert3",
    "dataProvider": {
        "map": "worldLow",
        "getAreasFromMap": true
    },
    "areasSettings": {
        "selectedColor": "#CC0000",
        "selectable": true
    },
    /**
     * Add click event to track country selection/unselection
     */
    "listeners": [{
        "event": "clickMapObject",
        "method": function(e) {

            // Ignore any click not on area
            if (e.mapObject.objectType !== "MapArea")
                return;

            var area = e.mapObject;

            // Toggle showAsSelected
            area.showAsSelected = !area.showAsSelected;
            e.chart.returnInitialColor(area);

            var selected_cc = getSelectedCountries();

            current_selected_cc.forEach(function (country_code) {
                if(!selected_cc.includes(country_code)) {
                    $('.j-compare-country[data-cc="' + country_code + '"]').hide();
                }
            })

            selected_cc.forEach(function (country_code) {
                $('.j-compare-country[data-cc="' + country_code + '"]').show();
            })

            current_selected_cc = selected_cc;

            // Update the list
            document.getElementById("selected").innerHTML = JSON.stringify(current_selected_cc);
        }
    }]
});

// map.zoomToGroup([
//     {
//         "id": "LT",
//         "showAsSelected": true
//     }
// ]);

// map.homeZoomLevel = 2
// map.homeGeoPoint = {
//     latitude: 52,
//     longitude: 11
// };

/**
 * Function which extracts currently selected country list.
 * Returns array consisting of country ISO2 codes
 */
function getSelectedCountries() {
    var selected = [];
    for(var i = 0; i < map.dataProvider.areas.length; i++) {
        if(map.dataProvider.areas[i].showAsSelected)
            selected.push(map.dataProvider.areas[i].id);
    }
    return selected;
}
