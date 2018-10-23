{# sidepanel() #}

{% if content['theme']['sideLeft'] is true %}
    {# remove sidebar for user profile pages #}
    {% if helper.getTemplate() is not empty and helper.getTemplate()['name'] !== 'session' %}
        <div id="qam-sidepanel-left-toggle"><i class="icon-right-open-big"></i></div>
        <div class="ilya-sidepanel-left" id="qam-sidepanel-left-mobile">

            {#{{ partial('qam_search') }}#}
            {{ partial(
                'widgets',
                [
                    'region': 'side2',
                    'place' : 'top'
                ]
            ) }}
            {#{{ partial('sidebar') }}#}

            {{ partial(
                'widgets',
                [
                    'region': 'side2',
                    'place' : 'high'
                ]
            ) }}

            {{ partial(
                'widgets',
                [
                    'region': 'side2',
                    'place' : 'low'
                ]
            ) }}

            {{ partial(
                'widgets',
                [
                    'region': 'side2',
                    'place' : 'bottom'
                ]
            ) }}

        </div> <!-- qa-sidepanel -->
    {% endif %}
{% endif %}
