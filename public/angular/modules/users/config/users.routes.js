angular.module('users').config([
	'$stateProvider',
	function($stateProvider) {
		$stateProvider
			.state('login', {
				url: '/login',
				templateUrl: '/modules/users/views/login.view.pug'	
			})
			.state('signup', {
				url: '/signup',
				templateUrl: '/modules/users/views/signup.view.pug'
			});
	}
]);