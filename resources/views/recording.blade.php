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
            <section data-audio-text="{{ $text_to_speech }}">
                <h2>{{ $welcome_heading }}</h2>
                <p>{{ $welcome_text }}</p>
            </section>
            <section data-state="record">
                <div id="recording" class="spinner-grow text-danger" role="status" style="width: 150px; height: 150px; margin-top: 60px">
                    <span class="sr-only">Loading...</span>
                </div>

                <div id="progress" class="progress-b" style="margin-top: 60px">
                    <div id="volume" class="progress-bar" role="progressbar" style="width: 100%" aria-valuemin="0" aria-valuemax="1"></div>
                </div>

                <ol id="recordingsList" hidden></ol>
            </section>
            <!--        <section>Slide 2</section>-->
        </div>
    </div>

    <script src="/revealjs/js/reveal.js"></script>
    <script type="text/javascript" src="/js/plugins/adapter.js"></script>
    <script type="text/javascript" src="/js/plugins/recorder.js"></script>
    <script type="text/javascript" src="/js/plugins/soundmeter.js"></script>
    <script type="text/javascript" src="/js/recording.js"></script>
    <script>
        // More info about config & dependencies:
        // - https://github.com/hakimel/reveal.js#configuration
        // - https://github.com/hakimel/reveal.js#dependencies
        Reveal.initialize({
            hash: true,
            dependencies: [
                //	audio-Slideshow Plugins
                // { src: '/revealjs/plugin/audio-slideshow/RecordRTC.js', condition: function( ) { return !!document.body.classList; } },
                // { src: '/revealjs/plugin/audio-slideshow/slideshow-recorder.js', condition: function( ) { return !!document.body.classList; } },
                { src: '/revealjs/plugin/audio-slideshow/audio-slideshow.js', condition: function( ) { return !!document.body.classList; } }
            ],
            audio: {
                // prefix: 'audio/', 	// audio files are stored in the "audio" folder
                suffix: '.ogg',		// audio files have the ".ogg" ending
                textToSpeechURL: "http://api.voicerss.org/?key=cfd596fcbbe34564ac52a71af9aa3de1&hl=de-de&c=ogg&src=",  // the URL to the text to speech converter
                // textToSpeechURL: "https://translate.google.com/translate_tts?ie=UFT-8&tl=de&client=gtx&q=",  // the URL to the text to speech converter
                defaultNotes: false, 	// use slide notes as default for the text to speech converter
                defaultText: false, 	// use slide text as default for the text to speech converter
                advance: 1, 		// advance to next slide after given time in milliseconds after audio has played, use negative value to not advance
                autoplay: true,	// automatically start slideshow
                defaultDuration: 5,	// default duration in seconds if no audio is available
                defaultAudios: true,	// try to play audios with names such as audio/1.2.ogg
                playerOpacity: 0.05,	// opacity value of audio player if unfocused
                playerStyle: 'position: fixed; bottom: 4px; left: 25%; width: 50%; height:75px; z-index: 33;', // style used for container of audio controls
                startAtFragment: false, // when moving to a slide, start at the current fragment or at the start of the slide
            },
            // keyboard: {
            //     82: function () {
            //         Recorder.toggleRecording();
            //     },	// press 'r' to start/stop recording
            //     90: function () {
            //         Recorder.downloadZip();
            //     }, 	// press 'z' to download zip containing audio files
            // }

        });

        Reveal.addEventListener( 'record', function() {
            console.log( 'record called!' );
            start();
        } );
    </script>
@endsection
