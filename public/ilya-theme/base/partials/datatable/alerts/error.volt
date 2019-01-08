{# datatable/alerts/error( datatable ) #}
{% if datatable.getSibling(prefix) %}
    {% set datatable = datatable.getSibling(prefix) %}
    {% if messages['error'][datatable.prefix] is defined %}
        {% if messages['error'][datatable.prefix] is iterable %}
            {% for error in messages['error'][datatable.prefix] %}
                <div class="ilya-form-tall-error" style="display: block;margin-bottom: 10px;">
                    {{ error }}
                </div>
            {% endfor %}
        {% else %}
            <div class="ilya-form-tall-error" style="display: block;margin-bottom: 10px;">
                {{ messages['error'][datatable.prefix] }}
            </div>
        {% endif %}
    {% endif %}
{% else %}
    {% if messages['error'][datatable.prefix] is defined %}
        {% if messages['error'][datatable.prefix] is iterable %}
            {% for error in messages['error'][datatable.prefix] %}
                <div class="ilya-form-tall-error" style="display: block;margin-bottom: 10px;">
                    {{ error }}
                </div>
            {% endfor %}
        {% else %}
            <div class="ilya-form-tall-error" style="display: block;margin-bottom: 10px;">
                {{ messages['error'][datatable.prefix] }}
            </div>
        {% endif %}
    {% endif %}
{% endif %}