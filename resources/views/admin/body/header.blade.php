@php
    $user = DB::table('users')->where('id',Auth::user()->id)->first();
     $name = trim(collect(explode(' ', Auth::user()->name))->map(function ($segment) {
        return mb_substr($segment, 0, 1);
    })->join(' '));
     $avatar= 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=7F9CF5&background=EBF4FF';
@endphp
<div class="topbar">
    <nav class="navbar-custom">
        <ul class="list-inline float-right mb-0">
            <li class="list-inline-item dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user"
                   data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                   aria-expanded="false">
                    <img
                        src="{{ (!empty($user->profile_photo_path))? Storage::url('uploads/avatar/'.$user->profile_photo_path):$avatar }}"
                        alt="user"
                        class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-item noti-title">
                        <h5>Welcome</h5>
                    </div>
                    <a class="dropdown-item" href="{{route('profile.show')}}"><i
                            class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                    <a class="dropdown-item" href="{{route('profile.edit')}}"><i
                            class="mdi mdi-settings m-r-5 text-muted"></i> Settings</a>
                    <a class="dropdown-item" href="{{route('password.change')}}"><i
                            class="mdi mdi-lock-open-outline m-r-5 text-muted"></i> Lock screen</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        @method('post')
                        <button class="dropdown-item" type="submit" href="#"><i
                                class="mdi mdi-logout m-r-5 text-muted"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>

        <div class="clearfix"></div>

    </nav>

</div>

