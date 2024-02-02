<div>
    <div class="row" data-toggle="address-1">
        <div class="col-md-3 mb-2">
            <label for="province_id">प्रदेश</label>
            <select name="province_id" class="form-select @error('province_id') is-invalid @enderror" id="province_id">
                <option value="">--- छान्नुहोस् ---</option>
                @foreach($provinces as $province)
                    <option
                        {{$province->id==$provinceId ? 'selected' : ''}}
                        value="{{$province->id}}">
                        {{$province->province}}
                    </option>
                @endforeach
            </select>
            @error('province_id')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-3 mb-2">
            <label for="district_id">जिल्ला</label>
            <select name="district_id" class="form-select @error('district_id') is-invalid @enderror" id="district_id">
                <option value="">--- छान्नुहोस् ---</option>
            </select>
            @error('district_id')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-3 mb-2">
            <label for="local_body_id">पालिका</label>
            <select name="local_body_id" class="form-select @error('local_body_id') is-invalid @enderror" id="local_body_id">
                <option value="">--- छान्नुहोस् ---</option>
            </select>
            @error('local_body_id')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="col-md-3 mb-2">
            <label for="ward_no">वडा नं.</label>
            <select name="ward_no" class="form-select @error('ward_no') is-invalid @enderror" id="ward_no">
                <option value="">--- छान्नुहोस् ---</option>
            </select>
            @error('ward_no')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                let provinceId = "{{$provinceId}}" ?? $("#province_id").val();
                let districtId = "{{$districtId}}" ?? $("#district_id").val();
                let localBodyId = "{{$localBodyId}}" ?? $("#local_body_id").val();
                let wardNo = "{{$wardNo}}" ?? $("#ward_no").val();

                const assignOptions = (selectElement, options, selectedOptionId) => {
                    selectElement.empty().append(
                        $("<option>", {
                            value: "",
                            text: "--- छान्नुहोस् ---"
                        })
                    );
                    options.forEach(option => {
                        const optionElement = $("<option>", {
                            value: option.id || option,
                            text: option.district || option.local_body || option
                        });
                        if (optionElement.val() === selectedOptionId) {
                            optionElement.prop("selected", true);
                        }
                        selectElement.append(optionElement);
                    });
                };
                const assignDistricts = provinceId => {
                    $.get({
                        url: "{{ route('admin.address.districts') }}",
                        data: { province_id: provinceId },
                        success: resp => {
                            assignOptions($("#district_id"), resp, districtId);
                            assignOptions($("#local_body_id"), [], null);
                            assignOptions($("#ward_no"), [], null);
                        },
                        error: console.error
                    });
                };
                const assignLocalBodies = districtId => {
                    $.get({
                        url: "{{ route('admin.address.local-bodies') }}",
                        data: { district_id: districtId },
                        success: resp => {
                            assignOptions($("#local_body_id"), resp, localBodyId);
                            assignOptions($("#ward_no"), [], null);
                        },
                        error: console.error
                    });
                };

                const assignWardNo = localBodyId => {
                    $.get({
                        url: "{{ route('admin.address.ward-no') }}",
                        data: { local_body_id: localBodyId },
                        success: resp => {
                            assignOptions($("#ward_no"), resp, wardNo);
                        },
                        error: console.error
                    });
                };
                if (provinceId) {
                    assignDistricts(provinceId);
                }
                if (districtId) {
                    assignLocalBodies(districtId);
                }
                if (localBodyId) {
                    assignWardNo(localBodyId);
                }
                $("#province_id").on("change", function() {
                    const provinceId = $(this).val() || null;
                    if (provinceId) {
                        assignDistricts(provinceId);
                    } else {
                        assignOptions($("#district_id"), [], null);
                        assignOptions($("#local_body_id"), [], null);
                        assignOptions($("#ward_no"), [], null);
                    }
                });

                $("#district_id").on("change", function() {
                    const districtId = $(this).val() || null;
                    if (districtId) {
                        assignLocalBodies(districtId);
                    } else {
                        assignOptions($("#local_body_id"), [], null);
                        assignOptions($("#ward_no"), [], null);
                    }
                });

                $("#local_body_id").on("change", function() {
                    const localBodyId = $(this).val() || null;
                    if (localBodyId) {
                        assignWardNo(localBodyId);
                    } else {
                        assignOptions($("#ward_no"), [], null);
                    }
                });
            });
        </script>
    @endpush

</div>
