require('./bootstrap');
require('./admin/notification')
import { song } from './admin/song';
import user from './admin/user';
import dashboard from './admin/dashboard';
song()

$('#authors-select').select2({
    tags: true,
});

$('.admin-user-table .user-manage').click(async function (e) {
    if (e.target.checked) {
        await user.unblockUser(e);
    } else {
        await user.blockUser(e);
    }
});

let currentSongChart = null;
$(document).on('DOMContentLoaded', async function () {
    currentSongChart = await dashboard.initSongChart();
    dashboard.initSongFilter();
    $(dashboard.songChartFilterEl).select2({
        width: '128px',
    });
});

$(document).on('change', dashboard.songChartFilterEl, async function (e) {
    if (currentSongChart) {
        currentSongChart.destroy();
    }

    currentSongChart = await dashboard.initSongChart(dashboard.songChartFilter.value);
})
