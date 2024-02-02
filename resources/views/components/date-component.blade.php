<div class="row">
    <div class="col-md-6">
        <label for="{{$name_ne}}">{{$label_ne}}</label>
        <input type="text" name="{{$name_ne}}" class="form-control" id="{{$name_ne}}">
    </div>
    <div class="col-md-6">
        <label for="{{$name_en}}">{{$label_en}}</label>
        <input type="date" name="{{$name_en}}" class="form-control" id="{{$name_en}}"  pattern="\d{4}-\d{2}-\d{2}">
    </div>
    @once
        @push('scripts')
            <script src="{{asset('assets/backend/js/plugins/datepicker.min.js')}}"></script>
        @endpush
    @endonce
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                $("#{{$name_ne}}").nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    onChange: function () {
                        let parsedDate = NepaliFunctions.ParseDate($("#{{$name_ne}}").val());
                        let englishDate = NepaliFunctions.BS2AD(parsedDate.parsedDate)
                        let formattedDate = NepaliFunctions.ConvertDateFormat(englishDate, "YYYY-MM-DD")
                        $("#{{$name_en}}").val(formattedDate)
                    }
                });

                $("#{{$name_en}}").change(function (){
                    let parsedDate = NepaliFunctions.ParseDate($("#{{$name_en}}").val());
                    let nepaliDate = NepaliFunctions.AD2BS(parsedDate.parsedDate)
                    let formattedDate = NepaliFunctions.ConvertDateFormat(nepaliDate, "YYYY-MM-DD")
                    $("#{{$name_ne}}").val(formattedDate)
                })


                let todayBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), "YYYY-MM-DD")
                let todayAdDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentAdDate(), "YYYY-MM-DD")
                $('#{{$name_ne}}').val(todayBsDate)
                $('#{{$name_en}}').val(todayAdDate)
            });
        </script>
    @endpush
</div>
