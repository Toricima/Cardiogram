var data = {
    labels: setXaxis(heartRates.length),
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.1)",
            strokeColor: "rgba(229,79,79,1)",
            pointColor: "rgba(245,49,49,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: heartRates
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: []
        }
    ]
};



var options = {
    scaleShowGridLines: true,
    scaleGridLineColor: "rgba(0,0,0,.05)",
    scaleGridLineWidth: 1,
    scaleShowHorizontalLines: true,
    scaleShowVerticalLines: true,
    bezierCurve: true,
    bezierCurveTension: 0.4,
    pointDot: true,
    pointDotRadius: 5,
    pointDotStrokeWidth: 1,
    pointHitDetectionRadius: 10,
    datasetStroke: true,
    datasetStrokeWidth: 2,
    datasetFill: true,
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

};



$(document).ready(function () {
    var stuff = document.getElementById('myChart');
    var ctx = stuff.getContext('2d');
    var myLineChart = new Chart(ctx).Line(data, options);

    
    var keys = getUrlVars();
    $('#b').selected = "true";


    $("#target").change(function () {
        var value = $("#target option:selected").text();
        window.location.href = "?time=" + value;
        $('#target select').val("60");
        
    });



});

function setXaxis(length)
{
    Xasis = [];

    var startValue = 0
    var keys = getUrlVars();
    var increase = parseInt(keys.time);

    for (var i = 0; i < length; i++)
        Xasis.push(startValue += increase);
        

    return Xasis;
}

function getUrlVars() {
    var url = window.location.href;
    var vars = {};
    var parts = url.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
        vars[key] = value;
    });
    return vars;
}