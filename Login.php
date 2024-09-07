<!-- hiển thị giao diện đăng nhập -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/Base.css">
    <link rel="stylesheet" href="./css/Login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
    <title>Dang nhap</title>
</head>
<body>
    <div class = "background">
        <div class="web">          
            <div class="logContainer">
                <h1 class="logContainer__header">
                        Đăng nhập
                </h1>
                <div class="logContainer__mid">
                    <div id = "login" method = "POST">
                    <div class="logContainer__mid1">
                            <div class="logContainer__mid1-item">
                                <label for="username">Tên người dùng</label>
                            </div>
                            <div class="logContainer__mid1-label">
                                <input type="text" id = "accountname" placeholder="Nhập tên người dùng" name = "accountname"/>
                            </div>
                        </div>
                        <div class="logContainer__mid2">
                            <div class="logContainer__mid2-item">
                                <label for="username">Tên đăng nhập</label>
                            </div>
                            <div class="logContainer__mid2-label">
                                <input type="text" id = "username" placeholder="Nhập tên đăng nhập" name = "username"/>
                            </div>
                        </div>
                        <div class="logContainer__mid3">
                            <div id = "current password" class="logContainer__mid3-item">
                                <label for="password">Mật khẩu</label>
                            </div>
                            <div class="logContainer__mid3-label">
                                <input type="password" id = "password" placeholder="Nhập mật khẩu" name="password"/>
                            </div>
                        </div>
                        <div class="logContainer__space"></div>
                        <div id="logContainer" class="logContainer__footer">
                            <button id = "logbttn" class="logContainer__footer-button">
                                <span class="logContainer__footer-button-main">Đăng nhập</span>
                            </button>
                                <span class="sub" >Đăng ký tài khoản</span>
                        </div>
                        
                    </div>
                   
                </div>
                
            </div>
           
        </div>
    </div>
    <script type="text/javascript" src="javascript/jquery-3.2.1.min.js"></script>
    <script src="javascript/Login.js"></script>
</body>
</html>