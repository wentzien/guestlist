@extends('layouts.app')

@section('content')
    <style>
        #einstellungen {
            max-width: 1100px;
            margin-left: auto;
            margin-right: auto;
        }

        #einstellungen h1 {
            font-size: 16px;
            padding: 0;
            margin: 0;
        }

        #einstellungen h2 {
            font-size: 14px;
        }

        #einstellungen li.list-group-item {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        #einstellungen div.card-body {
            padding-top: 0;
            padding-bottom: 0;
        }
        video, canvas {
            margin-top: 20px;
            width: 480px;
            height: 360px;
            background-color: #999;
        }

        canvas {
            image-rendering: pixelated;
        }
    </style>
    <div id="einstellungen" class="card">
        <div class="card-header">
            <h1>Empfindlichkeits-Einstellungen</h1>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h2>Audio-Empfindlichkeit (niedrig <-> hoch)</h2>
                    <input id="volumeSensitivity" type="range" class="form-control-range" id="formControlRange"
                           min="1"
                           max="100" onchange="save()">
                    <div class="progress">
                        <div id="progressVolume" class="progress-bar" role="progressbar" style="width: 100%"
                             aria-valuemin="0"
                             aria-valuemax="100"></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <h2>Motion-Empfindlichkeit (hoch <-> niedrig)</h3>
                        <input id="motionSensitivity" type="range" class="form-control-range" id="formControlRange"
                               min="0"
                               max="200" step="10" onchange="save()">

                        <div class="progress">
                            <div id="progressMotion" class="progress-bar" role="progressbar" style="width: 100%"
                                 aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <figure>
                                        <video id="video"></video>
                                        <figcaption>Live Video</figcaption>
                                    </figure>
                                </div>
                                <div class="col-sm">
                                    <figure>
                                        <canvas id="motion"></canvas>
                                        <figcaption>
                                            Motion Heatmap<br>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>
                        </div>
                </li>
            </ul>
        </div>
    </div>

    <script type="text/javascript" src="/js/plugins/adapter.js"></script>
    <script type="text/javascript" src="/js/plugins/diff-cam-engine.js"></script>
    <script type="text/javascript" src="/js/plugins/soundmeter.js"></script>
    <script type="text/javascript" src="/js/settings.js"></script>
@endsection

