{{ flash.output() }}
{% if form is defined %}

        {{ form('class': 'md-float-material') }}
        {% for field in form %}
            {% switch field.getAttribute('type') %}
                {% case 'text' %}
                    <div class="input-group">
                        {{ field.render() }}
                        <span class="md-line"></span>
                    </div>
                    {{ partial('forms/flash/message') }}
                    {% break %}
                {% case 'password' %}
                    <div class="input-group">
                        {{ field.render() }}
                        <span class="md-line"></span>
                    </div>
                    {{ partial('forms/flash/message') }}
                    {% break %}
                {% case 'checkbox' %}
                    <div class="row m-t-25 text-left">
                        <div class="col-md-12">
                            <div class="checkbox-fade fade-in-primary">
                                <label>
                                    {{ field.render() }}
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    <span class="text-inverse">{{ field.label() }}</span>
                                </label>
                                {{ partial('forms/flash/message') }}
                            </div>
                        </div>
                    </div>
                    {% break %}
                {% case 'submit' %}
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            {{ field.render() }}
                        </div>
                    </div>
                    {% break %}
            {% endswitch %}

        {% endfor %}

        {{ form.render('csrf', ['value': security.getToken()]) }}
        {% if form.hasMessagesFor('csrf') %}
            {% for message in form.getMessagesFor('csrf') %}
                <div class="messages">
                    <p class="text-danger error">{{ message }}</p>
                </div>
            {% endfor %}
        {% endif %}

        </form>

{% endif %}