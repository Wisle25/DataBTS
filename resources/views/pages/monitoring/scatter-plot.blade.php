<!-- Scatter Plot -->
<div  class="mt-16 mb-8 mx-3 z-0">
    @component('components.section.title')
        Plot Monitoring
    @endcomponent
    <canvas id="scatterPlot" width="300" height="150" class="mt-5 bg-slate-50 border border-gray-400 shadow-sm"></canvas>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('scatterPlot').getContext('2d');

        function parseScatterData(data, conditionId) {
            return Object.keys(data).map(function(key) {
                return {
                    x: new Date(key + '-01').getTime(),
                    y: data[key][conditionId] || 0
                };
            });
        }

        var scatterData = {
            datasets: [{
                    label: 'Normal',
                    data: parseScatterData({!! json_encode($scatterData) !!}, 1),
                    backgroundColor: 'rgba(75, 192, 192, 1)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    showLine: true,
                    fill: false,
                    radius: 4
                },
                {
                    label: 'Fault',
                    data: parseScatterData({!! json_encode($scatterData) !!}, 2),
                    backgroundColor: 'rgba(255, 99, 132, 1)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    showLine: true,
                    fill: false,
                    radius: 4
                },
                {
                    label: 'Maintenance',
                    data: parseScatterData({!! json_encode($scatterData) !!}, 3),
                    backgroundColor: 'rgba(255, 205, 86, 1)',
                    borderColor: 'rgba(255, 205, 86, 1)',
                    showLine: true,
                    fill: false,
                    radius: 4
                },
                {
                    label: 'Offline',
                    data: parseScatterData({!! json_encode($scatterData) !!}, 4),
                    backgroundColor: 'rgba(201, 203, 207, 1)',
                    borderColor: 'rgba(201, 203, 207, 1)',
                    showLine: true,
                    fill: false,
                    radius: 4
                }
            ]
        };

        var scatterOptions = {
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'month',
                        tooltipFormat: 'MMM yyyy',
                        displayFormats: {
                            month: 'MMM yyyy'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Bulan dan Tahun'
                    },
                    min: new Date('2023-12-20').getTime(), // Menentukan nilai minimum untuk sumbu x
                    max: new Date('2024-07-31').getTime() // Menentukan nilai maksimum untuk sumbu x
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah BTS'
                    },
                    min: 0, 
                    max: 15, 
                    ticks: {
                        stepSize: 1 
                    }
                }
            }
        };

        var scatterPlot = new Chart(ctx, {
            type: 'line', 
            data: scatterData,
            options: scatterOptions
        });

        window.toggleDataset = function(datasetIndex) {
            var dataset = scatterPlot.data.datasets[datasetIndex];
            dataset.hidden = !dataset.hidden;
            scatterPlot.update();
        }
    });
</script>
