angular.module(ANGULAR_APP_NAME)
.controller('ItemCtrl', function($scope, $routeParams, $location){
  
  $scope.itemType = $routeParams.type || 'thing';
  $scope.itemId = $routeParams.id || 'thing';
  
  
  $scope.item = {id:$scope.itemId, name: $scope.itemType+$scope.itemId};  
  
  $scope.editItem = function() {
    $location.path('/edit/'+$scope.id);
  };
  
  
  
  
});