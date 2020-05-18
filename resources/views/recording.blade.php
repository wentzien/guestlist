@extends('layouts.app')

@section('content')
    <style>
        .not-displayed {
            display: none;
        }

        .fixed-top {
            position: fixed;
            top: 0;
            z-index: 1;
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

    <div class="fixed-top reveal">
        <div class="slides">
            <section data-audio-text="Liebe Gäste, auf Grund der aktuellen Corona-Auflagen sind wir verpflichtet ihre Kontaktdaten zu erfassen. Bitte sprechen sie gleich, wenn der rote Punkt erscheint ihren Namen und wie sie zu erreichen sind. Vielen Dank.">
                <h2>Liebe Gäste,</h2>
                <p>auf Grund der aktuellen Corona-Auflagen sind wir verpflichtet Ihre Kontaktdaten zu erfassen.</p>
                <p>Bitte sprechen Sie gleich, wenn der rote Punkt erscheint Ihren Namen und wie Sie zu erreichen sind.</p>
                <p>Vielen Dank!</p>
            </section>
            <section>
                <div id="recording" class="spinner-grow text-danger" role="status" style="width: 150px; height: 150px; margin-top: 60px">
                    <span class="sr-only">Loading...</span>
                </div>
            </section>
            <!--        <section>Slide 2</section>-->
        </div>
    </div>

    <script src="/revealjs/js/reveal.js"></script>

    <script>
        // More info about config & dependencies:
        // - https://github.com/hakimel/reveal.js#configuration
        // - https://github.com/hakimel/reveal.js#dependencies
        Reveal.initialize({
            hash: true,
            dependencies: [
                //	audio-Slideshow Plugins
                { src: '/revealjs/plugin/audio-slideshow/RecordRTC.js', condition: function( ) { return !!document.body.classList; } },
                { src: '/revealjs/plugin/audio-slideshow/slideshow-recorder.js', condition: function( ) { return !!document.body.classList; } },
                { src: '/revealjs/plugin/audio-slideshow/audio-slideshow.js', condition: function( ) { return !!document.body.classList; } }
            ],
            audio: {
                // prefix: 'audio/', 	// audio files are stored in the "audio" folder
                suffix: '.ogg',		// audio files have the ".ogg" ending
                textToSpeechURL: "http://api.voicerss.org/?key=cfd596fcbbe34564ac52a71af9aa3de1&hl=de-de&c=ogg&src=",  // the URL to the text to speech converter
                // textToSpeechURL: "https://translate.google.com/translate_tts?ie=UFT-8&tl=de&client=gtx&q=",  // the URL to the text to speech converter
                autoplay: true,	// automatically start slideshow
            },
            keyboard: {
                82: function () {
                    Recorder.toggleRecording();
                },	// press 'r' to start/stop recording
                90: function () {
                    Recorder.downloadZip();
                }, 	// press 'z' to download zip containing audio files
            }
        });
    </script>
@endsection
