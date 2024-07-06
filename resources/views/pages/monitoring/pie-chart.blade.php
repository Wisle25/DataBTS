<div class="mt-16 mx-3 z-0">
    <!-- Modal -->
    <div id="btsModal2" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-4 rounded shadow-lg w-1/3 ">
            <div class="flex justify-between items-center border-b pb-2">
                <h2 class="text-xl font-bold" id="modalTitle"></h2>
                <button id="closeModal" class="text-gray-900 text-2xl w-10 h-10 flex items-center justify-center">&times;</button>
            </div>
            <div class="mt-4">
                <p id="modalCount"></p>
                <ul id="modalBTSList" class="list-disc pl-5 mt-2"></ul>
            </div>
        </div>
    </div>

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
            <div class="ml-12">
                <ul class="text-sm">
                    <li><span
                            class="bg-teal-300 text-black px-2 py-1 inline-block rounded border mr-2 my-1">Normal</span>:
                        <span id="normalCount"></span></li>
                    <li><span
                            class="bg-red-500 text-white px-2 py-1 inline-block rounded border mr-2 my-1">Fault</span>:
                        <span id="faultCount"></span></li>
                    <li><span
                            class="bg-yellow-300 text-black px-2 py-1 inline-block rounded border mr-2 my-1">Maintenance</span>:
                        <span id="maintenanceCount"></span></li>
                    <li><span
                            class="bg-gray-300 text-black px-2 py-1 inline-block rounded border mr-2 my-1">Offline</span>:
                        <span id="offlineCount"></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('pieChart').getContext('2d');
    const pieData = @json($pieData);
    const btsData = @json($btsData); // Data BTS yang diisi dari controller
    
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
            },
            onClick: function(evt, activeElements) {
                if (activeElements.length > 0) {
                    const index = activeElements[0].index;
                    const condition = chartData.labels[index];
                    showModal(condition, pieData[index + 1], btsData[condition.toLowerCase()]);
                }
            }
        }
    });

    document.getElementById('normalCount').textContent = pieData[1] || 0;
    document.getElementById('faultCount').textContent = pieData[2] || 0;
    document.getElementById('maintenanceCount').textContent = pieData[3] || 0;
    document.getElementById('offlineCount').textContent = pieData[4] || 0;

    // Show modal function
    function showModal(condition, count, btsList) {
        document.getElementById('modalTitle').textContent = `Kondisi ${condition}`;
        document.getElementById('modalCount').textContent = `Jumlah BTS: ${count}`;
        const listElement = document.getElementById('modalBTSList');
        listElement.innerHTML = '';
        btsList.forEach(bts => {
            const li = document.createElement('li');
            li.textContent = bts;
            listElement.appendChild(li);
        });

        document.getElementById('btsModal2').classList.remove('hidden');
    }

    // Close modal
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('btsModal2').classList.add('hidden');
    });
});

</script>
