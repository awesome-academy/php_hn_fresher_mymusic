import { slick } from "./slick";
import musicPlayer from "./music-player";
import axios from "../admin/axios";

const _$ = document.querySelector.bind(document);
const _$$ = document.querySelectorAll.bind(document);

const main = {
    el: _$("#main"),
    render: function (html) {
        let r = `
      <div class="main-content">
        ${html}
      </div>
    `;

        this.el.innerHTML = r;
    },
    homepage: async function (e) {
        let resp = await axios.get("/homepage");
        if (resp && resp.status === 200) {
            sidebar.unactiveMenuItems();
            $("#homepage-button").addClass("c-active");
            uri.updateQueryStringParameter({ key: "ac", value: "homepage" });
            main.render(resp.data);
            musicPlayer.handleEvents();
            slick();
        }
    },
    searchpage: async function (e) {
        let resp = await axios.get("/search");
        sidebar.unactiveMenuItems();
        $("#search-button").addClass("c-active");
        uri.updateQueryStringParameter({ key: "ac", value: "search" });
        main.render(resp.data);
    },
    categorypage: async function (id) {
        let resp = await axios.get("/category?id=" + id);
        uri.updateQueryStringParameter({ key: "ac", value: "category" });
        main.render(resp.data);
        musicPlayer.handleEvents();
    },
    getUrlParam: function () {
        const params = new URLSearchParams(window.location.search);
        switch (params.get("ac")) {
            case "homepage":
                main.homepage();
                break;
            case "search":
                main.searchpage();
                break;
            case "category":
                main.categorypage();
                break;
            default:
                break;
        }
    },
};

const sidebar = {
    unactiveMenuItems: function () {
        _$$(".menu-item").forEach((e) => {
            e.classList.remove("c-active");
        });
    },
};

const uri = {
    updateQueryStringParameter: function (cx) {
        const { key, value } = cx;
        const url = new URL(window.location);
        url.searchParams.set(key, value);
        window.history.pushState({}, "", url);
    },
};

export default {
    sidebar,
    main,
    uri,
};
