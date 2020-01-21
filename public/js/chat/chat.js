
// Your web app's Firebase configuration
var firebaseConfig = {
    apiKey: "AIzaSyDj_HZWt-8IxdIrs2xRlH224MLCZJMLCBk",
    authDomain: "chat-application-5a089.firebaseapp.com",
    databaseURL: "https://chat-application-5a089.firebaseio.com",
    projectId: "chat-application-5a089",
    storageBucket: "chat-application-5a089.appspot.com",
    messagingSenderId: "244852348231",
    appId: "1:244852348231:web:b74d376417185f4ce3a862",
    measurementId: "G-P0S0E1DMFG"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();

$(document).ready(function(){

//date and time
function getDate(){
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date+' '+time;
    return dateTime;
}

var ref = firebase.database().ref("messages");


//get message
ref.on("child_added", function(snapshot){

    if(auth_user.id == snapshot.val().sender_id && receive_id == snapshot.val().receive_id || auth_user.id == snapshot.val().receive_id && receive_id == snapshot.val().sender_id){

        $('<li class="' + ((auth_user.id == snapshot.val().sender_id) ? "sent" : "replies") + '"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + snapshot.val().message + '</p></li>').appendTo($('.messages ul'));
        $('.message-input input').val(null);
        $('.contact.active .preview').html('<span>You: </span>' + message);
        $(".messages").animate({ scrollTop: $(document).height() }, "fast");

    }

});


function newMessage() {
	message = $(".message-input input").val();
	if($.trim(message) == '') {
		return false;
    }
    
    ref.push().set({
        "message" : message,
        "sender_id" : parseInt(auth_user.id),
        "receive_id" : parseInt(receive_id),
        "edit" : 0,
        "del" : 0,
        "has_seen" : 0,
        "created_at" : getDate(),
        "updated_at" : getDate(),
    });
    return false;
};

$('.submit').click(function() {
  newMessage();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    newMessage();
    return false;
  }
});

});