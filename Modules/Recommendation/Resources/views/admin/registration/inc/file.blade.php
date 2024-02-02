<div class="modal fade" id="personalDetail-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">व्यक्तिगत विवरण थप्नुहोस् ।</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="personalDetail-form" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <legend><h4 class="text-info">व्यक्तिगत विवरण</h4></legend>
                        <h6 class="py-2">नोट: कृपया व्यक्तिगत विवरण भर्दा ध्यान दिएर भर्नु होला । </h6>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="name" class="form-label">पुरा नाम *</label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{old('name')}}"
                                    class="form-control"
                                    id="name"
                                    placeholder="पुरा नाम"
                                />
                                @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="phone_no" class="form-label">सम्पर्क नं.</label>
                                <input
                                    type="text"
                                    name="phone_no"
                                    value="{{old('phone_no')}}"
                                    class="form-control"
                                    id="phone_no"
                                    placeholder="सम्पर्क नं."
                                />
                                @error('phone_no')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="gender" class="form-label">लिंग *</label>
                                <select id="gender" name="gender" class="form-select">
                                    <option value="">-- छान्नुहोस् --</option>
                                    @foreach(\App\Enums\Gender::cases() as $gender)
                                        <option
                                            {{$gender->value==old('gender') ? 'selected' : ''}}
                                            value="{{$gender->value}}">{{$gender->label()}}</option>
                                    @endforeach
                                </select>
                                @error('gender')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-2" id="marital-status-div">
                                <label for="is_minor" class="form-label">नाबालिका हो/होइन ?*</label>
                                <select id="is_minor" name="is_minor" class="form-select">
                                    <option value="">-- छान्नुहोस् --</option>
                                    <option value="1" {{ old('is_minor') == 1 ? 'selected':'' }}>हो</option>
                                    <option value="0" {{ old('is_minor') == 0 ? 'selected':'' }}>होइन</option>
                                </select>
                                @error('is_minor')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="citizenship_no" class="form-label">नागरिकता नं. *</label>
                                <input
                                    type="text"
                                    name="citizenship_no"
                                    value="{{old('citizenship_no')}}"
                                    class="form-control @error('citizenship_no') is-invalid @enderror"
                                    id="citizenship_no"
                                    placeholder="नागरिकता नं."
                                />
                                @error('citizenship_no')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="my-2">
                        <legend><h4 class="text-info">स्थायी ठेगाना *</h4></legend>
                        <h6 class="py-2">नोट: कृपया क्रमशः प्रदेश, जिल्ला, गा.पा./न.पा., वार्ड नं., गाउँ र टोल छनौट
                            गर्नुहोस् । </h6>
                        @livewire('address', [
                        'province_id' =>  old('province_id',$officeSetting->province_id),
                        'district_id' =>  old('district_id',$officeSetting->district_id),
                        'local_body_id' => old('local_body_id',$officeSetting->local_body_id) ,
                        'ward_no' =>  old('ward_no',$officeSetting->ward_no)
                        ])
                        <div class="col-md-6 mb-2">
                            <label for="tole" class="form-label">
                                टोल</label>
                            <input
                                type="text"
                                name="tole"
                                value="{{old('tole')}}"
                                class="form-control @error('tole') is-invalid @enderror"
                                id="tole"
                                placeholder="टोल"
                            />
                            @error('tole')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </fieldset>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">रद्द गर्नुहोस्</button>
                        <button type="submit" id="personalDetailSubmitBtn" class="btn btn-primary">पेश गर्नुहोस्
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('assets/backend/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/backend/ckeditor/editor.js')}}"></script>
    <script>

        $(document).ready(function () {
            //farmer form submit
            $('#personalDetail-form').on('submit', function (e) {
                e.preventDefault()
                const personalDetailSubmitBtn = $("#personalDetailSubmitBtn");
                $.ajax({
                    type: "post",
                    url: "{{route('admin.recommendation.setting.personalDetail.store')}}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        personalDetailSubmitBtn.prop('disabled', true);
                        personalDetailSubmitBtn.html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function (resp) {
                        personalDetailSubmitBtn.prop('disabled', false);
                        personalDetailSubmitBtn.html("पेश गर्नुहोस्");
                        $('.personalDetail').append("<option value=" + resp.data.personal_detail_id + ">" + resp.data.name + " (" + resp.data.reg_no + ")" + "</option>")
                        toastMessage('success', resp.message)
                        $('#personalDetail-modal').modal('toggle')
                        $('#personalDetail-form').trigger('reset');
                        window.location.reload();
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        personalDetailSubmitBtn.prop('disabled', false)
                        personalDetailSubmitBtn.html("पेश गर्नुहोस्");
                        toastMessage('error', XMLHttpRequest.responseJSON.message)
                    }
                });
            });

            function toastMessage(type, title) {
                swal.fire({
                    title: title,
                    toast: true,
                    position: 'top-right',
                    showConfirmButton: false,
                    width: 450,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: type,
                });
            }
        });
        $('#recommendation_category_id').on('change', function () {
            let val = $(this).val();
            $.ajax({
                type: 'GET',
                url: window.location.origin + '/admin/recommendation/setting/recommendationCategory' + '/' + val + '/getTemplate',
                success: function (resp) {
                    CKEDITOR.instances.recommendation_data.setData(resp.data);
                },
                error: function () {
                    alert('Something Went Wrong')
                }
            })
        })
    </script>
@endpush
