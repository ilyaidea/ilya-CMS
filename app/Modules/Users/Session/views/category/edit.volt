{%- macro messages(form, nameElem) %}
    {% if (form.hasMessagesFor(nameElem)) %}
        {% for message in form.getMessagesFor(nameElem) %}
            <div style="margin-left: 110px; color: red">{{ message }}</div>
        {% endfor %}
    {% endif %}
{%- endmacro %}
<style type="text/css">
    .form-style-2 {
        max-width: 500px;
        padding: 20px 12px 10px 20px;
        font: 13px Arial, Helvetica, sans-serif;
    }

    .form-style-2-heading {
        font-weight: bold;
        font-style: italic;
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
        font-size: 15px;
        padding-bottom: 3px;
    }

    .form-style-2 label {
        display: block;
        margin: 0px 0px 15px 0px;
    }

    .form-style-2 label > span {
        width: 100px;
        font-weight: bold;
        float: left;
        padding-top: 8px;
        padding-right: 5px;
    }

    .form-style-2 span.required {
        color: red;
    }

    .form-style-2 .tel-number-field {
        width: 40px;
        text-align: center;
    }

    .form-style-2 input.input-field, .form-style-2 .select-field {
        width: 48%;
    }

    .form-style-2 input.input-field,
    .form-style-2 .tel-number-field,
    .form-style-2 .textarea-field,
    .form-style-2 .select-field {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        border: 1px solid #C2C2C2;
        box-shadow: 1px 1px 4px #EBEBEB;
        -moz-box-shadow: 1px 1px 4px #EBEBEB;
        -webkit-box-shadow: 1px 1px 4px #EBEBEB;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        padding: 7px;
        outline: none;
    }

    .form-style-2 .input-field:focus,
    .form-style-2 .tel-number-field:focus,
    .form-style-2 .textarea-field:focus,
    .form-style-2 .select-field:focus {
        border: 1px solid #0C0;
    }

    .form-style-2 .textarea-field {
        height: 100px;
        width: 55%;
    }

    .form-style-2 input[type=submit],
    .form-style-2 input[type=button] {
        border: none;
        padding: 8px 15px 8px 15px;
        background: #FF8500;
        color: #fff;
        box-shadow: 1px 1px 4px #DADADA;
        -moz-box-shadow: 1px 1px 4px #DADADA;
        -webkit-box-shadow: 1px 1px 4px #DADADA;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
    }

    .form-style-2 input[type=submit]:hover,
    .form-style-2 input[type=button]:hover {
        background: #EA7B00;
        color: #fff;
    }
</style>

{{ flash.output() }}
<div class="form-style-2">
    <div class="form-style-2-heading">User Category Fields</div>
    {{ form() }}
    <label for="field1"><span>Title <span class="required">*</span></span>
        {{ form.render('title', ['class': 'input-field']) }}
        {{ messages(form, 'title') }}
    </label>
    <label for="field4"><span>Language</span>
        {{ form.render('lang', ['class': 'select-field']) }}
        {{ messages(form, 'lang') }}
    </label>
    <label for="field1"><span>Position <span class="required">*</span></span>
        {{ form.render('position', ['class': 'input-field']) }}
        {{ messages(form, 'position') }}
    </label>
    <label for="field5"><span>Content <span class="required">*</span></span>
        {{ form.render('content', ['class': 'textarea-field']) }}
        {{ messages(form, 'content') }}
    </label>

    <label><span>&nbsp;</span>
        {{ form.render('Submit') }}
    </label>

    {{ form.render('id') }}
    {{ form.render('csrf', ['value': security.getToken()]) }}
    {{ messages(form, 'csrf') }}
    {{ end_form() }}
</div>