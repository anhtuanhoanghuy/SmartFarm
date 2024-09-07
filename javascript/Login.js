var mikExp = /[\$\\\\\#\^\&\*\(\)\[\]\+\_\{\}\`\~\=\\!\|\/\?\.\,\:\;\"\'\@]/;  //Kiểm tra hợp thức
$(document).ready(function(){
    $("#password").keypress(function(event) {
        if (event.keyCode == "13") {
            $("#logbttn").click();
        }
    })

    $("#logbttn").click(function(event) { //xử lý đăng nhập
        if($(".logContainer__footer").attr('id')=="logContainer") {
            if ($("#username").val() == "" && $("#password").val() == "") {
                
                $(".logContainer__space").html("Vui lòng nhập tên đăng nhập và mật khẩu.");
            } else if ($("#username").val() == "" && $("#password").val() != "") {
                
                $(".logContainer__space").html("Vui lòng nhập tên đăng nhập.");
            } else if ($("#username").val() != "" && $("#password").val() == "") {
                
                $(".logContainer__space").html("Vui lòng nhập mật khẩu.");
            } else {
                if ($("#username").val().search(mikExp) >= 0 || $("#password").val().search(mikExp) >= 0) {
                    
                    $(".logContainer__space").html("Vui lòng nhập đúng định dạng.");
                } else {
                    $.post("backend/Login.php",
                        {
                        username: $("#username").val(),
                        password: $("#password").val()
                        },
                        function(data){
                            data = JSON.parse(data);
                        if (data == "account_failed"){
                            $(".logContainer__space").html("Tên đăng nhập hoặc mật khẩu không đúng.");                   
                        } else if (data == "account_success") {
                            location.reload();
                        }
                        });
                }
            } 
        } else if($(".logContainer__footer").attr('id')=="registerContainer") {
            if ($("#username").val() == "" || $("#password").val() == "" || $("#accountname").val() == "") {
                
                $(".logContainer__space").html("Vui lòng nhập đầy đủ thông tin.");
            } else {
                if ($("#username").val().search(mikExp) >= 0 || $("#password").val().search(mikExp) >= 0 || $("#accountname").val().search(mikExp) >= 0) {
                    
                    $(".logContainer__space").html("Vui lòng nhập đúng định dạng.");
                } else if ($("#password").val().length < 8) {
                    $(".logContainer__space").html("Mật khẩu phải có tối thiểu 8 kí tự.");
                } else {
                $.post("backend/Register.php",
                    {
                    accountname: $("#accountname").val(),
                    username: $("#username").val(),
                    password: $("#password").val()
                    },
                    function(data){
                        data = JSON.parse(data);
                        if (data == "register_failed"){
                            $(".logContainer__space").html("Tên đăng nhập đã được sử dụng.");                   
                        } else if (data == "register_success") {
                            alert("Đăng ký thành công!");
                        }
                    });
            }
        } 
    }
    })

    $(".sub").click(function(){
        if($(".logContainer__footer").attr('id')=="logContainer") {
            $(".logContainer__mid1").css('display','block');
            $(".logContainer__space").html("");
            $("#accountname").val("");
            $("#username").val("");
            $("#password").val("");
            $(".logContainer").css({'transform':'rotateY(180deg)','height':'600px','transition': 'transform linear 0.5s, height linear 0.2s'});
            $(".logContainer__header").css({'transform':'rotateY(180deg)','transition': 'transform linear 0.5s'});
            $(".logContainer__mid").css({'transform':'rotateY(180deg)','transition': 'transform linear 0.5s'});
            $(".logContainer__header").html('Đăng ký tài khoản');
            $(".logContainer__footer-button-main").html("Đăng ký");
            $(".sub").html("Đăng nhập");
            $(".logContainer__footer").attr('id',"registerContainer");
        } else if($(".logContainer__footer").attr('id')=="registerContainer") {
            $(".logContainer__mid1").css('display','none');
            $(".logContainer__space").html("");
            $("#accountname").val("");
            $("#username").val("");
            $("#password").val("");
            $(".logContainer").css({'transform':'rotateY(0deg)','height':'480px','transition': 'transform linear 0.5s, height linear 0.2s'});
            $(".logContainer__header").css({'transform':'rotateY(0deg)','transition': 'transform linear 0.5s'});
            $(".logContainer__mid").css({'transform':'rotateY(0deg)','transition': 'transform linear 0.5s'});
            $(".logContainer__header").html('Đăng nhập');
            $(".logContainer__footer-button-main").html("Đăng nhập");
            $(".sub").html("Đăng ký tài khoản");
            $(".logContainer__footer").attr('id',"logContainer");
        }
    })
})