document.addEventListener('DOMContentLoaded', function () {
    // Mood selection handler
    const moodOptions = document.querySelectorAll('.mood-option');
    if (moodOptions.length > 0) {
        moodOptions.forEach(option => {
            option.addEventListener('click', () => {
                moodOptions.forEach(opt => opt.classList.remove('active'));
                option.classList.add('active');
                // Di aplikasi nyata, di sini Anda akan mengirim data mood ke server
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('performanceChart');
    if (!ctx) return;

    const chartContext = ctx.getContext('2d');
    
    const gradient = chartContext.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(100, 121, 112, 0.4)');
    gradient.addColorStop(1, 'rgba(100, 121, 112, 0.05)');

    const chart = new Chart(chartContext, {
        type: 'line',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            datasets: [{
                label: 'Sesi Selesai',
                data: [5, 6, 8, 7, 9, 8, 7],
                borderColor: '#647970',
                borderWidth: 3,
                pointRadius: 0,
                pointHoverRadius: 0,
                fill: true,
                backgroundColor: gradient,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { 
                    enabled: true,
                    mode: 'index',
                    intersect: false,
                    backgroundColor: '#fff',
                    titleColor: '#333',
                    bodyColor: '#666',
                    borderColor: '#ddd',
                    borderWidth: 1
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { color: '#9AA5B6', stepSize: 2 },
                    grid: { color: '#F0F2F5', drawBorder: false }
                },
                x: {
                    ticks: { color: '#9AA5B6' },
                    grid: { display: false }
                }
            }
        }
    });
});
