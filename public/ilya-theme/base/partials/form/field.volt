{# form_field(field, style) #}
{{ partial('form/prefix', ['field': field, 'style': style]) }}

{% if field['html_prefix'] is defined %}
    {{ field['html_prefix'] }}
{% endif %}

{% if field['type'] is defined %}
    {% switch field['type'] %}
        {% case "check" %}
            {{ partial('form/checkbox', ['field':field, 'style': style]) }}
            {% break %}

        {% case "static" %}
            {{ partial('form/static', ['field':field, 'style': style]) }}
            {% break %}

        {% case "password" %}
            {{ partial('form/password', ['field':field, 'style': style]) }}
            {% break %}

        {% case "numeric" %}
            {{ partial('form/numeric', ['field':field, 'style': style]) }}
            {% break %}

        {% case "file" %}
            {{ partial('form/file', ['field':field, 'style': style]) }}
            {% break %}

        {% case "select" %}
            {{ partial('form/select', ['field':field, 'style': style]) }}
            {% break %}

        {% case "radio" %}
            {{ partial('form/radio', ['field':field, 'style': style]) }}
            {% break %}

        {% case "image" %}
            {{ partial('form/image', ['field':field, 'style': style]) }}
            {% break %}

        {% case "custom" %}
                {{ helper.output_raw(field['html']) }}
            {% break %}

        {% default %}
                {% if field['type'] == 'textarea' or ( field['rows'] is defined and field['rows'] > 1) %}
                    {{ partial('form/text_multi_row', ['field':field, 'style': style]) }}
                {% else %}
                    {{ partial('form/text_single_row', ['field':field, 'style': style]) }}
                {% endif %}
            {% break %}
    {% endswitch %}
{% endif %}