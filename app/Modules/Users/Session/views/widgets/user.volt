<h3>{{ name }}</h3>
{% if auth.isLoggedIn()%}
    {{ tag_html("button", ["type":"submit","class": "btn btn-primary"]) }}
    <a href='{{ url('logout')~'?to='~router.getRewriteUri() }}' title='{{ "logout" }}'>
        {{ 'logout' }}
    </a>
{% else %}
{{ tag_html("button", ["type":"submit","class": "btn btn-primary" ]) }}

<a href='{{ url('register')~'?to='~router.getRewriteUri() }}' title='{{ "Register" }}'>
    {{ 'Register' }}
</a>
    <br>
{{ tag_html("button", ["type":"submit","class": "btn btn-primary"]) }}
<a href='{{ url('login')~'?to='~router.getRewriteUri() }}' title='{{ "login" }}'>
    {{ 'login' }}
</a>

{{ tag_html_close("button") }}
{% endif  %}
