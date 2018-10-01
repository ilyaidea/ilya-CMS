<!DOCTYPE html>
<html class="">
<head>
    <meta charset="utf-8">
    <title>Refactoring topic</title>
    <link rel="stylesheet" type="text/css" href="{{ static_url('ilya-theme/backend/assets/courses/css/public.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ static_url('ilya-theme/backend/assets/courses/css/home.css') }}">

    <!-- CodeMirror is a single must-have requirement -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.15.2/codemirror.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.15.2/addon/search/searchcursor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.15.2/addon/edit/matchbrackets.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.15.2/addon/runmode/runmode.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.15.2/addon/hint/show-hint.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.15.2/mode/clike/clike.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.15.2/mode/php/php.js"></script>

    <!-- jQuery and Underscore are also required -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

    <!-- Required for diff:true option -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/diff_match_patch/20121119/diff_match_patch.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.15.2/addon/merge/merge.js"></script>

    <!-- Required for tooltips and general styling -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"  crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"  crossorigin="anonymous"></script>

    <!-- CodePlayer files -->
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/codeplayer.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/class.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/compile.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/indent.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/jumpTo.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/moveTo.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/popover.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/run.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/select.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/setStep.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/type.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/wait.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/utils/syntax.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/type-protection.js') }}"></script>
    <script src="{{ static_url('ilya-theme/backend/assets/courses/codeplayer/src/actions/edit_form.js') }}"></script>

    <style>
        .codeplayer-roadmap {
            direction: rtl;
        }
        .tooltip .tooltip-inner {
            text-align: right;
        }
    </style>

</head>
<body class="locale-en page-slides">
<div id="app">
    <div class="app-content">
        <div class="content container-fluid">
            <div id="presenter" class="pane pt-page-current">
                <nav class="navbar navbar-light bg-faded transparent">
                    <ul class="nav navbar-nav pull-left">
                        <li class="active nav-item">
                            {% if next_link is defined %}
                                <a href="{{ next_link }}" class="nav-link link-prev">
                                    <i class="fa fa-chevron-left"></i><span data-text="btn_back"
                                                                            data-locale="en">Back</span>
                                </a>
                            {% endif %}
                        </li>
                    </ul>

                    <ul class="nav navbar-nav pull-right">
                        <li class="non-active nav-item">
                            {% if prev_link is defined %}
                                <a href="{{ prev_link }}" class="nav-link link-next">
                                    <span data-text="btn_next" data-locale="en">Next</span><i
                                            class="fa fa-chevron-right"></i>
                                </a>
                            {% endif %}
                        </li>
                    </ul>

                    <div class="nav-title">
                        <a href="#" class="nav-link item link-storyline">
                            <i class="fa fa-align-justify"></i><span data-text="btn_storyline" data-locale="en">الگوهای طراحی</span>
                        </a>
                        <span class="item divider"><i class="fa fa-angle-double-left"></i></span>
                        <span class="item topic-title">SingleTon</span>
                    </div>
                </nav>
                <article class="slides bespoke-parent ready" id="slides" style="">
                    {{ content() }}
                </article>
                <div class="bespoke-progress-parent"><div class="bespoke-progress-bar" style="width: {{ progress_bar }}%;"></div></div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.practice.bespoke-slide.bespoke-active').empty();
    $('.practice.bespoke-slide.bespoke-active').append('<div class="section-content">\n' +
        '<figure class="image"><img src="{{ static_url("ilya-theme/backend/assets/courses/img/practice.svg") }}">'+
        '</figure><h1>دیگه وقت تمرینه!</h1>\n' +
        '</div>');
    $('.live_example.bespoke-slide.bespoke-active .section-content').append('<div id="codeplayer"></div>')
    $('.live_example.bespoke-slide.bespoke-active .section-content').find('#codeplayer').each(function () {
        var div1 = $('#codeplayer');
        $.getJSON('{{ json_practice }}', function (data) {
            CodeMirror.player.create(div1, data, {
                diff: true,
                translation: {
                    "Play": "شروع",
                    "Replay": "شروع مجدد",
                    "Next": "گام بعدی",
                    "Back": "گام قبلی",
                    "Stop": "توقف",
                    "Click on these blue things to continue.": "برای ادامه آموزش بر روی دیالوگ آبی رنگ کلیک نمایید.",
                    "Show difference": "دیدن تغییرات کد",
                    "Compile and test": "تست و کامپایل"
                }
            });
        });
    });

</script>
<script src="{{ static_url('ilya-theme/backend/assets/courses/instantclick/instantclick.min.js') }}" data-no-instant></script>
<script data-no-instant>
    InstantClick.init();
</script>
</body>
</html>