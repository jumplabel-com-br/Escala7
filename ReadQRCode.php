<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">

  </style>
</head>
<body cz-shortcut-listen="true">

<div id="container">

  <div class="select" style="display: none">
    <label for="audioSource">Audio source: </label>
    <select id="audioSource">
      <option value="default">Padrão - Microfone (Realtek(R) Audio)</option>
      <option value="communications">Comunicações - Microfone (Realtek(R) Audio)</option>
      <option value="7109f7fcef65033867e85a310cd04ac8437e6c00e414cce09049649eba6cf8f2">Microfone (Realtek(R) Audio)</option></select>
  </div>

  <div class="select">
    <label for="videoSource">Flip file: </label><select id="videoSource"><option value="b9b429884cc4d7588abfd55620b13f526e228faa58d204312ef54a7480703847">Integrated Webcam (0c45:671e)</option></select>
  </div>

  <video autoplay="" muted="" playsinline=""></video>

  <script type="text/javascript">
    'use strict';

    var videoElement = document.querySelector('video');
    var audioSelect = document.querySelector('select#audioSource');
    var videoSelect = document.querySelector('select#videoSource');

    audioSelect.onchange = getStream;
    videoSelect.onchange = getStream;

    getStream().then(getDevices).then(gotDevices);

    function getDevices() {
      // AFAICT in Safari this only gets default devices until gUM is called :/
      return navigator.mediaDevices.enumerateDevices();
    }

    function gotDevices(deviceInfos) {
      window.deviceInfos = deviceInfos; // make available to console
      console.log('Available input and output devices:', deviceInfos);
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
      window.stream = stream; // make stream available to console
      audioSelect.selectedIndex = [...audioSelect.options].
        findIndex(option => option.text === stream.getAudioTracks()[0].label);
      videoSelect.selectedIndex = [...videoSelect.options].
        findIndex(option => option.text === stream.getVideoTracks()[0].label);
      videoElement.srcObject = stream;
    }

    function handleError(error) {
      console.log('Error: ', error);
    }

  </script>
</div>

<script type="text/javascript">

  /*
  Copyright 2017 Google Inc.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      http://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License.
  */

  'use strict';

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33848682-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' === document.location.protocol ?
      'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>