<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=getMap&key=ApmjZMScf3QndIcQhYNlkzZrFokZjkqUjGE6y-3Y00-sJdpjwUvoVDlaEFQPjctJ' async defer></script>
    <link rel="shortcut icon" type="image/ico" href="./resources/power-button.png">
    <link rel="stylesheet" href="./css/main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.2/mqttws31.min.js" type="text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>SmartFarm</title>
</head>
<body>
    <header class="header_logo">
        <div class="header_logo-wrapper">
            <img alt ="png" class="header_logo-img" src="./resources/slogan.png">
        </div>
        <div class="welcome">
           <span class="welcome_name"></span>
            <span class="user_options">▼</span>
            <div class="dropdown_container">
                <div class="dropdown-content">
                    <span id="logout">Đăng xuất</span>
                    <img src="logout.svg" alt="">
                </div>
            </div>
        </div>
        
          
    </header>
    <h1 id ="title">Bảng giám sát, điều khiển vi khí hậu trong nhà màng</h1>
    <div class="information">
        <div id = "weather">
            <div id = "name"></div>
            <div id ="info">
                <img id="icon" src="" alt="Weather icon">
                <div id = "details">
                    <p id = "temp"></p>
                    <p id = "humid"></p>
                    <p id = "wind"></p>
                    <p id = "description"></p>
                </div>
            </div>
        </div>
        <div id="currentTime"></div>
    </div>


    <!-- navbar -->
    <div class="nav-menu" onclick="handleMenuClick()">&#9776;</div>

    <div class="radio-inputs">
        <label class="radio" onclick="closeMenu()">
          <input type="radio" name="radio" id="giamsat" checked="" />
          <span class="name">Giám sát</span>
        </label>
        <label class="radio" onclick="closeMenu()">
          <input type="radio" name="radio" id="dieukhien"/>
          <span class="name">Điều khiển</span>
        </label>
        <label class="radio" onclick="closeMenu()">
            <input type="radio" name="radio" id="cauhinh" />
            <span class="name">Cấu hình tự động</span>
        </label>
        <label class="radio" onclick="closeMenu()">
            <input type="radio" name="radio" id="caidat" />
            <span class="name">Cài đặt</span>
        </label>
    </div>
    <div class="data-container10">
        <div class ="control">
            <input id="checkbox" type="checkbox">
            <label class="switch" for="checkbox">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="slider">
                <path
                d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"
                ></path>
            </svg>
            </label>
            </input>
        </div>
        <div class="dropdown">
            <div class="select">
                <span class="selected">--- Hãy chọn thiết bị ---</span>
                <span class="serialText"></span>
                <div class="caret"></div>
            </div>
            <ul class="menu">
                <!-- <li data-value="device1">
                    <span>Thiết bị 1</span>
                    <span>e-Id: MsZ8hS5</span>
                </li> -->
            </ul>
        </div>
    </div>
    <div class="tab1">
        <div id="container">
            <div class="data-container">
                <div class="data-container1">
                    <div>
                        <img src="./resources/RSSI.png" alt=""  class="icon">
                        <span class="label">RSSI:</span>
                    </div>
                    <input autocomplete="off" name="data-value1" id="data-value1" class="data-value" disabled>
                    
                </div>
                <div class="data-container2">
                    <div>
                        <img src="./resources/GPS.png" alt=""  class="icon">
                        <span class="label">Vị trí GPS:</span>
                    </div>
                    <input autocomplete="off" name="data-value1" id="data-value2" class="data-value" disabled>
                    
                </div>
                <div class="data-container3">
                    <div>
                        <img src="./resources/Nhietdo.png" alt="" class="icon">
                        <span class="label">Nhiệt độ không khí:</span>
                    </div>
                    <input autocomplete="off" name="data-value3" id="data-value3" class="data-value" disabled>
                    
                </div>
                <div class="data-container4">
                    <div>
                        <img src="./resources/Doamkhongkhi.png" alt=""  class="icon">
                        <span class="label">Độ ẩm không khí:</span>
                    </div>
                    <input autocomplete="off" name="data-value4" id="data-value4" class="data-value" disabled>
                    
                </div>
                <div class="data-container5">
                    <div>
                        <img src="./resources/Cuongdoanhsang.png" alt=""  class="icon">
                        <span class="label">Cường độ ánh sáng:</span>
                    </div>
                    <input autocomplete="off" name="data-value5" id="data-value5" class="data-value" disabled>
                    
                </div>
                
            </div>
            <div class="data-container">
                <div class="data-container6">
                    <div>
                        <img src="./resources/Doamdat.png" alt=""  class="icon">
                        <span class="label">Độ ẩm đất:</span>
                    </div>
                    <input autocomplete="off" name="data-value6" id="data-value6" class="data-value" disabled>
                    
                </div>
                <div class="data-container7">
                    <div>
                        <img src="./resources/O2.png" alt=""  class="icon">
                        <span class="label">Hàm lượng O2:</span>
                    </div>
                    <input autocomplete="off" name="data-value7" id="data-value7" class="data-value" disabled>
                    
                </div>
                <div class="data-container8">
                    <div>
                        <img src="./resources/CO2.png" alt=""  class="icon">
                        <span class="label">Hàm lượng CO2:</span>
                    </div>
                    <input autocomplete="off" name="data-value8" id="data-value8" class="data-value" disabled>
                    
                </div>
                <div class="data-container9">
                    <div>
                        <img src="./resources/pH.png" alt=""  class="icon">
                        <span class="label">Độ pH:</span>
                    </div>
                    <input autocomplete="off" name="data-value9" id="data-value9" class="data-value" disabled>
                    
                </div>
            </div>
            
            <div id="map" ></div>
            
        </div>
        
    </div>
    <div class="tab2">
        
        <div id="container2">
            <div class="control-container">
                <div class="control-container1">
                    <div class="label_container">
                        <img src="./resources/Quat_control.png" alt=""  class="control_icon">
                        <span class="control_label">Quạt 1:</span>

                    </div>
                    <div class="button">
                        <input id="button-1" class="checkbox" type="checkbox" value="1" checked>
                        <div class="knobs"></div>
                        <div class="layer"></div>
                    </div>
                </div>
                <div class="control-container2">
                    <div class="label_container">
                        <img src="./resources/Quat_control.png" alt=""  class="control_icon">
                        <span class="control_label">Quạt 2:</span>
  
                    </div>
                     <div class="button">
                        <input id="button-2" class="checkbox" type="checkbox" value="2" checked>
                        <div class="knobs"></div>
                        <div class="layer"></div>
                    </div>
                </div>
                <div class="control-container3">
                    <div class="label_container">
                        <img src="./resources/Quat_control.png" alt=""  class="control_icon">
                        <span class="control_label">Quạt 3:</span>

                    </div>
                    <div class="button">
                        <input id="button-3" class="checkbox" type="checkbox" value="3" checked>
                        <div class="knobs"></div>
                        <div class="layer"></div>
                    </div>
                </div>
                
                
            </div>
            <div class="control-container">
            <div class="control-container4">
                    <div class="label_container">
                        <img src="./resources/Pump_control.png" alt=""  class="control_icon">
                        <span class="control_label">Bơm nước:</span>
                    </div>
                    <div class="button">
                        <input id="button-4" class="checkbox" type="checkbox" value="4" checked>
                        <div class="knobs"></div>
                        <div class="layer"></div>
                    </div>
                </div>
            <div class="control-container5">
                    <div class="label_container">
                        <img src="./resources/Coolingpad_control.png" alt=""  class="control_icon">
                        <span class="control_label">Dàn lạnh:</span>

                    </div>
                    <div class="button">
                        <input id="button-5" class="checkbox" type="checkbox" value="5" checked>
                        <div class="knobs"></div>
                        <div class="layer"></div>
                    </div>
                </div>
                
                
                <div class="control-container6">
                    <div class="label_container">
                        <img src="./resources/Phunsuong_control.png" alt=""  class="control_icon">
                        <span class="control_label">Phun sương:</span>
                        
                    </div>
                    <div class="button">
                        <input id="button-6" class="checkbox" type="checkbox" value="6" checked>
                        <div class="knobs"></div>
                        <div class="layer"></div>
                    </div>
                </div>
            </div>
            <div class="control-container">

                <div class="control-container7">
                    <div class="label_container">
                        <img src="./resources/Tuoi_control.png" alt=""  class="control_icon">
                        <span class="control_label">Tưới nước:</span>
                        
                    </div>
                    <div class="button">
                        <input id="button-7" class="checkbox" type="checkbox" value="7" checked>
                        <div class="knobs"></div>
                        <div class="layer"></div>
                    </div>
                </div>
          

                <div class="control-container8">
                    <div class="label_container">
                        <img src="./resources/Catnang_control.png" alt=""  class="control_icon">
                        <span class="control_label">Cắt nắng:</span>
                     
                    </div>
                    <div class="button">
                        <input id="button-8" class="checkbox" type="checkbox" value="light" checked>
                        <div class="knobs"></div>
                        <div class="layer"></div>
                    </div>
                </div>
            

                <div class="control-container9">
                    <div class="label_container">
                        <img src="./resources/Isulation_control.png" alt=""  class="control_icon">
                        <span class="control_label">Bảo ôn:</span>
                    
                    </div>
                    <div class="button">
                        <input id="button-9" class="checkbox" type="checkbox" value="isult" checked>
                        <div class="knobs"></div>
                        <div class="layer"></div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <div class="tab3">
        <div class="menu_container3">
            <div id="container3">
                <div class="input">
                    <label class = "radio-select">
                        <input type="radio" name = "radio-select" value="fan_timer" checked/>
                        <img src="./resources/Quat_control.png" alt=""  class="timer_icon">
                        <span class="name">Quạt làm mát</span>
                    </label>
                    <label class = "radio-select">
                        <input type="radio" name = "radio-select" value="cooling_timer"/>
                        <img src="./resources/Coolingpad_control.png" alt=""  class="timer_icon">
                        <span class="name">Dàn lạnh</span>
                    </label>

                    <label class = "radio-select">
                        <input type="radio" name = "radio-select" value="frost_timer"/>
                        <img src="./resources/Phunsuong_control.png" alt=""  class="timer_icon">
                        <span class="name">Phun sương</span>
                    </label>
                    <label class = "radio-select">
                        <input type="radio" name = "radio-select" value="water_timer"/>
                        <img src="./resources/Tuoi_control.png" alt=""  class="timer_icon">
                        <span class="name">Tưới nước</span>
                    </label>
                    <label class = "radio-select">
                        <input type="radio" name = "radio-select" value="light_timer"/>
                        <img src="./resources/Catnang_control.png" alt=""  class="timer_icon">
                        <span class="name">Cắt nắng</span>
                    </label>
                    <label class = "radio-select">
                        <input type="radio" name = "radio-select" value="isult_timer"/>
                        <img src="./resources/Isulation_control.png" alt=""  class="timer_icon">
                        <span class="name">Bảo ôn</span>
                    </label>
                </div>
            </div>

        </div>
        <div class="timer_container">
            <div class="timer_label">
                <p>Thời gian bật</p>
                <p>Thời gian tắt</p>    
            </div>
            <div id="fan_timer">
                <!-- <div class="timer">
                    <label class="checkbox_container">
                        <input checked="checked" type="checkbox">
                        <div class="checkmark"></div>
                    </label>
                    <input type="time" class="on_timer">
                    <input type="time" class="off_timer">
                    <button class="delete_button">
                        <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
                    </button>
                </div> -->
            </div>
            <div id="cooling_timer"></div>
            <div id="frost_timer"></div>
            <div id="water_timer"></div>
            <div id="light_timer"></div>
            <div id="isult_timer"></div>
         
            <button type="button" class="add_timer">
                <span class="add_timer__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor"  fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg></span>
              </button>
        </div>
        <div class="info_control_container fan_timer">
            <div class="info_control">
                <div class="button">
                    <input id="button_control" class="checkbox" type="checkbox" checked>
                    <div class="knobs"></div>
                    <div class="layer"></div>
                </div>
                <div>
                    <div>Nhiệt độ bật</div>
                    <input class="on_value" type="number" disabled>
                </div>
                <div>
                    <div>Nhiệt độ tắt</div>
                    <input class="off_value" type="number" disabled>
                </div>
            </div>   
        </div>
        <div class="info_control_container cooling_timer">
            <div class="info_control">
                <div class="button">
                    <input id="button_control" class="checkbox" type="checkbox" checked>
                    <div class="knobs"></div>
                    <div class="layer"></div>
                </div>
                <div>
                    <div>Nhiệt độ bật</div>
                    <input class="on_value" type="number" disabled>
                </div>
                <div>
                    <div>Nhiệt độ tắt</div>
                    <input class="off_value" type="number" disabled>
                </div>
            </div>   
        </div>
        <div class="info_control_container frost_timer">
            <div class="info_control">
                <div class="button">
                    <input id="button_control" class="checkbox" type="checkbox" checked>
                    <div class="knobs"></div>
                    <div class="layer"></div>
                </div>
                <div>
                    <div>Độ ẩm không khí bật</div>
                    <input class="on_value" type="number" disabled>
                </div>
                <div>
                    <div>Độ ẩm không khí tắt</div>
                    <input class="off_value" type="number" disabled>
                </div>
            </div>   
        </div>
        <div class="info_control_container water_timer">
            <div class="info_control">
                <div class="button">
                    <input id="button_control" class="checkbox" type="checkbox" checked>
                    <div class="knobs"></div>
                    <div class="layer"></div>
                </div>
                <div>
                    <div>Độ ẩm đất bật</div>
                    <input class="on_value" type="number" disabled>
                </div>
                <div>
                    <div>Độ ẩm đất tắt</div>
                    <input class="off_value" type="number" disabled>
                </div>
            </div>   
        </div>
        <div class="info_control_container light_timer">
            <div class="info_control">
                <div class="button">
                    <input id="button_control" class="checkbox" type="checkbox" checked>
                    <div class="knobs"></div>
                    <div class="layer"></div>
                </div>
                <div>
                    <div>Cường độ sáng bật</div>
                    <input class="on_value" type="number" disabled>
                </div>
                <div>
                    <div>Cường độ sáng tắt</div>
                    <input class="off_value" type="number" disabled>
                </div>
            </div>   
        </div>
        <div class="info_control_container isult_timer">
            <div class="info_control">
                <div class="button">
                    <input id="button_control" class="checkbox" type="checkbox" checked>
                    <div class="knobs"></div>
                    <div class="layer"></div>
                </div>
                <div>
                    <div>Nhiệt độ bật</div>
                    <input class="on_value" type="number" disabled>
                </div>
                <div>
                    <div>Nhiệt độ tắt</div>
                    <input class="off_value" type="number" disabled>
                </div>
            </div>   
        </div>
        <button id="save">Lưu thay đổi</button>
    </div>
    <div class="tab4">
        <div class="device_management">
            <div class="horizon">
                <span>Quản lý thiết bị</span>
            </div>
            <div class="device_container">
                <div class="device_label">
                    <div>Tên thiết bị</div>
                    <div>Số e-Id</div>    
                </div>
                <div class="device no_device"> 
                    Không có thiết bị
                </div>
                <!-- <div class="device">
                    <input type="text" class="device_name" value="Thiết bị 1">
                    <input type="text" class="device_eid">
                    <button class="delete_button">
                        <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
                    </button>
                    <button class="connect"> -->
                        <!-- <span>Kết nối</span> -->
                        <!-- <svg class ="loading" viewBox="25 25 50 50">
                            <circle class="loading_circle" r="10" cy="50" cx="50"></circle>
                        </svg>
                    </button>
                </div>
                
                <div class="device">
                    <input type="text" class="device_name" value="Thiết bị 1">
                    <input type="text" class="device_eid">
                    <button class="delete_button">
                        <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
                    </button>
                    <button class="connect">
                        <span>Kết nối</span>
                    </button>
                </div>
                
                <div class="device">
                    <input type="text" class="device_name" value="Thiết bị 1">
                    <input type="text" class="device_eid">
                    <button class="delete_button">
                        <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
                    </button>
                    <button class="connect">
                        <span>Đã kết nối</span>
                    </button>
                </div> -->
                <button type="button" class="add_device">
                    <span class="add_timer__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor"  fill="none" class="svg"><line y2="19" y1="5" x2="12" x1="12"></line><line y2="12" y1="12" x2="19" x1="5"></line></svg></span>
                </button>
            </div>
        </div>
        <div class="account_management">
            <div class="horizon">
                <span>Quản lý tài khoản</span>
            </div>
            <div class="Account-container">
            <div class="Account">
                <div class="Account-username">
                    <p>Tên người dùng:</p>
                    <input id = "accountname" class="Account-password1-newPW-input" type="text" placeholder="Nhập tên người dùng">
                </div>
                <div class="Account-newpassword">
                    <p>Mật khẩu mới:</p>
                    <input id = "newpassword" class="Account-password1-newPW-input" type="password" placeholder="Nhập mật khẩu mới">
                </div>
            </div>
            <div class="Account">
                <div class="Account-oldpassword">
                    <p>Mật khẩu cũ:</p>
                    <input id = "oldpassword" class="Account-password1-newPW-input" type="password" placeholder="Nhập mật khẩu">
                </div>
            </label>
                <div class="Account-renewpassword">
                    <p>Nhập lại mật khẩu:</p>
                    <input id = "renewpassword" class="Account-password1-newPW-input" type="password" placeholder="Nhập lại mật khẩu">
                </div>
            </div>
            </div>
        </div>
        <button class="Account-save" type="button">
            <span>Lưu thay đổi</span>
        </button>
    </div>
    <footer></footer>
    
    <script type="text/javascript" src="./javascript/CurrentTime.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" src="./javascript/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="./javascript/ChangeAccount.js"></script>
    <script src="./javascript/javascript.js" type="text/javascript" async></script>
    <script type="text/javascript" src="https://thingspeak.com/highcharts-3.0.8.js"></script>
</body>
</html>