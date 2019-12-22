<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-app.js"></script>
<!-- add firebase database -->
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-database.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyABSf3yrzzxVubfyfYVX_CIbuhAYP1ECIk",
    authDomain: "chatapplication-4107c.firebaseapp.com",
    databaseURL: "https://chatapplication-4107c.firebaseio.com",
    projectId: "chatapplication-4107c",
    storageBucket: "chatapplication-4107c.appspot.com",
    messagingSenderId: "1068619485129",
    appId: "1:1068619485129:web:a715e1c4c4c422cbe8e218",
    measurementId: "G-CVGKQ3TKY0"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

  var myName = prompt("Enter Your Name.");

  //send message function
  function sendMessage(){
      var message = document.getElementById("message").value;
      firebase.database().ref("messages").push().set({
          "sender" : myName,
          "message" : message
      });
      return false;
  }
  //get message function
  firebase.database().ref("messages").on("child_added", function(snapshot){
    var html = "";
    //give message each of unique id
    html += "<li id='message-" + snapshot.key + "'>";
      //show delete button if message sender
      if(snapshot.val().sender == myName){
          html += "<a href='#' class='btn-edit' data-id='" + snapshot.key + "' onclick='deleteMessage(this);'>Edit</a>";
      }
      html += snapshot.val().sender + ": " + snapshot.val().message;
    html += "</li>";
    document.getElementById("messages").innerHTML += html;
  });
  //delete message function
  function deleteMessage(self){
    var messageId = self.getAttribute('data-id');
    firebase.database().ref('messages').child(messageId).remove();
  }
  //delete message show message
  firebase.database().ref("messages").on("child_removed", function(snapshot){
    document.getElementById("message-" + snapshot.key).innerHTML = "This message has been removed.";
  });
</script>
    <input id="message" placeholder="Enter Message" autocomplete="off">
    <input type="submit" onclick="sendMessage()">

    <ul id="messages"></ul>
</body>
</html>