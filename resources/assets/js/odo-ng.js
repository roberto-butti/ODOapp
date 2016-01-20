var app =  angular.module('odo-app',[]);
app.config(["$interpolateProvider","$httpProvider", function($interpolateProvider,$httpProvider) {
  $interpolateProvider.startSymbol('<%').endSymbol('%>');
  $httpProvider.defaults.headers.common['X-Requested-With'] = "XMLHttpRequest";
}]);

var mediaRecorder = null;

app.controller("newClip",["$scope",function($scope){
	$scope.clip = null;
	$scope.rec = false;
	var step = 100/30;
	var timerCircle = null;

	var circle = new ProgressBar.Circle('#recordCircle', {
	    color: '#d44769',
    	trailColor: '#c0c0c0',
	    strokeWidth: 3,
	    trailWidth: 3,
	    text: {
	        value: '0',

	    },
	    style: {
            // Text color.
            // Default: same as stroke color (options.color)
            color: '#f00',
            position: 'absolute',
            left: '50%',
            top: '50%',
            padding: 0,
            margin: 0,
            // You can specify styles which will be browser prefixed
            transform: {
                prefix: true,
                value: 'translate(-50%, -50%) scale(1)'
            }
        },
	    step: function(state, bar) {
	        bar.setText((((bar.value()*100) / step) / 2).toFixed(0));
	    }
	});

	$scope.start = function($event){
		$event.preventDefault();

		$scope.rec = true;

		if($scope.clip == null){
			rec = $($event.currentTarget).parent();
			$(rec).find(".record-option").slideDown(400);
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
		}else{
			$scope.clip = null;
			startAudio();
		}
	};

	$scope.stop = function($event){
		$event.preventDefault();
		clearInterval(timerCircle);
		
		mediaRecorder.stop();

		bt = $event.currentTarget;

		if($scope.rec == true){
			$scope.rec = false;
			$(".rcircle").addClass('anim-stop');
			$(".message-option").slideDown('400');
		}

	};

	function startAudio(){
		mediaRecorder.start(15000);
		setTimeout(function(){cicleCount(0);},500);
	}

	function cicleCount(timer){
		if(timer == 29){
			mediaRecorder.stop();
			circle.animate(1);
			if($scope.rec == true){
				$scope.rec = false;
				$(".rcircle").addClass('anim-stop');
				$(".message-option").slideDown('400');
			}
		}else{
			prog = (timer / step)/10;
			circle.animate(prog);
			timerCircle = setTimeout(function(){
				cicleCount(timer+1);
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