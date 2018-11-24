{# main-part(key, part) #}
{% if helper.partDiv(key) %}
    {% set class = 'ilya-part-'~ strtr(key, '_', '-') %}
    {% set id = 'part_'~key %}

    <div class="{{ class }}" id="{{ id }}">
{% endif %}

{% if (strpos(key, 'form') === 0) %}
    {{ partial('form', ['form': part]) }}
{% endif %}

{% if (strpos(key, 'dt') === 0) %}
    {{ partial('datatable', ['key': key,'datatable': part]) }}
{% endif %}

{% if helper.partDiv(key) %}
    </div>
{% endif %}