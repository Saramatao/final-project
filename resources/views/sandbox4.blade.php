<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Prompt' rel='stylesheet'>

  
  <link rel="stylesheet" href="/css/materialize.min.css"> 
  <link rel="stylesheet" href="/css/custom.css"> 
  
  
  <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="/js/ajax-image.js"></script>
  <script type="text/javascript" src="/js/materialize.min.js"></script>
  <script type="text/javascript" src="/js/init.js"></script>  
  <script src="https://apis.google.com/js/platform.js" async defer></script>

  <style>
    .add-vdo-btn, .add-pdf-btn, .add-txt-btn {
      margin-left:15%;
      border-bottom:1px solid grey;
    }

    .add-vdo-btn:hover, .add-pdf-btn:hover, .add-txt-btn:hover {
      cursor: pointer;
      border-bottom:1px solid black;
    }
  </style>

</head>
<body>
  
  <canvas id="myChart" width="400" height="400"></canvas>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
  
  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
    </script>


</body>
</html>