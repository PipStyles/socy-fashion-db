angular.module(ANGULAR_APP_NAME)
.service('Me', function(Restangular) {
    this.get = function() {
       var meRA = Restangular.one('me',1);
       return meRA.get();
  };
})


.factory('Encounters', function (Restangular) {
  var _serviceName = 'encounter';
  var _ra = Restangular.all(_serviceName);

  return {
       service: function() {
         return _ra;
       },
       list: function (params) {
         return _ra.getList(params);
       },
       one: function(id) {
         return _ra.one(id);
       },
       create: function(data) {
         return _ra.post(data);
       },
       update: function(id, data) {
         _ra.one(id).get().then(function(_enc){
            return _enc.put(data);
         });
       },
       delete: function(id) {
         var _id = typeof(id) == 'object' ? id.encounter_id : id;

         _ra.one(_id).get().then(function(_enc) {

             console.log(_enc);
              return _enc.remove();
         });
       }
    };
})

.service('ActiveFilters', function() {

  var _filters = {};

  this.addFilter = function(name, ob) {
     _filters[name] = {};
     _filters[name].default = ob;
     this.resetFilter(name);
     return this.getFilter(name);
  }

  this.getFilter = function(name) {
    if(typeof(_filters[name]) !== 'undefined' && typeof(_filters[name].active) !== 'undefined') {
      return _filters[name].active;
    }
    return false;
  }

  this.resetFilter = function(name) {
    if(typeof(_filters[name].default !== 'undefined')) {
       _filters[name].active = {};
       angular.copy(_filters[name].default, _filters[name].active);
    }
  }

  this.resetFilters = function() {
    //copy the defaults to the actives
    for(var k in _filters) {
      this.resetFilter(k);
    }
  }


})


.factory('Subjects', function(Restangular) {

  var _serviceName = 'subjects';
  var _ra = Restangular.all(_serviceName);

  return {
       service: function() {
         return _ra;
       },
       list: function (params) {
         return _ra.getList(params);
       },
       one: function(id) {
         return _ra.one(id);
       },
       create: function(data) {
         return _ra.post(data);
       },
       update: function(id, data) {
         _ra.one(id).get().then(function(_enc){
            return _enc.put(data);
         });
       },
       delete: function(id) {
         _ra.one(id).get().then(function(_enc) {
            return _enc.remove();
         });
       }
    };


})



.factory('Themes', function (Restangular) {

    var _serviceName = 'theme';
    var _ra = Restangular.all(_serviceName);

    return {
       service: function() {
         return _ra;
       },
       list: function (params) {
         return _ra.getList(params);
       },
       one: function(id) {
         return _ra.one(id);
       },
       create: function(data) {
           return _ra.post(data);
       },
       update: function(id, data) {
         _ra.one(id).get().then(function(_enc){
            return _enc.put(data);
         });
       },
       delete: function(id) {
         _ra.one(id).get().then(function(_enc) {
           return _enc.remove();
         });
       }
    };


})

.factory('Tags', function (Restangular) {

    var _serviceName = 'tags';
    var _ra = Restangular.all(_serviceName);

    return {
       service: function() {
         return _ra;
       },
       list: function (params) {
         return _ra.getList(params);
       },
       one: function(id) {
         return _ra.one(id);
       },
       create: function(data) {
           return _ra.post(data);
       },
       update: function(id, data) {
         _ra.one(id).get().then(function(_enc){
            return _enc.put(data);
         });
       },
       delete: function(id) {
         _ra.one(id).get().then(function(_enc) {
            return _enc.remove();
         });
       }
    };

})
.factory('Images', function (Restangular) {

    var _serviceName = 'image';
    var _ra = Restangular.all(_serviceName);

    return {
       service: function() {
         return _ra;
       },
       list: function (params) {
         return _ra.getList(params);
       },
       one: function(id) {
         return _ra.one(id);
       },
       create: function(data) {
           return _ra.post(data);
       },
       update: function(id, data) {
         _ra.one(id).get().then(function(_enc){
            return _enc.put(data);
         });
       },
       delete: function(id) {
         _ra.one(id).get().then(function(_enc) {
            return _enc.remove();
         });
       }
    };



})


;
