<?php

class Conf {
    
    static $URL_BASE="http://localhost/viajesmr/";
    static $SEPARATOR = "</(tr)/>";
    static $FLAG_SUCCESS=1;
    static $FLAG_ERROR=0;
    static $FLAG_TRANS_NA='nothing';
    static $MINL = 0 ; 
    static $MAXL = 100;
    static $MAXLT = 10;
    static $MAXF = 11;

    static $VIEW_USERS='user';
    static $VIEW_USERS_URL='web/view/user/index.php';
    static $VIEW_HOME='home';
    static $VIEW_HOME_URL='web/view/home/index.php';
    static $VIEW_LOGIN='login';
    static $VIEW_LOGIN_URL='web/view/login/index.php';
    static $VIEW_ERROR_404='error404';
    static $VIEW_ERROR_404_URL='web/view/error/error404.php';
    static $VIEW_ERROR_500='error500';
    static $VIEW_ERROR_500_URL='web/view/error/error500.php';
    static $VIEW_HOTEL='hotel';
    static $VIEW_HOTEL_URL='web/view/hotel/index.php';
    
    static $TRANS_NEW_CATEGORY='nuevacategoria';
    static $TRANS_HOTEL_LIST='hotellist';
    static $TRANS_HOTEL_NEW='newhotel';
    static $TRANS_HOTEL_CONSULT='consulthotel';
    static $TRANS_HOTEL_UPDATE='updatehotel';
    static $TRANS_HOTEL_DELETE='deletehotel';

    static $HOTEL_CAMP_NAME='nombre de hotel';
    static $HOTEL_CAMP_NAME_MAXL=45;
    static $HOTEL_CAMP_NAME_MINL=1;
    static $HOTEL_CAMP_DESCRIPTION='descripci&oacute;n';
    static $HOTEL_CAMP_DESCRIPTION_MINL=0;
    static $HOTEL_CAMP_DESCRIPTION_MAXL=400;
    
    /*****************************************************************/
    static $VIEW_BRANCH='branch';
    static $VIEW_BRANCH_URL='web/view/branch/index.php';

    static $TRANS_BRANCH_LIST='branchlist';
    static $TRANS_BRANCH_NEW='newbranch';
    static $TRANS_BRANCH_CONSULT='consultbranch';
    static $TRANS_BRANCH_UPDATE='updatebranch';
    static $TRANS_BRANCH_DELETE='deletebranch';
    static $TRANS_BRANCH_OPTION='optionbranch';
    static $TRANS_HOTEL_OPTION = 'optionhotel';
    static $TRANS_RESTAURANT_OPTION = 'optionrestaurant';
    static $TRANS_AIRLINE_OPTION = 'optionairline';

    static $BRANCH_CAMP_DESCRIPTION='descripci&oacute;n de sucursal';
    static $BRANCH_CAMP_DESCRIPTION_MAXL=45;
    static $BRANCH_CAMP_DESCRIPTION_MINL=1;
    
    static $BRANCH_CAMP_ADDRESS='direcci&oacute;n de sucursal';
    static $BRANCH_CAMP_ADDRESS_MAXL=200;
    static $BRANCH_CAMP_ADDRESS_MINL=1;
    
    static $STATUS_ACTIVO='ACTIVO';
    static $TRANS_LOGIN='login';
    
    static $SESS_USER='user';
    static $SESS_USER_NAME='username';
    static $SESS_USER_KEY='userkey';
    static $SESS_USER_TYPE="usertype";
    static $SESS_STATUS = 'userstatus';
    static $SESS_SUCURSAL = 'usersucursal';
    static $SESS_NO_EMPLOYE = 'noemploye';
    static $SESS_PRIVILEGES='privilegios';

    static $TRANS_LOAD_VIEW = 'loadview';
    static $TRANS_USER_NEW = 'newuser';
    static $TRANS_USER_LIST='userlist';
    static $TRANS_USER_CONSULT = 'consultuser';
    static $TRANS_USER_UPDATE = 'updateuser';
    static $TRANS_USER_DELETE = 'deleteuser';
    static $TRANS_USER_ACCESS_MENU="accessmenu";
    static $LINK_USER_URL = 'web/link/userlink';
    static $LINK_UPLOAD_FILES = 'web/link/linkfiles';
    static $USER_CAMP_NAME='nombre de empleado';
    static $USER_CAMP_NAME_MAXL=80;
    static $USER_CAMP_NAME_MINL=1;
    
    static $USER_CAMP_USER='nombre de usuario';
    static $USER_CAMP_USER_MAXL=45;
    static $USER_CAMP_USER_MINL=1;
    
    static $USER_CAMP_BRANCH='sucursal';
    static $USER_TYPE_ADMIN="ADMINISTRADOR";
    static $USER_TYPE_COLAB='COLABORADOR';
    static $USER_TYPE_SYSTEM='SYSTEM';
    static $USER_CAMP_TYPE_USER='tipo de usuario';
    static $TRANS_FILE_UP_PHOTO_USER='uploadphotouser';
    static $TRANS_FILE_UP_PHOTO_TRAVEL = 'uploadphototravel';
    static $TRANS_FILE_DEL_PHOTO_USER = 'deletephotouser';
    static $TRANS_FILE_DEL_PHOTO_TRAVEL = 'deletephototravel';

    static $TMP_URL="/util/tmp/";
    static $TABLE_USER='user';
    static $TABLE_TRAVEL='travel';
    /*     * ************************************************************** */

    static $VIEW_AIRLINE='airline';
    static $VIEW_AIRLINE_URL='web/view/airline/index.php';

    static $TRANS_AIRLINE_LIST = 'airlineList';
    static $TRANS_AIRLINE_NEW = 'newAirline';
    static $TRANS_AIRLINE_CONSULT = 'consultAirline';
    static $TRANS_AIRLINE_UPDATE = 'updateAirline';
    static $TRANS_AIRLINE_DELETE = 'deleteAirline';
    static $AIRLINE_CAMP_NAME = 'nombre de aereolínea';
         
    static $VIEW_RESTAURANT='restaurant';
    static $VIEW_RESTAURANT_URL ='web/view/restaurant/index.php';  
    static $TRANS_RESTAURANT_LIST='restaurantList';
    static $TRANS_RESTAURANT_NEW='newRestaurant';
    static $TRANS_RESTAURANT_CONSULT='consultRestaurant';
    static $TRANS_RESTAURANT_UPDATE='updateRestaurant';
    static $TRANS_RESTAURANT_DELETE='deleteRestaurant';
    static $RESTAURANT_CAMP_NAME='nombre de restaurante';
    static $RESTAURANT_CAMP_DESCRIPTION='descripci&oacute;n';
    
    static $VIEW_DRIVER='driver';
    static $VIEW_DRIVER_URL ='web/view/driver/index.php';  
    static $TRANS_DRIVER_LIST='driverList';
    static $TRANS_DRIVER_NEW='newDriver';
    static $TRANS_DRIVER_CONSULT='consultDriver';
    static $TRANS_DRIVER_UPDATE='updateDriver';
    static $TRANS_DRIVER_DELETE='deleteDriver';
    static $DRIVER_CAMP_NAME='Nombre del conductor';
    static $DRIVER_CAMP_GENDER='Genero';
    static $DRIVER_CAMP_PHONE='Telefono';
    static $DRIVER_CAMP_INTERNO='Interno';
    static $DRIVER_CAMP_CERTIFICATION='Certificación';
    static $DRIVER_CAMP_LICENCE='Licencia';
    
    static $DRIVER_CAMP_NAME_MAXL=75;
    static $DRIVER_CAMP_NAME_MINL=1;
    static $DRIVER_CAMP_GENDER_MAXL=10;
    static $DRIVER_CAMP_GENDER_MINL=1;
    static $DRIVER_CAMP_PHONE_MAXL=15;
    static $DRIVER_CAMP_PHONE_MINL=1;
    static $DRIVER_CAMP_INTERNO_MAXL=2;
    static $DRIVER_CAMP_INTERNO_MINL=1;
    static $DRIVER_CAMP_CERTIFICATION_MAXL=400;
    static $DRIVER_CAMP_CERTIFICATION_MINL=1;
    static $DRIVER_CAMP_LICENCE_MAXL=45;
    static $DRIVER_CAMP_LICENCE_MINL=1;
    
    static $VIEW_CUSTOMER='customer';
    static $VIEW_CUSTOMER_URL ='web/view/customer/index.php';  
    static $TRANS_CUSTOMER_LIST='customerlist';
    static $TRANS_CUSTOMER_NEW='newcustomer';
    static $TRANS_CUSTOMER_CONSULT='consultcustomer';
    static $TRANS_CUSTOMER_UPDATE='updatecustomer';
    static $TRANS_CUSTOMER_DELETE='deletecustomer';
    static $CUSTOMER_CAMP_NAME = 'Nombre del cliente';
    static $CUSTOMER_CAMP_ADDRESS = 'Dirección';
    static $CUSTOMER_CAMP_PHONENUMBER = 'Número telefónico';
    static $CUSTOMER_CAMP_GENDER = 'Genero';
    static $CUSTOMER_CAMP_BIRTHDATE = 'Fecha de nacimiento';

    static $CUSTOMER_CAMP_NAME_MAXL=100;
    static $CUSTOMER_CAMP_NAME_MINL=1;
    static $CUSTOMER_CAMP_ADDRESS_MAXL = 100;
    static $CUSTOMER_CAMP_ADDRESS_MINL = 1;
    static $CUSTOMER_CAMP_PHONENUMBER_MAXL = 14;
    static $CUSTOMER_CAMP_PHONENUMBER_MINL = 7;
    static $CUSTOMER_CAMP_GENDER_MAXL = 1;
    static $CUSTOMER_CAMP_GENDER_MINL = 1;
    static $CUSTOMER_CAMP_BIRTHDATE_MAXL = 10;
    static $CUSTOMER_CAMP_BIRTHDATE_MINL = 10;
    static $TRANS_LOGOUT ='logout';
    static $TRANS_GET_LOGIN_DATA='logindata';

    static $SESS_TABLE_KEY_TMP='tablekeytmp';
    static $MENU_TYPE_MODULE="module";
    static $TRANS_USER_APPLY_PRIV='applyprivilege';
    
    static $VIEW_TRAVEL='travel';
    static $VIEW_TRAVEL_URL ='web/view/travel/index.php';  
    static $TRANS_TRAVEL_LIST='travellist';
    static $TRANS_TRAVEL_NEW='newtravel';
    static $TRANS_TRAVEL_CONSULT='consulttravel';
    static $TRANS_TRAVEL_UPDATE='updatetravel';
    static $TRANS_TRAVEL_DELETE='deletetravel';
  
    static $TRAVEL_CAMP_TRAVEL_KEY='clave de viaje';
    static $TRAVEL_CAMP_TRAVEL_KEY_MAXL=45;
    static $TRAVEL_CAMP_TRAVEL_KEY_MINL=0;
    
    static $TRAVEL_CAMP_LOCATION='lugar';
    static $TRAVEL_CAMP_LOCATION_MAXL=60;
    static $TRAVEL_CAMP_LOCATION_MINL=1;
    
    static $TRAVEL_CAMP_DESCRIPTION='descripci&oacute;n';
    static $TRAVEL_CAMP_DESCRIPTION_MAXL=100;
    static $TRAVEL_CAMP_DESCRIPTION_MINL=1;
    
    static $TRAVEL_CAMP_NOTES='notas';
    static $TRAVEL_CAMP_NOTES_MAXL=400;
    static $TRAVEL_CAMP_NOTES_MINL=0;

    static $TRAVEL_CAMP_DATE_DEPARTURE='fecha partida';
    static $TRAVEL_CAMP_TIME_DEPARTURE='hora partida';
    static $TRAVEL_CAMP_DATE_RETURN='fecha de regreso';
    static $TRAVEL_CAMP_TIME_RETURN='hora de regreso';
    static $TRAVEL_CAMP_ADULT_PRICE='precio audlto';
    static $TRAVEL_CAMP_MINOR_PRICE='precio menor';
    static $TRAVEL_CAMP_INFANT_PRICE='precio infante';
    static $TRAVEL_CAMP_DAYS='dias';
    static $TRAVEL_CAMP_NIGTHS='noches';
    static $TRAVEL_CAMP_RESTAURANT='restaurant';
    static $TRAVEL_CAMP_HOTEL='hotel';
    static $TRAVEL_CAMP_AIRLINE='aerolinea';
    static $TRAVEL_CAMP_LAST_DAY_PAY='ultimo d&iacute;a de pago';
    static $TRAVEL_CAMP_PERCENT='porcentaje de adelanto';
    static $TRAVEL_CAMP_MILES='millas';
    
    static $VIEW_SALE='sale';
    static $VIEW_SALE_URL ='web/view/sale/index.php';  
    
    
    

}
