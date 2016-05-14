 
// Buttons
 var playButton = document.getElementById("play");
 var previousButton = document.getElementById("previous");
 var nextButton = document.getElementById("next");
 var pauseButton = document.getElementById("pause");
 var forwardButton = document.getElementById("forward");
 var backwardsButton = document.getElementById("backwards");

// variables
var duration = document.getElementById("duration");
var defaultBar = document.getElementById("defaultbar");
var progressBar = document.getElementById("progressbar");
var entireAudioPlayer = document.getElementById("entire-audio-player");
var menu = document.getElementById("menu");
var title = document.getElementById("title");
var links = document.getElementById("links");
var song_to_display = document.getElementById("song")

var barSize = 271;
$(links).hide();
$(entireAudioPlayer).draggable();
$(document).tooltip();
$("#playlist li:first-child").addClass("current-song");
 function audioPlayer(){
            var currentSong = 0;
            var song_playing = $("#audioPlayer")[0];
            var min = parseInt(song_playing.duration/60);
            var sec = parseInt(song_playing.duration%60);
            duration.innerHTML = min + ":" + sec;
            song_playing.src = $("#playlist li a")[0];
            updateTime = setInterval(updateTime,250);
            $("#playlist li a").click(function(e){
               e.preventDefault(); 
               song_playing.src = this;
               song_playing.play();
               $("#playlist li").removeClass("current-song");
                currentSong = $(this).parent().index();
                $(this).parent().addClass("current-song");
                $(playButton).css("display","none");
              $(pauseButton).css("display","block");
              updateTime = setInterval(updateTime,250);
            });
            
            //song finishing or clicking next Icon
            song_playing.addEventListener("ended",nextSong);
            nextButton.addEventListener("click",nextSong);
             function nextSong(){
               currentSong++;
                if(currentSong == $("#playlist li a").length)
                    currentSong = 0;
                $("#playlist li").removeClass("current-song");
                $("#playlist li:eq("+currentSong+")").addClass("current-song");
                song_playing.src = $("#playlist li a")[currentSong].href;
                song_playing.play();   
                updateTime = setInterval(updateTime,250);
            }

            //displaying duration
            duration.innerHTML = parseInt(song_playing.currentTime);

            //play song
            playButton.addEventListener("click",play,false);
            function play(){
              song_playing.play();
              $(playButton).css("display","none");
              $(pauseButton).css("display","block");
              updateTime = setInterval(updateTime,250);
            }

            //pause song
            pauseButton.addEventListener("click",pause,false);
            function pause(){
              song_playing.pause();
              $(pauseButton).css("display","none");
              $(playButton).css("display","block");
              updateTime = setInterval(updateTime,250);
            }

            //previous Button
            previousButton.addEventListener("click",prevSong,false);
            function prevSong(){
              song_playing.currentTime = 0;
              updateTime = setInterval(updateTime,250);
            }

            //forward button
            forwardButton.addEventListener("click",forward10sec);
            function forward10sec(){
              song_playing.currentTime += 10;
              updateTime = setInterval(updateTime,250);
            }

            //backwards button
            backwardsButton.addEventListener("click",backwards10sec);
            function backwards10sec(){
              song_playing.currentTime -= 10;
              updateTime = setInterval(updateTime,250);
            }

            //menu toggle
            title.addEventListener("click",toggleMenu);
            function toggleMenu(){
            $(links).toggle();
            updateTime = setInterval(updateTime,250);
            }

            function updateTime(){
              if(!song_playing.ended){
                var currentMin = parseInt(song_playing.currentTime/60);
                var currentSec = parseInt(song_playing.currentTime%60);

                var size = parseInt(song_playing.currentTime * barSize/song_playing.duration);
                progressBar.style.width = size + "px";
                song_to_display.innerHTML = $(".current-song").text();

                if (currentSec > 9) {

                duration.innerHTML = currentMin + ":" + currentSec;
                }else{
                duration.innerHTML = currentMin + ":0" + currentSec;
              }
              }else{
                song_playing.currentTime = 0;
                 progressBar.style.width = "0px";
              }
            }
            // clicking on bar
          defaultBar.addEventListener('click',clickBar,false);
           function clickBar(event){
              if(!song_playing.ended){
                var mouseXValue = event.pageX - defaultBar.offsetLeft;
                var newTime = (mouseXValue * song_playing.duration/barSize) - (1/7 * song_playing.duration) - (1/21 * song_playing.duration);

                song_playing.currentTime = newTime;

                progressBar.style.width = mouseXValue + "px";
              }

            }

            //mouse-enter on entire-audio-player
            $(entireAudioPlayer).mouseenter(function(){
              $(progressBar).css("height","5.5px","transition-duration","0.7s");
              $(defaultBar).css("height","5.5px","transition-duration","0.7s");
            });

            //mouse-leave on entire-audio-player
            $(entireAudioPlayer).mouseleave(function(){
              $(progressBar).css("height","3px","transition-duration","0.7s");
              $(defaultBar).css("height","3px","transition-duration","0.7s");
            }) 

            //volume changing
           $('#vol').change(function(){
              song_playing.volume = parseFloat(this.value / 10);
            });

           //info toggle
           $("#info-icon").mouseenter(function(){

           });

           $(document).keyup(function(trigger){
            if(!song_playing.paused && trigger.which === 32) {
              song_playing.pause();
              $(pauseButton).css("display","none");
              $(playButton).css("display","block");
            }else if(song_playing.paused && trigger.which === 32){
              song_playing.play();
              $(playButton).css("display","none");
              $(pauseButton).css("display","block");
            }
           })

        }