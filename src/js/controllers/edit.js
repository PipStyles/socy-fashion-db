angular.module(ANGULAR_APP_NAME)
.controller('EditCtrl', function($scope, $routeParams, $location){
  
  $scope.itemType = $routeParams.type || 'thing';
  $scope.itemId = parseInt($routeParams.id) || 0;
  
  $scope.item = {id:$scope.itemId,name: $scope.itemsType+$scope.itemId};  
  
  
});