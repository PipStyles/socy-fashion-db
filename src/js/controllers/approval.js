angular.module(ANGULAR_APP_NAME)
.controller('ApprovalCtrl', function($scope, $routeParams, $location, $rootScope, Encounters, Images, Me) {
  
  Me.get().then(function(m) {
      if(!m.IS_ADMIN) {
        $location.url('/');   
      }
  });
    
  
    Encounters.one($routeParams.id).get().then(function(res) {
    $scope.encounter = res;
        Images.list({"encounter_id":$scope.encounter.encounter_id}).then(function(images) {
            $scope.images = images;
        });
    });

    $scope.approveAll = function() {
      //set all images as approved
      angular.forEach($scope.images, function(image) {
          image.approved = 1; 
      });           
      $scope.approveSet();
    }

    $scope.approveSet = function() {  
        var i = 0;
        angular.forEach($scope.images, function(image) {
           i += parseInt(image.approved);
           image.customPUT(null, image.image_id, {"approved": image.approved}).then(function(res) {
               //console.log(res);
           });
        });
        
        alert(i+" image(s) set as approved");
        $location.url('/approval-list');
    }


    $scope.toggleApproved = function(image) {
      image.approved = 1 - parseInt(image.approved);
    }
    
    
    
    
});