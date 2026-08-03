@role('konselor')
    <div x-data="chartDataCounselor()" x-init="init()"
        class="rounded-2xl border border-gray-200 bg-white px-5 pb-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
        <div class="flex flex-col gap-5 mb-6 sm:flex-row sm:justify-between">
            <div class="w-full">
                {{-- Ganti Judul --}}
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    Statistik Aktivitas Saya
                </h3>
                <p class="mt-1 text-gray-500 text-sm dark:text-gray-400">
                    Analisis kinerja dan beban kerja Anda.
                </p>
            </div>

            <div class="flex items-start w-full gap-3 sm:justify-end">
                <div class="inline-flex w-fit items-center gap-0.5 rounded-lg bg-gray-100 p-0.5 dark:bg-gray-900">
                    {{-- Ganti Label & Nama Tab --}}
                    <button @click="changeTab('session_activity')"
                        :class="activeTab === 'session_activity' ?
                            'shadow-sm text-gray-900 dark:text-white bg-white dark:bg-gray-800' :
                            'text-gray-500 dark:text-gray-400'"
                        class="px-3 py-2 font-medium rounded-md text-sm hover:text-gray-900 dark:hover:text-white">
                        Aktivitas Sesi
                    </button>
                    <button @click="changeTab('service_distribution')"
                        :class="activeTab === 'service_distribution' ?
                            'shadow-sm text-gray-900 dark:text-white bg-white dark:bg-gray-800' :
                            'text-gray-500 dark:text-gray-400'"
                        class="px-3 py-2 font-medium rounded-md text-sm hover:text-gray-900 dark:hover:text-white">
                        Jenis Layanan
                    </button>
                    <button @click="changeTab('status_pipeline')"
                        :class="activeTab === 'status_pipeline' ?
                            'shadow-sm text-gray-900 dark:text-white bg-white dark:bg-gray-800' :
                            'text-gray-500 dark:text-gray-400'"
                        class="px-3 py-2 font-medium rounded-md text-sm hover:text-gray-900 dark:hover:text-white">
                        Status Janji Temu
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-full overflow-x-auto">
            <div x-ref="chart" class="-ml-4 min-w-[700px] pl-2"></div>
        </div>
    </div>

    <script>
        function chartDataCounselor() {
            return {
                activeTab: 'session_activity',
                chart: null,

                init() {
                    const options = this.getChartOptions();
                    this.chart = new ApexCharts(this.$refs.chart, options);
                    this.chart.render();
                    this.fetchData();
                },

                async fetchData() {
                    const response = await fetch(
                        `{{ route('dashboard.counselorChartDashboard') }}?type=${this.activeTab}`);
                    const data = await response.json();

                    if (this.activeTab === 'session_activity') {
                        this.chart.updateOptions(this.getChartOptions());
                        this.chart.updateSeries([{
                            name: 'Sesi Selesai',
                            data: data.series
                        }]);
                        this.chart.updateOptions({
                            xaxis: {
                                categories: data.labels
                            }
                        });
                    } else if (this.activeTab === 'service_distribution') {
                        this.chart.updateOptions(this.getBarChartOptions());
                        this.chart.updateSeries([{
                            name: 'Jumlah',
                            data: data.series
                        }]);
                        this.chart.updateOptions({
                            xaxis: {
                                categories: data.labels
                            }
                        });
                    } else if (this.activeTab === 'status_pipeline') {
                        this.chart.updateOptions(this.getBarChartStatusDistributionOptions(data.labels));
                        this.chart.updateSeries([{
                            name: 'Jumlah',
                            data: data.series
                        }]);
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
@endrole
