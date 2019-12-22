
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

//   var myName = prompt("Enter Your Name.");

  //send message function
  function addMessage(){
      var currentDate = new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate();
      firebase.database().ref("messages").push().set({
          "message" : document.getElementById("write_msg").value,
          "sender_id" : auth_id,
          "receive_id" : receive_id,
          "reply_id" : 0, 
          "edit" : 0,
          "del" : 0,
          "created_at" : currentDate,
          "updated_at" : currentDate,
      });
      return false;
  }
function getMessage(){
  //get message function
  firebase.database().ref("messages").on("child_added", function(snapshot){
    var html = "";
    console.log(auth_id + "====" + snapshot.val().sender_id +"and"+ receive_id +"======="+ snapshot.val().receive_id +"and"+ receive_id +"===="+ snapshot.val().sender_id +"and"+ receive_id +"======"+ snapshot.val().receive_id);
    if(auth_id == snapshot.val().sender_id || auth_id == snapshot.val().receive_id || receive_id == snapshot.val().sender_id || receive_id == snapshot.val().receive_id){
    //start message div
    html += "<div class='outgoing_msg' id='message-" + snapshot.key + "'>";
      html += "<div class=" + ((auth_id == snapshot.val().sender_id) ? "sent_msg" : "receive_msg") + ">";
      html += "<div>";
      if(snapshot.val().del == 0 && snapshot.val().reply_id != 0){
        var rply_id = snapshot.val().reply_id;
        firebase.database().ref('messages').child(snapshot.val().reply_id).once("value",snapshot => {
          if (snapshot.exists()){
            html += "<p class='rply_message' data-id='" + rply_id + "'> | " + snapshot.val().message + "</p>";
          }
        });
        // html += "<p class='rply_message'> | Reply Message</p>";
      }
          html += "<p>" + ((snapshot.val().del == 1) ? "This message have been delete." : snapshot.val().message) + "</p>";
          if(snapshot.val().del == 0 && snapshot.val().edit == 1){
              html += "<i class='fas fa-pencil-alt' style='float: right;'></i>";
          }
          //show delete button if message sender
          if(snapshot.val().sender_id == auth_id && snapshot.val().del == 0){
              html += "<i class='fas fa-edit btn-edit' data-id='" + snapshot.key + "' onclick='editMessage(this);'></i>";
              html += "<i class='fas fa-trash-alt btn-del' onclick='deleteMessage(this);' data-id='" + snapshot.key + "'></i>";
          }else{
            if(snapshot.val().del == 0){
              //reply message btn
              html += "<i class='fas fa-reply btn-del' data-id='" + snapshot.key + "' onclick='replyMessage(this);'></i>";
            // html += "<span class='btn-del' data-id='" + snapshot.key + "' onclick='replyMessage(this);'>Reply</span>";
            }
          }
        html += "</div>";
        html += "<span class='time_date'>" + snapshot.val().created_at + "</span>";
      html += "</div>";
    html += "</div>";

    // append message div
    document.getElementById("msg_history").innerHTML += html;
    document.getElementById("write_msg").value = '';
  }
    //end message div
  });
}
getMessage();

  //edit message
  function editMessage(self){
    var messageId = self.getAttribute('data-id');
    var edit_value = self.parentElement.children[0].innerText;
    document.getElementById('write_msg').value = edit_value;
    var html = "";
    html += "<div id='editMessageContainer'>Edit: <span data-id=" + messageId + ">" + messageId + "</span></div>";
    document.getElementById('editMessage_con').innerHTML += html;
  }
  //update message
  function updateMessage(messageId){
    firebase.database().ref('messages').child(messageId).update(
    {
      'message' : document.getElementById("write_msg").value,
      'edit' : 1,
    });
    document.getElementById("write_msg").value = '';
    document.getElementById("editMessageContainer").remove();
  }
  //replyMessage
  function replyMessage(self){
    var messageId = self.getAttribute('data-id');
  //  var mess = '-LwduuJaG05FjPNeWQ2L';
    firebase.database().ref('messages').child(messageId).once("value",snapshot => {
        if (snapshot.exists()){
          const messageData = snapshot.val();
          //append Reply data
          var html = "";
          html += "<div id='replyMessageContainer'>Reply: <span data-id=" + messageId + ">" + messageId + "</span></div><div></div>";
          document.getElementById('editMessage_con').innerHTML += html;
        }
    });
  }
  //reply update message
  function replyUpdateMessage(messageId){
    var currentDate = new Date().getFullYear()+'-'+(new Date().getMonth()+1)+'-'+new Date().getDate();
      firebase.database().ref("messages").push().set({
          "message" : document.getElementById("write_msg").value,
          "sender_id" : auth_id,
          "receive_id" : receive_id,
          "reply_id" : messageId, 
          "edit" : 0,
          "del" : 0,
          "created_at" : currentDate,
          "updated_at" : currentDate,
      });
      // return false;
      document.getElementById("replyMessageContainer").remove();
  }
  //send message
  function sendMessage(self){
    var elements = self.closest("#editMessage_con").children.length;
    if(document.getElementById("write_msg").value != ''){
      if(elements == 1){
        //send new message
        addMessage();
      }else if(elements == 2){
        //edit message
        messageId = self.closest("#editMessage_con").children[1].children[0].getAttribute("data-id");
        updateMessage(messageId);
      }else if(elements == 3){
        //reply message
        messageId = self.closest("#editMessage_con").children[1].children[0].getAttribute("data-id");
        replyUpdateMessage(messageId);
      }else{
        return false;
      }
    }else{
      document.getElementById('write_msg').style.border = '1px solid red';
      setInterval(() => {
        document.getElementById('write_msg').style.border = '';
      }, 1000);
    }
  }
  //delete message function
  function deleteMessage(self){
    var messageId = self.getAttribute('data-id');
    firebase.database().ref('messages').child(messageId).update(
      {
        'del' : 1
      }
    );
  }
  //delete message show message
  firebase.database().ref("messages").on("child_changed", function(snapshot){
    messageElement = document.getElementById("message-" + snapshot.key);
    if(snapshot.val().del == 1){
      messageElement.children[0].children[0].innerHTML = "This message have been delete.";
    }
    if(snapshot.val().edit == 1){
      //add "Edited"
      var edited_text = messageElement.children[0].children[0];
      var element = document.createElement('li');
      element.className = 'fas fa-pencil-alt';
      element.setAttribute("style", "float: right;");
      edited_text.appendChild(element);
      //change edit text
      var edit_value = messageElement.children[0].children[0].children[0];
      edit_value.innerText = snapshot.val().message;
    }
  });