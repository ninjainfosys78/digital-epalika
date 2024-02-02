<div class="modal fade" id="grantType-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">नयाँ अनुदान प्रकार थप्नुहोस् ।</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="grantType-form" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">अनुदान प्रकार *</label>
                                <input
                                    type="text"
                                    name="title"
                                    value="{{old('title')}}"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title"
                                    placeholder="अनुदान प्रकार"
                                />
                                @error('title')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">रद्द गर्नुहोस्</button>
                        <button type="submit" id="grantTypeSubmitForm" class="btn btn-primary">पेश गर्नुहोस्</button>
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
                    $('#marital-status-div').next().remove()
                }
            }

            function spouseInput() {
                return "<div class='col-md-4 mb-2'>" +
                    "<label for='spouse_name' class='form-label'>पति/पत्नी नाम</label>" +
                    "<input type='text' name='spouse_name' value='{{old('spouse_name')}}' class='form-control' id='spouse_name' placeholder='पति/पत्नी नाम' />" +
                    "@error('spouse_name') <div class='invalid-feedback'>{{$message}}</div> @enderror </div>"
            }

            //farmer form submit
            $('#grantType-form').on('submit', function (e) {
                e.preventDefault()
                $.ajax({
                    type: "post",
                    url: "{{route('admin.grant.setting.grantType.store')}}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $("#grantTypeSubmitForm").prop('disabled', true);
                        $("#grantTypeSubmitForm").html("<i class='fa fa-spinner fa-spin'></i>");
                    },
                    success: function (resp) {
                        $("#grantTypeSubmitForm").prop('disabled', false);
                        $("#grantTypeSubmitForm").html("पेश गर्नुहोस्");
                        $('#grant_type_id').append("<option value=" + resp.data.id + ">" + resp.data.title + "</option>")
                        toastMessage('success', resp.message)
                        $('#grantType-modal').modal('toggle')
                        $('#grantType-form').trigger('reset')
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        $('#grantTypeSubmitForm').prop('disabled', false)
                        $("#grantTypeSubmitForm").html("पेश गर्नुहोस्");
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
