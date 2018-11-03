{# treemenu_view_buttons(data) #}

{% if data['buttons'] is not empty %}
    <div class="ilya-q-view-buttons">
        {{ partial('form', ['form': data['buttons']]) }}
    </div>
{% endif %}