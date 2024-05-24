<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Statistics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Race Statistics</h3>

                    @if($laps->isEmpty())
                        <p>No race data available.</p>
                    @else
                        <div class="chart-container" style="position: relative; height:40vh; width:80vw">
                            <!-- Canvas for the Chart -->
                            <canvas id="raceChart"></canvas>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var lapData = {!! $laps->toJson() !!};

                                if (lapData.length === 0) {
                                    console.error('No lap data available.');
                                    return;
                                }

                                // Extract lap times and labels from the last 5 races
                                var lapTimes = lapData.slice(0, 5).reverse().map(function (lap) {
                                    return lap.lap_time;
                                });

                                var raceLabels = lapData.slice(0, 5).reverse().map(function (_, index) {
                                    return 'Race ' + (index + 1);
                                });

                                console.log('lapTimes:', lapTimes);
                                console.log('raceLabels:', raceLabels);

                                // Create a bar chart
                                var ctx = document.getElementById('raceChart').getContext('2d');
                                var raceChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: raceLabels,
                                        datasets: [{
                                            label: 'Lap Times',
                                            data: lapTimes,
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            x: {
                                                beginAtZero: true,
                                            },
                                            y: {
                                                beginAtZero: true,
                                            }
                                        }
                                    }
                                });
                            });
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
