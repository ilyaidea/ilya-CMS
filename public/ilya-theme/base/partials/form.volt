{# form(form) #}

{% if form is not empty %}

    {{ partial('form/title', ['part', form]) }}

    {% if form['tags'] is defined %}
        <form {{ form['tags'] }}>
    {% endif %}

    {{ partial('form/body', ['form': form]) }}

    {% if form['tags'] is defined %}
        </form>
    {% endif %}
{% endif %}