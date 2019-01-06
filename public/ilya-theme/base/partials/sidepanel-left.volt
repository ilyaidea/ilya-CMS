{# sidepanel() #}

{% if theme.hasLeftSide() %}
    {# remove sidebar for user profile pages #}
    {% if content.getTemplate() is not empty and content.getTemplate() %}
        <div id="qam-sidepanel-left-toggle"><i class="icon-right-open-big"></i></div>
        <div class="ilya-sidepanel-left" id="qam-sidepanel-left-mobile">

            <hr>
            {#{{ partial('qam_search') }}#}
            {{ partial(
                'widgets',
                [
                    'region': 'side2',
                    'place' : 'top'
                ]
            ) }}
            {#{{ partial('sidebar') }}#}

            <hr>
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

        </div> <!-- ilya-sidepanel -->
    {% endif %}
{% endif %}
