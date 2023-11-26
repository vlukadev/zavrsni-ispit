<style>
    .one-page-dashboard {
        padding: 20px;
        background-color: #f4f4f4;
    }

    .dashboard-content {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .widget {
        flex: 0 0 30%; /* Adjust the width of the widgets as needed */
        background-color: #fff;
        padding: 15px;
        margin-right: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="one-page-dashboard">

    <div class="dashboard-content">
        <div class="widget">
            <div x-data="{ chart: null }" x-init="initChart()">
                <h1>Most Visited Products</h1>
                <hr>
                <canvas id="mostVisitedChart" width="400" height="400"></canvas>

                <!-- Export button -->
                <button onclick="exportData()">Export as JSON</button>

                <script>
                    function initChart() {
                        let labels = {!! json_encode($mostVisitedProducts->pluck('name')) !!};
                        let data = {!! json_encode($mostVisitedProducts->pluck('visits_count')) !!};

                        this.chart = new Chart(document.getElementById('mostVisitedChart').getContext('2d'), {
                            type: 'horizontalBar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Number of Views',
                                    data: data,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    xAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }

                    // Function to export data as JSON
                    function exportData() {
                        let exportData = {
                            labels: {!! json_encode($mostVisitedProducts->pluck('name')) !!},
                            data: {!! json_encode($mostVisitedProducts->pluck('visits_count')) !!}
                        };

                        let jsonData = JSON.stringify(exportData, null, 2);
                        let blob = new Blob([jsonData], { type: 'application/json' });
                        let url = URL.createObjectURL(blob);

                        let a = document.createElement('a');
                        a.href = url;
                        a.download = 'most_visited_products_data.json';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                        URL.revokeObjectURL(url);
                    }
                </script>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
