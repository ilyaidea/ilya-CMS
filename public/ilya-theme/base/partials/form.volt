{# form(form) #}
{% if form is not empty %}

    {{ partial('form_title', ['part', form]) }}

    {% if form['tags'] is defined %}
        <form {{ form['tags'] }}>
    {% endif %}

    {{ partial('form_body', ['form': form]) }}

    {% if form['tags'] is defined %}
        </form>
    {% endif %}
{% endif %}