<?php require_once('php/auth.php'); ?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Sociology of Fashion - Image Database</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
    <meta name="apple-mobile-web-app-status-bar-style" content="yes" />
    
    <link rel="stylesheet" href="css/app.min.css" />
    <link rel="stylesheet" href="css/responsive.min.css" />
        
  </head>
  
  <body ng-app="socyFashionImage" class="has-navbar-top has-sidebar-left" >

    <!-- Sidebars -->
    <div ng-include="'views/partials/sidebar.html'" uui-track-as-search-param='true' class="sidebar sidebar-left"></div>
    
    <div class="app" >
      <!-- Navbars -->
      <div class="navbar navbar-app navbar-absolute-top" >
          <ng-include src="'views/partials/header.html'" ></ng-include>
      </div>
      
      <!-- App Body -->
      <div class="app-body">
        <div ng-show="loading" class="app-content-loading">
          <i class="fa fa-spinner fa-spin loading-spinner"></i>
        </div>
        
        <div class="app-content">
          <ng-view></ng-view>
        </div>
      </div>
    
    </div><!-- ~ .app -->

    <div ui-yield-to="modals" ></div>
    
    <script src="js/app.min.js"></script>
    
  </body>
</html>