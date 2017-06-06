angular.module(ANGULAR_APP_NAME)
.controller('EncounterCtrl', function($scope, $rootScope, $routeParams, $location, Encounters){
  
    Encounters.one($routeParams.encounter_id).get().then(function(res) {
        $scope.encounter = res;
    });
    
    
    //return to list WITH routeparams intact...
    $scope.backToList = function() {
        var ret_id = $routeParams.encounter_id
        delete $routeParams.encounter_id;
        $location.path('/encounters').search($routeParams).hash('encounter_'+ret_id);   
        
    }
    
    $scope.goTag = function(tag_id) {
        delete $routeParams.theme_id;
        $routeParams.tag_ids = tag_id;
        $scope.backToList();
    }
    
    $scope.goTheme = function(theme_id) {
        delete $routeParams.tag_ids;
        $routeParams.theme_id = theme_id;
        $scope.backToList();
    }
    
    $scope.edit = function() {
      if($rootScope.me.IS_ADMIN || $rootScope.me.UID == $scope.encounter.owner_id) {
        $location.path('/encounter-edit/'+$scope.encounter.encounter_id).search($routeParams); 
      }
      
      
    }
    
});