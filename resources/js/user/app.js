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
$(document).on("click", ".menu-item", function (event) {
    ajax.main.playlistPage(this.getAttribute("data-id"));
});