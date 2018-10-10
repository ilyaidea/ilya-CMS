<div class="ilya-main">
    {{ flash.output() }}
    {#{{ partial(
        'common/widgets',
        [
            'region': 'main',
            'place' : 'top'
        ]
    ) }}#}
    {# page_title_error #}

    {#{{ partial(
        'common/widgets',
        [
            'region': 'main',
            'place' : 'high'
        ]
    ) }}#}

    {{ partial('body/content/main/main_parts') }}

    {#{{ partial(
        'common/widgets',
        [
            'region': 'main',
            'place' : 'low'
        ]
    ) }}#}

    {# page_links() #}
    {# $this->suggest_next(); #}

    {#{{ partial(
        'common/widgets',
        [
            'region': 'main',
            'place' : 'bottom'
        ]
    ) }}#}

</div> <!-- END ilya-main -->