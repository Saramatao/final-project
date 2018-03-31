'use strict';

angular.module('core').config([
	'$urlRouterProvider',
	'$locationProvider',
	'$stateProvider',
	function($urlRouterProvider, $locationProvider, $stateProvider) {
		$locationProvider.hashPrefix('!');
		$urlRouterProvider.otherwise('/');

		$stateProvider
			.state('home', {
				url: '/'
			});
	}
]);