angular.module(ANGULAR_APP_NAME)
.controller('ListCtrl', function($scope, $routeParams, $location, $injector){
  
  $scope.itemsType = $routeParams.type || 'thing';
  
  var itemService;
  if($injector.has('sfi-'+$scope.itemsType)) {
     itemService = $injector.get('sfi-'+$scope.itemsType);
  };
  
  $scope.nameParam = itemService.nameParam || 'name';
  
  $scope.items = [];
  for(var i=0; i<20; i++) {
   $scope.items.push({id:i,name: $scope.itemsType+i});  
  };
  
  $scope.viewItem = function(id) {
    $location.path('/item/'+ $scope.itemsType +'/'+id);
  };
   
  
});