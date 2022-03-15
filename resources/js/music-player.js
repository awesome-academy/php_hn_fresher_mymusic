const _$ = document.querySelector.bind(document);
const _$$ = document.querySelectorAll.bind(document);
const playBtn = _$(".center-btn");
const audio = _$("#music-player");
const play = _$(".play");
const pause = _$(".pause");
const volume = _$("#range-volume-control");
const volumeBtn = _$(".volume-btn");
const fire = _$(".fire");
const mute = _$(".mute");
const progress = _$("#range-time-control");
const currentTime = _$(".current-time");
const totalTime = _$(".total-time");
const cardBoxs = _$$(".card-box");
const songThumbnail = _$(".music-img img");
const nameSong = _$(".name");
const app = {
    isPlaying : false,
    isMute : false,
    handleEvents() {
        const _this = this;
        playBtn.onclick = function () {
            if (_this.isPlaying) {
                audio.pause();
            } else {
                audio.play();
            }
        };
        audio.onplay = function () {
            _this.isPlaying = true;
            play.classList.add("d-none");
            pause.classList.remove("d-none");
        };
        audio.onpause = function () {
            _this.isPlaying = false;
            pause.classList.add("d-none");
            play.classList.remove("d-none");
        };
        audio.ontimeupdate = function () {
            if (audio.duration) {
              const progressPercent = Math.floor(
                (audio.currentTime / audio.duration) *1000
              );
              progress.value = progressPercent;
              currentTime.innerText = displayTime(audio.currentTime);
              totalTime.innerText = displayTime(audio.duration);

            }
        };
        progress.onchange = function (e) {
            const seekTime = (audio.duration / 1000) * e.target.value;
            audio.currentTime = seekTime;
        };
        volume.onchange = function(e){
            audio.volume = e.target.value;
            if(audio.volume == 0)
            {
                fire.classList.add("d-none");
                mute.classList.remove("d-none");
            }else{
                mute.classList.add("d-none");
                fire.classList.remove("d-none");
            }
        };

        volumeBtn.onclick = function(e){
            if (!_this.isMute) {
                fire.classList.add("d-none");
                mute.classList.remove("d-none");
                audio.volume = volume.value = 0;
            } else {
                mute.classList.add("d-none");
                fire.classList.remove("d-none");
                audio.volume = volume.value = 0.5;
            }
            _this.isMute = !_this.isMute;
        }

        function displayTime (value) {
            value = Math.ceil(value);
            return Math.floor(value / 60) + ":" + (value % 60 < 10 ? '0' + value % 60  : value % 60);
        }

        function addEventListenerList(list, event, fn) {
            for (var i = 0, len = list.length; i < len; i++) {
                list[i].addEventListener(event, fn, false);
            }
        }
        addEventListenerList(cardBoxs,'click',function(e){
            audio.src = this.getAttribute("data-song");
            songThumbnail.src = this.getAttribute("data-thumbnail");
            nameSong.innerText = this.getAttribute("data-title");
            audio.play();
        })

    }
}
app.handleEvents();
