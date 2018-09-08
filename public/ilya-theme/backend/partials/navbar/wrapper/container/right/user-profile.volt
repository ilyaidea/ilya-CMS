<li class="user-profile header-notification">
    <a href="#!">
        <img src="{{ url.get() }}ilya-theme/backend/assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
        <span>{{ session.get('auth').username }}</span>
        <i class="ti-angle-down"></i>
    </a>
    <ul class="show-notification profile-notification">
        <li>
            <a href="#">
                <i class="ti-settings"></i> Settings
            </a>
        </li>
        <li>
            <a href="#">
                <i class="ti-user"></i> Profile
            </a>
        </li>
        <li>
            <a href="#">
                <i class="ti-email"></i> My Messages
            </a>
        </li>
        <li>
            <a href="#">
                <i class="ti-lock"></i> Lock Screen
            </a>
        </li>
        <li>
            <a href="{{ url.get('logout') }}">
                <i class="ti-layout-sidebar-left"></i> Logout
            </a>
        </li>
    </ul>
</li>