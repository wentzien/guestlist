var video = document.getElementById('video');
var canvas = document.getElementById('motion');
var score = document.getElementsByClassName('progressMotion');

var motionSensitivity = localStorage.getItem("motionSensitivity") || 20;


function initSuccess() {
    DiffCamEngine.start();
}

function initError() {
    alert('Something went wrong.');
}

function capture(payload) {
    diff = payload.score - motionSensitivity;
    score.setAttribute("aria-valuemax", motionSensitivity)
    score.setAttribute("style", "width: " + diff + "%");

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
