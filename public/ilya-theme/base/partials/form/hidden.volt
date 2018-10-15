{# form_hidden(form) #}
{% if form['hidden'] is defined %}
    {{ partial('form/hidden_elements', ['hidden': form['hidden']]) }}
{% endif %}