{# datatable/alerts/notice( datatable ) #}
{% if datatable.getSibling(prefix) %}
    {% set datatable = datatable.getSibling(prefix) %}
    {% if messages['notice'][datatable.prefix] is defined %}
        {% if messages['notice'][datatable.prefix] is iterable %}
            {% for notice in messages['notice'][datatable.prefix] %}
                <div class="ilya-form-tall-notice" style="display: block;margin-bottom: 10px;">
                    {{ notice }}
                </div>
            {% endfor %}
        {% else %}
            <div class="ilya-form-tall-notice" style="display: block;margin-bottom: 10px;">
                {{ messages['notice'][datatable.prefix] }}
            </div>
        {% endif %}
    {% endif %}
{% else %}
    {% if messages['notice'][datatable.prefix] is defined %}
        {% if messages['notice'][datatable.prefix] is iterable %}
            {% for notice in messages['notice'][datatable.prefix] %}
                <div class="ilya-form-tall-notice" style="display: block;margin-bottom: 10px;">
                    {{ notice }}
                </div>
            {% endfor %}
        {% else %}
            <div class="ilya-form-tall-notice" style="display: block;margin-bottom: 10px;">
                {{ messages['error'][datatable.prefix] }}
            </div>
        {% endif %}
    {% endif %}
{% endif %}