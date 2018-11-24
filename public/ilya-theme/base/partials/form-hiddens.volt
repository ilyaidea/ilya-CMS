{# form_hiddens(form) #}
{% if form.elements.hasHidden() %}
    {{ partial('form-hidden-elements', ['hiddens': form.elements.getHiddens()]) }}
{% endif %}