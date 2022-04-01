import Pusher from "pusher-js";
import trans from "../trans";
$(document).ready(function () {
    var pusher = new Pusher(process.env.MIX_PUSHER_APP_KEY, {
        encrypted: true,
        cluster: "ap2",
    });
    var channel = pusher.subscribe("NotificationEvent");
    channel.bind("send-notification", function (data) {
        let pending = parseInt($("#notifications").find(".pending").html());
        $("#notifications")
            .find(".pending")
            .html(pending + 1);
        let notificationItem = `
        <li class="notification-item unread">
            <p>${trans.__("notification_mess", { email: data.email })}</p>
            <p class="float-right">${trans.__("recent")}</p>
        </li>`;
        $("#notification-list").prepend(notificationItem);
    });
});
