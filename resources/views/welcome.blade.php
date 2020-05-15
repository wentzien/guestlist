@extends('layouts.app')

@section('content')
    <style>
        .not-displayed {
            display: none;
        }

        .fixed-top {
            position: fixed;
            top: 0;
        }
        .progress-b {
            display: flex;
            height: 1rem;
            overflow: hidden;
            line-height: 0;
            font-size: 0.675rem;
            background-color: #e9ecef;
            border-radius: 0.25rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 60px;
        }
    </style>

    {{--    wird nicht angezeigt--}}
    <div class="not-displayed">
        <figure>
            <video id="video"></video>
            <figcaption>Live Video</figcaption>
        </figure>

        <figure>
            <canvas id="motion"></canvas>
            <figcaption>
                Motion Heatmap<br>
            </figcaption>
        </figure>
    </div>

    <div class="fixed-top reveal">
        <div class="slides">
            <section>
                <h1 class="center">Herzlich Willkommen!</h1>
                <p>Bitte einmal winken...</p>
                <div class="progress-b">
                    <div id="progressMotion" class="progress-bar" role="progressbar" style="width: 100%"
                         aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
            </section>
            <section>
                <h1 class="center">Welcome!</h1>
                <p>Please wave once...</p>
                <div class="progress-b">
                    <div id="progressMotion" class="progress-bar" role="progressbar" style="width: 100%"
                         aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
            </section>
            <section>
                <h1 class="center">Bienvenidos!</h1>
                <p>Por favor saluda una vez...</p>
                <div class="progress-b">
                    <div id="progressMotion" class="progress-bar" role="progressbar" style="width: 100%"
                         aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
            </section>
            <section>
                <h1 class="center">Benvenuto!</h1>
                <p>Per favore saluta una volta...</p>
                <div class="progress-b">
                    <div id="progressMotion" class="progress-bar" role="progressbar" style="width: 100%"
                         aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
            </section>
        </div>
    </div>

    <script src="/revealjs/js/reveal.js"></script>
    <script>
        // More info about config & dependencies:
        // - https://github.com/hakimel/reveal.js#configuration
        // - https://github.com/hakimel/reveal.js#dependencies
        Reveal.initialize({
            hash: false,
            loop: true,
            controls: false,
            autoSlide: 5000,
            autoSlideStoppable: false,

        });
        Reveal.shuffle();
    </script>
    <script type="text/javascript" src="/js/plugins/adapter.js"></script>
    <script type="text/javascript" src="/js/plugins/diff-cam-engine.js"></script>
    <script type="text/javascript" src="/js/motion.js"></script>

@endsection
