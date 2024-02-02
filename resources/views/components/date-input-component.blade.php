    <div class="row">
    <div class="col-md-{{$showEnglishDate?'6':'12'}}">
        <label for="{{$idNe ?? $nameNe}}">{{$labelNe}}</label>
        <input type="text" name="{{$nameNe}}"
               class="form-control @error($nameNe) is-invalid @enderror"
               placeholder="{{$labelNe}}"
               id="{{$idNe ?? $nameNe}}" value="{{old($nameNe, ($editDateNe ?? ""))}}">
        @error($nameNe)
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div @class([
        'col-md-6'=>$showEnglishDate,
        'd-none'=>!$showEnglishDate,
])>

        <label for="{{$idEn??$nameEn}}">{{$labelEn}}</label>

        <input type="date" name="{{$nameEn}}"
               class="form-control @error($nameEn) is-invalid @enderror"
               placeholder="{{$labelEn}}"
               id="{{$idEn??$nameEn}}" value="{{old($nameEn, ($editDateEn ?? ''))}}" max="{{$disableAfterAd}}" min="{{$disableBeforeAd}}">
        @error($nameEn)
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    @once
        @push('scripts')
            <script src="{{asset('assets/backend/js/plugins/datepicker.min.js')}}"></script>
        @endpush
    @endonce
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                $("#{{$idNe ?? $nameNe}}").nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    container: "{{$container}}",
                    @if(!empty($disableBefore))
                    disableBefore: "{{$disableBefore}}",
                    @endif

                        @if(!empty($disableAfter))
                    disableAfter: "{{$disableAfter}}",
                    @endif

                    onChange: function () {
                        let parsedDate = NepaliFunctions.ParseDate($("#{{$idNe ?? $nameNe}}").val());
                        let englishDate = NepaliFunctions.BS2AD(parsedDate.parsedDate)
                        let formattedDate = NepaliFunctions.ConvertDateFormat(englishDate, "YYYY-MM-DD")
                        $("#{{$idEn??$nameEn}}").val(formattedDate)
                    }
                });

                $("#{{$idEn??$nameEn}}").change(function () {
                    let parsedDate = NepaliFunctions.ParseDate($("#{{$idEn??$nameEn}}").val());
                    let nepaliDate = NepaliFunctions.AD2BS(parsedDate.parsedDate)
                    let formattedNepaliDate = NepaliFunctions.ConvertDateFormat(nepaliDate, "YYYY-MM-DD")
                    $("#{{$idNe??$nameNe}}").val(formattedNepaliDate)
                })

                @if($getTodayDate)
                let todayBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), "YYYY-MM-DD")
                $('#{{$idNe ?? $nameNe}}').val(todayBsDate)
                let todayAdDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentAdDate(), "YYYY-MM-DD")
                $('#{{$idEn??$nameEn}}').val(todayAdDate)
                @endif
            });
        </script>
    @endpush
</div>
