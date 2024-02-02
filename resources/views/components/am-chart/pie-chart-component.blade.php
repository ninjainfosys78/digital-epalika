@push('styles')
    <!-- Styles -->
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>
@endpush

@push('scripts')

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Chart code -->
    <script>
        am5.ready(function () {

            const root = am5.Root.new("chartdiv");


            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            const chart = root.container.children.push(am5percent.PieChart.new(root, {
                layout: root.verticalLayout
            }));

            const series = chart.series.push(am5percent.PieSeries.new(root, {
                valueField: "value",
                categoryField: "category"
            }));

            series.data.setAll([
                {value: 10, category: "One"},
                {value: 9, category: "Two"},
                {value: 6, category: "Three"},
                {value: 5, category: "Four"},
                {value: 4, category: "Five"},
                {value: 3, category: "Six"},
                {value: 1, category: "Seven"},
            ]);

            series.appear(1000, 100);

        }); // end am5.ready()
    </script>
@endpush

<!-- HTML -->
<div id="chartdiv"></div>
