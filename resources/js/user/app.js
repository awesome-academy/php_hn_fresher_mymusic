import musicPlayer from "./music-player";
import { slick } from "./slick";
import ajax from "./ajax";
//Call slide function
slick();
//Call handleEvent for play music
musicPlayer.handleEvents();
//Call handle url history function to navigation
ajax.main.getUrlParam();
//Navigation route by button sidebar
$(document).on("click", "#homepage-button", ajax.main.homepage);
$(document).on("click", "#search-button", ajax.main.searchpage);
$(document).on("click", ".card-box", function () {
    ajax.main.categorypage(this.getAttribute('data-id'));
});
