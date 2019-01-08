{# datatable/alerts/success( datatable ) #}
{% if datatable.getSibling(prefix) %}
    {% set datatable = datatable.getSibling(prefix) %}
    {% if messages['success'][datatable.prefix] is defined %}
        {% if messages['success'][datatable.prefix] is iterable %}
            {% for success in messages['success'][datatable.prefix] %}
                <div class="ilya-form-tall-ok" style="display: block;margin-bottom: 10px;">
                    {{ success }}
                </div>
            {% endfor %}
        {% else %}
            <div class="ilya-form-tall-ok" style="display: block;margin-bottom: 10px;">
                {{ messages['success'][datatable.prefix] }}
            </div>
        {% endif %}
    {% endif %}
{% else %}
    {% if messages['success'][datatable.prefix] is defined %}
        {% if messages['success'][datatable.prefix] is iterable %}
            {% for success in messages['success'][datatable.prefix] %}
                <div class="ilya-form-tall-ok" style="display: block;margin-bottom: 10px;">
                    {{ success }}
                </div>
            {% endfor %}
        {% else %}
            <div class="ilya-form-tall-ok" style="display: block;margin-bottom: 10px;">
                {{ messages['success'][datatable.prefix] }}
            </div>
        {% endif %}
    {% endif %}
{% endif %}