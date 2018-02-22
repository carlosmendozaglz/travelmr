$(document).ready(function (){
    $(document).on("submit", "#form-login", function (){
        login();
    });
});

function login(){
    var user=$("#user").val();
    var password=$("#password").val();
    
    if(user===""){
        $("#user").parent().find(".error-message").text("El usuario es requerido");
        $("#user").focus();
    }else{
        $("#user").parent().find(".error-message").text("");
        if(password===""){
            $("#password").parent().find(".error-message").text("Escribe la contraseña");
            $("#password").focus();
        }else{
            $("#password").parent().find(".error-message").text("");
            $("#trans").val(TRANS_LOGIN);
            var fd = new FormData(document.getElementById("form-login"));
            $.ajax({
                url: LINK_URL,
                type: "POST",
                data: fd,
                processData: false,
                contentType: false,
                async: true,
                success: function (datos) {
                    if(isSuccess(datos, true)){
                        location.href="home";
                    }
                }
            });
        }
    }
}

