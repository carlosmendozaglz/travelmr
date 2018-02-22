$(document).ready(function () {
    loadGridBranch();
    loadFormBranch();

    $(document).on("click", "#btn-save-branch", function () {
        newBranch();
    });
    
    $(document).on("click",".row-branch", function (){
        markRow($(this));
    });
    
    $(document).on("click",".edit-branch", function (){
        consultBranch($(this),'consult');
    });
    
    $(document).on("click",".delete-branch", function (){
        deleteBrach($(this));
    });
    
    $(document).on("click",".btn-new-branch", function (){
        showFormBranch($(this));
    });
    
    $(document).on("click", "#btn-cancel-branch", function (){
        hideFromBranch($(this));
    });
    
    $(document).on("click", ".createas-branch", function (){
        createAs($(this));
    });
});

function createAs(item){
    consultBranch(item,'createas');
}
function markRow(item){
    item.parent("tbody").find('tr').removeClass("info");
    var row=item.parent("tbody").parent("table").parent("div");
    item.addClass("info");
}

function deleteBrach(item){
    dhtmlx.confirm({
        title: TITLE_CONFIRM_DELETE,
        ok: "Si", cancel: "No",
        text: "¿Estas  seguro de eliminar la sucursal selecionada? ",
        callback: function (eliminar) {
            if (eliminar) {
                var key = item.parent().parent().attr("data-key");
                $.ajax({
                    url: LINK_BRANCH_URL,
                    type: 'POST',
                    data: {trans: TRANS_BRANCH_DELETE, keybranch: key},
                    success: function (data) {
                        if (isSuccess(data, true)) {
                            loadGridBranch();
                            loadFormBranch();
                        }
                    }
                });
            }
        }
    });
}

function consultBranch(item, type){
    var key=item.parent().parent().attr("data-key");
    $.ajax({
        url: LINK_BRANCH_URL,
        type: 'POST',
        data: {trans: TRANS_BRANCH_CONSULT, keybranch:key},
        success: function (data) {
            if (isSuccess(data, true)) {
                $(".btn-new-branch").attr("disabled","disabled");
                setValuesBranch(contentAnswer(data, false), type);
            }
        }
    });
}

function setValuesBranch(json, type){
    showFormBranch($(this));
    var branch=JSON.parse(json);
    var address=branch.address;
    var description=branch.description;
    var branchkey=branch.branch_key;
    $("#description-branch").val(description);
    $("#address-branch").val(address);
    if(type!=="createas"){
        $("#form-branch").append("<input name='branch-key' type='hidden' value='"+branchkey+"' />");
        $("#trans").val(TRANS_BRANCH_UPDATE);
    }
}

function showFormBranch(item){
    $("#trans").val(TRANS_BRANCH_NEW);
    $(".content-table").removeClass('col-md-12');
    $(".content-table").addClass('col-md-7');
    $(".content-form").removeClass('hide');
}

function hideFromBranch(){
    loadFormBranch();
    $(".content-table").removeClass('col-md-7');
    $(".content-table").addClass('col-md-12');
    $(".content-form").addClass('hide');
}

function loadGridBranch() {
    $.ajax({
        url: LINK_BRANCH_URL,
        type: 'POST',
        data: {trans: TRANS_BRANCH_LIST},
        success: function (data) {
            if (isSuccess(data)) {
                $("#table-branch tbody").html(contentAnswer(data));
                $("#table-branch").DataTable();
            }
        }
    });
}

function loadFormBranch() {
    $("#content-form-branch").load(BRANCH_FORM_URL, function (){
        $("#trans").val(TRANS_BRANCH_NEW);
        $(".btn-new-branch").removeAttr("disabled");
    });
}

function newBranch() {
    var fd = new FormData(document.getElementById("form-branch"));
    $.ajax({
        url: LINK_BRANCH_URL,
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        async: false,
        success: function (datos) {
            if(isSuccess(datos, true)){
                loadGridBranch();
                loadFormBranch();
                hideFromBranch();
            }
        }
    });
}
