
<div class="modal fade" id="enterprise-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">नयाँ उधम/फर्मको थप्नुहोस् ।</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="enterprise-form" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <legend><h4 class="text-info"> उधम/फर्मको विवरण </h4></legend>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">निजि उधम/फर्मको नाम <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror" id="name"
                                       placeholder="निजि उधम/फर्मको नाम" />
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="enterprise_type_id" class="fs-5">निजि उधम/फर्म प्रकार<span
                                        class="text-danger">*</span></label>
                                <select name="enterprise_type_id" id="enterprise_type_id" class="form-select">
                                    <option value="">--- छान्नुहोस् ---</option>
                                    @foreach($enterpriseTypes as $type)
                                        <option
                                            {{$type->id == old('enterprise_type_id')}}
                                            value="{{$type->id}}"
                                        >{{$type->title}}</option>
                                    @endforeach
                                </select>
                                @error('enterprise_type_id')
                                <p class="text-danger">{{ $message }}</p>
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
                        <button type="submit" id="enterpriseSubmitForm" class="btn btn-primary">पेश गर्नुहोस्</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function (){
            //enterprise form
            $('#enterprise-form').on('submit', function (e) {
                e.preventDefault()
                $.ajax({
                    type: "post",
                    url: "{{route('admin.grant.enterprise.store')}}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $("#enterpriseSubmitForm").prop('disabled', true);
                        $("#enterpriseSubmitForm").html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function (resp) {
                        $("#enterpriseSubmitForm").prop('disabled', false);
                        $("#enterpriseSubmitForm").html("पेश गर्नुहोस्");
                        $('#enterprises').append("<option value=" + resp.data.enterprise_id + ">" + resp.data.enterprise_name + "</option>")
                        toastMessage('success', resp.message)
                        $('#enterprise-modal').modal('toggle')
                        $('#enterprise-form').trigger('reset')
                        //for grant detail livewire
                        Livewire.emit('fetchGranteesData');
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        $('#enterpriseSubmitForm').prop('disabled', false)
                        $("#enterpriseSubmitForm").html("पेश गर्नुहोस्");
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
