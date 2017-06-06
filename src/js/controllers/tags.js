angular.module(ANGULAR_APP_NAME)
.controller('TagsCtrl', function($scope, $location, Tags){
  
  Tags.list().then(function(res) {
      $scope.tags = res;
  });
  
  $scope.goTags = function(tag_id) {
      $location.url('/encounters?tag_ids='+tag_id);
  }
  
});