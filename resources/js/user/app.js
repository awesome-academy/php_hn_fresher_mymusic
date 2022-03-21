import musicPlayer from "./music-player";
import { slick } from "./slick";
import ajax from "./ajax";
//Call slide function
slick();
ajax.sidebar.getPlaylist();
//Call handleEvent for play music
musicPlayer.handleEvents();
//Call handle url history function to navigation
ajax.main.getUrlParam();
//Navigation route by button sidebar
$(document).on("click", "#homepage-button", ajax.main.homepage);
$(document).on("click", "#search-button", ajax.main.searchpage);
$(document).on("click", ".category", function () {
    ajax.main.categorypage(this.getAttribute("data-id"));
});
$(document).on("click", ".album", function (event) {
    ajax.main.albumpage(this.getAttribute("data-id"));
});
$(document).on("click", ".author", function (event) {
    ajax.main.authorpage(this.getAttribute("data-id"));
});
$(document).on("click", ".author", function (event) {
    ajax.main.authorpage(this.getAttribute("data-id"));
});
$(document).on("click", ".user-playlist .menu-item", function (event) {
    ajax.main.playlistPage(this.getAttribute("data-id"));
});
$(document).on("click", "#create-playlist .btn-create", async function (event) {
    event.preventDefault();
    await ajax.playlist.createPlaylist();
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
    await ajax.playlist.deletePlaylist();
});
