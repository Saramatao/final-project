'use strict';

var mainAppModuleName = 'Main';
var mainAppModule = angular.module(mainAppModuleName, ['courses']);

angular.element(document).ready( function() {
	angular.bootstrap(document.querySelector('#angularApp'), [mainAppModuleName], {
		strictDi: true
	});
});
