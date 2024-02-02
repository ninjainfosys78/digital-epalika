<h4 class="header-title">{{$chartTitle}}</h4>
<div class="mt-4 chartjs-chart">
    <canvas id="{{$id}}"></canvas>
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
        const ctx{{Str::slug($id,"_")}} = document.getElementById('{{$id}}').getContext('2d');
        const {{Str::slug($id,"_")}} = new Chart(ctx{{Str::slug($id,"_")}}, {
            type: '{{$chartType}}',
            data: {
                labels: [@foreach($labels as $label)"{{$label}}" {{!$loop->last ? "," : ""}} @endforeach],
                datasets: [
                        @foreach($dataSets as $dataSet){
                        data: [@foreach($dataSet["data"] as $data) {{$data}} {{!$loop->last ? "," : ""}} @endforeach],
                        label: "{{$dataSet['label'] ?? ''}}",
                        borderColor: random_bg_color(),
                        backgroundColor: random_bg_color(),
                        fill: {{$dataSet['fill'] ?? false}},
                    }{{!$loop->last ? "," : ""}}
                        @endforeach
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend:{
                    display:"{{$displayLegend}}"
                }
            }
        });
    </script>


@endpush
