$(document).ready(function () {
    loadGridHotel();
    loadFormHotel();

    $(document).on("click", "#btn-save-hotel", function () {
        newHotel();
    });

    $(document).on("click", ".row-hotel", function () {
        markRow($(this));
    });

    $(document).on("click", ".edit-hotel", function () {
        consultHotel($(this),'consult');
    });

    $(document).on("click", ".delete-hotel", function () {
        deleteHotel($(this));
    });

    $(document).on("click", ".btn-new-hotel", function () {
        showFormHotel();
    });
    
    $(document).on("click", ".createas-hotel", function (){
        consultHotel($(this),'createas');
    });
    $(document).on("click", "#btn-cancel-hotel", function (){
        hideFormHotel();
    });
});

function markRow(item) {
    item.parent("tbody").find('tr').removeClass("info");
    var row = item.parent("tbody").parent("table").parent("div");
    item.addClass("info");
}
function deleteHotel(item) {
    dhtmlx.confirm({
        title: TITLE_CONFIRM_DELETE,
        ok: "Si", cancel: "No",
        text: "¿Estas  seguro de eliminar el hotel selecionado? ",
        callback: function (eliminar) {
            if (eliminar) {
                var key = item.parent().parent().attr("data-key");
                $.ajax({
                    url: LINK_HOTEL_URL,
                    type: 'POST',
                    data: {trans: TRANS_HOTEL_DELETE, keyhotel: key},
                    success: function (data) {
                        if (isSuccess(data, true)) {
                            loadGridHotel();
                            loadFormHotel();
                        }
                    }
                });
            }
        }
    });
}

function consultHotel(item, type) {
    var key = item.parent().parent().attr("data-key");
    $.ajax({
        url: LINK_HOTEL_URL,
        type: 'POST',
        data: {trans: TRANS_HOTEL_CONSULT, keyhotel: key},
        success: function (data) {
            if (isSuccess(data, true)) {
                $(".btn-new-hotel").attr("disabled","disabled");
                showFormHotel();
                setValuesHotel(contentAnswer(data, false), type);
            }
        }
    });
}

function setValuesHotel(json, type) {
    var hotel = JSON.parse(json);
    var hotelname = hotel.name;
    var description = hotel.description;
    var hotelkey = hotel.hotel_key;
    $("#description-hotel").val(description);
    $("#name-hotel").val(hotelname);
    if(type!=="createas"){
        $("#form-hotel").append("<input name='hotel-key' type='hidden' value='" + hotelkey + "' />");
        $("#trans").val(TRANS_HOTEL_UPDATE);
    }
}

function showFormHotel() {
    $(".content-table").removeClass('col-md-12');
    $(".content-table").addClass('col-md-7');
    $(".content-form").removeClass('hide');
}

function hideFormHotel() {
    loadFormHotel();
    $(".content-table").removeClass('col-md-7');
    $(".content-table").addClass('col-md-12');
    $(".content-form").addClass('hide');
}

function loadGridHotel() {
    $.ajax({
        url: LINK_HOTEL_URL,
        type: 'POST',
        data: {trans: TRANS_HOTEL_LIST},
        success: function (data) {
            if (isSuccess(data, true)) {
                $("#table-hotel tbody").html(contentAnswer(data));
                $('#table-hotel').DataTable();
            }
        }
    });
}

function loadFormHotel() {
    $("#content-form-hotel").load(HOTEL_FORM_URL, function (){
        $(".btn-new-hotel").removeAttr("disabled");
    });
}

function newHotel() {
    $("#trans").val(TRANS_HOTEL_NEW);
    var fd = new FormData(document.getElementById("form-hotel"));
    $.ajax({
        url: LINK_HOTEL_URL,
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        async: false,
        success: function (datos) {
            if (isSuccess(datos, true)) {
                loadGridHotel();
                loadFormHotel();
                hideFormHotel() ;
            } 
        }
    });
}
