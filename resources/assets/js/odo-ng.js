var app =  angular.module('odo-app',[]);
app.config(["$interpolateProvider","$httpProvider", function($interpolateProvider,$httpProvider) {
  $interpolateProvider.startSymbol('<%').endSymbol('%>');
  $httpProvider.defaults.headers.common['X-Requested-With'] = "XMLHttpRequest";
}]);

var mediaRecorder = null;

app.controller("newClip",["$scope",function($scope){
	$scope.clip = null;
	$scope.start = function($event){
		$scope.clip = null;
		$event.preventDefault();
		var mediaConstraints = {
		    audio: true
		};

		navigator.getUserMedia(mediaConstraints, onMediaSuccess, onMediaError);

		function onMediaSuccess(stream) {

		    mediaRecorder = new MediaStreamRecorder(stream);
		    mediaRecorder.mimeType = 'audio/ogg';
		    mediaRecorder.audioChannels = 1;

		    mediaRecorder.ondataavailable = function (blob) {
		        // POST/PUT "Blob" using FormData/XHR2
		        var blobURL = URL.createObjectURL(blob);
		        $(".clips-cont").append('<a href="' + blobURL + '" target="_blank">' + blobURL + '</a>');
		        $scope.clip = blob;
		        var reader = new window.FileReader();
				 reader.readAsDataURL(blob); 
				 reader.onloadend = function() {
				                base64data = reader.result;                
				                $("#clip-audio").val(base64data);
				  }
		    };


		 	if($scope.clip == null)mediaRecorder.start(15000);
		}

		function onMediaError(e) {
		    console.error('media error', e);
		}
	};

	$scope.stop = function($event){
		$event.preventDefault();
		mediaRecorder.stop();
	};
}]);