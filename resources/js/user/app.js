import musicPlayer from "./music-player";
import { slick } from "./slick";
import ajax from "./ajax";
import trans from "../trans"
import comment from "../user/comment"

//Call slide function
slick();

ajax.sidebar.getPlaylist();

ajax.sidebar.getFavoritePlaylist();

//Call handleEvent for play music
musicPlayer.handleEvents();

// Show song detail from related song
$(document).on('click', ".related-song-item", function(e) {
    ajax.main.songPage(this.getAttribute('data-songId'));
});

//Call handle url history function to navigation
ajax.main.getUrlParam(window.location.search);

$(document).on('click', ".comment-reply", function(e) {
    var indexclicked = $('.comment-reply').index(this);
    $('.reply-input')[indexclicked].classList.toggle('active');
    $('.reply-list')[indexclicked].classList.toggle('active');
});
//Navigation route by button sidebar
$(document).on("click", "#homepage-button", async function (e) {
    await ajax.main.homepage();
});

$(document).on("click", "#search-button", async function (e) {
    await ajax.main.searchpage();
});

$(document).on("click", ".category", function () {
    ajax.main.categorypage(this.getAttribute("data-id"));
});

$(document).on("click", ".album", function (event) {
    ajax.main.albumpage(this.getAttribute("data-id"));
});

$(document).on("click", ".author", function (event) {
    ajax.main.authorpage(this.getAttribute("data-id"));
});

$(document).on("click", ".user-playlist .menu-item", async function (event) {
    await ajax.main.playlistPage(this.getAttribute("data-id"));
});

$(document).on("click", ".send-mess-btn", function (event) {
    event.preventDefault();
    comment.storeComment(this);
});

$(document).on("click", ".favorite", async function (event) {
    await ajax.main.playlistPage(this.getAttribute("data-id"));
});

$(document).on("click", "#create-playlist .btn-create", async function (event) {
    event.preventDefault();
    await ajax.playlist.createPlaylist();
});

$(document).on("click", ".unlike", async function () {
    $("#song-id-select").val($("#song-id").val());
    await ajax.playlist.addToFavorite();
});

$(document).on("click", ".liked", async function () {
    $("#song-id-select").val($("#song-id").val());
    await ajax.playlist.removeFromFavorite();
});

$(document).on("click", ".add-to-playlist", async function () {
    await ajax.playlist.getPlaylistSelect();
});

$(document).on("click", ".btn-add", async function () {
    $("#song-id-select").val($("#song-id").val());
    event.preventDefault();
    await ajax.playlist.addToPlaylist();
});

$(document).on("click", ".delete-playlist", async function () {
    if(confirm(trans.__('confirm_delete_playlist')))
        await ajax.playlist.deletePlaylist();
});

$(document).on('submit', ajax.search.formEl, function (e) {
    e.preventDefault();
    ajax.search.search();
});

let searchFire = 0;
$(document).on('keyup', ajax.search.inputEl, function (e) {
    clearTimeout(searchFire);
    searchFire = setTimeout(() => {
        ajax.search.search();
    }, 1000);
});

$(document).on('click', ajax.back.element, function (e) {
    ajax.back.goBack();
});

ajax.back.changeBackButtonStyle();
$(ajax.back.element).hover(function () {
        // over
        ajax.back.changeBackButtonStyle();
    }, function () {
        // out
        ajax.back.changeBackButtonStyle();
    }
);

let currentSongId = null;
$(document).on('DOMSubtreeModified', '.main-content', function (e) {
    let musicPlayerSongId = $('#music-player').attr('data-song-id');
    if (musicPlayerSongId && musicPlayerSongId != currentSongId) {
        currentSongId = musicPlayerSongId;
    }
    $('.track').removeClass('track-active');
    $(`.track[song-id="${currentSongId}"]`).addClass('track-active');
    $(`.song[song-id="${currentSongId}"] .quick-play`).addClass('is-playing');
    if ($('#music-player').get(0).paused) {
        $('.is-playing').find('.fa-play').removeClass('d-none');
        $('.is-playing').find('.fa-pause').addClass('d-none');
    } else {
        $('.is-playing').find('.fa-pause').removeClass('d-none');
        $('.is-playing').find('.fa-play').addClass('d-none');
    }
});
