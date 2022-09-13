<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>

<body>


    <div id="chart_div"></div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {

            var data = google.visualization.arrayToDataTable([
                ['', '', { role: 'style' }],
                ['Xs', 75, 'red'],            // RGB value
                ['S', 125, 'red'],            // English color name
                ['M', 175, '#F8961E'],

            ]);

            var options = {
                    title: 'Motivation and Energy Level Throughout the Day',
                    isStacked: true,
                    bar: {groupWidth: "10%"},
                
                };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div'));

            chart.draw(data, options);
            }
    </script>
</body>

</html>