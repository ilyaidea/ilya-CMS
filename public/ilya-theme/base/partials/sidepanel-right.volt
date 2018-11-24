{# sidepanel() #}

{% if theme.hasRightSide() %}
    {# remove sidebar for user profile pages #}
    {% if helper.getTemplate() is not empty and helper.getTemplate()['name'] !== 'session' %}
        <div id="qam-sidepanel-right-toggle"><i class="icon-left-open-big"></i></div>
        <div class="ilya-sidepanel-right" id="qam-sidepanel-right-mobile">

            {#{{ partial('qam_search') }}#}
            {#{{ partial(
                'widgets',
                [
                    'region': 'side1',
                    'place' : 'top'
                ]
            ) }}#}
            {#{{ partial('sidebar') }}#}

            {#{{ partial(
                'widgets',
                [
                    'region': 'side1',
                    'place' : 'high'
                ]
            ) }}

            {{ partial(
                'widgets',
                [
                    'region': 'side1',
                    'place' : 'low'
                ]
            ) }}

            {{ partial(
                'widgets',
                [
                    'region': 'side1',
                    'place' : 'bottom'
                ]
            ) }}#}

        </div> <!-- qa-sidepanel -->
    {% endif %}
{% endif %}
