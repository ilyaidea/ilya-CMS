<div class="pcoded-main-container">
    <div class="pcoded-wrapper">

        {#{{ partial('main-container/sidebar/sidebar') }}#}

        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div></div>
                <div class="main-body">
                    <div class="page-wrapper">
                        {#{{ helper.widgets('main', 'top') }}#}
                        <div class="page-header">
                            <span>{{ 'title' }}</span>
                        </div>
                        <div class="page-body">
                            {{ content() }}
                        </div>
                        {#{{ helper.widgets('main', 'bottom') }}#}
                    </div>

                    {#<div id="styleSelector">#}

                    {#</div>#}
                </div>
            </div>
        </div>

    </div>
</div>