{# form_body(form) #}

{% if form.design.isBoxed() is true %}
    <div class="ilya-form-table-boxed">
{% endif %}

        {% if form.design.getColumns() is not 0 %}
            <table class="ilya-form-{{ form.design.getStyle() }}-table">
        {% endif %}

                {{ partial('form-ok', ['form': form]) }}
                {{ partial('form-error', ['form': form]) }}
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