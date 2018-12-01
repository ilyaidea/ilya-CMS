{# form_field(field, style) #}
{{ partial('form-prefix', ['field': field, 'style': style]) }}

{% if field.getUserOption('html_prefix') !== null %}
    {{ field.getUserOption('html_prefix') }}
{% endif %}

{% if field.getAttributes('type') is not null %}
    {% switch field.getAttributes('type') %}
        {% case "checkbox" %}
            {{ partial('form/fields/checkbox', ['field':field, 'style': style]) }}
            {% break %}
        {% case "color" %}
            {{ partial('form/fields/color', ['field':field, 'style': style]) }}
        {% break %}

        {% case "datetime" %}
            {{ partial('form/fields/datetime', ['field':field, 'style': style]) }}
        {% break %}

        {% case "datetime-local" %}
            {{ partial('form/fields/datetime-local', ['field':field, 'style': style]) }}
        {% break %}

        {% case "month" %}
            {{ partial('form/fields/month', ['field':field, 'style': style]) }}
        {% break %}

        {% case "radiogroup" %}
            {{ partial('form/fields/radiogroup', ['field':field, 'style': style]) }}
        {% break %}

        {% case "range" %}
            {{ partial('form/fields/range', ['field':field, 'style': style]) }}
        {% break %}

        {% case "search" %}
            {{ partial('form/fields/search', ['field':field, 'style': style]) }}
        {% break %}

        {% case "tel" %}
            {{ partial('form/fields/tel', ['field':field, 'style': style]) }}
        {% break %}

        {% case "time" %}
            {{ partial('form/fields/time', ['field':field, 'style': style]) }}
        {% break %}

        {% case "url" %}
            {{ partial('form/fields/url', ['field':field, 'style': style]) }}
        {% break %}

        {% case "week" %}
            {{ partial('form/fields/week', ['field':field, 'style': style]) }}
        {% break %}


    {% case "static" %}
            {{ partial('form/fields/static', ['field':field, 'style': style]) }}
            {% break %}

        {% case "password" %}
            {{ partial('form/fields/password', ['field':field, 'style': style]) }}
            {% break %}

        {% case "numeric" %}
            {{ partial('form/fields/numeric', ['field':field, 'style': style]) }}
            {% break %}

        {% case "file" %}
            {{ partial('form/fields/file', ['field':field, 'style': style]) }}
            {% break %}

        {% case "select" %}
            {{ partial('form/fields/select', ['field':field, 'style': style]) }}
            {% break %}

        {% case "radio" %}
            {{ partial('form/fields/radio', ['field':field, 'style': style]) }}
            {% break %}

        {% case "image" %}
            {{ partial('form/fields/image', ['field':field, 'style': style]) }}
            {% break %}

        {% case "custom" %}
                {{ helper.output_raw(field.getUserOption('html')) }}
            {% break %}

        {% default %}
                {% if (field.getAttributes('type') == 'textarea' or ( field.getAttributes('rows') !== null and field.getAttributes('rows') > 1)) %}
                    {{ partial('form/fields/textarea', ['field':field, 'style': style]) }}
                {% else %}
                    {{ partial('form/fields/text', ['field':field, 'style': style]) }}
                {% endif %}
            {% break %}
    {% endswitch %}
{% endif %}