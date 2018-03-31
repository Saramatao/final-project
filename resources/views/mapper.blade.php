<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name') }}</title>
		{{--  <link rel="stylesheet" href="{{ asset('css/app.css') }}">  --}}
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"> 
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
	</head>
	<body>
    <div class="white row" style="width:1002px;">
      <div class="hoverable teal col mapper-box">
        <h5>/</h5>
      </div>
      <div class="hoverable teal col mapper-box">
        <h5>cart</h5>
      </div>
      <div class="hoverable teal col mapper-box">
        <h5>view/{slug}</h5>
        <div class="yellow-text">if(purchased) >> learn/{slug}</div>
        <div class="yellow-text">if(owner) >> home/my-teaching/{slug}</div>
      </div>
      <div class="hoverable teal col mapper-box">
        <h5>learn/{slug}</h5>
        <h5 class="red-text">AUTH</h5>
        <div class="yellow-text">if(NOT purchased) >> view/{slug}</div>
      </div>
      <div class="hoverable teal col mapper-box">
        <h5>user/edit-profile</h5>
        <h5 class="red-text">AUTH</h5>
      </div>
      <div class="hoverable teal col mapper-box">
        <h5>/user/edit-image</h5>
        <h5 class="red-text">AUTH</h5>
      </div>
      <div class="hoverable teal col mapper-box">
        <h5>/user/edit-account</h5>
        <h5 class="red-text">AUTH</h5>
      </div>
      <div class="hoverable teal col mapper-box">
        <h5>/user/edit-notification</h5>
        <h5 class="red-text">AUTH</h5>
      </div>
      <div class="hoverable teal col mapper-box">
        <h5>/user/edit-privacy</h5>
        <h5 class="red-text">AUTH</h5>
      </div>
      {{--  <div class="hoverable teal col" style="width:200px; height:150px; margin-left:40px; margin-top:40px;">
        <h5>/user/notification</h5>
      </div>  --}}
    </div>

		<script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/init.js') }}"></script>  
     <script>
      $(document).ready(function(){
        $('.button-collapse').sideNav();
        $('.slider').slider();
        $('.carousel').carousel();
        $('select').material_select();
        $('.modal').modal();
      });
    </script>   
	</body>
</html>
