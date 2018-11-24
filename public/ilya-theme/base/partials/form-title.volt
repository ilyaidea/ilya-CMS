{# form_title(form) #}

{% set partTitle = (form.formInfo.title.get() !== null) ? form.formInfo.title.get() : null %}
{% set partTitleTags = (form.formInfo.title.getTags(true) !== null) ? form.formInfo.title.getTags(true) : null %}

{% if (strlen(partTitle)) or (strlen(partTitleTags)) %}
    <h2{{ rtrim(' '~ partTitleTags) }}>{{ partTitle }}</h2>
{% endif %}