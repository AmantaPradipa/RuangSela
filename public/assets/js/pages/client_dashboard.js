document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('moodChart');
    if (!ctx) return;

    const chartContext = ctx.getContext('2d');
    
    const gradient = chartContext.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(123, 153, 127, 0.4)'); // primary-color with opacity
    gradient.addColorStop(1, 'rgba(123, 153, 127, 0.05)');

    const moodChart = new Chart(chartContext, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Mood Harian',
                data: [65, 59, 80, 81, 56, 55, 40], // Example data
                borderColor: 'var(--primary-color)',
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: 'var(--primary-color)',
                pointBorderColor: '#fff',
                pointHoverRadius: 6,
                fill: true,
                backgroundColor: gradient,
                tension: 0.3 // Smooth curves
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // Hide legend
                },
                tooltip: {
                    backgroundColor: 'var(--dark-text)',
                    titleColor: 'var(--white-text)',
                    bodyColor: 'var(--white-text)',
                    borderColor: 'var(--primary-color)',
                    borderWidth: 1,
                    cornerRadius: 4,
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    grid: {
                        color: 'var(--border-light)',
                        drawBorder: false
                    },
                    ticks: {
                        color: 'var(--light-text)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: 'var(--light-text)'
                    }
                }
            }
        }
    });
});