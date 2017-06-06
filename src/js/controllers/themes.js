angular.module(ANGULAR_APP_NAME)
.controller('ThemesCtrl', function($scope, $location, Themes){
  
  Themes.list().then(function(res) {
      $scope.themes = res;
  });
  
  $scope.goEncounters = function(theme_id) {
      $location.url('/encounters?theme_id='+theme_id);
      
  }
    
    
});