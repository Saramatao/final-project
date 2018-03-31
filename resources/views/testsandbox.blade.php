<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
  </head>

  <body>

  {{--  {{ $dummy['purchase'] }}  --}}


  
  @foreach($data['purchase'] as $purchase)
    {{ $purchase->title }}
  @endforeach

  </body>
</html> 