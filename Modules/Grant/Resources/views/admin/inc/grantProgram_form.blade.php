<div class="modal fade" id="grantProgram-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">अनुदान कार्यक्रम थप्नुहोस् ।</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="grantProgram-form" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 mb-2">
                        <label for="name" class="form-label">अनुदान कार्यक्रम <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="name"
                            value="{{old('name')}}"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            placeholder="कार्यक्रम"
                        />
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">रद्द गर्नुहोस्</button>
                        <button type="submit" id="grantProgramSubmitBtn" class="btn btn-primary">पेश गर्नुहोस्</button>
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
            $('#grantProgram-form').on('submit', function (e) {
                e.preventDefault()
                $.ajax({
                    type: "post",
                    url: "{{route('admin.grant.setting.grantProgram.store')}}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $("#grantProgramSubmitBtn").prop('disabled', true);
                        $("#grantProgramSubmitBtn").html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function (resp) {
                        $("#grantProgramSubmitBtn").prop('disabled', false);
                        $("#grantProgramSubmitBtn").html("पेश गर्नुहोस्");
                        $('#grant_program_id').append("<option value=" + resp.data.grantProgram_id + ">" + resp.data.grantProgram_name + "</option>")
                        toastMessage('success', resp.message)
                        $('#grantProgram-modal').modal('toggle')
                        $('#grantProgram-form').trigger('reset')
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        $('#grantProgramSubmitBtn').prop('disabled', false)
                        $("#grantProgramSubmitBtn").html("पेश गर्नुहोस्");
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
