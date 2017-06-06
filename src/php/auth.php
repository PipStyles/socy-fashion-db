<?php

require_once(__DIR__.'/funcs.php');

$_SERVER['APPLICATION_ENV'] = ($_SERVER['SERVER_NAME'] == 'lore.humanities.manchester.ac.uk') ?
   'production' : 'development';


$_SERVER['APPLICATION_ENV'] == 'development' ?
    require_once($_SERVER['DOCUMENT_ROOT'].'/_lib/uom_cas/uom_cas.dev.inc.php') :
    require_once($_SERVER['DOCUMENT_ROOT'].'/_lib/uom_cas/uom_cas.inc.php');

$_SERVER['APPLICATION_ENV'] == 'development' ?
require_once(__DIR__.'/config/local.conf') : require_once(__DIR__.'/config/prod.conf');

//fixing the session attributes
$_SESSION['UOM_CAS_USER_ATTRIBUTES'] = [];
$_SESSION['UOM_CAS_USER_ATTRIBUTES'] = $_SESSION['phpCAS']['attributes'];
sfi_cas_split_attributes($_SESSION['UOM_CAS_USER_ATTRIBUTES']['attribute'], $sfi_cas_attribute_delims);

$sfi_db = new  PDO("mysql:host={$sfi_config['db_host']};dbname={$sfi_config['db_name']}", $sfi_config['db_user'], $sfi_config['db_password']);

$sfi_user_res = $sfi_db->query("SELECT users.*, admins.user_id AS admin_id FROM users LEFT JOIN admins ON users.user_id = admins.user_id WHERE users.user_id = {$_SESSION['UOM_CAS_USER_ATTRIBUTES']['attribute']['umanPersonID']}");


if($sfi_user_res->rowCount() !== 1)
{
    //log access attempt
    $stmt = $sfi_db->prepare("INSERT INTO access_attempts (id,email,timestamp) VALUES ({$_SESSION['UOM_CAS_USER_ATTRIBUTES']['attribute']['umanPersonID']}, '{$_SESSION['UOM_CAS_USER_ATTRIBUTES']['attribute']['mail']}',NOW())");
    $stmt->execute();
    header("location: noaccess/");
}
else
{
    $sfi_user_row = $sfi_user_res->fetch(PDO::FETCH_ASSOC);
    $_SESSION['SFI_USER'] = $_SESSION['UOM_CAS_USER_ATTRIBUTES']['attribute'];
    $_SESSION['SFI_USER']['UID'] = $_SESSION['SFI_USER']['umanPersonID'];

    $_SESSION['SFI_USER']['IS_ADMIN'] = false;
    if($sfi_user_row['admin_id'])
    {
        $_SESSION['SFI_USER']['IS_ADMIN'] = true;
    }

    //first log of access - set firstaccess
    if(substr($sfi_user_row['firstaccess'],0,1) == '0')
    {
        $sfi_db->query("UPDATE users SET firstaccess = NOW() WHERE id = {$_SESSION['SFI_USER']['umanPersonID']}");
    }

    $sfi_db->query("UPDATE users SET lastaccess = NOW() WHERE id = {$_SESSION['SFI_USER']['umanPersonID']}");

}

?>
