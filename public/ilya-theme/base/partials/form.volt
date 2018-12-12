{# form(key, form) #}
{% if helper.partDiv(key) %}
    {% set class = 'ilya-part-'~ strtr(key, '_', '-') %}
    {% set id = 'part_'~key %}

    <div class="{{ class }}" id="{{ id }}">
{% endif %}

    {% if part is not empty %}

        {{ partial('form-title', ['form': form]) }}

        {% if form.formInfo.getTags() is not empty %}
            <form {{ form.formInfo.getTags(true) }}>
        {% endif %}

        {{ partial('form-body', ['form': form]) }}

        {% if form.formInfo.getTags() is not empty %}
            </form>
        {% endif %}

    {% endif %}

{% if helper.partDiv(key) %}
    </div>
{% endif %}