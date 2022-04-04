import Pusher from "pusher-js";
import trans from "../trans";
import axios from "../admin/axios";
$(document).ready(function () {
    var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
        encrypted: true,
        cluster: "ap2",
    });
    var channel = pusher.subscribe("NotificationEvent");
    channel.bind("send-notification", function (data) {
        let pending = parseInt($("#notifications").find(".pending").html());
        if (Number.isNaN(pending)) {
            $("#notifications").append(
                '<span class="pending badge bg-primary badge-number">1</span>'
            );
        } else {
            $("#notifications")
                .find(".pending")
                .html(pending + 1);
        }
        let notificationItem = `
        <li class="notification-item unread">
            <p>${trans.__("notification_mess", { email: data.email })}</p>
            <p class="float-right">${trans.__("recent")}</p>
        </li>`;
        $("#notification-list").prepend(notificationItem);
    });

    $(document).on("click", ".notification-item", async function (e) {
        let resp = await axios.put("/admin/notify/mark-as-read", {
            id: $(this).attr("data-id"),
        });
        if (resp && resp.status === 200) {
            window.location.assign("/admin/users");
        }
    });

    $(document).on("click", ".mark-at-read", async function (e) {
        let resp = await axios.put("/admin/notify/mark-as-read-all");
        if (resp && resp.status === 200) {
            $(".notification-item").removeClass("unread");
            $("#notifications").find(".pending").remove();
        }
    });
});
