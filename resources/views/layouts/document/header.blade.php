<nav>
    <div class="nav-wrapper">
        <span class="page-title">@yield('title')</span>
        <ul class="left">
            <li><a href="#" data-activates="side-nav" class="button-collapse show-on-large top-nav full"><i class="material-icons">menu</i></a></li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li>
                <a class="dropdown-button" href="#" data-activates="user-dropdown">
                    <span class="avatar avatar-sm">
                        <img alt="User Icon" src="{{$user->logo or url('/images/user.png') }}" class="user-logo">
                    </span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<ul id="user-dropdown" class="dropdown-content">
    <li>
        <a href="{{ route('user.show', ['user' => $user->user_id]) }}" class="waves-effect">
            <i class="material-icons left">account_box</i>
            Profile
        </a>
    <li>
        <a class="waves-effect" href="{{ route('auth.signout') }}">
            <span class="material-icons material-icons-lg left">exit_to_app</span>
            Sign Out
        </a>
    </li>
</ul>