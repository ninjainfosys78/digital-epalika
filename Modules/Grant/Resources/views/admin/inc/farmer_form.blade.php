<div class="modal fade" id="farmer-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">नयाँ कृषक थप्नुहोस् ।</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="farmer-form" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <legend><h4 class="text-info"> कृषकको विवरण </h4></legend>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="first_name" class="form-label">पहिलो नाम *</label>
                                <input
                                    type="text"
                                    name="first_name"
                                    value="{{old('first_name')}}"
                                    class="form-control"
                                    id="first_name"
                                    placeholder="पहिलो नाम "
                                />
                                @error('first_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="middle_name" class="form-label">बीचको नाम</label>
                                <input
                                    type="text"
                                    name="middle_name"
                                    value="{{old('middle_name')}}"
                                    class="form-control"
                                    id="middle_name"
                                    placeholder="बीचको नाम"
                                />
                                @error('middle_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="last_name" class="form-label">थर *</label>
                                <input
                                    type="text"
                                    name="last_name"
                                    value="{{old('last_name')}}"
                                    class="form-control"
                                    id="last_name"
                                    placeholder="थर"
                                />
                                @error('last_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="phone_no" class="form-label">सम्पर्क नं. *</label>
                                <input
                                    type="text"
                                    name="phone_no"
                                    value="{{old('phone_no')}}"
                                    class="form-control "
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
                                <label for="marital_status" class="form-label">बैबाहिक अवस्था *</label>
                                <select id="marital_status" name="marital_status" class="form-select">
                                    <option value="">-- छान्नुहोस् --</option>
                                    @foreach(\App\Enums\MaritalStatusEnum::cases() as $marital_status)
                                        <option
                                            value="{{$marital_status->value}}"
                                            {{$marital_status->value==old('marital_status') ? 'selected' : ''}}>
                                            {{$marital_status->label()}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('marital_status')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="father_name" class="form-label">बुवाको नाम थर *</label>
                                <input
                                    type="text"
                                    name="father_name"
                                    value="{{old('father_name')}}"
                                    class="form-control "
                                    id="father_name"
                                    placeholder="बुवाको नाम थर"
                                />
                                @error('father_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="grandfather_name" class="form-label">बाजे/ससुराको नाम थर *</label>
                                <input
                                    type="text"
                                    name="grandfather_name"
                                    value="{{old('grandfather_name')}}"
                                    class="form-control "
                                    id="grandfather_name"
                                    placeholder="बाजे/ससुराको नाम थर "
                                />
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="citizenship_no" class="form-label">नागरिकता नं. *</label>
                                <input
                                    type="text"
                                    name="citizenship_no"
                                    value="{{old('citizenship_no')}}"
                                    class="form-control "
                                    id="citizenship_no"
                                    placeholder="नागरिकता नं."
                                />
                                @error('citizenship_no')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="my-1">
                        <legend><h4 class="text-info"> स्थायी ठेगाना </h4></legend>
                        @livewire('address', [
                        'province_id' =>$officeSetting->province_id,
                        'district_id' => $officeSetting->district_id,
                        'local_body_id' => $officeSetting->local_body_id
                        ])
                    </fieldset>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">रद्द गर्नुहोस्</button>
                        <button type="submit" id="farmerSubmitBtn" class="btn btn-primary">पेश गर्नुहोस्</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@push('scripts')
    <script>

        $(document).ready(function () {
            if ($('#marital_status').val() === 'married') {
                setStatus($('#marital_status').val())
            }
            $('#marital_status').on('change', function () {
                setStatus($(this).val())
            });

            function setStatus(status) {
                if (status === 'married') {
                    $('#marital-status-div').after(spouseInput())
                } else {
                    $('.spouse').remove()
                }
            }

            function spouseInput() {
                return "<div class='spouse col-md-4 mb-2'>" +
                    "<label for='spouse_name' class='form-label'>पति/पत्नी नाम</label>" +
                    "<input type='text' name='spouse_name' value='{{old('spouse_name')}}' class='form-control' id='spouse_name' placeholder='पति/पत्नी नाम' />" +
                    "@error('spouse_name') <div class='invalid-feedback'>{{$message}}</div> @enderror </div>"
            }

            //farmer form submit
            $('#farmer-form').on('submit', function (e) {
                e.preventDefault()
                $.ajax({
                    type: "post",
                    url: "{{route('admin.grant.farmer.store')}}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $("#farmerSubmitBtn").prop('disabled', true);
                        $("#farmerSubmitBtn").html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function (resp) {
                        $("#farmerSubmitBtn").prop('disabled', false);
                        $("#farmerSubmitBtn").html("पेश गर्नुहोस्");
                        $('#farmers').append("<option value=" + resp.data.farmer_id + ">" + resp.data.farmer_name + "</option>")
                        toastMessage('success', resp.message)
                        $('#farmer-modal').modal('toggle')
                        $('#farmer-form').trigger('reset')
                        //for grant detail livewire
                        Livewire.emit('fetchGranteesData');
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        $('#farmerSubmitBtn').prop('disabled', false)
                        $("#farmerSubmitBtn").html("पेश गर्नुहोस्");
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
    </script>
@endpush
