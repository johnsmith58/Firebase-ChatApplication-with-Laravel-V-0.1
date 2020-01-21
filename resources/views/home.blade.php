@extends('layouts.app')

@section('content')
<div id="frame">
	<div id="sidepanel">
		<div id="profile">
			<div class="wrap">
				<img id="profile-img" src="{{ asset('/storage/img/profile.jpg') }}" class="online" alt="" />
                <p>{{ Auth::user()->name }}</p>
			</div>
		</div>
		<div id="contacts">
			<ul>
                @foreach ($users as $user)
                <li class="contact" data-id="{{ $user->id }}">
					<div class="wrap">
                        <img src="{{ asset('/storage/img/profile.jpg') }}" alt="" />
						<div class="meta">
                            <p class="name">{{ $user->name }}</p>
							<p class="preview">{{ $user->email }}</p>
						</div>
					</div>
				</li>
                @endforeach
			</ul>
		</div>
	</div>
	<div class="content">
		<div class="contact-profile">
            <img src="{{ asset('/storage/img/profile.jpg') }}" alt="" />
            <p>{{ \App\User::find(Request()->receive_id)->name }}</p>
		</div>
		<div class="messages">
			<ul>
			</ul>
		</div>
		<div class="message-input">
			<div class="wrap">
			<input type="text" placeholder="Write your message..." />
			<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div>
@include('footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('js/chat/chat.js') }}"></script>
<script>
$(document).ready(function(){
    $('.contact').on('click', function(){
        var receive_id = $(this).attr('data-id');
        //pass two parameter url
        var url = '{{ route( "chat", [ ":receive_id" ] ) }}';
        var url = url.replace(':receive_id', receive_id);
        window.location.href = url;
    });
});
</script>
@endsection