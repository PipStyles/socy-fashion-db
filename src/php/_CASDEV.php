<?php
if(!isset($_SESSION['session_id']) || $_SESSION['session_id'] == '') {
  session_start();
  $_SESSION['UOM_CAS_USERNAME'] = 'testuser';
  
}
?>