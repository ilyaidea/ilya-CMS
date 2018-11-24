{# form(form) #}

{% if part is not empty %}

    {{ partial('form-title', ['form': form]) }}

    {% if form.formInfo.getTags() is not empty %}
        <form {{ form.formInfo.getTags(true) }}>
    {% endif %}

    {{ partial('form-body', ['form': form]) }}

    {% if form.formInfo.getTags() is not empty %}
        </form>
    {% endif %}

{% endif %}