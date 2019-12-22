@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/chat/chat.css') }}">
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-app.js"></script>
<!-- add firebase database -->
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-database.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
 https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-analytics.js"></script>
<script src="https://kit.fontawesome.com/d568763dc3.js" crossorigin="anonymous"></script>
<div class="container">
    <div class="messaging">
          <div class="inbox_msg">
            <div class="inbox_people">
              {{-- <div class="headind_srch"> --}}
                {{-- <div class="recent_heading">
                  <h4>Recent</h4>
                </div> --}}
                {{-- <div class="srch_bar">
                  <div class="stylish-input-group">
                    <input type="text" class="search-bar"  placeholder="Search" >
                    <span class="input-group-addon">
                    <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                    </span> </div>
                </div> --}}
              {{-- </div> --}}
              {{-- <div class="inbox_chat"> --}}
                {{-- <div class="chat_list active_chat"> --}}
                  {{-- <div class="chat_people"> --}}
                    {{-- <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div> --}}
                    {{-- <div class="chat_ib">
                      <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                      <p>Test, which is a new approach to have all solutions 
                        astrology under one roof.</p>
                    </div> --}}
                  {{-- </div> --}}
                {{-- </div> --}}
              {{-- </div> --}}
            </div>
            <div class="mesgs">
              <div class="msg_history" id="msg_history">
                {{-- <div class="incoming_msg">
                  <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                  <div class="received_msg">
                    <div class="received_withd_msg">
                      <p>Test which is a new approach to have all
                        solutions</p>
                      <span class="time_date"> 11:01 AM    |    June 9</span>
                    </div>
                  </div>
                </div> --}}
                {{-- <div class="outgoing_msg">
                  <div class="sent_msg">
                    <div class="message">
                      <p class="rply_message"> | Reply Message</p>
                      <p>Test which is a new approach to have all
                        solutions Test user sendMessage
                      </p>
                      <span class="btn-edit">Edit</span>
                      <span class="btn-del">Delete</span>
                    </div>
                    <span class="time_date"> 11:01 AM    |    June 9</span>
                  </div>
                </div> --}}
                {{-- <div class="outgoing_msg">
                  <div class="receive_msg">
                    <div class="message">
                      <p>Test which is a new approach to have all
                        solutions Test user sendMessage
                      </p>
                      <span class="btn-edit">Edit</span>
                      <span class="btn-del">Delete</span>
                    </div>
                    <span class="time_date"> 11:01 AM    |    June 9</span>
                  </div>
                </div> --}}
              </div>
              
              <div class="emojiContainer" style="display:none">
                <div class="grid01">
                  <span style='font-size:20px;' class="emoji_item">&#128526;</span>
                  <span style='font-size:20px;' class="emoji_item">&#128528;</span>
                  <span style='font-size:20px;' class="emoji_item">&#129296;</span>
                  <span style='font-size:20px;' class="emoji_item">&#128512;</span>
                  <span style='font-size:20px;' class="emoji_item">&#128514;</span>
                </div>
                <div class="grid02">
                  <span style='font-size:20px;' class="emoji_item">🦄</span>
                  <span style='font-size:20px;' class="emoji_item">&#128516;</span>
                  <span style='font-size:20px;' class="emoji_item">&#128517;</span>
                  <span style='font-size:20px;' class="emoji_item">&#128520;</span>
                  <span style='font-size:20px;' class="emoji_item">&#128521;</span>
                </div>
                <div class="grid03">
                  <span style='font-size:20px;' class="emoji_item">&#128522;</span>
                  <span style='font-size:20px;' class="emoji_item">&#128525;</span>
                  <span style='font-size:20px;' class="emoji_item">&#128541;</span>
                  <span style='font-size:20px;' class="emoji_item">&#128552;</span>
                  <span style='font-size:20px;' class="emoji_item">&#128553;</span>
                </div>
                <div class="grid04">
                  <span style='font-size:20px;' class="emoji_item">&#128557;</span>
                  <span style='font-size:20px;' class="emoji_item">&#129309;</span>
                  <span style='font-size:20px;' class="emoji_item">&#129306;</span>
                  <span style='font-size:20px;' class="emoji_item">&#129505;</span>
                  <span style='font-size:20px;' class="emoji_item">&#9997;</span>
                </div>
            </div>
              <div class="type_msg" id="editMessage_con">
                <div class="input_msg_write">
                  <input type="text" id="write_msg" placeholder="Type a message" value=""/>
                  <button style='font-size:20px;' class="emoji-btn" type="button">&#128526;</button>
                  <button onclick="sendMessage(this)" class="msg_send_btn" type="button">Send</i></button>
                </div>
              </div>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @include('footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('js/chat/chat.js') }}"></script>
    <script src="{{ asset('js/chat/chatUI.js') }}"></script>
@endsection
