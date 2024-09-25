var mikExp = /[\$\\\\\#\^\&\*\(\)\[\]\+\_\{\}\`\~\=\\!\|\/\?\.\,\:\;\"\'\@]/;  //Kiểm tra hợp thức
var rssi;
var device = "";
// var gps =  [];
// var buttons = ['#button-3', '#button-4', '#button-5', '#button-6'];
// var tmp=[0,0,0,0,0,0,0,0,0];
var status_bttn = "";
var timer = ["fan_timer","cooling_timer","frost_timer","water_timer","light_timer","isult_timer"];
var data_timer;
var time_out = true;
// variables for the first series
// var array_machine = ['0','0','0','0','0'];
// var machine = $("input[type='radio'][name='radio-select']:checked").val();
// var on_value = $(`.${machine}`).find(".on_value");
// var off_value = $(`.${machine}`).find(".off_value");
// when the document is ready
$(document).ready(function() {

  $.getJSON("https://ipinfo.io/", onLocationGot);
  $(".welcome_name").html("Xin chào " + getCookie('accountname'));
});

$(".user_options").click(function() {
  $(".dropdown_container").css('display','flex');
})
$(".dropdown_container").click(function(){
  location.href = "backend/Logout.php";
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
$(document).mouseup(function(e) 
{
    var dropdown_container = $(".dropdown_container");
    var dropdown = $(".dropdown");

    // if the target of the click isn't the container nor a descendant of the container
    if (!dropdown_container.is(e.target) && dropdown_container.has(e.target).length === 0) 
    {
      dropdown_container.hide();
    }
    if (!dropdown.is(e.target) && dropdown.has(e.target).length === 0) 
      {
        $('.select').removeClass('select-clicked');
          $('.caret').removeClass('caret-rotate');
          $('.menu').removeClass('menu-open');
          $('.menu li').each(function(){
            $(this).removeClass('active');
          });
      }
});

$('#giamsat').click(function(){
  $('.data-container10').css('display','flex');
  $('.tab2').css('display','none');
  $('.tab3').css('display','none');
  $('.tab4').css('display','none');
  if (device != "") {
    $('.tab1').css('display','block');

  }
})
$('#dieukhien').click(function(){
  $('.data-container10').css('display','flex');
  $('.tab1').css('display','none');
  $('.tab3').css('display','none');
  $('.tab4').css('display','none');
  if (device != "") {
    $('.tab2').css('display','block');
  }
})
$('#cauhinh').click(function(){
  $('.data-container10').css('display','flex');
  $('.tab1').css('display','none');
  $('.tab2').css('display','none');
  $('.tab4').css('display','none');
  if (device != "") {    
    $('.tab3').css('display','flex');
    $.post("backend/Automation.php",
      {token: getCookie('token'),
        function: "getTimer",
        e_Id: device
      },
       function(data) {
        data = JSON.parse(data);
        console.log(data);
        data_timer = data;
        checkTimerData();
      })
    
  }
})
$('#caidat').click(function(){
    $('.data-container10').css('display','none');
    $('.tab1').css('display','none');
    $('.tab2').css('display','none');
    $('.tab3').css('display','none');
    $('.tab4').css('display','flex');
    $.post("backend/Device.php",
      {token: getCookie('token'),
        function: "getDevice"
      },
       function(data) {
        data =  JSON.parse(data); //dữ liệu JSON
        if (data.length == 0) {
          $(".no_device").css("display",'block');
        } else {
          $(".no_device").css("display",'none');
          if ($(".device_container").children().length == 3) {
            for (var x = 0; x < data.length;x++){
              $(`<div class="device">
                      <input type="text" class="device_name" value="${data[x].devicename}">
                      <input type="text" class="device_eid" value="${data[x].e_Id}" disabled="disabled">
                      <button class="delete_button">
                          <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
                      </button>
                      <button class="connect">
                          <span class = "connected">Kết nối</span>
                          <svg class ="loading" viewBox="25 25 50 50">
                            <circle class="loading_circle" r="10" cy="50" cx="50"></circle>
                          </svg>
                      </button>
                  </div>`).insertBefore(".add_device");
            }
          }  
        }
     }) 

})
// add the base chart


    $('.select').click(function(){
     $(".menu li").remove();
      $.post("backend/Device.php",
        {token: getCookie('token'),
          function: "getDevice"
        },
         function(data) {
          data =  JSON.parse(data); //dữ liệu JSON
          console.log(data);
          if (data.length == 0) {
            $(".menu").append(`<li>
              <span>Không có thiết bị</span>
            </li>`)
    
          } else {
            for (var x = 0; x < data.length;x++){
              $(".menu").append(`<li class="Device" data-value="${data[x].e_Id}">
                        <span>${data[x].devicename}</span>
                        <span>e-Id: ${data[x].e_Id}</span>
                    </li>`)
            }
    
          }
    
       }) 
       $('.select').toggleClass('select-clicked');
       $('.caret').toggleClass('caret-rotate');
       $('.menu').toggleClass('menu-open');
    });

        $('.menu').on("click",".Device",function() {

          $('.selected').text($(this).find('span:first').text());
          $('.serialText').text($(this).find('span:nth-child(2)').text());
          $('.select').removeClass('select-clicked');
          $('.caret').removeClass('caret-rotate');
          $('.menu').removeClass('menu-open');
          $('.menu li').each(function(){
            $(this).removeClass('active');
          });
          $(this).addClass('active');
          var tabId = $('input[name="radio"]:checked').attr('id');
          device = $(this).data('value');
          $('.control').css('visibility', 'visible');
          $(`#${tabId}`).click();
          // gps =  ['21.0380724','105.7829396'];
          getMap();
          connectDevice();
        });

// **************************************************************************************
  $('#checkbox').change(async function(){
    if(this.checked) {
      publishMessage("@");
      for(var i = 1;i<=9;i++) {
        $(`#button-${i}`).prop('disabled',false);
        $(`#button-${i}`).css('z-index','3');
      }
    } else {
      publishMessage("!");
      for(var i = 1;i<=9;i++) {
        $(`#button-${i}`).prop('checked',true);
        $(`#button-${i}`).prop('disabled',true);
        $(`#button-${i}`).css('z-index','-1');
      }
    } 
    setTimeout_bttn();    
  });

  $('.checkbox').change(async function() {
    if(this.checked) {
      publishMessage(`${$(this).val()}0`);
    } else {
      publishMessage(`${$(this).val()}1`);
    }
    setTimeout_bttn();
  });

       

// **************************************************************************************
//Covert decimaltoDMS
function ConvertDecimalToDMS (DD) {
  // Tách số thập phân thành hai phần: độ và số lẻ
  let degree = DD.split (".")[0]; // lấy phần trước dấu chấm
  let decimal = DD.split (".")[1]; // lấy phần sau dấu chấm

  // Tính ra phút từ số lẻ
  let minute = Math.floor (Number ("0." + decimal) * 60);

  // Tính ra giây từ số lẻ
  let second = Math.round ((Number ("0." + decimal) * 60 - minute) * 60);

  // Trả về kết quả dạng string
  return degree + "°" + minute + "'" + second + "\"";
}

// **************************************************************************************
//Get weather
function onLocationGot(info) {
  let position = info.loc.split(",");
  var lat = position[0];
  var lon = position[1];
  url = 'https://api.openweathermap.org/data/2.5/weather?lat=' + lat + '&lon=' + lon +'&appid=2a57a02df82bc7d87088d657a944cb5a&units=metric&lang=vi';
  async function asyncCall() {
      const response = await fetch(url);
      const json = await response.json(); 
      var data = JSON.parse(JSON.stringify(json));
      var name = data.name;
      var temp = "Nhiệt độ: " + data.main.temp +"&degC";
      var humidity = "Độ ẩm: " + data.main.humidity + "%";
      var wind = "Gió: " + data.wind.speed + " km/h";
      var weather = data.weather[0].description;
      weather = weather.charAt(0).toUpperCase() + weather.slice(1)
      var icon = data.weather[0].icon;
      var iconurl = "http://openweathermap.org/img/w/" + icon + ".png";
      $('#name').html(name);
      $('#temp').html(temp); 
      $('#humid').html(humidity);
      $('#wind').html(wind);
      $('#description').html(weather);
      $('#icon').attr('src',iconurl)
  }
  asyncCall();
}



// **************************************************************************************
//Get map
 function getMap() {
  var gps = ['20.3524474', '106.5552532'];
  var map = new Microsoft.Maps.Map('#map', {
    credentials: 'ApmjZMScf3QndIcQhYNlkzZrFokZjkqUjGE6y-3Y00-sJdpjwUvoVDlaEFQPjctJ',
  });
 //Request the user's location
  
  var loc = new Microsoft.Maps.Location(
   gps[0],gps[1]);

  //Add a pushpin at the user's location.
  var pin = new Microsoft.Maps.Pushpin(loc);
  map.entities.push(pin);

  //Center the map on the user's location.
  map.setView({ center: loc, zoom: 15 });

}

$(".add_timer").click(function(){
  if ($(`#${$("input[type='radio'][name='radio-select']:checked").val()}`).children().length < 3) {
    $(`#${$("input[type='radio'][name='radio-select']:checked").val()}`).append(
            `<div class="timer">
                <label class="checkbox_container">
                    <input checked="checked" type="checkbox">
                    <div class="checkmark"></div>
                  </label>
                <input type="time" class="on_timer">
                <input type="time" class="off_timer">
                <button class="delete_button">
                    <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
                </button>
                
            </div>`);

            if ($(`#${$("input[type='radio'][name='radio-select']:checked").val()}`).children().length == 3) {
              $(".add_timer .svg").css('color','#9d9d9d');
              $(".add_timer").css('border','solid 1px #9d9d9d');
              $(".add_timer").hover(function(){
                $(this).css('cursor','default');
              });
            }
  }
  if (!$(`.${$("input[type='radio'][name='radio-select']:checked").val()} #button_control`).prop("checked")) {
    $(`.${$("input[type='radio'][name='radio-select']:checked").val()} #button_control`).click();
  }
})

$(".add_device").click(function(){
  $(".no_device").css('display','none');
    $(
            `<div class="device">
                    <input type="text" class="device_name" value="Thiết bị mới">
                    <input type="text" class="device_eid">
                    <button class="delete_button">
                        <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
                    </button>
                    <button class="connect">
                        <span class = "connected">Kết nối</span>
                        <svg class ="loading" viewBox="25 25 50 50">
                            <circle class="loading_circle" r="10" cy="50" cx="50"></circle>
                        </svg>
                    </button>
                </div>`).insertBefore($(".add_device"));
})

$(".timer_container").on("click", ".delete_button", function() {
  $(this).parent().remove();
  if ($(`#${$("input[type='radio'][name='radio-select']:checked").val()}`).children().length < 3) {
    $(".add_timer .svg").css('color','#1e73e2');
    $(".add_timer").css('border','solid 1px #1e73e2');
    $(".add_timer").hover(function(){
      $(this).css('cursor','pointer');
    });
  }
  // Thêm mã xử lý khác tại đây
});

$(".device_container").on("click", ".delete_button", function() {
  var deviceCount = $(this).closest(".device");
  var e_Id = deviceCount.find(".device_eid").val();
  $.post("backend/Device.php",
    {token: getCookie('token'),
      function: "deleteDevice",
      device_eid: e_Id
    },
     function(data) {
      data =  JSON.parse(data); //dữ liệu JSON
      if (data == 1) {
        deviceCount.remove();
        if($(".device_container").children().length == 3) {
          $(".no_device").css('display','block');
        }
        if(device == e_Id) {
          $('.selected').text("--- Hãy chọn thiết bị ---");
          $('.serialText').text("");
          device = "";
        }
      } else if (data == 0) {
        alert("Có lỗi xảy ra, vui lòng thử lại.");
      }
   }) 
  // Thêm mã xử lý khác tại đây
});

$(".timer_container").on("click", ".checkbox_container input", function() {
  var timerElement = $(this).closest(".timer");
  var onTimerInput = timerElement.find(".on_timer");
  var offTimerInput = timerElement.find(".off_timer");
  if(this.checked) {
    onTimerInput.removeAttr('disabled');
    offTimerInput.removeAttr('disabled');
    if (!$(`.${$("input[type='radio'][name='radio-select']:checked").val()} #button_control`).prop("checked")) {
      $(`.${$("input[type='radio'][name='radio-select']:checked").val()} #button_control`).click();
    }
  } else {
    onTimerInput.attr('disabled','true');
    offTimerInput.attr('disabled','true');
  }
  // Thêm mã xử lý khác tại đây
});

$(".on_value").blur(function(){
 if ($(".on_value").val() > 40 || $(".on_value").val() < $(".off_value").val()) {
   $(".on_value").val(40);
 }
})
$(".off_value").blur(function(){
  if ($(".off_value").val() < 20 || $(".off_value").val() > $(".on_value").val()) {
    $(".off_value").val(20);
  }
 })

$(".info_control_container").on("click","#button_control",function(){
  var info_control_container = $(this).closest(".info_control_container");
  var on_value = info_control_container.find(".on_value");
  var off_value = info_control_container.find(".off_value");
  if(this.checked) {
    on_value.attr('disabled','true');
    off_value.attr('disabled','true');
  } else {
    on_value.removeAttr('disabled');
    off_value.removeAttr('disabled');
    $(`#${$("input[type='radio'][name='radio-select']:checked").val()} input[type='checkbox']:checked`).click();    
  }
})

$(".input").on("click",".radio-select input",function(){
  checkTimerData();
  $(`#${$(this).val()}`).css('display','block');
  $(`.${$(this).val()}`).css('display','block');
  for (var index = 0; index < timer.length; index++){
    if(`#${timer[index]}` != `#${$(this).val()}`){
      $(`#${timer[index]}`).css('display','none');
    }
    if(`.${timer[index]}` != `.${$(this).val()}`){
      $(`.${timer[index]}`).css('display','none');
    }
  }
  if ($(`#${$("input[type='radio'][name='radio-select']:checked").val()}`).children().length < 3) {
    $(".add_timer .svg").css('color','#1e73e2');
    $(".add_timer").css('border','solid 1px #1e73e2');
    $(".add_timer").hover(function(){
      $(this).css('cursor','pointer');
    });
  } else {
    $(".add_timer .svg").css('color','#9d9d9d');
    $(".add_timer").css('border','solid 1px #9d9d9d');
    $(".add_timer").hover(function(){
      $(this).css('cursor','default');
    });
  }
  
});

$(".device_container").on("click",".connect",function(){
  var device_setting = $(this).closest(".device");
  var e_Id_setting = device_setting.find(".device_eid").val();
  var device_name = device_setting.find(".device_name").val();
  if (e_Id_setting == "" || device_name == "") {
    alert("Trường dữ liệu không được để trống.")
  } else {
    var update = "0";
    if (device_setting.find(".device_eid").prop("disabled")) {
      update = "1";
    }
    var connected = $(this).find(".connected");
    var loading = $(this).find(".loading");
    connected.css('display','none');
    loading.css('display','block');
    $.post("backend/Device.php",
      {token: getCookie('token'),
        function: "addDevice",
        device_name: device_name,
        device_eid: e_Id_setting,
        update: update
      },
       function(data) {
        data =  JSON.parse(data); //dữ liệu JSON
        if (data == 0) {
          setTimeout(() => {
            loading.css('display','none');
            connected.html("Kết nối")
            connected.css('display','block');
            alert ("Đã tồn tại thiết bị.");
        }, 2000);
        } else if (data == 1){
          setTimeout(() => {
            loading.css('display','none');
            connected.html("Kết nối")
            connected.css('display','block');
            alert ("Không tồn tại thiết bị.");
        }, 2000);
        } else if(data == 2) {
          setTimeout(() => {
            loading.css('display','none');
            connected.html("Đã kết nối")
            connected.css('display','block');
            alert("Thêm thiết bị thành công.");
            device_setting.find(".device_eid").attr('disabled','disabled');
        }, 2000);
        } else if(data == 3) {
          setTimeout(() => {
            loading.css('display','none');
            connected.html("Đã kết nối")
            connected.css('display','block');
            if(device == e_Id_setting) {
              $('.selected').text(device_name);
              $('.serialText').text(e_Id_setting);
            }
            alert("Cập nhật thiết bị thành công.");
        }, 2000);
  
  
        }
     }) 
  }


})

function connectDevice(){

  clientID = "clientID - "+parseInt(Math.random() * 100);
  var host = "35a196d8b54146f08f917c8c382e1c0a.s1.eu.hivemq.cloud";   
  var port = "8884";  
  var userId  = "hoanghuyanhtuan";
  var passwordId = "Tuan2002";  
  client = new Paho.MQTT.Client(host,Number(port),clientID);
  client.onConnectionLost = onConnectionLost;
  client.onMessageArrived = onMessageArrived;
  client.connect({
      onSuccess: onConnect,
      useSSL: true,
      userName: userId,
      password: passwordId
  });
}


function onConnect(topic){
  topic =  device + "/client";
  console.log("Subscribing to topic "+topic);
  client.subscribe(topic);
}



function onConnectionLost(responseObject){
  console.log("ERROR: Connection is lost.");
  if(responseObject !=0){
      console.log("ERROR:"+ responseObject.errorMessage);
  }
}

function onMessageArrived(message){
  console.log("Topic:"+message.destinationName+"| Message : "+message.payloadString);
  var subscribe_data = JSON.parse(message.payloadString);
  var inputString = subscribe_data.data;
  const data = inputString.split(",")
  status_bttn = data[12];
  if (status_bttn == "0") {
    $('#checkbox').prop('checked',false);
  } else {
    $('#checkbox').prop('checked',true);
  }      
  var feature = $("input[type='radio'][name='radio']:checked").attr('id');
  if (feature =='giamsat') {
    $("#data-value1").val(data[0] + "%");
    // $("#data-value2").val(data.gps[0] + ", " + data.gps[1]);
    $("#data-value3").val(data[1] + "°C");
    $("#data-value4").val(data[2] + "%");
    $("#data-value5").val(data[3] + " lux");
    $("#data-value6").val(data[4] + "%");
    // $("#data-value7").val(data.o2 + "%");
    // $("#data-value8").val(data.co2 + "%");
    // $("#data-value9").val(data.pH);
  } else if (feature == "dieukhien") {
    if (time_out == true) {
      if (status_bttn == "0") {
        $('#checkbox').prop('checked',false);
        $('.checkbox').prop('checked', true);
        $('.checkbox').attr('disabled', true);
        $('.checkbox').css('z-index','-1');
      } else {
        $('.checkbox').attr('disabled', false);
        $('.checkbox').css('z-index','3');
        for (var i=5;i<=11;i++) {
          if(data[i]=='0') {
            $(`#button-${i-4}`).prop('checked',true);
          } else if (data[i]=='1'){
            $(`#button-${i-4}`).prop('checked',false);
          }
        }     
      }
    }
  }
}

function startDisconnect(){
  client.disconnect();
  console.log("Disconnected.");
}

function publishMessage(msg){
  topic = device + "/control";
  Message = new Paho.MQTT.Message(msg);
  Message.destinationName = topic;
  client.send(Message);
  console.log("Sent: "+msg);
}

$("#save").click(function(){
  
  // alert($("input[type='radio'][name='radio-select']:checked").val());
  // alert($(`#${$("input[type='radio'][name='radio-select']:checked").val()}`).children().length);
  var device_timer = $("input[type='radio'][name='radio-select']:checked").val();
  var onTimerElements = $(`#${device_timer} input[type='time']`);
  var oncheckTimerElements = $(`#${device_timer} input[type='checkbox']`);
  var device_timer_send = $(`.${device_timer} .on_value`).val() + "," + $(`.${device_timer} .off_value`).val();
  var timer_status = "";
  if ($(`.${device_timer} input[type='checkbox']`).prop("checked")) {
    timer_status+="0";
  } else {
    timer_status+="1";
  }
  var check = true;
    onTimerElements.each(function() {
    if ($(this).val() == "") {
      check = false;
    } 
    if (check == true) {
      device_timer_send += "," + $(this).val();
    }
  });
  oncheckTimerElements.each(function() {
    if($(this).prop("checked")) {
      timer_status+=",1";
    } else {
      timer_status+=",0";
    }
  })
  if (check == false){
    alert("Vui lòng điền đầy đủ thời gian");
  } else {
    $.post("backend/Automation.php",
      {token: getCookie('token'),
        function: "updateTimer",
        e_Id: device,
        machine: device_timer,
        timer_status:timer_status,
        timer_data: device_timer_send
      },
       function(data) {
        data =  JSON.parse(data); //dữ liệu JSON
        if (data == 1) {
          alert("Cập nhật thành công.");
        } else if (data == 0) {
          alert("Cập nhật thất bại.");
        }
     }) 
  }

})

function checkTimerData() {
  var device_timer = $("input[type='radio'][name='radio-select']:checked").val();
  var device_timer_status = device_timer + "_status";
  const status = data_timer[0][device_timer_status];
  const arr_status = status.split(",");
  const timer = data_timer[0][device_timer];
  const arr_timer = timer.split(",");
  if (arr_status[0] == "0") {
    if (!$(`.${device_timer} #button_control`).prop("checked")) {
      $(`.${$("input[type='radio'][name='radio-select']:checked").val()} #button_control`).click();
    }
  } else if (arr_status[0] == "1") {
    if ($(`.${device_timer} #button_control`).prop("checked")) {
      $(`.${$("input[type='radio'][name='radio-select']:checked").val()} #button_control`).click();
    }
  }
  var on_value = $(`.${device_timer}`).find(".on_value");
  var off_value = $(`.${device_timer}`).find(".off_value");
  on_value.val(arr_timer[0]);
  off_value.val(arr_timer[1]);
  $(".timer").remove();
  for (var i=2;i<arr_timer.length;i+=2){
      $(`#${device_timer}`).append(
        `<div class="timer">
            <label class="checkbox_container">
                <input ${arr_status[i-1] === "1" ? "checked" : ""} type="checkbox">
                <div class="checkmark"></div>
              </label>
            <input type="time" class="on_timer" value="${arr_timer[i]}" ${arr_status[i-1] === "1" ? "":"disabled"}>
            <input type="time" class="off_timer" value="${arr_timer[i+1]}" ${arr_status[i-1] === "1" ? "":"disabled"}>
            <button class="delete_button">
                <svg viewBox="0 0 448 512" class="svgIcon"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path></svg>
            </button>
        </div>`);

  }
  if ($(`#${$("input[type='radio'][name='radio-select']:checked").val()}`).children().length == 3) {
    $(".add_timer .svg").css('color','#9d9d9d');
    $(".add_timer").css('border','solid 1px #9d9d9d');
    $(".add_timer").hover(function(){
      $(this).css('cursor','default');
    });
  }
}

var isMenu = false;
function handleMenuClick() {
  if (!isMenu) {
    $(".radio-inputs").css('display','block');
    isMenu = true;
  } else {
    $(".radio-inputs").css('display','none');
    isMenu = false;
  }
}

function closeMenu() {
  if ($(window).width() < 480) {
    $(".radio-inputs").css('display','none');
    isMenu = false;
  }
}

function setTimeout_bttn(){
  time_out = false;
  setTimeout(() => {
    time_out = true;
  }, 4000);
}