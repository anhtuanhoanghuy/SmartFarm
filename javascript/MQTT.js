function startConnect(){

    clientID = "clientID - "+parseInt(Math.random() * 100);

    var host = document.getElementById("host").value;   
    var port = document.getElementById("port").value;  
    var userId  = document.getElementById("username").value;  
    var passwordId = document.getElementById("password").value;  

    document.getElementById("messages").innerHTML += "<span> Connecting to " + host + "on port " +port+"</span><br>";
    document.getElementById("messages").innerHTML += "<span> Using the client Id " + clientID +" </span><br>";

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


function onConnect(){
    topic =  document.getElementById("topic_s").value;

    document.getElementById("messages").innerHTML += "<span> Subscribing to topic "+topic + "</span><br>";

    client.subscribe(topic);
}



function onConnectionLost(responseObject){
    document.getElementById("messages").innerHTML += "<span> ERROR: Connection is lost.</span><br>";
    if(responseObject !=0){
        document.getElementById("messages").innerHTML += "<span> ERROR:"+ responseObject.errorMessage +"</span><br>";
    }
}

function onMessageArrived(message){
    console.log("OnMessageArrived: "+message.payloadString);
    document.getElementById("messages").innerHTML += "<span> Topic:"+message.destinationName+"| Message : "+message.payloadString + "</span><br>";
}

function startDisconnect(){
    client.disconnect();
    document.getElementById("messages").innerHTML += "<span> Disconnected. </span><br>";




}

function publishMessage(){
msg = document.getElementById("Message").value;
topic = document.getElementById("topic_p").value;

Message = new Paho.MQTT.Message(msg);
Message.destinationName = topic;

client.send(Message);
console.log("Sent: "+msg);
document.getElementById("messages").innerHTML += "<span> Message to topic "+topic+" is sent </span><br>";


}
