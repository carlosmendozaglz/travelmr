$(document).ready(function () {
    loadGridDriver();
    loadFormDriver();

    $(document).on("click", "#btn-save-driver", function () {
        newDriver();
    });

    $(document).on("click", ".row-driver", function () {
        markRow($(this));
    });

    $(document).on("click", ".edit-driver", function () {
        consultDriver($(this), 'consult');
    });

    $(document).on("click", ".delete-driver", function () {
        deleteDriver($(this));
    });

    $(document).on("click", ".btn-new-driver", function () {
        showFormDriver($(this));
    });

    $(document).on("click", "#btn-cancel-driver", function () {
        hideFromDriver($(this));
    });
    
    $(document).on("click", ".createas-driver", function (){
        consultDriver($(this), 'createas');
    });
});

function markRow(item) {
    item.parent("tbody").find('tr').removeClass("info");
    var row = item.parent("tbody").parent("table").parent("div");
    item.addClass("info");
}
function deleteDriver(item) {
    dhtmlx.confirm({
        title: TITLE_CONFIRM_DELETE,
        ok: "Si", cancel: "No",
        text: "¿Estas  seguro de eliminar el Conductor selecionado? ",
        callback: function (eliminar) {
            if (eliminar) {
                var key = item.parent().parent().attr("data-key");
                $.ajax({
                    url: LINK_DRIVER_URL,
                    type: 'POST',
                    data: {trans: TRANS_DRIVER_DELETE, keyDriver: key},
                    success: function (data) {
                        if (isSuccess(data, true)) {
                            loadGridDriver();
                            loadFormDriver();
                        }
                    }
                });
            }
        }
    });
}

function consultDriver(item, type) {
    var key = item.parent().parent().attr("data-key");
    $.ajax({
        url: LINK_DRIVER_URL,
        type: 'POST',
        data: {trans: TRANS_DRIVER_CONSULT, keyDriver: key},
        success: function (data) {
            if (isSuccess(data, true)) {
                setValuesDriver(contentAnswer(data, false), type);
            }
        }
    });
}

function setValuesDriver(json, type) {
    showFormDriver($(this));
    var driver = JSON.parse(json);
    var name = driver.name;
    var gender = driver.gender;
    var interno = driver.interno;
    var phone = driver.phone;
    var certification = driver.certification;
    var licence = driver.licence;
    var driverkey = driver.driver_key;
    
    switch(gender){
        case GENDER_MASCULINO:
            $("#gender-masculino").parent().click() ;
            break;
        case GENDER_FEMENINO:
            $("#gender-femenino").parent().click() ;
            break;
    }
    $("#name").val(name);
    
    $("#phoneNumber").val(phone);
    $("#interno").val(interno);
    $("#certification").val(certification);
    $("#licence").val(licence);
    if(type!=='createas'){
        $("#form-driver").append("<input name='driver-key' id='driver-key' type='hidden' value='" + driverkey + "' />");
        $("#trans").val(TRANS_DRIVER_UPDATE);
    }
}

function showFormDriver(item) {
    $(".content-table").removeClass('col-md-12');
    $(".content-table").addClass('col-md-7');
    $(".content-form").removeClass('hide');
    document.getElementById("btn-new").style.display = "none";
}

function hideFromDriver() {
    $(".content-table").removeClass('col-md-7');
    $(".content-table").addClass('col-md-12');
    $(".content-form").addClass('hide');
    document.getElementById("btn-new").style.display = "block";
    loadFormDriver();
}

function loadGridDriver() {
    $.ajax({
        url: LINK_DRIVER_URL,
        type: 'POST',
        data: {trans: TRANS_DRIVER_LIST},
        success: function (data) {
            if (isSuccess(data)) {
                $("#table-driver tbody").html(contentAnswer(data));
                $('#table-driver').DataTable();
            }
        }
    });
}

function loadFormDriver() {
    $("#content-form-driver").load(DRIVER_FORM_URL, function (){
        $("#trans").val(TRANS_DRIVER_NEW);
    });
}
function newDriver() {
    var fd = new FormData(document.getElementById("form-driver"));
    $.ajax({
        url: LINK_DRIVER_URL,
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        async: false,
        success: function (datos) {
            if (isSuccess(datos, true)) {
                loadGridDriver();
                loadFormDriver();
                hideFromDriver();
            } else {
                dhtmlx.message({text: contentAnswer(datos, false), type: 'error'});
            }
        }
    });
}
