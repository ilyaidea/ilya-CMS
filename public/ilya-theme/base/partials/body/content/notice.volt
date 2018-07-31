<div class="qa-notice" id="{{ notice['id'] }}">

    {% if notice['form_tags'] is defined %}
        <form {{ notice['form_tags'] }}>
    {% endif %}

    {{ helper.output_raw(notice['content']) }}

    <input {{ notice['close_tags'] }} type="submit" value="X" class="qa-notice-close-button"/>

    {% if notice['form_tags'] is defined %}
        {{ partial(
            'common/form/hidden/elements',
            [
                'hidden': notice['form_hidden']
            ]
        )}}
        </form>
    {% endif %}

</div>