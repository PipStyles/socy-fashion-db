angular.module(ANGULAR_APP_NAME)
.controller('EncounterEditCtrl', function($scope, $rootScope, $routeParams, $location, Restangular, Encounters, Themes, Subjects, Images, Tags, $q, $upload) {


    $scope.upload = function (files) {
        if (files && files.length) {
            for (var i in files) {
                var file = files[i];
                $upload.upload({
                    url: $rootScope.appConstants.apiRoot+'imageupload',
                    headers:{
                      'Content-Type':'multipart/form-data'
                    },
                    fields: {
                        'encounter_id': $scope.encounter.encounter_id,
                         'image_detail':''

                        },
                    data: {
                       'encounter_id': $scope.encounter.encounter_id
                    },
                    file: file
                }).progress(function (evt) {
                    var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);

                    $scope.progress_message = progressPercentage+'% done'

                    file.progress = progressPercentage;
                }).success(function (data, status, headers, config) {
                    //console.log(data, status, headers, config);
                    $scope.progress_message = 'all uploaded!'
                    loadImages();

                })
                .error(function(e) {
                    console.log(e);

                });
            }
        }
    };


  $scope.save = function() {
    if(typeof($routeParams.id) !== 'undefined' || $scope.encounter.encounter_id) {
        $scope.encounter.put().then(function(res) {
          $scope.encounter = res;
          fixEncounter();
          alert('Encounter was saved');
     });
    } else {
      Encounters.create($scope.encounter).then(function(res) {
        alert('Encounter was created');
        $location.url(/encounter-edit/+res.encounter_id);
      });
    }
  };

  $scope.delete = function() {
    $scope.encounter.remove().then(function(res) {
        alert('Encounter was deleted');
        $location.url('/encounters');
    });
  };


    function fixEncounter() {
         $scope.encounter.tags = _.toArray($scope.encounter.tags);
          $scope.encounter.images = _.toArray($scope.encounter.images);
          $scope.encounter.clothing = _.toArray($scope.encounter.clothing);

     };

    function unfixEncounter() {
         $scope.encounter.tags = _.object($scope.encounter.tags);
          $scope.encounter.images = _.object($scope.encounter.images);
          $scope.encounter.clothing = _.object($scope.encounter.clothing);

     };



    var editingImage = false;
    $scope.initEditImage = function(image) {
        $scope.editimage = image;
        editingImage = true;
    }

    $scope.saveEditImage = function(image) {
        editingImage = false;
    }

    $scope.deleteImage = function(image) {
        var i = $scope.encounter.images.indexOf(image);
        $scope.encounter.images.splice(i, 1);
    }

    function loadImages() {
        Images.list({"encounter_id":$scope.encounter.encounter_id}).then(function(res) {
            $scope.encounter.images = res;
        });
    }



    var editingClothing = false;
    $scope.newclothing = {};

    $scope.initEditClothing = function(clothing) {
        editingClothing = true;
        $scope.newclothing = clothing;
    };


    $scope.initAddClothing = function() {
        editingClothing = false;
        $scope.newclothing = {};
    };

    var addClothing = function(clothing) {
        $scope.encounter.clothing.push(clothing);
       // console.log('added clothing:', clothing);
    };

    var editClothing = function(clothing) {
       //console.log('edited clothing:', clothing);

    };

    $scope.saveClothing = function(clothing) {
        editingClothing ? editClothing(clothing) : addClothing(clothing);
    };

    $scope.deleteClothing = function(clothing) {
        var i = $scope.encounter.clothing.indexOf(clothing);
        $scope.encounter.clothing.splice(i, 1);
        $scope.initAddClothing();
    };


   function loadThemes() {
     Themes.list().then(function(themes) {
        $scope.themes = themes;
     });
   };






    $scope.getFilteredTags = function(query) {
        var defer = $q.defer();
        if(typeof($scope.all_tags) !== 'undefined' && $scope.all_tags.length) {
            var filteredTags = _.filter($scope.all_tags, function(val) {
                return val.tag_name.toLowerCase().indexOf(query.toLowerCase()) >= 0;
             });
            defer.resolve(filteredTags);
        } else {
            loadTags().then(function(tags) {
               defer.resolve($scope.getFilteredTags(query));
          });
        }
        return defer.promise;
    }


   function loadTags() {
       var defer = $q.defer();
       Tags.list().then(function(tags) {
          $scope.all_tags = tags.plain();
          defer.resolve($scope.all_tags);
       });
       return defer.promise;
    };







    $scope.subject_emails = [];

    function loadSubjects() {
        Subjects.list().then(function(subs) {
            $scope.subjects = subs.plain();
            $scope.subject_emails = _.pluck($scope.subjects, 'subject_email');
            $scope.subjectEmailBlur();
        });
    };


    function clearSubject() {
      var temp_email = $scope.encounter.subject.subject_email;
      $scope.encounter.subject = {"subject_email":temp_email};
    };

    $scope.setSubjectByEmail = function() {
        var found = false;

        for(var k in $scope.subjects) {
            if($scope.subjects[k].subject_email == $scope.encounter.subject.subject_email) {

              $scope.encounter.subject = $scope.subjects[k];
              $scope.subject_fields = false;
              $scope.encounter.subject_id =  $scope.encounter.subject.subject_id;

              found = true;
            }
        }

        if(!found) {
          //clearSubject();
          $scope.subject_fields = true;
        }
    };

    $scope.subjectEmailBlur = function() {
        var found = false;

        if(typeof($scope.encounter.subject) !== 'undefined' && typeof($scope.encounter.subject.subject_email) !== 'undefined' && $scope.encounter.subject.subject_email.length) {
            for(var k in $scope.subjects) {
                if($scope.subjects[k].subject_email == $scope.encounter.subject.subject_email) {

                  $scope.encounter.subject = $scope.subjects[k];
                  $scope.subject_fields = false;
                  $scope.encounter.subject_id =  $scope.encounter.subject.subject_id;
                  found = true;
                }
            }

            if(!found) {
                clearSubject();
                if(typeof($scope.encounter.subject.subject_email) !== 'undefined' && $scope.encounter.subject.subject_email.length)
                {
                  $scope.subject_fields = true;
                }
            }
        }
    };

   $scope.newtheme = {"theme_name":''};
   $scope.addTheme = function() {
       Themes.create({"theme_name":$scope.newtheme.theme_name})
         .then(function(res) {
             loadThemes();
             $scope.encounter.theme_id = res.theme_id;
             $scope.newtheme.theme_name = '';
       });
   };


  $scope.encounter = {
                      "clothing":[],
                      "tags":[],
                      "images":[],
                      "subject":{"subject_email":""},
                      "title":"",
                      "subject_agreement":0
                   };


  //awful!
  $scope.isSaveableEncounter = function() {
    return ($scope.encounter.subject_agreement
            && $scope.encounter.title.length > 3
            && typeof($scope.encounter.subject) !== 'undefined'
            && typeof($scope.encounter.subject.subject_email) !== 'undefined'
            && $scope.encounter.subject.subject_email.length > 5);
  }

  if(typeof($routeParams.id) !== 'undefined') {
  //editing existing, get by id and populate form...
      $scope.action = 'edit';
      $scope.subject_fields = false;

      //load data from Encounters service...
      Encounters.one($routeParams.id).get().then(function(enc){
          $scope.encounter = enc;
          //convert from object to array, stupid Apigility giving enum objects only :(
          fixEncounter();
        });
  }
  else {


    //making new...
    $scope.action = 'new';
    $scope.subject_fields = false;
    clearSubject();
  }


  loadTags();
  loadSubjects();
  loadThemes();

});
