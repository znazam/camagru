// (function () {
// 	var video = document.getElementById('video'),
// 	canvas = document.getElementById('canvas'),
// 	context = canvas.getContext('2d');
// 	photo = document.getElementById('photo'),
// 	vendorURL = window.URL || window.webkitURL;
// 	navigator.getMedia =	navigator.getUserMedia ||
// 	navigator.webkitGetUserMedia ||
// 	navigator.mozGetUSerMedia ||
// 	navigator.msGetUserMedia;
// 	navigator.getMedia({
// 		video: true,
// 		audio: false
// 	},    function (stream) {
// 		video.srcObject = stream;
// 		video.play()
// 	},    function (error) {
// 		console.log('error');
// 	});
// 	var capture = document.getElementById('capture');
// 	capture.addEventListener('click', function() {
// 		context.drawImage(video, 0, 0, 400, 300);
// 	})
// 	var upload = document.getElementById('upload');
// 	upload.addEventListener('click', function() {
// 		var request = new XMLHttpRequest();
// 		request.onload = () => {
// 			console.log(request.responseText);
// 		}

// 		request.open("POST", "/cama/modal/images.php");
// 		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
// 		request.send("photo=" + canvas.toDataURL());
// 	})
//  }) ();

function hasGetUserMedia()
{
	return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
}
	const constraints = {
	video: true
	};
	const video = document.getElementById('vid');
	const img = document.getElementById('captured_one');
	const canvas = document.getElementById('screenshot');
	const shoot = document.getElementById('take_pic');
	const re_shoot = document.getElementById('take_another_one');
	const post_it = document.getElementById('post_pic');
	const url = document.getElementById('url');
	const cat = document.getElementById('cat1');
	const dragon = document.getElementById('dragon');
	const cupid = document.getElementById('cupid');
	const none = document.getElementById('none');
	var context = canvas.getContext('2d');
	const frame = document.getElementById('omunye');
	const chosenFrame = document.getElementById('chosen_frame');
	const origin = document.getElementById('origin');
	frame.style.display = "none";
if (hasGetUserMedia())
{
	navigator.mediaDevices.getUserMedia(constraints).
	then((stream) => {video.srcObject = stream});
	navigator.mediaDevices.getUserMedia(constraints).
	then((stream) => {video.srcObject = stream});
	//When you take a picture
	shoot.onclick = video.onclick = function()
	{
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		context.drawImage(video, 0, 0);
		img.src = canvas.toDataURL('image/jpeg');
		url.value = canvas.toDataURL('image/jpeg');
		img.style.display = "block";
		video.style.display = "none";
		origin.value = "cam";
	};
	re_shoot.onclick = function()
	{
		img.src = "";
		url.value = "";
		img.style.display = "none";
		video.style.display = "block";
	};
}
else
{
	alert('getUserMedia() is not supported by your browser');
}
	//frames start
	cat.addEventListener("click", function()
	{
		if (video.style.display != "none" || origin.value == "file")
		{
			frame.src = cat.src;
			chosenFrame.value = cat.src;
			frame.style.display = "block";
		}
	});
	dragon.addEventListener("click", function()
	{
		if (video.style.display != "none" || origin.value == "file")
		{
			frame.src = dragon.src;
			chosenFrame.value = dragon.src;
			frame.style.display = "block";
		}
	});
	cupid.addEventListener("click", function()
	{
		if (video.style.display != "none" || origin.value == "file")
		{
			frame.src = cupid.src;
			chosenFrame.value = cupid.src;
			frame.style.display = "block";
		}
	});
	none.addEventListener("click", function()
	{
		frame.style.display = "none";
		chosenFrame.value = "";
	});
	//frames end
	//When you select a picture
	var loadFile = function(event)
	{
		if (event.target.files[0])ﬁ
		{
			canvas.width = video.videoWidth;
			canvas.height = video.videoHeight;
			img.src = URL.createObjectURL(event.target.files[0]);
			canvas.innerHTML = "<img src='" + img.src + "'>";
			//canvas.style.display = "block";
			url.value = canvas.toDataURL('image/jpeg');
			img.style.display = "block";
			video.style.display = "none";
			origin.value = "file";
		}
	};
	function deletePost(id)
	{
		var srcId = "image"+id;
		var path = document.getElementById(srcId).src;
		$.ajax({url: "deletePost.php?id=" + id + "&path=" + path, success: function(result)
		{
			if (result == "Deleted")
			{
				location.reload();
				showSnackbar("Post deleted");
			}
			showSnackbar(result);
		}})
	}
	
	function showSnackbar(message) {
		var snackbar = document.getElementById("snackbar");
		snackbar.innerHTML = message;
		snackbar.className = "show";
		setTimeout(function()
		{
			snackbar.className = "";
		}, 3000);
	}
	
	function logOut()
	{
		$.ajax({url:"logOut.php", success: function(result)
		{
			location.reload();
		}})
	}