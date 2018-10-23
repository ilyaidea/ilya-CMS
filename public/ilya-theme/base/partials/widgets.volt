{# widgets(region, place) #}
{#{% set widgetsHere = (helper.content['widgets'][region][place] is defined) ? helper.content['widgets'][region][place] : [] %}#}
{% set widgetsHere =
    (helper.content().getContent().getParts('widgets')[region][place] is not empty) ?
    helper.content().getContent().getParts('widgets')[region][place] :
    []
%}

{% if (strpos(region, 'side')) !== false %}
    {% set newRegion = 'side' %}
{% else %}
    {% set newRegion = region %}
{% endif %}

{% if widgetsHere is not empty %}
    <div class="ilya-widgets-{{ newRegion }} ilya-widgets-{{ newRegion }}-{{ place }}">

    {% for module in widgetsHere %}
        <div class="ilya-widget-{{ newRegion }} ilya-widget-{{ newRegion }}-{{ place }}">
            {% set options = ['region': region, 'place': place] %}
            {{ helper.widget(module).run(options) }}
        </div>
    {% endfor %}

    </div>
{% endif %}