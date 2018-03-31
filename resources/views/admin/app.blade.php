<!DOCTYPE html5>  
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name') }}</title>
		
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"> 
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
    
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ajax-image.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/init.js') }}"></script>

    <style>
      .active {
        font-size: 18px;
        width: 25px;
        padding-top: 2px;
      }

      .disabled {
        font-size: 18px;
        margin-right: 20px;
        margin-left: 20px;
        padding-top: 2px;
      }

      ul {
        margin-top: 25px;
        margin-bottom: 25px;
      }

      #myTable tr:hover {
        background-color:#ddd;
      }
      
      label {
        margin-left:20px;
      }
  

    </style>

	</head>
	<body>

    @include('admin.navbar')
    @yield('content')

    <script>
      $(document).ready(function(){
        $('.button-collapse').sideNav();
        $('select').material_select();
        $('.modal').modal();
        $('.tooltipped').tooltip();

        $('.datepicker').pickadate({
          selectMonths: true, // Creates a dropdown to control month
          selectYears: 15, // Creates a dropdown of 15 years to control year,
          today: 'Today',
          clear: 'Clear',
          close: 'Ok',
          closeOnSelect: true // Close upon selecting a date,
        });

        // Toggle Column
        $("input[type='checkbox']").on('click', function(event){
          $('.'+$(this).attr('id')).toggle();
        });

        // Highlight Column
        $("label").on({
          mouseenter: function () {
            $('.'+$(this).prev().attr('id')).toggleClass('light-grey-2');
          },
          mouseleave: function () {
            $('.'+$(this).prev().attr('id')).toggleClass('light-grey-2');
          }
        });
      });
    </script>   

    <script>
      $('.print-btn').on('click', function(e) {
        var printContents = document.getElementById('print-content').innerHTML;
        var originalContents = document.body.innerHTML;
   
        document.body.innerHTML = printContents;
   
        window.print();
   
        document.body.innerHTML = originalContents;

        location.reload();
      });
    </script>

    <script>
      function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable");
        switching = true;
        dir = "asc"; 

        while (switching) {
          switching = false;
          rows = table.getElementsByTagName("TR");
          for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            if (dir == "asc") {
              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                shouldSwitch= true;
                break;
              }
            } else if (dir == "desc") {
              if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                shouldSwitch= true;
                break;
              }
            }
          }
          if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;      
          } else {
            if (switchcount == 0 && dir == "asc") {
              dir = "desc";
              switching = true;
            }
          }
        }
      }
    </script>
	</body>
</html>