{# form_button_note(button, style) #}
{% if button['note'] is not empty %}
    <span class="ilya-form-{{ style }}-note">
    {{ button['note'] }}
    </span>
    <br/>
{% endif %}