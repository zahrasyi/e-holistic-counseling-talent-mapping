<div x-data="chartData()" x-init="init()"
    class="mt-6 rounded-2xl border border-gray-200 bg-white px-5 pb-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
    <div class="flex flex-col gap-5 mb-6 sm:flex-row sm:justify-between">
        <div class="w-full">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                Analisis Aktivitas Saya
            </h3>
            <p class="mt-1 text-gray-500 text-sm dark:text-gray-400">
                Lihat ringkasan perjalanan konseling Anda.
            </p>
        </div>

        <div class="flex items-start w-full gap-3 sm:justify-end">
            <div class="inline-flex w-fit items-center gap-0.5 rounded-lg bg-gray-100 p-0.5 dark:bg-gray-900">
                <button @click="changeTab('session_frequency')"
                    :class="activeTab === 'session_frequency' ?
                        'shadow-sm text-gray-900 dark:text-white bg-white dark:bg-gray-800' :
                        'text-gray-500 dark:text-gray-400'"
                    class="px-3 py-2 font-medium rounded-md text-sm hover:text-gray-900 dark:hover:text-white">
                    Frekuensi Sesi
                </button>
                <button @click="changeTab('service_distribution')"
                    :class="activeTab === 'service_distribution' ?
                        'shadow-sm text-gray-900 dark:text-white bg-white dark:bg-gray-800' :
                        'text-gray-500 dark:text-gray-400'"
                    class="px-3 py-2 font-medium rounded-md text-sm hover:text-gray-900 dark:hover:text-white">
                    Jenis Layanan
                </button>
                <button @click="changeTab('sessions_per_counselor')"
                    :class="activeTab === 'sessions_per_counselor' ?
                        'shadow-sm text-gray-900 dark:text-white bg-white dark:bg-gray-800' :
                        'text-gray-500 dark:text-gray-400'"
                    class="px-3 py-2 font-medium rounded-md text-sm hover:text-gray-900 dark:hover:text-white">
                    Sesi per Konselor
                </button>
            </div>
        </div>
    </div>

    <div class="max-w-full overflow-x-auto">
        <div x-ref="chart" class="-ml-4 min-w-[700px] pl-2"></div>
    </div>
</div>

<script>
    function chartData() {
        return {
            activeTab: 'session_frequency',
            chart: null,

            init() {
                const options = this.getChartConfig(this.activeTab);
                this.chart = new ApexCharts(this.$refs.chart, options);
                this.chart.render();
                this.fetchData();
            },

            async fetchData() {
                try {
                    const response = await fetch(
                        `{{ route('dashboard.userChartDashboard') }}?type=${this.activeTab}`);
                    const data = await response.json();
                    this.chart.updateOptions(this.getChartConfig(this.activeTab, data));
                } catch (error) {
                    console.error('Gagal mengambil data chart:', error);
                }
            },

            changeTab(tab) {
                this.activeTab = tab;
                this.fetchData();
            },

            getChartConfig(type, data = {}) {
                const seriesData = data.series || [];
                const labelsData = data.labels || [];
                const baseOptions = {
                    chart: {
                        height: 350,
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    noData: {
                        text: 'Data belum ada'
                    }
                };

                switch (type) {
                    case 'service_distribution':
                        return {
                            ...baseOptions,
                            chart: {
                                    ...baseOptions.chart,
                                    type: 'bar'
                                },
                                series: [{
                                    name: 'Jumlah Sesi',
                                    data: seriesData
                                }],
                                xaxis: {
                                    categories: labelsData
                                },
                                plotOptions: {
                                    bar: {
                                        distributed: true,
                                        horizontal: false
                                    }
                                },
                                legend: {
                                    show: false
                                }
                        };

                    case 'sessions_per_counselor':
                        return {
                            ...baseOptions,
                            chart: {
                                    ...baseOptions.chart,
                                    type: 'bar'
                                },
                                series: [{
                                    name: 'Sesi Selesai',
                                    data: seriesData
                                }],
                                xaxis: {
                                    categories: labelsData
                                }
                        };

                    case 'session_frequency':
                    default:
                        return {
                            ...baseOptions,
                            chart: {
                                    ...baseOptions.chart,
                                    type: 'line'
                                },
                                series: [{
                                    name: 'Sesi Selesai',
                                    data: seriesData
                                }],
                                xaxis: {
                                    categories: labelsData
                                },
                                stroke: {
                                    curve: 'smooth'
                                }
                        };
                }
            }
        }
    }
</script>
