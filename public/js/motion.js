var video = document.getElementById('video');
var canvas = document.getElementById('motion');
var score = document.getElementsByClassName('progressMotion');
var diff = 0;

var motionSensitivity = localStorage.getItem("motionSensitivity") || 20;

for (var i = 0; i < score.length; ++i) {
    score[i].setAttribute("aria-valuemax", motionSensitivity);
}

function initSuccess() {
    DiffCamEngine.start();
}

function initError() {
    alert('Something went wrong.');
}

function capture(payload) {
    diff = payload.score - motionSensitivity;

    for (var i = 0; i < score.length; ++i) {
        score[i].setAttribute("style", "width: " + diff + "%");
    }

    if(payload.score > motionSensitivity){
        DiffCamEngine.stop();
        window.location.href = "/recording";
    }
}

DiffCamEngine.init({
    video: video,
    motionCanvas: canvas,
    initSuccessCallback: initSuccess,
    initErrorCallback: initError,
    captureCallback: capture
});

function stop() {
    DiffCamEngine.stop();
    window.location.href = '/';
}
