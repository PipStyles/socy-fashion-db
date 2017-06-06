angular.module(ANGULAR_APP_NAME)
.controller('EncountersCtrl', function($scope, $routeParams, $location, $anchorScroll, $rootScope, Encounters, Themes, Tags, Restangular, ActiveFilters) {

  $scope.prevHash = '';

  var _filterDefaults = {
    cohorts: {
      2014: true,
      2015: true
    },
    hasApprovedImages: false
  };

  $scope.filter = ActiveFilters.getFilter("Encounters");
  if(!$scope.filter) {
    $scope.filter = ActiveFilters.addFilter("Encounters", _filterDefaults);
  }

  $scope.clearFilters = function(){
      ActiveFilters.resetFilter("Encounters");
  }

  $scope.filterItem = function(item) {
    var result = true;
    if(!$scope.filter.cohorts[item.user_cohort]) {
      result = false;
    }
    if($scope.filter.hasApprovedImages && item.approved_images < 1) {
      result = false;
    }
    //...
    return result;
  }

  if($routeParams.params == 'my') {
      $scope.my = 'My ';
      $rootScope.getMe().then(function(me) {
          $scope.encounters = Encounters.list({"owner_id":me.UID}).$object;
      });
  } else {
      getResultsPage();
  }

  if($routeParams.theme_id) {
      //fetch theme name for view
      Themes.one($routeParams.theme_id).get().then(function(theme) {
         $scope.theme = theme;
      });
  }

  if($routeParams.tag_ids) {
      //fetch tag name for view
      Tags.one($routeParams.tag_ids).get().then(function(tag) {
         $scope.tag = tag;
      });
  }

  $scope.pageChanged = function(newPage) {
      $routeParams.page = newPage;
      getResultsPage();
  }


  function hideAllDeletes() {
      _.each($scope.encounters, function(elem,i,l) {
         elem.SHOW_DELETE = false;
      });
  }

  $scope.itemSwiped = function(e) {
      hideAllDeletes();
      e.SHOW_DELETE = true;
  }

  $scope.itemUnswiped = function(e) {
     e.SHOW_DELETE = false;
  }

  $scope.checkDelete = function(encounter) {
       $scope.encounterToDelete = encounter;
  }

  $scope.doDelete = function(encounterCopy) {
      hideAllDeletes();

      Encounters.delete(encounterCopy);
      var _index = $scope.encounters.indexOf(encounterCopy);
      $scope.encounters.splice(_index, 1);
      $scope.encounterToDelete = null;
      alert("Encounter was deleted");
  }

  $scope.cancelDelete = function() {
      $scope.encounterToDelete = null;
      hideAllDeletes();
  }


  function getResultsPage() {
      Encounters.list($routeParams).then(function(res) {
          $scope.encounters = res;
          $scope.pageNum = $routeParams.page;
          $location.search($routeParams);

          if($location.hash()) {
              $scope.prevHash = $location.hash();
              $anchorScroll();
          }
          //console.log($scope.encounters);
      });
  }


  //load the encounter, passing routeParams with .search (to preserve when returning)
  $scope.loadEncounter = function(id) {
      $location.path('/encounter/'+id).search($routeParams);
  }


});
