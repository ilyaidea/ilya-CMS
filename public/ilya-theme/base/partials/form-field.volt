{# form_field(field, style) #}
{{ partial('form-prefix', ['field': field, 'style': style]) }}

{% if field.getUserOption('html_prefix') !== null %}
    {{ field.getUserOption('html_prefix') }}
{% endif %}

{% if field.getAttributes('type') is not null %}
    {% switch field.getAttributes('type') %}
        {% case "checkbox" %}
            {{ partial('form-checkbox', ['field':field, 'style': style]) }}
            {% break %}

        {% case "static" %}
            {{ partial('form-static', ['field':field, 'style': style]) }}
            {% break %}

        {% case "password" %}
            {{ partial('form-password', ['field':field, 'style': style]) }}
            {% break %}

        {% case "numeric" %}
            {{ partial('form-numeric', ['field':field, 'style': style]) }}
            {% break %}

        {% case "file" %}
            {{ partial('form-file', ['field':field, 'style': style]) }}
            {% break %}

        {% case "select" %}
            {{ partial('form-select', ['field':field, 'style': style]) }}
            {% break %}

        {% case "radio" %}
            {{ partial('form-radio', ['field':field, 'style': style]) }}
            {% break %}

        {% case "image" %}
            {{ partial('form-image', ['field':field, 'style': style]) }}
            {% break %}

        {% case "custom" %}
                {{ helper.output_raw(field.getUserOption('html')) }}
            {% break %}

        {% default %}
                {% if (field.getAttributes('type') == 'textarea' or ( field.getAttributes('rows') !== null and field.getAttributes('rows') > 1)) %}
                    {{ partial('form-text-multi-row', ['field':field, 'style': style]) }}
                {% else %}
                    {{ partial('form-text-single-row', ['field':field, 'style': style]) }}
                {% endif %}
            {% break %}
    {% endswitch %}
{% endif %}