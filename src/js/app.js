ANGULAR_APP_NAME = 'socyFashionImage';

angular.module(ANGULAR_APP_NAME, [
  'ngRoute',
  'mobile-angular-ui',
    'mobile-angular-ui.gestures',
  'ngResource',
  'restangular',
  'ngTagsInput',
  'autocomplete',
  'angularFileUpload',
  'angularUtils.directives.dirPagination',
  'ngAnimate'
])

.config(function($routeProvider, $controllerProvider, RestangularProvider, appConstants, paginationTemplateProvider) {

    //adapting for apigility response format
    RestangularProvider
     .setBaseUrl(appConstants.apiRoot)
      .setRestangularFields({
        selfLink:'_links.self.href'
      })
      .setRequestInterceptor(function(elem, operation) {
          if (operation === "remove") {
             return undefined;
          }
          return elem;
      })
      .addResponseInterceptor(function(data, operation, what, url, response, deferred) {
          var extractedData;
          // .. to look for getList operations

        if(typeof(data._embedded) !== 'undefined' && typeof(data._embedded[what]) !== 'undefined') {
               extractedData = data._embedded[what];
           }
            else {
                extractedData = data;
            }

        if (operation === "getList") {
            // .. and handle the data and meta data
            extractedData._links = data._links;
            extractedData.page_count = data.page_count;
            extractedData.page_size = data.page_size;
            extractedData.total_items = data.total_items;

          } else {
            //extractedData = data._embedded[what];
          }

          return extractedData;
        });


  $routeProvider
      .when('/', {
        templateUrl: 'views/pages/home.html',
        controller: 'HomeCtrl'
      })
      .when('/help', {
        templateUrl: 'views/pages/help.html'
      })

      //generics
      .when('/list/:type/:my?', {
        templateUrl: 'views/pages/list.html',
        controller: 'ListCtrl'
      })
      .when('/item/:type/:id', {
        templateUrl: 'views/pages/item.html',
        controller: 'ItemCtrl'
      })
      .when('/edit/:type/:id', {
        templateUrl: 'views/pages/edit.html',
        controller: 'EditCtrl'
      })

      //specifics
      .when('/themes', {
        templateUrl: 'views/pages/themes.html',
        controller: 'ThemesCtrl'
      })

      .when('/tags', {
        templateUrl: 'views/pages/tags.html',
        controller: 'TagsCtrl'
      })

     .when('/encounters/:params?', {
        templateUrl: 'views/pages/encounters.html',
        controller: 'EncountersCtrl',
        reloadOnSearch: false
      })
     .when('/encounter/:encounter_id', {
        templateUrl: 'views/pages/encounter.html',
        controller: 'EncounterCtrl'
      })
     .when('/encounter-edit/:id?', {
        templateUrl: 'views/pages/encounter/encounter-edit.html',
        controller: 'EncounterEditCtrl'
      })


     //admin approval...
     .when('/approval-list', {
        templateUrl: 'views/pages/encounters.html',
        controller: 'ApprovalListCtrl'
      })
      .when('/approval/:id', {
        templateUrl: 'views/pages/approval.html',
        controller: 'ApprovalCtrl'
      });

})
.run(function($rootScope, $location, appConstants, Me) {

    $rootScope.Object = Object;

    $rootScope.appConstants = appConstants;
    $rootScope.loc = $rootScope.location = $location;
    $rootScope.sfiConfig = {};

    Me.get().then(function(res) {
       $rootScope.me = res;
    });

    $rootScope.getMe = function() {
     return Me.get();
    }

    var history = [];

    $rootScope.$on('$routeChangeSuccess', function() {
        history.push($location.$$path);
    });

    $rootScope.back = function () {
        var prevUrl = history.length > 1 ? history.splice(-2)[0] : "/";
        $location.path(prevUrl);
    };





});
