<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale = 1.0, user-scalable=no">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="{{ asset('js/pdf.js') }}"></script>
</head>
<body>

  <fb:login-button class="fb-login-button" data-max-rows="1" data-size="large" 
    data-button-type="continue_with" data-show-faces="false" 
    data-auto-logout-link="false" data-use-continue-as="true"
    scope="public_profile, email" onlogin="checkLoginState();">
  </fb:login-button>

  {{--  FACEBOOK LOGIN FUNCTION  --}}
  <script>
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

      checkLoginState();
      console.log('start');
    };

    // CHECK LOGIN STATUS
    function checkLoginState() {
      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });
    }

    // CHECK LOGIN STATUS CALLBACK
    function statusChangeCallback(response) {
      console.log(response);
      if (response.status === 'connected') {
        testAPI();
      } else if (response.status === 'not_authorized') {
        console.log("The person is logged into Facebook, but not your app.");
      } else {
        console.log("not login");
        // header("Location: {{ url('/') }}");
      }
    }

    // TEST FETCH DATA
    function testAPI() {
      console.log('Welcome!  Fetching your information.... ');
      FB.api('/me', function(response) {
        console.log("Fb response");
        console.log(response);
        console.log('Successful login for: ' + response.name);
        document.getElementById('status').innerHTML =
          'Thanks for logging in, ' + response.name + '!';
      });
    }
  </script>

</body>
</html>