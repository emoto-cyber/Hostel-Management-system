import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

import Chart from 'chart.js/auto';


// console.log("js loaded");

document.addEventListener('DOMContentLoaded', function () {
    // Wait for the canvases to exist
    const waitForCanvas = (id, callback) => {
        const canvas = document.getElementById(id);
        if (canvas) return callback(canvas);
        // If not found, try again after 50ms
        setTimeout(() => waitForCanvas(id, callback), 50);
    };

    waitForCanvas('usersChart', (usersCtx) => {
        new Chart(usersCtx, {
            type: 'bar',
            data: {
                labels: window.chartData.months,
                datasets: [{
                    label: 'Users',
                    data: window.chartData.totals,
                    backgroundColor: 'rgba(34,197,94,0.6)',
                    borderColor: 'rgba(34,197,94,1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });
    });

    waitForCanvas('roomsChart', (roomsCtx) => {
        new Chart(roomsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Booked', 'Vacant'],
                datasets: [{
                    label: 'Rooms',
                    data: [window.chartData.rooms.booked, window.chartData.rooms.vacant],
                    backgroundColor: ['rgba(34,197,94,0.6)','rgba(234,179,8,0.6)'],
                    borderColor: ['rgba(34,197,94,1)','rgba(234,179,8,1)'],
                    borderWidth: 1
                }]
            },
            options: { responsive: true }
        });
    });
});
