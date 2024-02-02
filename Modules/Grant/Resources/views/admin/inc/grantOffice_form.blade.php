<div class="modal fade" id="grantOffice-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" style="display: none;max-height: 60vh;" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">नयाँ अनुदान दिने कार्यालय थप्नुहोस् ।</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="grantOffice-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <label for="office_name" class="form-label">अनुदान कार्यालय</label>
                            <input
                                type="text"
                                name="office_name"
                                value="{{old('office_name')}}"
                                class="form-control @error('office_name') is-invalid @enderror"
                                id="office_name"
                                placeholder="अनुदान कार्यालय"
                            />
                            @error('office_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">रद्द गर्नुहोस्</button>
                        <button type="submit" id="grantOfficeSubmitBtn" class="btn btn-primary">पेश गर्नुहोस्</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@push('scripts')
    <script>

        $(document).ready(function () {

            //farmer form submit
            $('#grantOffice-form').on('submit', function (e) {
                e.preventDefault()
                $.ajax({
                    type: "post",
                    url: "{{route('admin.grant.setting.grantOffice.store')}}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $("#grantOfficeSubmitBtn").prop('disabled', true);
                        $("#grantOfficeSubmitBtn").html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function (resp) {
                        $("#grantOfficeSubmitBtn").prop('disabled', false);
                        $("#grantOfficeSubmitBtn").html("पेश गर्नुहोस्");
                        $('#grant_office_id').append("<option value=" + resp.data.grantOffice_id + ">" + resp.data.grantOffice_name + "</option>")
                        toastMessage('success', resp.message)
                        $('#grantOffice-modal').modal('toggle')
                        $('#grantOffice-form').trigger('reset')
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        $('#grantOfficeSubmitBtn').prop('disabled', false)
                        $("#grantOfficeSubmitBtn").html("पेश गर्नुहोस्");
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
