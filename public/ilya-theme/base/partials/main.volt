{% if content['theme']['sideMain'] is true %}
    <div class="ilya-main">
        {{ flash.output() }}
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

        {# page_links() #}
        {# $this->suggest_next(); #}

        {{ partial(
            'widgets',
            [
                'region': 'main',
                'place' : 'bottom'
            ]
        ) }}

    </div> <!-- END ilya-main -->
{% endif %}