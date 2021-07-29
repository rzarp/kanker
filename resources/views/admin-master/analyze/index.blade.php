@extends('admin-master.base')

@push('stylesheets')
    <style>
        .highcharts-title {
            font-weight: 100 !important;
        }

        .circle {
            padding: 50px;
            background: #96BAFF;
            border-radius: 600px;
            height: 300px;
            width: 300px;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .circle-text {
            position: absolute;
            text-align: center;
            top: 45%;
            bottom: 50%;
            font-weight: bolder !important;
            font-size: 40px;
        }
    </style>
@endpush

@section('content')
    <div class="section-header">
        <h1>Dashboard Analyze</h1>
    </div>

    <div class="row">
        <div class="col-md-12 mb-5">
            <label for=""> Filter Tahun </label>
            <select name="filterYear" class="form-control" onchange="window.location = '{{ route('analyze') }}' + '?year=' + this.value ">
                @php
                    $startYear = 2021;
                    $listYear = range(2021, date('Y') + 2)
                @endphp

                @foreach ($listYear as $value)
                    <option value="{{ $value }}" {{ $value == $year ? 'selected' : ''}}> {{ $value }} </option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-body">
                        <div id="monthly_status"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-body">
                        <div id="count_by_tumor_size"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-12 col-12">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-body">
                        <div id="jumlah_data"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-body" style="height: 400px;">
                        <p class="text-center highcharts-title"> Nilai Probabilitas </p>

                        <div class="circle">
                            <p class="circle-text"> {{ number_format($probability->probability, 2) ?? 0 }}% </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    $(document).ready(function() {
        let count_by_tumor_size = {!! $count_by_tumor_size !!};
        let count_by_tumor_size_map = count_by_tumor_size.map((value) => {
            return {'name' : 'Ukuran ' + value.tumor_size, y: value.count}
        });

        let monthly_status = {!! $monthly_status !!};
        let category = monthly_status.category;
        let data = monthly_status.data;

        generateColumnChart('count_by_tumor_size', 'Data Per Ukuran Tumor', count_by_tumor_size_map);
        generateColumnChartCategory('monthly_status', 'Data Per Bulan', category, data);


        let count_data_per_category = {!! $count_data_per_category !!};

        generateColumnChart('jumlah_data', 'Jumlah Data Per Kategori', count_data_per_category);
    });

    function generatePieChart(container, title, seriesname, data) {
        Highcharts.chart(container, {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: title
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: seriesname,
                colorByPoint: true,
                data: data
            }]
        });
    }

    function generateColumnChart(container, title, data) {
        console.log(data);
        Highcharts.chart(container, {
            chart: {
                type: 'column'
            },
            title: {
                text: title
            },
            xAxis: {
                type: 'category',
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Ukuran Tumor',
                colorByPoint: true,
                data: data
            }]
        });
    }

    function generateColumnChartCategory(container, title, category, data) {

        Highcharts.chart(container, {
            chart: {
                type: 'column'
            },
            title: {
                text: title
            },
            xAxis: {
                categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: data
        });
    }
</script>
@endpush
