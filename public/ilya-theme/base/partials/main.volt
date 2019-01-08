<div class="ilya-main">
    {% if messages is not empty %}
        {% for type, message in messages %}
            {% if type == 'success' %}
                {% for key,msg in message %}
                    {% if key is numeric %}
                        <div class="ilya-form-tall-ok" style="display: block; margin-bottom: 5px">{{ msg }}</div>
                    {% endif %}
                {% endfor %}
            {% endif %}
            {% if type == 'error' %}
                {% for key,msg in message %}
                    {% if key is numeric %}
                        <div class="ilya-form-tall-error" style="display: block; margin-bottom: 5px">{{ msg }}</div>
                    {% endif %}
                {% endfor %}
            {% endif %}
            {% if type == 'notice' %}
                {% for key,msg in message %}
                    {% if key is numeric %}
                        <div class="ilya-form-tall-notice" style="display: block; margin-bottom: 5px">{{ msg }}</div>
                    {% endif %}
                {% endfor %}
            {% endif %}
            {% if type == 'warning' %}
                {% for key,msg in message %}
                    {% if key is numeric %}
                        <div class="ilya-form-tall-warning" style="display: block; margin-bottom: 5px">{{ msg }}</div>
                    {% endif %}
                {% endfor %}
            {% endif %}
        {% endfor %}
    {% endif %}

        {{ partial(
            'widgets',
            [
                'region': 'main',
                'place' : 'top'
            ]
        ) }}
        {#page_title_error #}

        {{ partial(
            'widgets',
            [
                'region': 'main',
                'place' : 'high'
            ]
        ) }}

        {{ partial('main-parts') }}

        {{ partial(
            'widgets',
            [
                'region': 'main',
                'place' : 'low'
            ]
        ) }}

         {#page_links()#}
         {#$this->suggest_next(); #}

        {{ partial(
            'widgets',
            [
                'region': 'main',
                'place' : 'bottom'
            ]
        ) }}

</div> <!-- END ilya-main -->