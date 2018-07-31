{# widgets(region, place) #}
{% set widgetsHere = (helper.content['widgets'][region][place] is defined) ? helper.content['widgets'][region][place] : [] %}

{% if is_array(widgetsHere) and widgetHere|length > 0 %}
    <div class="ilya-widgets-{{ region }} ilya-widgets-{{ region }}-{{ place }}">

    {% for module in widgetsHere %}
        <div class="ilya-widget-{{ region }} ilya-widget-{{ region }}-{{ place }}">
            {{ module.output_widget(region, place, helper, helper.template, helper.request, helper.content) }}
        </div>
    {% endfor %}

    {{ helper.output('</div>', '') }}
{% endif %}