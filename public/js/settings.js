var volumeSensitivity = document.getElementById("volumeSensitivity")
var motionSensitivity = document.getElementById("motionSensitivity");

//falls bereits Werte vorhanden sind, werden die Regler an diese angepasst, ansonsten werden die Standardwerte genommen
volumeSensitivity.setAttribute("value", localStorage.getItem("volumeSensitivity") || 30);
motionSensitivity.setAttribute("value", localStorage.getItem("motionSensitivity") || 10);

//Nach Betätigung der Regler werden die neuen Werte im localStorage gespeichert
function save() {
    localStorage.setItem("volumeSensitivity", volumeSensitivity.value);
    localStorage.setItem("motionSensitivity", motionSensitivity.value);
}


var progressVolume = document.getElementById("progressVolume");
//Videofenster
var video = document.getElementById('video');
//Canvasfenster
var canvas = document.getElementById('motion');
//MotionScore live Anzeige
var score = document.getElementById('progressMotion');
//Differenz aus MotionScore und MotionSensitivity
var diff = 0;
//Messung der Lautstärke
var instantMeter = 0;



try {
    window.AudioContext = window.AudioContext || window.webkitAudioContext;
    window.audioContext = new AudioContext();
} catch (e) {
    alert('Web Audio API not supported.');
}

// Put variables in global scope to make them available to the browser console.
const constraints = window.constraints = {
    audio: true,
    video: false
};

function handleSuccess(stream) {
    // Put variables in global scope to make them available to the
    // browser console.
    window.stream = stream;
    const soundMeter = window.soundMeter = new SoundMeter(window.audioContext);
    soundMeter.connectToSource(stream, function(e) {
        if (e) {
            alert(e);
            return;
        }
        setInterval(() => {

            instantMeter = soundMeter.instant * volumeSensitivity.value;

            console.log(instantMeter);

            progressVolume.setAttribute("style", "width: " + instantMeter * 100 + "%");

        }, 200);
    });
}

function handleError(error) {
    console.log('navigator.MediaDevices.getUserMedia error: ', error.message, error.name);
}

navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);

function initSuccess() {
    DiffCamEngine.start();
}

function initError() {
    alert('Something went wrong.');
}

function capture(payload) {
    //Different zw. Grenzwert und berechneter MotionScore
    diff = payload.score - motionSensitivity.value;
    //aktualisiert die live Anzeige
    score.setAttribute("style", "width: " + diff + "%");
}

DiffCamEngine.init({
    video: video,
    motionCanvas: canvas,
    initSuccessCallback: initSuccess,
    initErrorCallback: initError,
    captureCallback: capture
});
