<div class="card card-small user-details border">
    <div class="card-header p-0" style="border-top-left-radius: 4px; border-top-right-radius: 4px;">
        <div class="user-details__bg">
            <img src="{{ $user->coverPicture()['url'] }}" alt="User Details Background Image">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="user-details__avatar mx-auto" style="box-shadow: none; border: thick solid #fff;">
            <img class="profile-photo" src="{{ $user->avatar()['url'] }}" alt="User Avatar">
        </div>
        <h5 class="text-center m-0 mt-2 text-ellipsis">{{ $user->name() }}</h5>
        <p class="text-center text-light m-0 mb-2 text-ellipsis">{{ $user->email }}</p>
        @auth
            @if(!Auth::user()->is($user))
                <p class="text-center mb-4"><user-actions :user="{{ $user }}" my-messenger-url="{{ route("my.messenger") }}"></user-actions></p>
            @endif
        @endauth
    </div>
    <ul class="list-group list-group-flush">
        @if($user->profile('phone_number'))
        <li class="list-group-item p-4 border-top-left-radius-0 border-top-right-radius-0">
            <strong class="d-block mb-2 text-muted">Phone number</strong>
            <span>{{ $user->profile('phone_number') }}</span>
        </li>
        @endif
        @if($user->profile('about'))
        <li class="list-group-item p-4 border-top-left-radius-0 border-top-right-radius-0" >
            <strong class="d-block mb-2 text-muted">Biography</strong>
            <span>{{ $user->profile('about') }}</span>
        </li>
        @endif
        @if($user->profile('address'))
        <li class="list-group-item p-4 border-top-left-radius-0 border-top-right-radius-0">
            <strong class="d-block mb-2 text-muted">Address</strong>
            <span>{{ $user->profile('address') }}</span>
        </li>
        @endif
    </ul>
</div>