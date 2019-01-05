{% if tag.getHeadLines() is not empty %}
    {% for line in tag.getHeadLines() %}
        {{ line }}
    {% endfor %}
{% endif %}