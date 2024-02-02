<h4 class="header-title">{{$chartName}}</h4>
<div class="mt-4 chartjs-chart">
    <canvas id="{{$id}}" height="140"></canvas>
</div>

@once
    @push('scripts')
        <script>
            function random_bg_color() {
                const x = Math.floor(Math.random() * 256);
                const y = Math.floor(Math.random() * 256);
                const z = Math.floor(Math.random() * 256);
                return "rgb(" + x + "," + y + "," + z + ")";
            }
        </script>
    @endpush
@endonce
@push('scripts')

    <script>
        const pie{{Str::slug($id,'_')}} = document.getElementById('{{$id}}');
        const myPieChart{{Str::slug($id,'_')}} = new Chart(pie{{Str::slug($id,'_')}}, {
            type: '{{$chartType}}',
            data: {
                labels: [
                    @foreach($labels as $label)
                        '{{$label}}' {{!$loop->last ? ",":""}}
                        @endforeach
                ],
                datasets: [
                        @foreach($dataSets as $dataSet)
                    {
                        label: '{{$dataSet['label'] ?? ''}}',
                        data: [
                            @foreach($dataSet['data'] as $data)
                                '{{$data}}' {{!$loop->last ? ",":""}}
                                @endforeach
                        ],
                        backgroundColor: [
                            @foreach($dataSet['data'] as $data)
                            random_bg_color() {{!$loop->last ? ",":""}}
                            @endforeach
                        ],
                        hoverOffset: 4
                    }{{!$loop->last ? ",":""}}
                        @endforeach
                ],


            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                legend:{
                    display:"{{$displayLegend}}"
                }
            }
        });
    </script>

@endpush
