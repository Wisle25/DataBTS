<div class="mt-16 mx-3 z-0">
    <div class="container bg-blue-100 px-4 pb-2 pt-1 border-gray-400 border shadow-sm">
        <form method="GET" action="{{ route('monitoring.index') }}" class="my-4 mx-4 flex">
            <h1 class="mr-5 text-3xl font-semibold font-nunito mt-2">
                Kondisi:
            </h1>
            <div class="flex items-center space-x-4">
                <div>
                    <label for="month" class="block text-xs font-medium text-gray-700">Bulan:</label>
                    <select id="month" name="month"
                        class="block w-full py-1 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach ($availableMonths as $month)
                            <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="year" class="block text-xs font-medium text-gray-700">Tahun:</label>
                    <select id="year" name="year"
                        class="block w-full py-1 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @foreach ($availableYears as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="inline-flex items-center mt-3 px-4 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Filter</button>
            </div>
        </form>
        <div class="flex justify-center">
            <div class="w-1/2 text-center">
                <canvas id="pieChart"></canvas>
            </div>
            <div class="ml-6">
                <ul >
                    <li><span class="bg-teal-300 text-black text-xs px-2 py-1 inline-block rounded border mr-2 my-1">Normal</span>: <span id="normalCount"></span></li>
                    <li><span class="bg-red-500 text-white text-xs px-2 py-1 inline-block rounded border mr-2 my-1">Fault</span>: <span id="faultCount"></span></li>
                    <li><span class="bg-yellow-300 text-black text-xs px-2 py-1 inline-block rounded border mr-2 my-1">Maintenance</span>: <span id="maintenanceCount"></span></li>
                    <li><span class="bg-gray-300 text-black text-xs px-2 py-1 inline-block rounded border mr-2 my-1">Offline</span>: <span id="offlineCount"></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieData = @json($pieData);

        const chartData = {
            labels: ['Normal', 'Fault', 'Maintenance', 'Offline'],
            datasets: [{
                data: [
                    pieData[1] || 0,
                    pieData[2] || 0,
                    pieData[3] || 0,
                    pieData[4] || 0
                ],
                backgroundColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 205, 86, 1)', 'rgba(201, 203, 207, 1)'],
            }]
        };

        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Monitoring Conditions for Selected Month and Year'
                    }
                }
            }
        });

        document.getElementById('normalCount').textContent = pieData[1] || 0;
        document.getElementById('faultCount').textContent = pieData[2] || 0;
        document.getElementById('maintenanceCount').textContent = pieData[3] || 0;
        document.getElementById('offlineCount').textContent = pieData[4] || 0;
    });
</script>
