URL = window.URL || window.webkitURL;
//Stram von getUserMedia
var gumStream;
//Recorder.js Objekt
var rec;
//MediaStreamAudioSourceNode welche aufgenommen wird
var input;
try {
    window.AudioContext = window.AudioContext || window.webkitAudioContext;
    window.audioContext = new AudioContext();
} catch (e) {
    alert('Web Audio API not supported.');
}

//Element dass das Audiovolumen auf grafisch darstellt
var volume = document.getElementById("volume");
//Ausgegebenes Volumen
var instantMeter = 0;

//Zählt später die Sekunden der Stille
var silentTime;
//liest timeToStop aus, wenn nicht vorhanden wird Standardwert genommen
var timeToStop = localStorage.getItem("timeToStop") || 10; // 10 -> 2 sec
//liest die eingestellte Volumen-Sensitivität aus, wenn nicht vorhanden wird Standardwert genommen
var volumeSensitivity = localStorage.getItem("volumeSensitivity") || 30;
console.log("Volume Sensitivity: " + volumeSensitivity);

//Element das grafisch anzeigt, dass gerade aufgenommen wird
var recording = document.getElementById("recording");
//Nach der Aufnahme wird die Progress-Bar ausgeblendet
var progress = document.getElementById("progress");

//sobald das Fenster geladen wurde:
function start() {
    //damit Mikro wirklich aktiviert wird...
    //wird eig. nicht mehr benötigt, aktuell doppelt vorhanden
    navigator.mediaDevices.getUserMedia({audio: true}).then(startRecording);
}

function startRecording() {
    console.log("Process started")

    //Recording-Symbol wird angezeigt
    recording.style.visibility = "visible";

    var constraints = {
        audio: true,
        video: false
    }

    navigator.mediaDevices.getUserMedia(constraints).then(function (stream) {

        //-----------------------------------------------
        //Audio Recorder:
        console.log("getUserMedia() success, stream created, initializing Recorder.js ...");
        gumStream = stream;
        input = audioContext.createMediaStreamSource(stream);
        //Recorder Objekt wird verwendet, mit mono sound
        rec = new Recorder(input, {
            numChannels: 1
        })
        //start the recording process
        rec.record()
        console.log("Recording started");
        //-----------------------------------------------


        //-----------------------------------------------
        //nach 5 sek Stop der Aufzeichnung
        //setTimeout(stopRecording, 5000);
        //-----------------------------------------------


        //-----------------------------------------------
        //Track Audio Volume
        window.stream = stream;
        const soundMeter = window.soundMeter = new SoundMeter(window.audioContext);
        soundMeter.connectToSource(stream, function (err) {
            if (err) {
                alert(err);
                return;
            }
            setInterval(() => {
                //"Lautstärke" wird mit der eingestellten Sensitivität verrechnet
                instantMeter = soundMeter.instant * volumeSensitivity;
                console.log(instantMeter);

                //Progress-Bar wird mit dem aktuellsten Wert angepasst
                volume.setAttribute("style", "width: " + instantMeter * 100 + "%");

                //Abbruchvorgang für das Recording
                if (instantMeter < 0.02) {
                    silentTime++;
                    console.log(silentTime);
                    //Wert stellt ein, wie lange Stille herrschen muss -> 10 -> 2Sek
                    if (silentTime == timeToStop) {
                        stopRecording();
                        setTimeout(window.location.href = link, 1000);
                    }
                } else {
                    silentTime = 0;
                    console.log(silentTime);
                }
            }, 200);

        });
        //-----------------------------------------------


    }).catch(function (error) {

        console.log('navigator.MediaDevices.getUserMedia error: ', error.message, error.name);
    });
}

function stopRecording() {
    console.log("Recording stopped");

    //Elemente werden nach Stop des Recordings ausgeblendet
    recording.style.visibility = "hidden";
    progress.style.visibility = "hidden";

    //Recorder wird gestoppt
    rec.stop();
    gumStream.getAudioTracks()[0].stop();
    //wav blob wird erstellt und an createDownloadLink weitergegeben
    rec.exportWAV(createDownloadLink);
}

//
function createDownloadLink(blob) {
    var url = URL.createObjectURL(blob);
    var au = document.createElement('audio');
    var li = document.createElement('li');
    var link = document.createElement('a');
    //controls für das Audio-Element... ist nicht mehr sichtbar
    au.controls = true;
    au.src = url;
    //a element wird mit blob verlinkt
    link.href = url;
    link.download = "tracked-guest_" + new Date().toISOString() + '.wav';
    link.innerHTML = link.download;
    //die neue Audio Datei wird ans li Element angehängt
    li.appendChild(au);
    li.appendChild(link);
    //li wird an die Liste angefügt
    recordingsList.appendChild(li);

    //Löst den Download aus
    link.click();
}

//Funktion gleich wie StopRecording, nur mit Weiterleitung
//doppelte Code muss noch in weitere Funktion ausgelagert werden...
function stop() {
    //Recorder stoppt
    rec.stop();
    gumStream.getAudioTracks()[0].stop();

    recording.style.visibility = "hidden";
    progress.style.visibility = "hidden";

    window.location.href = '/';
}
