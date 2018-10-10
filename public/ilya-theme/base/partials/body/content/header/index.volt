{# Header in full width top bar #}
{% set class = '' %}
{#{% set class = fixed_topbar ? ' fixed': '' %}#}
<div id="qam-topbar" class="clearfix{{ class }}">
    {#{{ partial('body/header/nav_main_sub') }}#}
</div> <!-- END qam-topbar -->

{#$this->output($this->ask_button());#}
{#$this->qam_search('the-top', 'the-top-search');#}