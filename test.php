<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Custome Labels</title>
    <script src="js/d3.v3.min.js"></script>
    <script src="js/topojson.v1.min.js"></script>
    <script src="js/datamaps.ind.js"></script>
</head>
<body>
<h1>Custom Labels</h1>
<div id="container1" style="position: relative; width: 800px; height: 600px;"></div>

<script>
    var INdata = {
        'KA': '123',        
        'WB': '1234'};

    var INmap = new Datamap({
        element: document.getElementById("container1"),
        scope: 'ind', //currently supports 'usa' and 'world', however with custom map data you can specify your own
        projection: 'equirectangular', //style of projection to be used. try "mercator"
        height: 520, //if not null, datamaps will grab the height of 'element'
        fills: {
            defaultFill: '#EDDC4E'
        },
        geographyConfig: {
            highlightBorderColor: '#bada55',
            popupTemplate: function (geography, data) {
                return '<div class="hoverinfo">' + geography.properties.name + '</div>';
            },
            highlightBorderWidth: 2
        }
    });
    INmap.labels({'customLabelText': INdata});
</script>
</div>
</body>
</html>