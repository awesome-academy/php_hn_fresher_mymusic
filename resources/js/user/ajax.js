import { slick } from "./slick";
import musicPlayer from "./music-player";
import axios from "../admin/axios";

const _$ = document.querySelector.bind(document);
const _$$ = document.querySelectorAll.bind(document);

const main = {
    el: _$("#main"),
    render: function (html) {
        let r = `<div class="main-content">${html}</div>`;
        this.el.innerHTML = r;
    },
    homepage: async function (e) {
        let resp = await axios.get("/homepage");
        if (resp && resp.status === 200) {
            sidebar.unactiveMenuItems();
            $("#homepage-button").addClass("c-active");
            uri.updateQueryStringParameter({ key: "", value: "homepage" });
            main.render(resp.data);
            musicPlayer.handleEvents();
            slick();
        }
    },
    searchpage: async function (e) {
        let resp = await axios.get("/search");
        sidebar.unactiveMenuItems();
        $("#search-button").addClass("c-active");
        uri.updateQueryStringParameter({ key: "", value: "search" });
        main.render(resp.data);
        slick();
    },
    categorypage: async function (id) {
        let resp = await axios.get("/category?id=" + id);
        uri.updateQueryStringParameter(
            { key: "", value: "category" },
            { param: "id", val: id }
        );
        main.render(resp.data);
        musicPlayer.handleEvents();
    },
    albumpage: async function (id) {
        let resp = await axios.get("/album?id=" + id);
        uri.updateQueryStringParameter(
            { key: "", value: "album" },
            { param: "id", val: id }
        );
        main.render(resp.data);
        musicPlayer.handleEvents();
        slick();
    },
    authorpage: async function (id) {
        let resp = await axios.get("/author?id=" + id);
        uri.updateQueryStringParameter(
            { key: "", value: "author" },
            { param: "id", val: id }
        );
        main.render(resp.data);
        musicPlayer.handleEvents();
    },
    playlistPage: async function (id) {
        let resp = await axios.get("/playlist/" + id);
        uri.updateQueryStringParameter(
            { key: "", value: "playlist" },
            { param: "id", val: id }
        );
        main.render(resp.data);
        musicPlayer.handleEvents();
    },
    getUrlParam: async function (url = null) {
        const params = new URLSearchParams(window.location.search);
        let _url = url || params.get("");
        switch (_url) {
            case "homepage":
                await main.homepage();
                break;
            case "search":
                await main.searchpage(params.get("id"));
                break;
            case "category":
                await main.categorypage(params.get("id"));
                break;
            case "album":
                await main.albumpage(params.get("id"));
                break;
            case "author":
                await main.authorpage(params.get("id"));
                break;
            case "playlist":
                await main.playlistPage(params.get("id"));
                break;
            default:
                break;
        }
    },
};

const sidebar = {
    el: _$("#sidebar-playlist"),
    renderPlaylist: function (playlists) {
        let r = "";
        playlists.forEach((playlist) => {
            r += `<li class="menu-item menu-item-light" data-id="${playlist.id}">
                        <span class="title">${playlist.name}</span>
                    </li>`;
        });
        this.el.innerHTML = r;
    },
    unactiveMenuItems: function () {
        _$$(".menu-item").forEach((e) => {
            e.classList.remove("c-active");
        });
    },
    getPlaylist: async function(){
        let resp = await axios.get("/playlist");
        if (resp && resp.status === 200) {
            sidebar.unactiveMenuItems();
            sidebar.renderPlaylist(resp.data.playlists);
            $("#homepage-button").addClass("c-active");
        }
    }
};

const uri = {
    updateQueryStringParameter: function (cx, pr) {
        const { key, value } = cx;
        const url = new URL(window.location);
        url.searchParams.delete("id");
        url.searchParams.set(key, value);
        if (pr) {
            const { param, val } = pr;
            url.searchParams.set(param, val);
        }
        window.history.pushState({}, "", url);
    },
};

export default {
    sidebar,
    main,
    uri,
};
