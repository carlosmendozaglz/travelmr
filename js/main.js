$(document).ready(function () {
    setHeight();

    Inputmask({ regex: "[A-Z a-z]*"}).mask(".capital");
    Inputmask({ regex: "[A-Za-z 1234567890]*" }).mask(".capital-numbers");

    $(".date").inputmask("99/99/9999",{ "placeholder": "DD/MM/AAAA" });
    //Date picker
    $('.date').datepicker({
      autoclose: true
    });
    
    $(document).on("input", ".phone-mask", function () {
        $(".phone-mask").inputmask('(999)999-9999',{placeholder:" ", clearMaskOnLostFocus: true } );
    });
    $(document).on("click", ".phone-mask", function () {
        $(".phone-mask").inputmask('(999)999-9999');
    });
    $(document).on("blur", ".phone-mask", function () {
        $(".phone-mask").inputmask('999 999 9999');
    });
    $(document).on("click", ".capital", function () {
        Inputmask({ regex: "[A-Z a-z]*"}).mask(".capital");
    });
    $(document).on("click", ".capital-numbers", function () {
        Inputmask({ regex: "[A-Za-z 1234567890]*" }).mask(".capital-numbers");
    });
    $(document).on("click", ".numbers", function () {
        Inputmask({ regex: "[1234567890]*", casing: "upper" }).mask(".numbers");
    });
    $(document).on("click", ".price", function (){
        Inputmask({ regex: "[1234567890.]*", casing: "upper" }).mask(".price");
    });
    $(document).on("focus",".date", function (){
        $(".date").inputmask("99/99/9999",{ "placeholder": "DD/MM/AAAA", regex: '/[(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[/\\/](19|20)\d{2}]/' });
        $('.date').datepicker({
            autoclose: true
          });
    });
    $(document).on("focus", ".time", function () {
        $(".time").inputmask("99:99",{ "placeholder": "HH:MM", regex: '/[(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[/\\/](19|20)\d{2}]/' });
        $('.time').timepicker({
            showInputs: false,
            showMeridian: false
        });
    });
    
    redirect(null);
    $(document).on("click", ".link", function () {
        redirect($(this));
    });
    $(document).on("resize", "#body", function (){
        setTimeout("setHeight()", 500);
    });
    $(document).on("click", ".logout-app", function (){
        logOut($(this));
    });
    getDataSesion();
});


Inputmask.extendDefaults({
  'autoUnmask': true
});
Inputmask.extendDefinitions({
  'A': {
    validator: "[A-Za-z\u0410-\u044F\u0401\u0451\u00C0-\u00FF\u00B5]",
    casing: "upper" //auto uppercasing
  },
  '+': {
    validator: "[0-9A-Za-z\u0410-\u044F\u0401\u0451\u00C0-\u00FF\u00B5]",
    casing: "upper"
  }
});
Inputmask.extendAliases({
  'numeric': {
    mask: "r",
    greedy: false,
  }
});

function initItems(){
    $(".select2").select2();
    $(".select2").css("width","100%");
    
}

function setHeight(){
    $(".main-header").css("position","fixed");
    $(".main-header").width($(window).width());
    $(".main-sidebar").css("position","fixed");
    $(".main-header").css("width",$(window).width());
    var headerheigth=$(".main-header").height();
    var heigthwindow=$(window).height();
    var footerheight=$(".main-footer").height();
    $("#main-content").height(heigthwindow-headerheigth-footerheight-32);
    $("#main-content").css("margin-top", headerheigth);
}

function loadMenu(){
    $(".main-sidebar").load("web/common/menu.php");
}
function loadHeader(){
    $(".main-header").load("web/common/header.php");
}
function loadFooter(){
    $(".main-footer").load("web/common/footer.php")
}
function loadSideBarControl(){
    $(".control-sidebar").load("web/common/sidebarcontrol.php");
}
function isSuccess(data, debug){
    var success=false;
    if(debug==true){
        console.log("Debug: "+data);
    }
    if(data==""){
        dhtmlx.message({text: 'No se recibio respuesta.', type: 'error'});
    }else{
        var values=data.split(SEPARATOR);
        var flag=values[1];
        var message=values[2];
        if(parseInt(flag)===1){
            if(message!==""){
                dhtmlx.message({text: message, type: 'success'});
            }
            success=true;
        }else{
            dhtmlx.message({text:message, type: 'error'});
            dhtmlx.message({text:message, type: 'error'});
        }
    }
    return success;
}

function contentAnswer(data, debug){
    if(debug){
        console.log("Debug contenido: "+data);
    }
    var array=data.split(SEPARATOR);
    var content=array[3];
    return content;
}

function infoAnswer(data, debug){
    if(debug){
        console.log("Debug info: "+data);
    }
    var array=data.split(SEPARATOR);
    var info=array[4];
    return info;
}

function redirect(item) {
    var view="home";
    if(item!==null){
        view = item.attr("data-link");
    }
    showLoading(true);
    $.ajax({
        url: LINK_URL,
        type: "POST",
        data: {trans:TRANS_LOAD_VIEW, view:view},
        async: false,
        success: function (datos) {
            $(".link").parent().removeClass("active");
            $(item).parent().addClass("active");
            $("#main-content").html(datos);
            showLoading(false);
        }
    });
}

function showLoading(show){
    if(show){
        $(".content-loading-img").css("display","block");
    }else{
        $(".content-loading-img").css("display","none");
    }
}

function loadOptionsBranch(select){
    showLoading(true);
    $.ajax({
        url: LINK_BRANCH_URL,
        type: "POST",
        data: {trans:TRANS_BRANCH_OPTION},
        async: false,
        success: function (datos) {
            showLoading(false);
            if(isSuccess(datos, false)){
                $(select).html(contentAnswer(datos, false));
                initItems();
            }
        },
        error: function (){
            showLoading(false);
        }
    });
}

function loadOptionsHotel(select){
    showLoading(true);
    $.ajax({
        url: LINK_HOTEL_URL,
        type: "POST",
        data: {trans:TRANS_HOTEL_OPTION},
        async: false,
        success: function (datos) {
            showLoading(false);
            if(isSuccess(datos, false)){
                console.log("Loading hotels");
                $(select).html(contentAnswer(datos, false));
                initItems();
            }
        },
        error: function (){
            showLoading(false);
        }
    });
}

function loadOptionsRestaurant(select){
    showLoading(true);
    $.ajax({
        url: LINK_RESTAURANT_URL,
        type: "POST",
        data: {trans:TRANS_RESTAURANT_OPTION},
        async: false,
        success: function (datos) {
            showLoading(false);
            if(isSuccess(datos, false)){
                console.log("Loading restaurants");
                $(select).html(contentAnswer(datos, false));
                initItems();
            }
        },
        error: function (){
            showLoading(false);
        }
    });
}

function loadOptionsAirline(select){
    showLoading(true);
    $.ajax({
        url: LINK_AIRLINE_URL,
        type: "POST",
        data: {trans:TRANS_AIRLINE_OPTION},
        async: false,
        success: function (datos) {
            showLoading(false);
            if(isSuccess(datos, false)){
                console.log("Loading airlines");
                $(select).html(contentAnswer(datos, false));
                initItems();
            }
        },
        error: function (){
            showLoading(false);
        }
    });
}

function isText(val) {
    expr = /^([a-zA-Z ])+$/;
    if (!expr.test(val)) {
        return false;
    } else {
        return true;
    }
}

function isTextAndNumber(val) {
    expr = /^([a-zA-Z0-9 ])+$/;
    if (!expr.test(val)) {
        return false;
    } else {
        return true;
    }
}

function isCapital(val) {
    expr = /^([A-Z ])+$/;
    if (!expr.test(val)) {
        return false;
    } else {
        return true;
    }
}

function isEmail(val) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!expr.test(val)) {
        return false;
    } else {
        return true;
    }
}

function isDate(val) {
    expr = /^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[/\\/](19|20)\d{2}$/;
    if (!expr.test(val)) {
        return false;
    } else {
        return true;
    }
}

function isRFC(val) {
    expr = /^([A-Z,Ã,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$/;
    if (!expr.test(val)) {
        return false;
    } else {
        return true;
    }
}

function logOut(item) {
    dhtmlx.confirm({
        title: TITLE_LOGOUT_APP,
        ok: "Si", cancel: "No",
        text: "¿Desea terminar tu sesión? ",
        callback: function (logout) {
            if (logout) {
                $.ajax({
                    url: LINK_URL,
                    type: 'POST',
                    data: {trans: TRANS_LOGOUT},
                    success: function (data) {
                        if (isSuccess(data, true)) {
                            location.href='index';
                        }
                    }
                });
            }
        }
    });
}

function getDataSesion() {
    if (currentFile() !== 'index') {
        $.ajax({
            url: LINK_URL,
            type: 'POST',
            data: {trans: TRANS_GET_LOGIN_DATA},
            success: function (data) {
                if (isSuccess(data, true)) {
                    initSesion(contentAnswer(data, false));
                }
            }
        });
    }
}

function initSesion(data){
    var json = JSON.parse(data);
    var key=json.userkey;
    var name=json.name;
    $(".img-user").attr("src",URL_SHOW_IMAGE+'img='+key+'&type='+TYPE_USER);
    $(".user-name").text(name);
}

function currentFile(){
    var URLactual = window.location.toString();
    var array=URLactual.split("/",20);
    var archivoac=array[array.length-1];
    var array=archivoac.split("#");
    var archivoac=array[0];
    var array=archivoac.split(".");
    var archivoac=array[0];
    return archivoac;
}
