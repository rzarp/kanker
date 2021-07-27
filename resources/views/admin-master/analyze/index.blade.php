@extends('admin-master.base')
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

        <div class="col-lg-12 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-body">
                        <div id="monthly_status"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-body">
                        <div id="count_by_tumor_size"></div>
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
        // generatePieChart('patient_stadium_type', 'Data Per Jenis Stadium', 'Jenis Stadium', patient_stadium_type_map);
        // generatePieChart('count_by_gender', 'Data Per Jenis Kelamin', 'Jenis Kelamin', count_by_gender_map);
        // generatePieChart('count_by_treatment_type', 'Data Per Jenis Pengobatan', 'Jenis Pengobatan', count_by_treatment_type_map);
        // generatePieChart('count_by_status', 'Data Per Status Pasien', 'Status Pasien', count_by_status_map);

        let count_by_tumor_size = {!! $count_by_tumor_size !!};
        let count_by_tumor_size_map = count_by_tumor_size.map((value) => {
            return {'name' : 'Ukuran ' + value.tumor_size, y: value.count}
        });

        let monthly_status = {!! $monthly_status !!};
        let category = monthly_status.category;
        let data = monthly_status.data;

        generateColumnChart('count_by_tumor_size', 'Data Per Ukuran Tumor', count_by_tumor_size_map);
        generateColumnChartCategory('monthly_status', 'Data Per Bulan', category, data);
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
