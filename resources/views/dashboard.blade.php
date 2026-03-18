<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hostel Management Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 space-y-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- KPI Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Booked Rooms -->
            <div class="bg-white p-6 rounded-lg shadow flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Booked Rooms</p>
                    <p class="text-3xl font-bold text-green-600">{{ $bookedRooms ?? 0 }}</p>
                </div>
                <div class="text-green-600">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M3 10h18M5 10V7a2 2 0 012-2h4a2 2 0 012 2v3M5 14v6M19 14v6" />
                    </svg>
                </div>
            </div>

            <!-- Vacant Rooms -->
            <div class="bg-white p-6 rounded-lg shadow flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Vacant Rooms</p>
                    <p class="text-3xl font-bold text-yellow-500">{{ $vacantRooms ?? 0 }}</p>
                </div>
                <div class="text-yellow-500">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M8 3h8v18H8zM12 12h.01" />
                    </svg>
                </div>
            </div>

            <!-- Total Paid -->
            <div class="bg-white p-6 rounded-lg shadow flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Paid</p>
                    <p class="text-2xl font-bold text-purple-600">KES {{ number_format($totalPaid ?? 0) }}</p>
                </div>
                <div class="text-purple-600">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M12 8c-3.866 0-7 1.79-7 4s3.134 4 7 4
                                 7-1.79 7-4-3.134-4-7-4z"/>
                        <path d="M5 12v4c0 2.21 3.134 4 7 4s7-1.79 7-4v-4"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Users Per Month Chart -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h5 class="text-lg font-semibold mb-2">Users Per Month</h5>
                <canvas id="usersChart"></canvas>
            </div>

            <!-- Rooms Occupancy Chart -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h5 class="text-lg font-semibold mb-2">Rooms Occupancy</h5>
                <canvas id="roomsChart"></canvas>
            </div>

        </div>

    </div>

    <!-- Push scripts to the layout -->
    @push('scripts')
        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Pass PHP data to JS safely
            window.chartData = {
                months: @json($months ?? []),
                totals: @json($totals ?? []),
                rooms: {
                    booked: {{ $bookedRooms ?? 0 }},
                    vacant: {{ $vacantRooms ?? 0 }}
                }
            };

            // Run charts after DOM is ready
            document.addEventListener('DOMContentLoaded', function () {

                // Users Per Month Chart
                const usersCtx = document.getElementById('usersChart');
                if (usersCtx) {
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
                            scales: {
                                y: { beginAtZero: true }
                            }
                        }
                    });
                }

                // Rooms Occupancy Chart
                const roomsCtx = document.getElementById('roomsChart');
                if (roomsCtx) {
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
                }

            });
        </script>
    @endpush

</x-app-layout>
