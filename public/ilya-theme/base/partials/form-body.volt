{# form_body(form) #}

{% if form.design.isBoxed() is true %}
    <div class="ilya-form-table-boxed">
{% endif %}

        {% if form.design.getColumns() is not 0 %}
            <table class="ilya-form-{{ form.design.getStyle() }}-table">
        {% endif %}

                {{ partial('form/alerts/success', ['form': form]) }}
                {{ partial('form/alerts/notice', ['form': form]) }}
                {{ partial('form/alerts/warning', ['form': form]) }}
                {{ partial('form/alerts/error', ['form': form]) }}
                {{ partial('form-fields', ['form': form]) }}
                {{ partial('form-buttons', ['form': form]) }}

        {% if form.design.getColumns() is not 0 %}
            </table>
        {% endif %}

        {{ partial('form/view-buttons', ['form': form]) }}

        {{ partial('form-hiddens', ['form': form]) }}

{% if form.design.isBoxed() is true %}
    </div> <!-- end form body box -->
{% endif %}