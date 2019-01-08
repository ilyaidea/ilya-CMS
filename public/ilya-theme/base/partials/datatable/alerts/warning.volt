{# datatable/alerts/warning( datatable ) #}
{% if datatable.getSibling(prefix) %}
    {% set datatable = datatable.getSibling(prefix) %}
    {% if messages['warning'][datatable.prefix] is defined %}
        {% if messages['warning'][datatable.prefix] is iterable %}
            {% for warning in messages['warning'][datatable.prefix] %}
                <div class="ilya-form-tall-warning" style="display: block;margin-bottom: 10px;">
                    {{ warning }}
                </div>
            {% endfor %}
        {% else %}
            <div class="ilya-form-tall-warning" style="display: block;margin-bottom: 10px;">
                {{ messages['warning'][datatable.prefix] }}
            </div>
        {% endif %}
    {% endif %}
{% else %}
    {% if messages['warning'][datatable.prefix] is defined %}
        {% if messages['warning'][datatable.prefix] is iterable %}
            {% for warning in messages['warning'][datatable.prefix] %}
                <div class="ilya-form-tall-notice" style="display: block;margin-bottom: 10px;">
                    {{ warning }}
                </div>
            {% endfor %}
        {% else %}
            <div class="ilya-form-tall-notice" style="display: block;margin-bottom: 10px;">
                {{ messages['warning'][datatable.prefix] }}
            </div>
        {% endif %}
    {% endif %}
{% endif %}