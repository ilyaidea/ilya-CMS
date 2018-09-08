<ul class="nav-right">
    {% if languages_disabled is not defined %}
        {{ partial('navbar/wrapper/container/right/languages') }}
    {% endif %}
    <li class="header-notification">
        <a href="#!">
            <i class="ti-bell"></i>
            <span class="badge bg-c-pink"></span>
        </a>
        <ul class="show-notification">
            <li>
                <h6>Notifications</h6>
                <label class="label label-danger">New</label>
            </li>
            <li>
                <div class="media">
                    <img class="d-flex align-self-center img-radius" src="{{ url.get() }}ilya-theme/backend/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="notification-user">John Doe</h5>
                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                        <span class="notification-time">30 minutes ago</span>
                    </div>
                </div>
            </li>
            <li>
                <div class="media">
                    <img class="d-flex align-self-center img-radius" src="{{ url.get() }}ilya-theme/backend/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="notification-user">Joseph William</h5>
                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                        <span class="notification-time">30 minutes ago</span>
                    </div>
                </div>
            </li>
            <li>
                <div class="media">
                    <img class="d-flex align-self-center img-radius" src="{{ url.get() }}ilya-theme/backend/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="notification-user">Sara Soudein</h5>
                        <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                        <span class="notification-time">30 minutes ago</span>
                    </div>
                </div>
            </li>
        </ul>
    </li>
    {{ partial('navbar/wrapper/container/right/chatbox') }}
    {{ partial('navbar/wrapper/container/right/user-profile') }}
</ul>