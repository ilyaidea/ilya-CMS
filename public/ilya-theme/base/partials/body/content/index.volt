{{ partial('body/prefix') }}
{{ partial('body/notices') }}

{{ helper.output(
        '<div class="qa-body-wrapper">',
        ''
    )
}}

{{ partial(
    'common/widgets',
    [
        'region': 'full',
        'place' : 'top'
    ]
) }}

{{ partial('body/header') }}

{{ partial(
    'common/widgets',
    [
        'region': 'full',
        'place' : 'high'
    ]
) }}