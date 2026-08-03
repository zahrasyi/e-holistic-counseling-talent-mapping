    <div x-data="chartData()" x-init="init()"
        class="rounded-2xl border border-gray-200 bg-white px-5 pb-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
        <div class="flex flex-col gap-5 mb-6 sm:flex-row sm:justify-between">
            <div class="w-full">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    Statistik Janji Temu
                </h3>
                <p class="mt-1 text-gray-500 text-sm dark:text-gray-400">
                    Analisis aktivitas sistem e-counseling
                </p>
            </div>

            <div class="flex items-start w-full gap-3 sm:justify-end">
                <div class="inline-flex w-fit items-center gap-0.5 rounded-lg bg-gray-100 p-0.5 dark:bg-gray-900">
                    <button @click="changeTab('daily_activity')"
                        :class="activeTab === 'daily_activity' ?
                            'shadow-sm text-gray-900 dark:text-white bg-white dark:bg-gray-800' :
                            'text-gray-500 dark:text-gray-400'"
                        class="px-3 py-2 font-medium rounded-md text-sm hover:text-gray-900 dark:hover:text-white">
                        Aktivitas Harian
                    </button>
                    <button @click="changeTab('status_distribution')"
                        :class="activeTab === 'status_distribution' ?
                            'shadow-sm text-gray-900 dark:text-white bg-white dark:bg-gray-800' :
                            'text-gray-500 dark:text-gray-400'"
                        class="px-3 py-2 font-medium rounded-md text-sm hover:text-gray-900 dark:hover:text-white">
                        Distribusi Status
                    </button>
                    <button @click="changeTab('counselor_workload')"
                        :class="activeTab === 'counselor_workload' ?
                            'shadow-sm text-gray-900 dark:text-white bg-white dark:bg-gray-800' :
                            'text-gray-500 dark:text-gray-400'"
                        class="px-3 py-2 font-medium rounded-md text-sm hover:text-gray-900 dark:hover:text-white">
                        Beban Konselor
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
                activeTab: 'daily_activity',
                chart: null,

                init() {
                    const options = this.getChartOptions();
                    this.chart = new ApexCharts(this.$refs.chart, options);
                    this.chart.render();
                    this.fetchData();
                },

                async fetchData() {
                    const response = await fetch(`{{ route('dashboard.adminChartDashboard') }}?type=${this.activeTab}`);
                    const data = await response.json();

                    if (this.activeTab === 'daily_activity') {
                        this.chart.updateOptions(this.getChartOptions());
                        this.chart.updateSeries([{
                            name: 'Sesi Dibuat',
                            data: data.series
                        }]);
                        this.chart.updateOptions({
                            xaxis: {
                                categories: data.labels
                            }
                        });
                    } else if (this.activeTab === 'status_distribution') {
                        this.chart.updateOptions(this.getBarChartStatusDistributionOptions(data.labels));
                        this.chart.updateSeries([{
                            name: 'Sesi Selesai',
                            data: data.series
                        }]);
                    } else if (this.activeTab === 'counselor_workload') {
                        this.chart.updateOptions(this.getBarChartOptions());
                        this.chart.updateSeries([{
                            name: 'Sesi Selesai',
                            data: data.series
                        }]);
                        this.chart.updateOptions({
                            xaxis: {
                                categories: data.labels
                            }
                        });
                    }
                },

                changeTab(tab) {
                    this.activeTab = tab;
                    this.fetchData();
                },

                getBarChartStatusDistributionOptions(labels = []) {
                    const isDark = document.documentElement.classList.contains('dark');
                    return {
                        chart: {
                            type: 'bar',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        series: [],
                        xaxis: {
                            categories: labels,
                            labels: {
                                style: {
                                    colors: Array(labels.length).fill(isDark ? '#fff' : '#333')
                                }
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    colors: isDark ? '#fff' : '#333'
                                }
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '55%',
                                distributed: true
                            }
                        },
                        legend: {
                            show: false
                        },
                        tooltip: {
                            theme: isDark ? 'dark' : 'light'
                        },
                        dataLabels: {
                            enabled: false
                        }
                    }
                },

                getChartOptions() {
                    return {
                        chart: {
                            type: 'line',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        series: [],
                        xaxis: {
                            categories: []
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        dataLabels: {
                            enabled: false
                        },
                        noData: {
                            text: 'Data belum ada.'
                        }
                    }
                },

                getBarChartOptions() {
                    return {
                        chart: {
                            type: 'bar',
                            height: 350,
                            toolbar: {
                                show: false
                            }
                        },
                        series: [],
                        xaxis: {
                            categories: []
                        },
                        noData: {
                            text: 'Data belum ada.'
                        }
                    }
                },
            }
        }
    </script>
