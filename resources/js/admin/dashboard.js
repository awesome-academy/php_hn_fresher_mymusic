import trans from '../trans';
import Chart from 'chart.js/auto';

const totalYear = 3;
const songChartEl = '#song-chart';
const songChartFilterEl = '#song-chart-filter';
const songChartElement = document.querySelector(songChartEl);
const songChartFilter = document.querySelector(songChartFilterEl);
const songChartLabels = trans.__('attributes.month');
const now = new Date().getFullYear();

const getSongChartData = async function (date) {
    return [date];
}

const initSongFilter = function () {
    let options = '';
    for (let i = 0; i <= totalYear - 1; i++) {
        options += `<option value="${now - i}"> ${now - i} </option>`;
    }

    if (songChartFilter) {
        songChartFilter.innerHTML = options;
    }
}

const initSongChart = async function (date = now) {
    if (songChartElement) {
        return new Chart(songChartElement, {
            type: 'line',
            data: {
                labels: songChartLabels,
                datasets: [{
                    label: trans.__('song_chart'),
                    data: await getSongChartData(date),
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                }]
            },
        });
    }
}

export default {
    initSongChart,
    initSongFilter,
    songChartEl,
    songChartFilterEl,
    songChartFilter
};
