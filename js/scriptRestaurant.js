$(document).ready(function () {
    loadGridRestaurant();
    loadFormRestaurant();

    $(document).on("click", "#btn-save-restaurant", function () {
        newRestaurant();
    });

    $(document).on("click", ".row-restaurant", function () {
        markRow($(this));
    });

    $(document).on("click", ".edit-restaurant", function () {
        consultRestaurant($(this), 'consult');
    });

    $(document).on("click", ".delete-restaurant", function () {
        deleteRestaurant($(this));
    });

    $(document).on("click", ".btn-new-restaurant", function () {
        showFormRestaurant($(this));
    });

    $(document).on("click", "#btn-cancel-restaurant", function () {
        hideFromRestaurant($(this));
    });
    
    $(document).on("click", ".createas-restaurant", function (){
        consultRestaurant($(this), 'createas');
    });
});

function markRow(item) {
    item.parent("tbody").find('tr').removeClass("info");
    var row = item.parent("tbody").parent("table").parent("div");
    item.addClass("info");
}
function deleteRestaurant(item) {
    dhtmlx.confirm({
        title: TITLE_CONFIRM_DELETE,
        ok: "Si", cancel: "No",
        text: "¿Estas  seguro de eliminar el restaurante selecionado? ",
        callback: function (eliminar) {
            if (eliminar) {
                var key = item.parent().parent().attr("data-key");
                $.ajax({
                    url: LINK_RESTAURANT_URL,
                    type: 'POST',
                    data: {trans: TRANS_RESTAURANT_DELETE, keyRestaurant: key},
                    success: function (data) {
                        if (isSuccess(data, true)) {
                            loadGridRestaurant();
                            loadFormRestaurant();
                        }
                    }
                });
            }
        }
    });
}

function consultRestaurant(item, type) {
    var key = item.parent().parent().attr("data-key");
    $.ajax({
        url: LINK_RESTAURANT_URL,
        type: 'POST',
        data: {trans: TRANS_RESTAURANT_CONSULT, keyRestaurant: key},
        success: function (data) {
            if (isSuccess(data, true)) {
                setValuesRestaurant(contentAnswer(data, false), type);
            }
        }
    });
}

function setValuesRestaurant(json, type) {
    showFormRestaurant($(this));
    var restaurant = JSON.parse(json);
    var restaurantname = restaurant.name;
    var description = restaurant.description;
    var restaurantkey = restaurant.restaurant_key;
    $("#description-restaurant").val(description);
    $("#name-restaurant").val(restaurantname);
    if(type!=="createas"){
        $("#form-restaurant").append("<input name='restaurant-key' type='hidden' value='" + restaurantkey + "' />");
        $("#trans").val(TRANS_RESTAURANT_UPDATE);
    }
}

function showFormRestaurant(item) {
    $(".content-table").removeClass('col-md-12');
    $(".content-table").addClass('col-md-7');
    $(".content-form").removeClass('hide');
}

function hideFromRestaurant() {
    $(".content-table").removeClass('col-md-7');
    $(".content-table").addClass('col-md-12');
    $(".content-form").addClass('hide');
}

function loadGridRestaurant() {
    $.ajax({
        url: LINK_RESTAURANT_URL,
        type: 'POST',
        data: {trans: TRANS_RESTAURANT_LIST},
        success: function (data) {
            if (isSuccess(data, false)) {
                $("#table-restaurant tbody").html(contentAnswer(data));
                $('#table-restaurant').DataTable();
            }
        }
    });
}

function loadFormRestaurant() {
    $("#content-form-restaurant").load(RESTAURANT_FORM_URL, function (){
        $("#trans").val(TRANS_RESTAURANT_NEW);
    });
}
function newRestaurant() {
    var fd = new FormData(document.getElementById("form-restaurant"));
    $.ajax({
        url: LINK_RESTAURANT_URL,
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        async: false,
        success: function (datos) {
            if (isSuccess(datos, true)) {
                loadGridRestaurant();
                loadFormRestaurant();
                hideFromRestaurant();
            } 
        }
    });
}
