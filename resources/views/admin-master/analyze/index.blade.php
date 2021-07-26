@extends('admin-master.base')
@section('content')
    <div class="section-header">
        <h1>Dashboard Analyze</h1>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-body">
                        <div id="patient_stadium_type"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-body">
                        <div id="count_by_gender"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-body">
                        <div id="count_by_treatment_type"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-body">
                        <div id="count_by_tumor_size"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-wrap">
                    <div class="card-body">
                        <div id="count_by_status"></div>
                    </div>
                </div>
            </div>
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
    </div>
@endsection

@push('scripts')

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    $(document).ready(function() {
        let patient_stadium_type = {!! $patient_stadium_type !!};
        let patient_stadium_type_map = patient_stadium_type.map((value) => {
            return {'name' : value.stadium_type, y: value.count}
        });

        let count_by_gender = {!! $count_by_gender !!};
        let count_by_gender_map = count_by_gender.map((value) => {
            return {'name' : value.gender, y: value.count}
        });

        let count_by_treatment_type = {!! $count_by_treatment_type !!};
        let count_by_treatment_type_map = count_by_treatment_type.map((value) => {
            return {'name' : value.treatment_type, y: value.count}
        });

        let count_by_status = {!! $count_by_status !!};
        let count_by_status_map = count_by_status.map((value) => {
            return {'name' : value.status, y: value.count}
        });

        generatePieChart('patient_stadium_type', 'Data Per Jenis Stadium', 'Jenis Stadium', patient_stadium_type_map);
        generatePieChart('count_by_gender', 'Data Per Jenis Kelamin', 'Jenis Kelamin', count_by_gender_map);
        generatePieChart('count_by_treatment_type', 'Data Per Jenis Pengobatan', 'Jenis Pengobatan', count_by_treatment_type_map);
        generatePieChart('count_by_status', 'Data Per Status Pasien', 'Status Pasien', count_by_status_map);

        let count_by_tumor_size = {!! $count_by_tumor_size !!};
        let count_by_tumor_size_map = count_by_tumor_size.map((value) => {
            return {'name' : 'Ukuran ' + value.tumor_size, y: value.count}
        });

        let monthly_status = {!! $monthly_status !!};
        let category = monthly_status.category;
        let monthly_status_data_hidup = [],
            monthly_status_data_meninggal = [];

        monthly_status.data.map((value) => {
            monthly_status_data_hidup.push(value.HIDUP);
            monthly_status_data_meninggal.push(value.MENINGGAL);
        });

        generateColumnChart('count_by_tumor_size', 'Data Per Ukuran Tumor', count_by_tumor_size_map);
        generateColumnChartCategory('monthly_status', 'Data Kematian Per Bulan', category, [monthly_status_data_hidup, monthly_status_data_meninggal]);
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
            series: [{
                name: 'Hidup',
                data: data[0]
            }, {
                name: 'Meninggal',
                data: data[1]
            }]
        });
    }
</script>
@endpush
