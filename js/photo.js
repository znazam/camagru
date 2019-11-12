(function () {
	var video = document.getElementById('video'),
	canvas = document.getElementById('canvas'),
	context = canvas.getContext('2d');
	photo = document.getElementById('photo'),
	vendorURL = window.URL || window.webkitURL;
	navigator.getMedia =    navigator.getUserMedia ||
	navigator.webkitGetUserMedia ||
	navigator.mozGetUSerMedia ||
	navigator.msGetUserMedia;
	navigator.getMedia({
		video: true,
		audio: false
	},    function (stream) {
		video.srcObject = stream;
		video.play()
	},    function (error) {
		console.log('error');
	});
	var capture = document.getElementById('capture');
	capture.addEventListener('click', function() {
		context.drawImage(video, 0, 0, 400, 300);
	})
	var upload = document.getElementById('upload');
	upload.addEventListener('click', function() {
		var request = new XMLHttpRequest();
		request.onload = () => {
			console.log(request.responseText);
		}

		request.open("POST", "/cama/modal/images.php");
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send("photo=" + canvas.toDataURL());
	})
 }) ();