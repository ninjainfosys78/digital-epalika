<div class="modal fade" id="group-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">नयाँ समूह थप्नुहोस् ।</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="group-form" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <legend><h4 class="text-info"> समूहको विवरण </h4></legend>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label for="name" class="form-label">समूहको नाम <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-control" id="name"
                                       placeholder="समूह नाम"/>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="registered_office" class="form-label">दर्ता भएको कार्यालय <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="registered_office" value="{{ old('registered_office') }}"
                                       class="form-control"
                                       id="registered_office" placeholder="दर्ता भएको कार्यालय"/>
                                @error('registered_office')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <x-date-input-component
                                    nameNe="g_registration_date" labelNe="दर्ता मिति *"
                                    nameEn="en_g_registration_date" labelEn="Registration Date"
                                    :getTodayDate="false"
                                    container="#group-modal"
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
                        <button type="submit" id="groupSubmitForm" class="btn btn-primary">पेश गर्नुहोस्</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function (){
            //group form
            $('#group-form').on('submit', function (e) {
                e.preventDefault()
                $.ajax({
                    type: "post",
                    url: "{{route('admin.grant.group.store')}}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $("#groupSubmitForm").prop('disabled', true);
                        $("#groupSubmitForm").html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function (resp) {
                        $("#groupSubmitForm").prop('disabled', false);
                        $("#groupSubmitForm").html("पेश गर्नुहोस्");
                        $('#groups').append("<option value=" + resp.data.group_id + ">" + resp.data.group_name + "</option>")
                        toastMessage('success', resp.message)
                        $('#group-modal').modal('toggle')
                        $('#group-form').trigger('reset')
                        //for grant detail livewire
                        Livewire.emit('fetchGranteesData');
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        $('#groupSubmitForm').prop('disabled', false)
                        $("#groupSubmitForm").html("पेश गर्नुहोस्");
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
