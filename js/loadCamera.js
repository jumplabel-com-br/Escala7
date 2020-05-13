'use strict';

var videoElement = document.querySelector('video');
var audioSelect = document.querySelector('select#audioSource');
var videoSelect = document.querySelector('select#videoSource');

audioSelect.onchange = getStream;
videoSelect.onchange = getStream;

getStream().then(getDevices).then(gotDevices);

videoSourceOptions();

function videoSourceOptions(){
  $('#videoSource option:eq(1)').html('Câmera Frontal');
  $('#videoSource option:eq(2)').html('Câmera Traseira');
  $('select').formSelect();
}

function getDevices() {
  // AFAICT no Safari, isso só obtém dispositivos padrão até que o GUM seja chamado :/
  return navigator.mediaDevices.enumerateDevices();
}

function gotDevices(deviceInfos) {
  window.deviceInfos = deviceInfos; // disponibiliza para o console

  for (const deviceInfo of deviceInfos) {

    const option = document.createElement('option');
    option.value = deviceInfo.deviceId;

    if (deviceInfo.kind === 'audioinput') {

      option.text = deviceInfo.label || `Microphone ${audioSelect.length + 1}`;
      audioSelect.appendChild(option);

    } else if (deviceInfo.kind === 'videoinput') {

      option.text = deviceInfo.label || `Camera ${videoSelect.length + 1}`;
      videoSelect.appendChild(option);
    }
  }
}

function getStream() {

  if (window.stream) {

    window.stream.getTracks().forEach(track => {
      track.stop();
    });

  }

  const audioSource = audioSelect.value;
  const videoSource = videoSelect.value;
  const constraints = {
    audio: {deviceId: audioSource ? {exact: audioSource} : undefined},
    video: {deviceId: videoSource ? {exact: videoSource} : undefined}
  };
  return navigator.mediaDevices.getUserMedia(constraints).
    then(gotStream).catch(handleError);
}

function gotStream(stream) {

  window.stream = stream; // disponibiliza o fluxo para o console 
  audioSelect.selectedIndex = [...audioSelect.options].
    findIndex(option => option.text === stream.getAudioTracks()[0].label);
  videoSelect.selectedIndex = [...videoSelect.options].
    findIndex(option => option.text === stream.getVideoTracks()[0].label);
  videoElement.srcObject = stream;

}

function handleError(error) {
  console.log('Error: ', error);
}