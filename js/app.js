var app = angular.module('schedular-ui', [ 'ngRoute', 'restangular' ]);

app.config(function(RestangularProvider) {
  RestangularProvider.setBaseUrl('http://localhost:3000');
});

app.config(['$routeProvider', function($routeProvider) {
  $routeProvider
    .when('/schedules',
      {
        controller: 'ScheduleListController',
        templateUrl: 'schedules.html'
      })
    .when('/schedules/:scheduleId',
      {
        controller: 'ScheduleDetailController',
        templateUrl: 'schedulesDetail.html'
      })
    .otherwise(
      {
        redirectTo: '/schedules'
      });
}]);

app.controller('ScheduleListController', ['$scope', '$location', 'Restangular', function($scope, $location, Restangular) {
  var schedules = Restangular.all('schedules');
  schedules.getList().then(function($schedules) {
    $scope.schedules = $schedules;
  });

  $scope.showDetail = function($schedule) {
    $location.path('/schedules/' + $schedule.id);
  }
}]);

app.controller('ScheduleDetailController', ['$scope', '$routeParams', 'Restangular', function($scope, $routeParams, Restangular) {
  var schedule = Restangular.one('schedules/' + $routeParams.scheduleId);
  schedule.get().then(function($schedule) {
    $scope.schedule = $schedule;
  });
}]);

app.controller('SubSchedulesController', ['$scope', '$routeParams', 'Restangular', function($scope, $routeParams, Restangular) {
  var sub_schedules = Restangular.all('schedules/sub_schedules');
  sub_schedules.getList().then(function($sub_schedules) {
    $scope.sub_schedules = $sub_schedules;
  });
}]);