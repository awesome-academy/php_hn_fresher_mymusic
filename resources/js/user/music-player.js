import ajax from "./ajax";
import trans from "../trans";

const _$ = document.querySelector.bind(document);
const _$$ = document.querySelectorAll.bind(document);
//Define const
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
const songThumbnail = _$(".music-img img");
const nameSong = _$(".name");
const authorName = _$("#author");
const nextBtn = _$(".next-btn");
const preBtn = _$(".prev-btn");
const replayBtn = _$(".loop-btn");
const randomBtn = _$(".mix-btn");
const songId = _$("#song-id");
const favBtn = _$(".fav-btn");

const app = {
    isPlaying: false,
    isMute: false,
    idSongPlay: 0,
    lengListSong: 0,
    isMix: false,
    isReplay: false,
    isRandom: false,
    handleEvents() {
        const _this = this;
        playBtn.onclick = function () {
            if (_this.isPlaying) {
                audio.pause();
            } else {
                audio.play();
            }
        };
        //Event play song
        audio.onplay = function () {
            _this.isPlaying = true;
            play.classList.add("d-none");
            pause.classList.remove("d-none");
            $(".track[data-id=" + _this.idSongPlay + "]").addClass(
                "track-active"
            );
            showPauseButton(_$('.is-playing'));
        };
        //Event pause song
        audio.onpause = function () {
            _this.isPlaying = false;
            play.classList.remove("d-none");
            pause.classList.add("d-none");
            showPlayButton(_$('.is-playing'));
        };
        //Event end of song
        audio.onended = function () {
            if (_this.isReplay) {
                audio.play();
            } else {
                nextBtn.click();
            }
        };
        //Event update time of soong
        audio.ontimeupdate = function () {
            if (audio.duration) {
                const progressPercent = Math.floor(
                    (audio.currentTime / audio.duration) * 1000
                );
                progress.value = progressPercent;
                currentTime.innerText = displayTime(audio.currentTime);
                totalTime.innerText = displayTime(audio.duration);
            }
        };
        // Progres change
        progress.onchange = function (e) {
            const seekTime = (audio.duration / 1000) * e.target.value;
            audio.currentTime = seekTime;
        };
        // Volume change
        volume.onchange = function (e) {
            audio.volume = e.target.value;
            if (audio.volume == 0) {
                fire.classList.add("d-none");
                mute.classList.remove("d-none");
            } else {
                mute.classList.add("d-none");
                fire.classList.remove("d-none");
            }
        };
        // Volume button click
        volumeBtn.onclick = function (e) {
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
        };
        // Format time display
        function displayTime(value) {
            value = Math.ceil(value);
            return (
                Math.floor(value / 60) +
                ":" +
                (value % 60 < 10 ? "0" + (value % 60) : value % 60)
            );
        }
        // Click box event multiple
        addEventListenerList(_$$(".song"), "click", function (e) {
            if ($(e.target).is("svg") || $(e.target).is("path") || $(e.target).hasClass("quick-play")) {
                const isFav = 1;
                let authorArr = this.getAttribute("data-author");

                unActivePlaying();
                this.querySelector('.quick-play').classList.add('is-playing');
                audio.src = this.getAttribute("data-song");
                songThumbnail.src = this.getAttribute("data-thumbnail");
                nameSong.innerText = this.getAttribute("data-title");
                authorName.innerText = authorArr;
                songId.value = this.getAttribute("song-id");
                if (!_this.isPlaying) {
                    audio.play();
                    showPauseButton(this);
                    _this.isPlaying = !_this.isPlaying;
                }
                else {
                    audio.pause();
                    showPlayButton(this);
                    _this.isPlaying = !_this.isPlaying;
                }
                if (this.getAttribute("data-fav") == isFav) {
                    favBtn.classList.remove('unlike')
                    favBtn.classList.add('liked')
                }
                else {
                    favBtn.classList.remove('liked');
                    favBtn.classList.add('unlike')
                }
            } else {
                ajax.main.songPage(this.getAttribute('song-id'));
            }

        });

        function showPlayButton(selector) {
            selector.querySelector('.fa-play').classList.remove('d-none');
            selector.querySelector('.fa-pause').classList.add('d-none');
            play.classList.remove("d-none");
            pause.classList.add("d-none");
        }

        function showPauseButton(selector) {
            selector.querySelector('.fa-play').classList.add('d-none');
            selector.querySelector('.fa-pause').classList.remove('d-none');
            play.classList.add("d-none");
            pause.classList.remove("d-none");
        }

        //Unactive playing
        function unActivePlaying() {
            _$$(".quick-play").forEach((e) => {
                e.classList.remove("is-playing");
                e.querySelector('.fa-play').classList.remove('d-none');
                e.querySelector('.fa-pause').classList.add('d-none');
            });
        };

        function addEventListenerList(list, event, fn) {
            for (var i = 0, len = list.length; i < len; i++) {
                list[i].addEventListener(event, fn, false);
            }
        }
        addEventListenerList(_$$(".track"), "click", async function (e) {
            if ($(e.target).is("svg") || $(e.target).is("path")) {
                let resp = await ajax.playlist.removePlaylist(
                    this.getAttribute("song-id")
                );
                if (resp.status === 200) {
                    toastr.success(trans.__('delete_song_success'));
                    _$(`.playlist-song.track[song-id='${this.getAttribute("song-id")}']`).remove();
                } else {
                    toastr.error(trans.__('delete_song_error'));
                }
            } else {
                const isFav = 1;
                let authorArr = this.getAttribute("data-author");
                $(".track[data-id=" + _this.idSongPlay + "]").removeClass("track-active");
                audio.src = this.getAttribute("data-song");
                songThumbnail.src = this.getAttribute("data-thumbnail");
                nameSong.innerText = this.getAttribute("data-title");
                songId.value = this.getAttribute("song-id");
                _this.idSongPlay = this.getAttribute("data-id");
                authorName.innerText = authorArr;
                _this.lengListSong = $(".track").length;
                if (this.getAttribute("data-fav") == isFav) {
                    favBtn.classList.remove('unlike')
                    favBtn.classList.add('liked')
                }
                else {
                    favBtn.classList.remove('liked');
                    favBtn.classList.add('unlike')
                }
                audio.play();
            }
        });

        //Next + Prev
        nextBtn.onclick = function () {
            if (_this.isRandom) {
                playRandomSong();
            } else {
                nextSong();
            }
            audio.play();
        };
        preBtn.onclick = function () {
            if (_this.isRandom) {
                playRandomSong();
            } else {
                prevSong();
            }
            audio.play();
        };

        function nextSong() {
            $(".track[data-id=" + _this.idSongPlay + "]").removeClass("track-active");
            let idSongPlay = ++_this.idSongPlay;
            if (idSongPlay >= _this.lengListSong) {
                idSongPlay = 0;
            }
            $(".track[data-id=" + idSongPlay + "]").click();
        }
        function prevSong() {
            $(".track[data-id=" + _this.idSongPlay + "]").removeClass("track-active");
            let idSongPlay = --_this.idSongPlay;
            if (idSongPlay < 0) {
                idSongPlay = _this.lengListSong - 1;
            }
            $(".track[data-id=" + idSongPlay + "]").click();
        }
        //Replay
        replayBtn.onclick = function () {
            replayBtn.classList.toggle("active");
            _this.isReplay = !_this.isReplay;
        };
        //Random
        randomBtn.onclick = function (e) {
            _this.isRandom = !_this.isRandom;
            randomBtn.classList.toggle("active", _this.isRandom);
        };
        function playRandomSong() {
            $(".track[data-id=" + _this.idSongPlay + "]").removeClass("track-active");
            let newIndex;
            do {
                newIndex = Math.floor(Math.random() * _this.lengListSong);
            } while (newIndex == _this.idSongPlay);
            $(".track[data-id=" + newIndex + "]").click();
        }
    },
};
export default app;
// app.handleEvents();
