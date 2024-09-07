var mikExp = /[\$\\\\\#\^\&\*\(\)\[\]\+\_\{\}\`\~\=\\!\|\/\?\.\,\:\;\"\'\@]/;  //Kiểm tra hợp thức
$("#accountname").val(getCookie('accountname'));
$(".Account-save").click(function(event) { //xử lý đăng nhập
var check = true;
    if ($("#newpassword").val() != "") {
        if ($("#renewpassword").val() == "") {
            alert("Nhập lại mật khẩu mới");
            check = false;
        } else {
            if ($("#newpassword").val().length < 8) {
                alert("Mật khẩu phải có tối thiểu 8 kí tự");
                check = false;
            }
            else if($("#newpassword").val() != $("#renewpassword").val()) {
                alert("Nhập lại mật khẩu mới không trùng khớp");
                check = false;
            }
        }
    } 

    if ($("#accountname").val() == "") {
        alert("Nhập tên chủ tài khoản");
        check = false;
    }
    if ($("#renewpassword").val() != "") {
        if ($("#newpassword").val() == "") {
            alert("Nhập mật khẩu mới");
            check = false;
        }
    }
    if ($("#accountname").val() != "" || $("#newpassword").val() != "" || $("#renewpassword").val() != "") {
        if ($("#oldpassword").val() == "") {
          alert("Nhập lại mật khẩu");
          check = false;
        } else  {
            var status = true
            if ($("#accountname").val() != "" && $("#accountname").val().search(mikExp) >= 0){
                status = false;}
            if ($("#newpassword").val() != "" && $("#newpassword").val().search(mikExp) >= 0){
                status = false;}
            if (status == true && check == true){
                $.post("backend/ChangeAccount.php",{
                token:getCookie("token"),
                accountname:$("#accountname").val(),
                oldpassword:$("#oldpassword").val(),
                newpassword:$("#newpassword").val()
               },function(data){  //AJAX không tải lại
                data =  JSON.parse(data);
                // alert("Cập nhật thông tin thành công");     //dữ liệu JSON
                console.log(data);
                if (data == 0) {
                    alert("Mật khẩu không đúng.");
                } else if (data == 1) {
                    alert("Thay đổi thông tin thành công.");
                }
                })
            } else if (status == false) {
                alert("Vui lòng nhập đúng định dạng.");
            }
        }
    } 
  })
  function getCookie(name) {
    // Split cookie string and get all individual name=value pairs in an array
    let cookieArr = document.cookie.split(";");
    
    // Loop through the array elements
    for(let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        
        /* Removing whitespace at the beginning of the cookie name
        and compare it with the given string */
        if(name == cookiePair[0].trim()) {
            // Decode the cookie value and return
            return decodeURIComponent(cookiePair[1]);
        }
    }
    
    // Return null if not found
    return null;
  }
    //Xử lý email
    function validateEmail(inputText){
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(inputText.match(mailformat)){
        // console.log("email đúng");
    return true;}
    else {
        // console.log("email không đúng định dạng");
    return false;}
    }
    
    //Xử lý sdt
    
        function validatePhoneNumber(mobile) {
            var vnf_regex = /((01|02|03|04|05|06|07|08|09)+([0-9]{8})\b)/g;
            if(mobile !==''){
                if (vnf_regex.test(mobile) == false) 
                {
                    // console.log('Số điện thoại không đúng định dạng!');
                    return false
                }else{
                    // console.log('Số điện thoại của bạn hợp lệ!');
                    return true;
                }
            }else{
                // console.log('Bạn chưa điền số điện thoại!');
                return false
            }
        }
    
    // xử lý họ tên
    function validateName (str) {
        if (str === null || str === undefined) return str;
        str = str.toLowerCase();
        str = str.replaceAll(" ", "");
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");
        var re = /^[a-zA-Z!@#\$%\^\&*\)\(+=._-]{2,}$/g; // regex here
        return re.test(str);
    }
    
    
    
    
    