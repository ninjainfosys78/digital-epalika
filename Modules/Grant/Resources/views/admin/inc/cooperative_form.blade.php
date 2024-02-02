<div class="modal fade" id="cooperative-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">नयाँ सहकारी थप्नुहोस् ।</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cooperative-form" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <legend><h4 class="text-info"> सहकारीको विवरण </h4></legend>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="form-label">सहकारी नाम <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="name"
                                    value="{{old('name')}}"
                                    class="form-control"
                                    id="name"
                                    placeholder="सहकारी नाम"
                                />
                                @error('name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="name" class="form-label">सहकारी प्रकार <span class="text-danger">*</span></label>
                                <select name="cooperative_type_id" id="cooperative_type_id"
                                        class="form-control">
                                    <option value="">सहकारी प्रकार छान्नुहोस्</option>
                                    @foreach($cooperativeTypes as $cooperativeType)
                                        <option value="{{$cooperativeType->id}}">
                                            {{$cooperativeType->title}}
                                        </option>
                                    @endforeach

                                </select>
                                @error('cooperative_type_id')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="registration_no" class="form-label">दर्ता नं<span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="registration_no"
                                    value="{{old('registration_no')}}"
                                    class="form-control "
                                    id="registration_no"
                                    placeholder="दर्ता नं"
                                />
                                @error('registration_no')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <x-date-input-component
                                    nameNe="c_registration_date" labelNe="दर्ता मिति *"
                                    nameEn="en_c_registration_date" labelEn="Registration Date"
                                    :getTodayDate="false"
                                    container="#cooperative-modal"
                                />
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
                        <button type="submit" id="cooperativeSubmitBtn" class="btn btn-primary">पेश गर्नुहोस्</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function (){

            //cooperative form submit

            $('#cooperative-form').on('submit', function (e) {
                e.preventDefault()
                $.ajax({
                    type: "post",
                    url: "{{route('admin.grant.cooperative.store')}}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $("#cooperativeSubmitBtn").prop('disabled', true);
                        $("#cooperativeSubmitBtn").html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function (resp) {
                        $("#cooperativeSubmitBtn").prop('disabled', false);
                        $("#cooperativeSubmitBtn").html("पेश गर्नुहोस्");
                        $('#cooperatives').append("<option value=" + resp.data.cooperative_id + ">" + resp.data.cooperative_name + "</option>")
                        toastMessage('success', resp.message)
                        $('#cooperative-modal').modal('toggle')


                        $('#cooperative-form').trigger('reset')
                        //for grant detail livewire
                        Livewire.emit('fetchGranteesData');
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        $('#cooperativeSubmitBtn').prop('disabled', false)
                        $("#cooperativeSubmitBtn").html("पेश गर्नुहोस्");
                        toastMessage('error', XMLHttpRequest.responseJSON.message)
                    }
                });
            })

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
        })
    </script>
@endpush
