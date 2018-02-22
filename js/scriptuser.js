$(document).ready(function () {
    loadGridUser();
    loadFormUser(null, 'consult');

    $(document).on("click", "#btn-save-user", function () {
        newUser();
    });
    
    $(document).on("click",".row-user", function (){
        markRow($(this))    ;
    });
    
    $(document).on("click",".edit-user", function (){
        consultUser($(this),'update');
    });
    
    $(document).on("click",".delete-user", function (){
        deleteUser($(this));
    });
    
    $(document).on("click",".btn-new-user", function (){
        showFormUser();
    });
    
    $(document).on("click", "#btn-cancel-user", function (){
        hideFormUser($(this));
    });
    
    $(document).on("click", ".createas-user", function (){
        createAs($(this));
    });
    
    $(document).on("click", ".access-user", function (){
        consultMenuAccess($(this));
    });
    
    $(document).on("click", ".apply-privilege", function (){
        applyPrivilege($(this));
    });
    
});

function loadFormAccess(){
    $(".content-form").load(USER_FORM_ACCESS_URL);
}

function consultMenuAccess(item){
    showFormUser();
    loadFormAccess();
    getMenuAccess(item);
}

function getMenuAccess(item) {
    var key=item.parent().parent().attr("data-key");
    $.ajax({
        url: LINK_USER_URL,
        type: 'POST',
        data: {trans: TRANS_USER_ACCESS_MENU, user_key:key},
        success: function (data) {
            if (isSuccess(data, false)) {
                $(".content-form-menu-acess").html(contentAnswer(data, false));
                $(".content-form-menu-acess").attr("data-key",""+key+"");
            }
        }
    });
}

function markRow(item){
    item.parent("tbody").find('tr').removeClass("info");
    var row=item.parent("tbody").parent("table").parent("div");
    item.addClass("info");
}

function deleteUser(item){
    dhtmlx.confirm({
        title: TITLE_CONFIRM_DELETE,
        ok: "Si", cancel: "No",
        text: "¿Estas  seguro de eliminar el usuario selecionado? ",
        callback: function (eliminar) {
            if (eliminar) {
                var key = item.parent().parent().attr("data-key");
                $.ajax({
                    url: LINK_USER_URL,
                    type: 'POST',
                    data: {trans: TRANS_USER_DELETE, userkey: key},
                    success: function (data) {
                        if (isSuccess(data, true)) {
                            loadGridUser();
                            loadFormUser(null);
                        }
                    }
                });
            }
        }
    });
}

function createAs(item) {
    consultUser(item, 'createas');
    setTimeout(function () {
        $("#trans").val(TRANS_USER_NEW);
        $("#password").removeAttr("disabled");
        $("#password-conf").removeAttr("disabled");
    }, 2000);
}

function consultUser(item, type){
    var key=item.parent().parent().attr("data-key");
    $(".btn-new-user").attr("disabled","disabled");
    $.ajax({
        url: LINK_USER_URL,
        type: 'POST',
        data: {trans: TRANS_USER_CONSULT, keyuser:key},
        success: function (data) {
            if (isSuccess(data, true)) {
                loadFormUser(contentAnswer(data, false), type);
            }
        }
    });
}

function setValuesUser(json, type){
    showFormUser();
    var user=JSON.parse(json);
    var user_key=user.user_key;
    var name=user.name;
    var username=user.user;
    var date_register=user.date_register;
    var last_modify=user.last_modify;
    var branch_key=user.branch_key;
    var branch=user.branch;
    var no_employe=user.no_employe;
    var usertype=user.type;
    
    $("#user-name").val(name);
    $("#user").val(username);
    $("#branch").val(branch_key);
    $("#employee-number").val(no_employe);
    $(".btn-new-user").attr("disabled");
    
    switch (usertype){
        case USER_TYPE_ADMIN:
            $("#type-administrador").parent().click();
            break;
        case USER_TYPE_COLAB:
            $("#type-colaborador").parent().click();
            break;
        case USER_TYPE_SYSTEM :
            $("#type-system").parent().click();
            break;
        default:
            break;
    } 
   if(type!=='createas'){
        $("#password").attr("disabled", "disabled");
        $("#password-conf").attr("disabled", "disabled");
        $("#trans").val(TRANS_USER_UPDATE);
        $("#form-user").append("<input name='user-key' type='hidden' value='"+user_key+"' />");
    }
}

function showFormUser(){
    $(".content-table").addClass("hide");
    $(".content-form").removeClass('hide');
}

function hideFormUser(){
    $(".content-table").removeClass("hide");
    $(".content-form").addClass('hide');
    loadFormUser(null);
}

function loadGridUser() {
    $.ajax({
        url: LINK_USER_URL,
        type: 'POST',
        data: {trans: TRANS_USER_LIST},
        success: function (data) {
            if (isSuccess(data)) {
                $("#table-user tbody").html(contentAnswer(data));
                $('#table-hotel').DataTable();
            }
        }
    });
}

function loadFormUser(json, type) {
    $("#content-form-user").load(USER_FORM_URL, function (){
        $("#trans").val(TRANS_USER_NEW);
        
        var initialPreview;
        var initialPreviewConf;

        if(json!==null){
            var user=JSON.parse(json);
            initialPreview=user.initialPreview;
            initialPreviewConf=user.initialPreviewConf;
            setValuesUser(json, type);
        }
        
        $("input[type=file]").fileinput({
            language: "es",
            uploadUrl: LINK_UPLOAD_FILES,
            maxFileCount: 1,
            showUpload: false,
            uploadAsync: false,
            showBrowse: false,
            showRemove: false,
            allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"],
            initialPreview: [initialPreview],
//            initialPreview: ['data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxAQDw8PDw8PDw8PEA0PDRAQDw8NDw4PFREWFhURFRUYHSggGBolHRMVITEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OGhAQGiseHyUtLS0tLSstLS0tLS0tLS0tLS0tLS0tKy0tLS0tLS0tLS0tLS0tLS0rLS0tLS0tLS0tLf/AABEIAL4BCgMBEQACEQEDEQH/xAAbAAEAAgMBAQAAAAAAAAAAAAAAAQMCBAUGB//EADcQAQABAwMABgcHAwUAAAAAAAABAgMRBCExBRJBUWFxBgcTIoGRoRQyUmKxweEjQsIkQ4KS0f/EABoBAQADAQEBAAAAAAAAAAAAAAABAgMEBQb/xAAtEQEBAAIBBAECAwkBAQAAAAAAAQIRAwQSITEFQVEyYZETIiNCUnGBobHhFf/aAAwDAQACEQMRAD8A+GgAAAAAmAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAACQAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAACQAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAACQAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAACQAAAAAAAAATgNIAAAAAAAAABAAAAAAAAAAAAAJAAAAAABdb08z4R4qXOR0cfT55/k2aNNRHO7O8mVdePS8ePvyuoimOIj5QzttdOOPHj6kX0VR3KWV0Y3H7M8UzzTE+cQjdibjhl7kYTobVX9uPGnZM5s4zy6Lhz+mv7NbUdEVRvRPWju4q/lrh1ON9+HFzfF54zeF3/wBc2qmYnExiY5idpdMu3mZY3G6vhAgAAAABAAAAAAAAAAAAAJAAAABNNMztAmY23UbNq1Eb8yyuW3bx8Ux83y2ImZ8GbqltA8JjBSaWU0qWtcZtnCK0m1tOVLppLWzZr23Z5R0YZXXlGp0dF2Pe2nsmOYWw5csPTPn6Xj5p+97+7g63R1WpxVvE/dq7Jd3HyTOeHz/UdLnwZay9fdrNHMAAAAgAAAAAAAAAAAAEgAAAmIztAmTd1GzRRiP1llbt24ccxiyiFWuMZV1IkWyy8aYJUnlZSq0i2hWtcPC+mGddE8s8oW2soqUsaY5NiidlK3l3FlyzFdM01xmmfp4pxyuN3Dk48eTHtz9PMa/STarmmd45pnvh6PHyTPHb5jquny4M+2+vo1mjmAAAQAAAAAAAAAAAACQAAAbWnt7dbv48mWeXnTs4OPU7qsiFW8m04QtowlGkxSjZIziEbWkq2mlS1tjGUzthC1upookpjdLrUxnEqZNcLLdVu2aWVdmE02KVWjX6Q0ftbcx/dG9E+Pc04uTsycvV9PObjs+s9PJ1RicTzHL03y9mrqoEAAIAAAAAAAAAAAABIAAM7VHWqiO9GV1Nr8eHflMW/Xjs47HPHp2SeImgq2PhEwKp6htPamKUbT2s4RV4upozvwzt02k35Y3OUxTP2UpqMWVKq09uhRXxDGx245+FsZ37v2VX3S3f3/RNiJyeXA9INP1LvWji5HW+Pa7umz7sNX6PC+S4phzbnq+XMdDzgAEAAAAAAAAAAAAAkAAG50dRmap7o/VjzXUkd3Q4byuX2jYqhnK6rCICRnNKu17iti2rtrMYy9mjuT2SIxhO0WaT1kaO7ZRieSk1fbPqxjMo3Vu2a3WMJUizrKaad1dHS1RMY24+Usspp18eUsa1duYnHivL4Y2Xan0ksT7Kir8MxEz57Nely/f05vlMN8Uy+1ead7wAAEAAAAAAAAAAAAAmAAAdboij3K576oj6fy5eovmPY+Nx3hlfzZVRvhWVrlPJTG5aiTytq3wpGt8s6IRVsU1TKJE5ZWsauVopfa+miMM7a2mM14ZU6bfY70zi8pvW9kY05MfCimlfbGYrKaEWrTFtaenG+23azrfCab1qIq32zH0Uu43mslHTFrOmvZ7IzHwmGnDdckc3WzfT57eIeq+WAAQAAAAAAAAAAAACQAAdjoef6dXhVP6Q4+o/FHtfG3+Fl/dbdoxKuN8Ns8dZMcJ2pryypVq8WwrWk8LOpmFdr9u4yos/VFyWx42dNnfwR3LTj1WzRGFG0ZTayb0XHam7pOrutMtscuLTY0+njq78z9IVuXlphhNeUXLWNo4TKi468MtPanOSoxnls9NWcaS/P5J+so4b/FivWTXT5/2fPXsPlAAEAAAAAAAAAAAAAkAAHX6BnPtKfKf2cvUz1XsfFZfiwdC/azu5scnpcuG1Hs5X7nP2VMRid0e0yarOqd0L27q6jeJjtVrSeYs0/crkvxtiKe9VqtoiMcKrRfao7dkWrSF3TZ3+RMlcsN+WdiIjET/BSanhZqNL3eEoxyRni2OjtLGfejxRnkYxV6YxFvQ3e+ubdFPnNUT+lMtOkndyxyfJZ9vT383zOXsvlwAEAAAAAAAAAAAAAkAAG70Re6t6nPFXuz8ePrhlz492FdnQ8nZzT8/D01VrZ5u30txU+zxEzK22fbJ5UzMVT8vBaeGNsyultFGImO3hW1pMdTSMYD0u01GZxttujJfDHdb0W2e3RpnTTGe9G06W0UfJFo26acxjtxszq1a9Fietxnfftab8MdeXVinnbux5Ml7W3ptJO04+9v8ABW1TbyXrP1UU/Z9LHMRN+74TPu0f5fOHo/H4eLn/AIeL8ry7uOH+XgnpPGAAQAAAAAAAAAAAACQAATEhvT2PReqi5airt4r8KoeVy8fZlp9b0fUfteKZfX6r7lrMSpttljuNCbExP/jTuct47td7P4z2+Su2mk1Was8I2XCtjSWKsx3K5ZRpx4V0qLHLK106Z0WYjnlFppnRaybQ3bVuMYj5qWjZtafs7O3xRtWurptBmOFO5S1t3qaLNuq7cnq0Wqaq65nsppjMpwxuWWow5OSYy2vg/TnSVWq1F3UVbTcqzEfhpjamn4REQ+h4uOceExj5fm5byZ3O/VoNGQACAAAAAAAAAAAAATAAAAOh0Pr/AGNe/wByravw8WPNxd+P5u3oeq/Ycnn1fb19EbdaJzE7xMcTDzL9n08ss3Kwm3Mzxt9RGt1l9m3z3mzs87bdq1tjmOyWdrWRuWbMQpa0nhdNvuhXYj2ZtFXUW9uP3Raq27NiZ7EVFrqaTTcbSpWdrtae3iIiEaYZV8r9aXpVF2r7Bp6om1bmPtNUcXLkTtbj8tM8+Pk9foun7Z35e/o8Trup7r2Y+vq+dS9F5oAACAAAAAAAAAAAAASAAAADs9B9M+yxbuZm1M7TzNH8Obn4O/zj7en0PX/sv3M/w/8AHrrduKqYmiYqpmM0zE5ifJ5ttl1X0ONmU3iut0q1eVsWbfgpVo2qbP68q2rbXxaV2bTFmdsYNq2tmzYmfii1W11NJo4U2pcnVs6f4QRhlm+fesD08poivR6GvNcxNN/UUztRHE0W57au+qOOzfj0+l6P+fP/ABHkdV1nvDD9Xyh6rykCAAAEAAAAAAAAAAAAAkAAAAAHS6I6Zu6afd96ifvW6vuz5d0seXgx5J59uvpus5OC+PM+z3XQ/TWl1OIiuLV38FyYpmfKeJeXy9Pycf03Hv8AB13DzfXV+1ego0Uxvjbscvc7dtmzo5mEWncsjSTnhG0bbFrQ8bSjatydDTaCe5GmWXJI1+mun9FoI/1N6mK8ZizR/UvVf8Y485xHi34unz5PUcfN1eOHuvlnpd6w9RrIqtWInS6acxMU1ZvXY/PVHET+GPjMvV4Ojw4/N815HN1mefieI8U7HGgAAAAEAAAAAAAAAAAAAkAAAAAAAHU6N9INXp9rOouU0/hmevR/1qzEMc+Djz/FHRx9Vy8f4cnodH6yNXR9+1p7u3M01UT9Jx9HNl8fx31bHXj8py/zSV07frVqjnQ258r1Uf4s/wD5uP8AV/pe/KZf0/7/APFd/wBbGp/2tLpqPGqbl394Wnx2H1tZ5fI531HA6U9OuktRmKtVXbon+yzEWI8s0+9MecunDpeLD1P1c2fU8mfu/o85VOd+Znec8y3c9QlCAAAAAAQAAAAAAAAAAAACQAATFM4meyMRO8dvh8AQAAAAAACQIAkEAAyrpxOMxPHE5jjvBiAAACAAAAAAAAAAAAASAAAAAAAAAAAAAAAAAAAACAAAAAAAAAAAAATAAAAAAAAAAAAAAAAAAAAAIAAAAAAAAAAAABIAAAAAAAAAAAAAAAAAAAAIAAAAAAB//9k=', 'data:image/jpeg;base64,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'],
            initialPreviewAsData: true,
            initialPreviewConfig: [initialPreviewConf],
 //           initialPreviewConfig: [{caption: "Hola munfo", height: "120px", downloadUrl: 'data:image/jpeg;base64,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', url: LINK_UPLOAD_FILES, key: 1}],
            deleteUrl: LINK_UPLOAD_FILES,
            uploadExtraData: {trans: TRANS_FILE_UP_PHOTO_USER},
            deleteExtraData: {trans: TRANS_FILE_DEL_PHOTO_USER}
//            slugCallback: function (filename) {
//                alert(filename);
//            }
        }).on('filepreupload', function () {
            alert("Imagen antes de subir ");
        }).on('fileuploaded', function (event, data) {
            alert("Imagen subida");
        });
        ;
        $(".btn-new-user").removeAttr("disabled");
        loadOptionsBranch("#branch .content-options");
    });
}

function newUser() {
    var fd = new FormData(document.getElementById("form-user"));
    $.ajax({
        url: LINK_USER_URL,
        type: "POST",
        data: fd,
        processData: false,
        contentType: false,
        async: false,
        success: function (datos) {
            if(isSuccess(datos, true)){
                uploadFile();
                loadGridUser();
                loadFormUser(null,'consult');
                hideFormUser();
            }
        }
    });
}

function uploadFile(){
    $(".kv-file-upload").click();
}

function applyPrivilege(item) {
    var userkey=$(".content-form-menu-acess").attr('data-key');
    var menu=item.children().attr("data-item");

    $.ajax({
        url: LINK_USER_URL,
        type: 'POST',
        data: {trans: TRANS_USER_APPLY_PRIV, userkey: userkey, item: menu},
        success: function (data) {
            if (isSuccess(data, true)) {
                if(contentAnswer(data, false)==PRIVILEGE_INSERT){
                    item.children().addClass('btn-info');
                }else{
                    item.children().removeClass('btn-info');
                }
            }
        }
    });
}
