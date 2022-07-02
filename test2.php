
<?php
unlink('../students_connect_hidden/comments/32/32(0).png');
?>



<script>
let videostream;
let mediasoupVideoProducer;
let mediasoupAudioProducer;
let host = window.location.host;
let params = new URLSearchParams(document.location.search);
let serviceurl;
let uploadurl;
var started = false;
var socket;
var loggedInUsername;
var name;
var examid;
var examdesc;
var mediasoupDevice;
var mediasoupProducerTransport;
var mediasoupConsumerTransport;
var mediasoupSocketIds = {};
var mediasoupConsumers = {};
//var mediasoupConsumersByProducer = {};
var company;
var socketioadded = false;
var subdomain;
let websocketport = 7070;
let publishvideointerval;
let mediaRecorder;
//let partno = 0;
let recording = false;
var debug = false;
let audiorequested = false;
let videorequested = false;
let currentroom;
let chunksuploaded = 0;
let chunkscreated = 0;
let recordinguploadstartedinterval;
async function stopPublishing() {
examiframe.contentWindow.postMessage({ status: 'notpublishing' }, '*');
if (mediasoupVideoProducer 