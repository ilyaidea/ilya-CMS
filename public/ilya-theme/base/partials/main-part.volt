{# main-part(key, part) #}
{% if (strpos(key, 'form') === 0) %}
    {{ partial('form', ['key': key,'form': part]) }}
{% endif %}

{% if (strpos(key, 'dt') === 0) and part.isSkip() is false%}
    {{ partial('datatable', ['key': key,'datatable': part]) }}
{% endif %}