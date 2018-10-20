{# script_builder(datatablekey, datatable) #}

{% set buttons = 'var buttons = [' %}
{% if datatable['buttons'] is defined and datatable['buttons'] is not empty %}
    {% for button in datatable['buttons'] %}
        {% set buttons = buttons~'{' %}
        {% if button['text'] is defined %}
            {% set buttons = buttons~'"text": "'~button['text']~'",' %}
        {% endif %}
        {% if button['action'] is defined %}
            {% set buttons = buttons~'"action": '~button['action']~'' %}
        {% endif %}
        {% if button['enabled'] is defined and button['enabled'] is not true %}
            {% set buttons = buttons~'"enabled": false' %}
        {% endif %}
        {% set buttons = buttons~'},' %}
    {% endfor %}
    console.log(buttons);
{% else %}
    {% set buttons = buttons~'{},' %}
{% endif %}
{% set buttons = buttons~'];' %}
{{ buttons }}

$(document).ready( function () {
    var {{ datatablekey }} = $('#{{ datatablekey }}').DataTable({
        dom: {{ json_encode(datatable['dom']) }},
        ajax: {{ json_encode(datatable['ajax']) }},
        columns: {{ json_encode(datatable['columns']) }},
        select: {{ json_encode(datatable['select']) }},
        buttons: buttons,
    });


    {% if datatable['event'] is not empty %}
        {% for event in datatable['event'] %}
            {{ datatablekey~event }}
        {% endfor %}
    {% endif %}
} );
