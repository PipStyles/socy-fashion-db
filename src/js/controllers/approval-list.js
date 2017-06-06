angular.module(ANGULAR_APP_NAME)
.controller('ApprovalListCtrl', function($scope, $routeParams, $location, $rootScope, Encounters, Me) {
  
  Me.get().then(function(m) {
    if(!m.IS_ADMIN) {
      $location.url('/');   
    }
  });
  
  Encounters.list({'unapproved':1}).then(function(res) {
      $scope.encounters = res;
  });
  
  $scope.loadEncounter = function(id) {
    $location.url('/approval/'+id);
  };
    
});