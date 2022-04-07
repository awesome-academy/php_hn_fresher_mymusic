import trans from '../trans';
import Chart from 'chart.js/auto';
import axios from './axios';

const totalYear = 3;
const songChartEl = '#song-chart';
const songChartFilterEl = '#song-chart-filter';
const songChartElement = document.querySelector(songChartEl);
const songChartFilter = document.querySelector(songChartFilterEl);
const songChartLabels = trans.__('attributes.month');
const now = new Date().getFullYear();

const getSongChartData = async function (year) {
    let data = [];
    let res = await axios.get('/api/dashboard/songs/' + year);
    if (res && res.status === 200) {
        data = Object.values(res.data.songs);
    } else {
        toastr.error(trans.__('have_error'));
    }

    return data;
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

const initSongChart = async function (year = now) {
    if (songChartElement) {
        return new Chart(songChartElement, {
            type: 'bar',
            data: {
                labels: songChartLabels,
                datasets: [{
                    label: trans.__('song_chart'),
                    data: await getSongChartData(year),
                    fill: false,
                    backgroundColor: 'rgb(75, 192, 192)',
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
