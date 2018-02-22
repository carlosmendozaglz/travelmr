$(document).ready(function () {
    loadGridTravel();
    loadFormTravel();

    $(document).on("click", "#btn-save-travel", function () {
        newTravel();
    });

    $(document).on("click", ".row-travel", function () {
        markRow($(this));
    });

    $(document).on("click", ".edit-travel", function () {
        consultTravel($(this), 'consult');
    });

    $(document).on("click", ".delete-travel", function () {
        deleteTravel($(this));
    });

    $(document).on("click", ".btn-new-travel", function () {
        showFormTravel($(this));
    });

    $(document).on("click", "#btn-cancel-travel", function () {
        hideFromTravel($(this));
    });
    
    $(document).on("click", ".createas-travel", function (){
        consultTravel($(this), 'createas');
    });
});

function markRow(item) {
    item.parent("tbody").find('tr').removeClass("info");
    var row = item.parent("tbody").parent("table").parent("div");
    item.addClass("info");
}

function deleteTravel(item) {
    dhtmlx.confirm({
        title: TITLE_CONFIRM_DELETE,
        ok: "Si", cancel: "No",
        text: "¿Estas  seguro de eliminar el viaje selecionado? ",
        callback: function (eliminar) {
            if (eliminar) {
                var key = item.parent().parent().attr("data-key");
                $.ajax({
                    url: LINK_TRAVEL_URL,
                    type: 'POST',
                    data: {trans: TRANS_TRAVEL_DELETE, keytravel: key},
                    success: function (data) {
                        if (isSuccess(data, true)) {
                            loadGridTravel();
                            loadFormTravel();
                        }
                    }
                });
            }
        }
    });
}

function consultTravel(item, type) {
    var key = item.parent().parent().attr("data-key");
    $.ajax({
        url: LINK_TRAVEL_URL,
        type: 'POST',
        data: {trans: TRANS_TRAVEL_CONSULT, keytravel: key},
        success: function (data) {
            if (isSuccess(data, true)) {
                setValuesTravel(contentAnswer(data, false), type);
            }
        }
    });
}

function setValuesTravel(json, type) {
    showFormTravel($(this));
    var travel = JSON.parse(json);
    var travel_key = travel.travel_key;
    var location = travel.location;
    var description = travel.description;
    var date_departure = travel.date_departure;
    var date_return = travel.date_return;
    var time_departure = travel.time_departure;
    var time_return = travel.time_return;
    var date_register = travel.date_register;
    var last_modify = travel.last_modify;
    var adult_price = travel.adult_price;
    var minor_price = travel.minor_price;
    var infant_price = travel.infant_price;
    var days = travel.days;
    var nigth = travel.nigth;
    var restaurant_key = travel.restaurant_key;
    var hotel_key = travel.hotel_key;
    var airline_key = travel.airline_key;
    var coments = travel.coments;
    var last_day_pay = travel.last_day_pay;
    var percent = travel.percent;
    var notes = travel.notes;
    var miles = travel.miles;
    var key = travel.key_;
    var airline_name=travel.airline_name;
    var hotel_name=travel.hotel_name;
    var restaurant_name=travel.restaurant_name;
    
    $('#key-travel').val(key);
    $('#location').val(location);
    $('#description').val(description);
    $('#notes').val(notes);
    $('#date-departure').val(date_departure);
    $('#time-departure').val(time_departure);
    $('#date-return').val(date_return);
    $('#time-return').val(time_return);
    $('#adult-price').val(adult_price);
    $('#minor-price').val(minor_price);
    $('#infant-price').val(infant_price);
    $('#days').val(days);
    $('#nigth').val(nigth);
    
    $('#restaurant-key').val(restaurant_key);
    $('#restaurant-key').parent().find('.select2').find(".selection").find(".select2-selection").children().eq(0).text(restaurant_name);
    $('#hotel-key').val(hotel_key);
    $('#hotel-key').parent().find('.select2').find(".selection").find(".select2-selection").children().eq(0).text(hotel_name);
    $('#airline-key').val(airline_key);
    $('#airline-key').parent().find('.select2').find(".selection").find(".select2-selection").children().eq(0).text(airline_name);

    $('#last-day-pay').val(last_day_pay);
    $('#percent').val(percent);
    $('#miles').val(miles);
    

    if(type!=="createas"){
        $("#form-travel").append("<input name='travel-key' type='hidden' value='" + travel_key + "' />");
        $("#trans").val(TRANS_TRAVEL_UPDATE);
    }
}

function showFormTravel(item) {
    $(".content-table").removeClass('col-md-12');
    $(".content-table").addClass('hide');
    $(".content-form").removeClass('hide');
}

function hideFromTravel() {
    $(".content-table").removeClass('hide');
    $(".content-table").addClass('col-md-12');
    $(".content-form").addClass('hide');
}

function loadGridTravel() {
    $.ajax({
        url: LINK_TRAVEL_URL,
        type: 'POST',
        data: {trans: TRANS_TRAVEL_LIST},
        success: function (data) {
            if (isSuccess(data, false)) {
                $('#table-travel tbody').html(contentAnswer(data));
                $('#table-travel').DataTable();
            }
        }
    });
}

function loadFormTravel() {
    $("#content-form-travel").load(TRAVEL_FORM_URL, function (){
        $("#trans").val(TRANS_TRAVEL_NEW);
        loadOptionsAirline("#airline-key .content-options");
        loadOptionsRestaurant("#restaurant-key .content-options");
        loadOptionsHotel("#hotel-key .content-options");
        
        $("input[type=file]").fileinput({
            language: "es",
            uploadUrl: LINK_UPLOAD_FILES,
            maxFileCount: 4,
            allowedFileExtensions: ["jpg", "png", "gif","JPG", "PNG", "GIF"],
            uploadExtraData: {trans: TRANS_FILE_UP_PHOTO_TRAVEL},
//            slugCallback: function (filename) {
//                alert(filename);
//            }
        });
    });
}
function newTravel() {
    var fd = new FormData(document.getElementById("form-travel"));
    $.ajax({
        url: LINK_TRAVEL_URL,
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        async: false,
        success: function (datos) {
            if (isSuccess(datos, true)) {
                uploadFile();
                loadGridTravel();
            } 
        }
    });
}

function uploadFile(){
    $(".kv-file-upload").click();
}
