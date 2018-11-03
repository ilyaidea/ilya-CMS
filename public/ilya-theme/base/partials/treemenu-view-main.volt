{# treemenu-view-main(key, data) #}
<div class="ilya-q-view-main">
    {% if data['main_form_tags'] is defined %}
        <form {{ data['main_form_tags'] }}>
    {% endif %}

    <div id="{{ 'ilya_body_'~key }}"></div>
    {{ partial('treemenu_view_buttons', ['data': data]) }}

    {% if data['main_form_tags'] is defined %}
        {% if data['buttons_form_hidden'] is defined %}
            {{ partial('form-hidden-elements', ['hidden': data['buttons_form_hidden']]) }}
        {% endif %}
        </form>
    {% endif %}

    {% for key,value in data %}
        {% if (strpos(key, 'form_') === 0) %}
            {{ partial('c-form', ['form': value]) }}
        {% endif %}
    {% endfor %}
</div>