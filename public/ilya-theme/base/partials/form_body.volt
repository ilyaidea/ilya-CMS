{# form_body(form) #}
{% if form['boxed'] is defined %}
    <div class="ilya-form-table-boxed">
{% endif %}

    {% if (form['ok'] is defined) or (form['fields'] is not empty) %}
        {% set columns = (form['style'] == 'wide') ? 2 : 1 %}
    {% else %}
        {% set columns = 0 %}
    {% endif %}

    {% if columns is not 0 %}
            <table class="ilya-form-{{ form['style'] }}-table">
    {% endif %}

        {{ partial('form_ok', ['form':form, 'columns':columns]) }}
        {{ partial('form_error', ['form':form, 'columns':columns]) }}
        {{ partial('form_fields', ['form':form, 'columns':columns]) }}
        {{ partial('form_buttons', ['form':form, 'columns':columns]) }}

    {% if columns is true %}
        </table>
    {% endif %}

        {{ partial('form_hidden', ['form':form]) }}

{% if form['boxed'] is defined %}
    </div>
{% endif %}