{{ partial('body/content/prefix') }}
{#{{ partial('body/notices') }}#}

{#{{ partial(
    'common/widgets',
    [
        'region': 'full',
        'place' : 'top'
    ]
) }}#}

{{ partial('body/content/header/index') }}

<div class="ilya-body-wrapper">

{#{{ partial(
    'common/widgets',
    [
        'region': 'full',
        'place' : 'high'
    ]
) }}#}
    <div class="ilya-main-wrapper">
        {{ partial('body/content/main/index') }}
        {#{{ partial('body/content/sidepanel/index') }}#}
    </div> <!-- END main-wrapper -->

</div> <!-- END ilya-body-wrapper -->