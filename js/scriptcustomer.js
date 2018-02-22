$(document).ready(function () {
    loadGridCustomer();
    loadFormCustomer();

    $(document).on("click", "#btn-save-customer", function () {
        newCustomer();
    });
    
    $(document).on("click",".row-customer", function (){
        markRow($(this))    ;
    });
    
    $(document).on("click",".edit-customer", function (){
        consultCustomer($(this));
    });
    
    $(document).on("click",".delete-customer", function (){
        deleteCustomer($(this));
    });
    
    $(document).on("click",".btn-new-customer", function (){
        showFormCustomer();
    });
    
    $(document).on("click", "#btn-cancel-customer", function (){
        hideFormCustomer($(this));
    });
    
    $(document).on("click", ".createas-customer", function (){
        createAs($(this));
    });
    
});


function markRow(item){
    item.parent("tbody").find('tr').removeClass("info");
    var row=item.parent("tbody").parent("table").parent("div");
    item.addClass("info");
}

function deleteCustomer(item){
    dhtmlx.confirm({
        title: TITLE_CONFIRM_DELETE,
        ok: "Si", cancel: "No",
        text: "¿Estas  seguro de eliminar el cliente selecionado? ",
        callback: function (eliminar) {
            if (eliminar) {
                var key = item.parent().parent().attr("data-key");
                $.ajax({
                    url: LINK_CUSTOMER_URL,
                    type: 'POST',
                    data: {trans: TRANS_CUSTOMER_DELETE, customerkey: key},
                    success: function (data) {
                        if (isSuccess(data, true)) {
                            loadGridCustomer();
                            loadFormCustomer() ;
                        }
                    }
                });
            }
        }
    });
}

function createAs(item) {
    consultCustomer(item);
    setTimeout(function () {
        $("#trans").val(TRANS_CUSTOMER_NEW);
    }, 2000);
}

function consultCustomer(item){
    var key=item.parent().parent().attr("data-key");

    $.ajax({
        url: LINK_CUSTOMER_URL,
        type: 'POST',
        data: {trans: TRANS_CUSTOMER_CONSULT, customerkey:key},
        success: function (data) {
            if (isSuccess(data, true)) {
                setValuesCustomer(contentAnswer(data, false));
            }
        }
    });
}

function setValuesCustomer(json){
    showFormCustomer();
    var customer=JSON.parse(json);
    var customer_key=customer.customer_key;
    var name=customer.name;
    var gender=customer.gender;
    var birthdate=customer.birthdate;
    var address=customer.address;
    var phone_number=customer.phone_number;
    var miles=customer.miles;
    
    switch(gender){
        case GENDER_MASCULINO:
            $("#gender-masculino").parent().click() ;
            break;
        case GENDER_FEMENINO:
            $("#gender-femenino").parent().click() ;
            break;
    }
    $("#customer-name").val(name);

    $("#birthdate").val(birthdate);
    $("#customer-address").val(address);
    $("#customer-phone").val(phone_number);
    $("#customer-miles").val(miles);

    $("#form-customer").append("<input name='customer-key' type='hidden' value='"+customer_key+"' />");
    $("#trans").val(TRANS_CUSTOMER_UPDATE);
}

function showFormCustomer(){
    $(".content-table").addClass("hide");
    $(".content-form").removeClass('hide');
}

function hideFormCustomer(){
    $(".content-table").removeClass("hide");
    $(".content-form").addClass('hide');
    loadFormCustomer();
}

function loadGridCustomer() {
    $.ajax({
        url: LINK_CUSTOMER_URL,
        type: 'POST',
        data: {trans: TRANS_CUSTOMER_LIST},
        success: function (data) {            
            if (isSuccess(data, false)) {
                $("#table-customer tbody").html(contentAnswer(data));
                $('#table-customer').DataTable();
            }
        }
    });
}

function loadFormCustomer() {
    $("#content-form-customer").load(CUSTOMER_FORM_URL, function (){
        $("#trans").val(TRANS_CUSTOMER_NEW);
    });
}

function newCustomer() {
    var fd = new FormData(document.getElementById("form-customer"));
    $.ajax({
        url: LINK_CUSTOMER_URL,
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        async: false,
        success: function (datos) {
            if(isSuccess(datos, true)){
                hideFormCustomer();
                loadGridCustomer();
                loadFormCustomer();
            }
        }
    });
}

function uploadFile(){
    $(".kv-file-upload").click();
}
