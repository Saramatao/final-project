'use strict';

angular.module('courses').controller('CoursesController', [
	'$scope',
	'$http',
	function($scope, $http) {
    $scope.firstname = "John";
    $scope.names = [
      'ww',
      'qqq'
    ];

    $scope.course = {}

    $http.get('/api/courses/COURSE0001')
      .then( 
        function(response) {
          console.log('success');
          console.log(response);
          $scope.course = response.data;
        },
        function(response) {
          console.log('fail');
          console.log(response);
        },
    );

    

	}
]);