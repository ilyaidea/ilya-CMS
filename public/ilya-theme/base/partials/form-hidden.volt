{# form_hidden(form) #}
{% if form['hidden'] is defined %}
    {{ partial('form-hidden-elements', ['hidden': form['hidden']]) }}
{% endif %}