var app =  angular.module('odo-app',[]);
app.config(["$interpolateProvider","$httpProvider", function($interpolateProvider,$httpProvider) {
  $interpolateProvider.startSymbol('<%').endSymbol('%>');
  $httpProvider.defaults.headers.common['X-Requested-With'] = "XMLHttpRequest";
}]);

var mediaRecorder = null;

app.controller("newClip",["$scope",function($scope){
	$scope.clip = null;
	var step = 0;
	var timerSpectre = null;
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
		        var blobURL = URL.createObjectURL(blob);
		        $scope.clip = blob;
		        var reader = new window.FileReader();
				 reader.readAsDataURL(blob); 
				 reader.onloadend = function() {
				                base64data = reader.result;                
				                $("#clip-audio").val(base64data);
				  }
		    };


		 	if($scope.clip == null)startAudio();
		}

		function onMediaError(e) {
		    console.error('media error', e);
		}
	};

	$scope.stop = function($event){
		clearInterval(timerSpectre);
		$event.preventDefault();
		mediaRecorder.stop();
	};

	function startAudio(){
		mediaRecorder.start(15000);
		step = 100/30;
		setTimeout(function(){spectre(0);},1000);
	}

	function spectre(timer){
		if(timer == 29){
			$(".spectre > div").css("width","100%");
		}else{
			$(".spectre > div").css("width",timer*step+"%");
			timerSpectre = setTimeout(function(){
				spectre(timer+1);
			},500);
		}
	}
}]);

app.directive("pinTo",function(){

	function link(scope,element,attrs){
		$(element).pinBox({
			Top : '30px',
			Container : attrs.pinTo
		});
	}

	return{
		restrict: "A",
		link:link
	};
});

app.directive("playerMorf",function(){

	function link(scope,element,attrs){
		$(element).append("<div class='left'></div><div class='right'></div><div class='triangle-1'></div><div class='triangle-2'></div>")
	}

	return{
		restrict: "C",
		link:link
	};
});

app.directive("clips",function(){

	function link(scope,element,attrs){
		var idwave = genUniqueId();

		$(element).find(".wave").attr('id',idwave);
		var wavesurfer = WaveSurfer.create({
		    container: '#'+idwave,
		    waveColor: '#4bfcd0',
		    progressColor: '#17adce',
		    barWidth: 2,
		    height: 80,
		    cursorWidth: 2
		});

		wavesurfer.on('ready', function () {
			$(element).find(".loadWave").remove();
		    
		    $(element).find(".play").click(function(event) {
		    	$(this).find(".player-morf").toggleClass('paused');
		    	wavesurfer.playPause();
		    });
		});

		wavesurfer.on("finish", function(){
			$(element).find(".player-morf").removeClass('paused');
		});

		wavesurfer.load($(element).find("#"+idwave).data("url"));
	}

	function genUniqueId(){
		var id ="wave" + Math.floor((Math.random()*999999999)+1);
		if($("#"+id).length == 0){
			return id;
		}else{
			genUniqueId();
		}
	}

	return{
		restrict: "A",
		link:link
	};
});