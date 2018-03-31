<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
    {{--  SET META TAG  --}}
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id" content="135919450618-3da88lohlsuj9kfsairtjf8r15sd34k3.apps.googleusercontent.com">
		
    {{--  CSRF TOKEN  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name') }}</title>
    
    {{--  GOOGLE API (FONTS & ICONS)  --}}
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Prompt' rel='stylesheet'>

    {{--  INCLUDE CSS  --}}
		<link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"> 
		<link rel="stylesheet" href="{{ asset('css/custom.css') }}"> 
    
    {{--  INCLUDE JS  --}}
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/ajax-image.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/init.js') }}"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
	</head>
	<body>

    @include('layouts.navbar')
    @yield('content')
    @include('layouts.footer')
  
    {{--  MATERILIZE CSS INITIALIZE  --}}
    <script>
      $(document).ready(function() {
        $('.button-collapse').sideNav();
        $('.slider').slider();
        $('.carousel').carousel();
        $('select').material_select();
        $('.modal').modal();
        $(".dropdown-button").dropdown({ hover: true });

        $('.datepicker').pickadate({
          selectMonths: true, // Creates a dropdown to control month
          selectYears: 15, // Creates a dropdown of 15 years to control year,
          today: 'Today',
          clear: 'Clear',
          close: 'Ok',
          closeOnSelect: true // Close upon selecting a date,
        });
      });
    </script>   

    {{--  FACEBOOK AUTH FUNCTIONS  --}}
    <script>
      
      // =============================================================================
      // FACEBOOK SDK INITIALIZE
      // =============================================================================

      // LOAD FACEBOOK SDK
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

      // INIT SETTING
      window.fbAsyncInit = function() {
        FB.init({
          appId: '141213139947090',
          cookie: true, 
          xfbml: true, 
          version: 'v2.2' 
        });

        console.log('face book api ready...');
      };

      // =============================================================================
      // FACEBOOK LOG IN
      // =============================================================================

      // FACEBOOK AUTH CHECKER
      function checkLoginState() {
        FB.getLoginStatus(function(response) {
          fbLoginCallback(response);
          console.log('face book login');
        });
      }

      // CALL BACK AFTER FACEBOOK AUTH
      function fbLoginCallback(response) {
        console.log("facebook callback...");
        console.log(response);
        
        if (response.status === 'connected') {
          console.log("fb auth connected");

          var result = fetchAPI( function(response) {
            $('.login-form').find("input[name='email']").val(response.email);
            $('.login-form').find("input[name='password']").val(response.id);

            $('.login-form').find("input[name='email']").focus();
            $('.login-form').find("input[name='password']").focus();
            $( ".login-user-btn" ).trigger( "click" );
          });

        } else if (response.status === 'not_authorized') {
          console.log("not authorize");

        } else {
          console.log("not login");
        }
      }

      // =============================================================================
      // FACEBOOK REGISTER
      // =============================================================================

      // FACEBOOK AUTH CHECKER
      function checkRegisterState() {
        FB.getLoginStatus(function(response) {
          fbRegisterCallback(response);
        });
      }

      // CALL BACK AFTER FACEBOOK AUTH
      function fbRegisterCallback(response){
        console.log("facebook callback...");
        console.log(response);

        if (response.status === 'connected') {
          console.log("fb auth connected");

          var result = fetchAPI( function(response) {
            $('.register-form').find("input[name='password']").val(response.id);
            $('.register-form').find("input[name='password_confirmation']").val(response.id);
            $('.register-form').find("input[name='name']").val(response.first_name + ' ' + response.last_name);
            $('.register-form').find("input[name='email']").val(response.email);

            $('.register-form').find("input[name='email']").focus();
            $('.register-form').find("input[name='password']").focus();
            $('.register-form').find("input[name='name']").focus();
            $('.register-form').find("input[name='password_confirmation']").focus();
            $( ".register-user-btn" ).trigger( "click" );
          });
  
        } else if (response.status === 'not_authorized') {
          console.log("not authorize");

        } else {
          console.log("not login");
        }
      }

      // =============================================================================
      // FACEBOOK FETCH USER API
      // =============================================================================

      // FETCH API USER INFO
      function fetchAPI(callback) {
        console.log('Fetching facebook user info...');
        FB.api('/me?fields=id,first_name,last_name,email', function(response) {
          console.log(response);
          callback(response);
        });
      }

      // LOGOUT (NO USED)
      function fbLogout() {
        FB.logout(function (response) {
            console.log('logout')
            //Do what ever you want here when logged out like reloading the page
            window.location.reload();
        });
      }

      // =============================================================================
      // GOOGLE OAUTH FUNCTION
      // =============================================================================

      // REGISTER
      function onSignUp(googleUser) {
        var profile = googleUser.getBasicProfile();
        googleUser.disconnect();

        $('.register-form').find("input[name='password']").val(profile.getId());
        $('.register-form').find("input[name='password_confirmation']").val(profile.getId());
        $('.register-form').find("input[name='name']").val(profile.getName());
        $('.register-form').find("input[name='email']").val(profile.getEmail());

        $('.register-form').find("input[name='email']").focus();
        $('.register-form').find("input[name='password']").focus();
        $('.register-form').find("input[name='name']").focus();
        $('.register-form').find("input[name='password_confirmation']").focus();

        $( ".register-user-btn" ).trigger( "click" );
      }

      // LOGIN
      function onLogIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        googleUser.disconnect();
        
        $('.login-form').find("input[name='email']").val(profile.getEmail());
        $('.login-form').find("input[name='password']").val(profile.getId());

        $('.login-form').find("input[name='email']").focus();
        $('.login-form').find("input[name='password']").focus();
        $( ".login-user-btn" ).trigger( "click" );
      }

    </script>
	</body>
</html>