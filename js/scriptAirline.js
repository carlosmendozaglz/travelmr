$(document).ready(function () {
    loadGridAirline();
    loadFormAirline(TRANS_AIRLINE_NEW);

    $(document).on("click", "#btn-save-airline", function () {
        newAirline();
    });
    
    $(document).on("click",".row-airline", function (){
        markRow($(this));
    });
    
    $(document).on("click",".edit-airline", function (){
        consultAirline($(this), 'consult');
    });
    
    $(document).on("click",".delete-airline", function (){
        deleteAirline($(this));
    });
    
    $(document).on("click",".btn-new-airline", function (){
        showFormAirline();
    });
    
    $(document).on("click", "#btn-cancel-airline", function (){
        hideFromAirline($(this));
    });
    $(document).on("click", ".createas-airline", function (){
        consultAirline($(this), 'createas');
    })
});

function markRow(item){
    item.parent("tbody").find('tr').removeClass("info");
    var row=item.parent("tbody").parent("table").parent("div");
    item.addClass("info");
}
function deleteAirline(item){
    dhtmlx.confirm({
        title: TRANS_AIRLINE_DELETE,
        ok: "Si", cancel: "No",
        text: "¿Estas  seguro de eliminar la aereolínea selecionado? ",
        callback: function (eliminar) {
            if (eliminar) {
                var key = item.parent().parent().attr("data-key");
                $.ajax({
                    url: LINK_AIRLINE_URL,
                    type: 'POST',
                    data: {trans: TRANS_AIRLINE_DELETE, keyAirline: key},
                    success: function (data) {
                        if (isSuccess(data, true)) {
                            loadGridAirline();
                            loadFormAirline(TRANS_AIRLINE_NEW);
                        }
                    }
                });
            }
        }
    });
}

function consultAirline(item, type){
    var key=item.parent().parent().attr("data-key");
    $.ajax({
        url: LINK_AIRLINE_URL,
        type: 'POST',
        data: {trans: TRANS_AIRLINE_CONSULT, keyAirline:key},
        success: function (data) {
            if (isSuccess(data, true)) {
                showFormAirline();
                setValuesAirline(contentAnswer(data, false), type);
            }
        }
    });
}

function setValuesAirline(json, type) {
    var airline = JSON.parse(json);
    var airlinename = airline.airline_name;
    var description = airline.airline_description;
    var airlinekey = airline.airline_key;
    $("#description-airline").val(description);
    $("#name-airline").val(airlinename);
    if(type!=='createas'){
        $("#trans").val(TRANS_AIRLINE_UPDATE);
        $("#form-airline").append("<input name='airline-key' type='hidden' value='" + airlinekey + "' />");
    }else{
        $("#trans").val(TRANS_AIRLINE_NEW);
    }
}

function showFormAirline(){
    $(".content-table").removeClass('col-md-12');
    $(".content-table").addClass('col-md-7');
    $(".content-form").removeClass('hide');
}

function hideFromAirline(){
    $(".content-table").removeClass('col-md-7');
    $(".content-table").addClass('col-md-12');
    $(".content-form").addClass('hide');
    $("#form-airline")[0].reset();
}

function loadGridAirline() {
    $.ajax({
        url: LINK_AIRLINE_URL,
        type: 'POST',
        data: {trans: TRANS_AIRLINE_LIST},
        success: function (data) {
            if (isSuccess(data, false)) {
                $("#table-airline tbody").html(contentAnswer(data));
                $('#table-airline').DataTable();
            }
        }
    });
}

function loadFormAirline(trans) {
    $("#content-form-airline").load(AIRLINE_FORM_URL, function (){
        $("#trans").val(trans);
    });
}

function newAirline() {  
    var fd = new FormData(document.getElementById("form-airline"));
    $.ajax({
        url: LINK_AIRLINE_URL,
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        async: false,
        success: function (datos) {
            if(isSuccess(datos, true)){
                loadGridAirline();
                loadFormAirline();
                hideFromAirline();
            }
        }
    });
}
