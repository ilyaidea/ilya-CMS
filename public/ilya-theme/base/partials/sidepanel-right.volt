{# sidepanel() #}

{% if theme.hasRightSide() %}
    {# remove sidebar for user profile pages #}
    {% if content.getTemplate() is not empty and content.getTemplate() %}
        <div id="qam-sidepanel-right-toggle"><i class="icon-left-open-big"></i></div>
        <div class="ilya-sidepanel-right" id="qam-sidepanel-right-mobile">

            <hr>
            {#{{ partial('qam_search') }}#}
            {{ partial(
                'widgets',
                [
                    'region': 'side1',
                    'place' : 'top'
                ]
            ) }}
            <hr>
            {#{{ partial('sidebar') }}#}

            {{ partial(
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
            ) }}

        </div> <!-- qa-sidepanel -->
    {% endif %}
{% endif %}
