<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Stock Price Prediction</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    
    <script src='main.js'></script>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
        <script src="https://code.highcharts.com/stock/highstock.js"></script>
        <script src="https://code.highcharts.com/stock/modules/data.js"></script>
        <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
        <style>
          #stock_icon{
              font-size: 50px;
          }

          #circle{
            border-radius: 30px;
          }
        </style>


</head>
<body>
    <nav>
        <div class="nav-wrapper">
          <a href="#" class="brand-logo center"><i class="material-icons" id="stock_icon">timeline</i>Stock Price Prdiction</a>
        </div>
      </nav>
      <div class="container">
        <div class="row"><br>
        <div class="col s1"><a class="btn-floating btn-large waves-effect waves-light blue z-depth-4"><i class="material-icons">arrow_back</i></a></div>
        <div class="col s11"><a class="waves-effect waves-light btn-large z-depth-4">You are viewing Stock of: <b>Microsoft (MSFT)</b></a></div>
        </div>
        <div class="row"><br>
        <div class="col s12"><a class="waves-effect waves-light btn-large z-depth-4 purple darken-2" id="circle"><b>Current Live Stock</b></a></div>
        </div>
        <div class="row z-depth-4" id=circle><br>
          <div class="col s12"><div id="container" style="height: 400px; min-width: 310px"></div></div>
        </div>
        <div class="row"><br>
          <div class="col s12"><a class="waves-effect waves-light btn-large z-depth-4 blue darken-3" id="circle"><b>Predicted Stock</b></a></div>
          </div>
          <div class="row z-depth-4" id=circle><br>
            <div class="col s12"><div id="container" style="height: 400px; min-width: 310px"></div></div>
          </div>
          <div class="col s6"><a class="waves-effect waves-light btn-large z-depth-4 blue darken-3" id="circle"><b>Tommorow's Predicted Price: 90.65</b></a></div>
          <div class="col s6"><a class="waves-effect waves-light btn-large z-depth-4 blue darken-3" id="circle"><b>You should BUY the stock</b></a></div>
      </div>
</body>
<script>
Highcharts.getJSON('https://www.highcharts.com/samples/data/aapl-c.json', function (data) {
    // Create the chart
    Highcharts.stockChart('container', {


        rangeSelector: {
            selected: 1
        },

        title: {
            text: 'MSFT Stock Price'
        },

        series: [{
            name: 'MSFT',
            data: data,
            tooltip: {
                valueDecimals: 2
            }
        }]
    });
});

</script>
</html>