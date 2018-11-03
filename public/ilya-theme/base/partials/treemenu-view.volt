{# treemenu-view(key, data) #}
{% if data is not empty %}
    {% set class_hidden = '' %}
    {% if data['hidden'] is defined %}
        {% set class_hidden = ' ilya-q-view-hidden' %}
    {% endif %}

    {% set classes = '' %}
    {% if data['classes'] is defined %}
        {% set classes = rtrim(' ', data['classes']) %}
    {% endif %}

    {% set tags = '' %}
    {% if data['tags'] is defined %}
        {% set tags = rtrim(' ', data['tags']) %}
    {% endif %}

    <div class="ilya-q-view{{ class_hidden }}{{ classes }}{{ tags }}">

        {% if data['main_form_tags'] is defined %}
            <form {{ data['main_form_tags'] }}>
        {% endif %}

        {% if data['main_form_tags'] is defined %}
            {% if data['voting_form_hidden'] is defined %}
                {{ partial('form-hidden-elements', ['hidden': data['voting_form_hidden']]) }}
            {% endif %}
            </form>
        {% endif %}

        {{ partial('treemenu-view-main', ['key': key, 'data': data]) }}
    </div>
{% endif %}