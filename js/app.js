var app = angular.module('schedular-ui', [ 'ngRoute', 'restangular', 'ui.bootstrap' ]);

app.config(function(RestangularProvider) {
  RestangularProvider.setBaseUrl('http://localhost/scheduler-api/');
});

app.config(['$routeProvider', function($routeProvider) {
  $routeProvider
    .when('/schedules',
      { controller: 'ScheduleListController',   templateUrl: 'schedules.html' })

    .when('/schedules/new',
      { controller: 'ScheduleNewController',    templateUrl: 'schedulesNew.html' })

    .when('/schedules/:scheduleId',
      { controller: 'ScheduleDetailController', templateUrl: 'schedulesDetail.html' })

    .when('/schedules/:scheduleId/edit',
      { controller: 'ScheduleEditController',   templateUrl: 'schedulesEdit.html' })

    .when('/schedules/:scheduleId/sub_schedule/new',
      { controller: 'SubScheduleNewController', templateUrl: 'sub_scheduleNew.html' })

    .when('/schedules/:scheduleId/sub_schedule/:sub_scheduleId/edit',
      { controller: 'SubScheduleEditController', templateUrl: 'sub_scheduleEdit.html' })

    .otherwise(
      { redirectTo: '/schedules' });
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

app.controller('ScheduleDetailController', ['$scope', '$location', '$routeParams', 'Restangular', function($scope, $location, $routeParams, Restangular) {
  var schedule = Restangular.one('schedules/' + $routeParams.scheduleId);
  schedule.get().then(function($schedule) {
    $scope.schedule = $schedule;
  });

  $scope.edit = function($schedule) {
    $location.path('/schedules/' + $schedule.id + '/edit');
  }
}]);

app.controller('ScheduleNewController', ['$scope', '$location', 'Restangular', function($scope, $location, Restangular) {
  $scope.open = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.opened = true;
  };

  $scope.submit = function() {
    Restangular.all('schedules').post($scope.schedule).then(function($schedule) {
      console.log($schedule.id);
      $location.path('/schedules/' + $schedule.id + '/edit');
    }, function() {
      console.log("Error");
    });
  };
}]);

app.controller('ScheduleEditController', ['$scope', '$location', '$routeParams', 'Restangular', function($scope, $location, $routeParams, Restangular) {
  var schedule = Restangular.one('schedules', $routeParams.scheduleId);
  schedule.get().then(function($schedule) {
    $scope.schedule = $schedule;
  });

  $scope.open = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.opened = true;
  };

  $scope.addSubSchedule = function($schedule) {
    $location.path('/schedules/' + $schedule.id + '/sub_schedule/new');
  }

  $scope.editDetail = function($sub_schedule) {
    $location.path('/schedules/' + $sub_schedule.schedule_id + '/sub_schedule/' + $sub_schedule.id + '/edit')
  }

  $scope.save = function() {
    $scope.schedule.put().then(function($schedule) {
      $location.path('/schedules/' + $schedule.id + '/edit');
    }, function($schedule) {
      console.log('Error saving schedule');
    });
  }
}]);

app.controller('SubScheduleNewController', ['$scope', '$location', '$routeParams', 'Restangular', function($scope, $location, $routeParams, Restangular) {
  var schedule = Restangular.one('schedules', $routeParams.scheduleId);

  $scope.submit = function() {
    schedule.all('sub_schedules').post($scope.sub_schedule).then(function($sub_schedule) {
      console.log($sub_schedule.id);
      $location.path('/schedules/' + $sub_schedule.schedule_id + '/edit');
    }, function() {
      console.log("Error");
    });
  };
}]);

app.controller('SubScheduleEditController', ['$scope', '$location', '$routeParams', 'Restangular', function($scope, $location, $routeParams, Restangular) {
  var sub_schedule = Restangular.one('schedules', $routeParams.scheduleId).one('sub_schedules', $routeParams.sub_scheduleId);
  //Restangular.one('schedules/' + $routeParams.scheduleId + '/sub_schedules/' + $routeParams.sub_scheduleId);
  sub_schedule.get().then(function($sub_schedule) {
    $scope.sub_schedule = $sub_schedule;
  });

  $scope.edit = function() {
    $scope.sub_schedule.put().then(function($sub_schedule) {
      console.log($sub_schedule.id);
      $location.path('/schedules/' + $sub_schedule.schedule_id + '/edit');
    }, function() {
      console.log("Error");
    });
  };
}]);