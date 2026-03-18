// Example chart
const ctx = document.getElementById('myChart');

if (ctx) {
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar'],
            datasets: [{
                label: 'Users',
                data: [5, 10, 7]
            }]
        }
    });
}
