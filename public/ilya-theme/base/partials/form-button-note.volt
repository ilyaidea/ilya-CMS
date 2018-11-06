{# form_button_note(button, style) #}
{% if button.getUserOptions()['note'] is defined %}
    <span class="ilya-form-{{ style }}-note">
    {{ button.getUserOptions()['note'] }}
    </span>
    <br/>
{% endif %}