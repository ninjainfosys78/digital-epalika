<div class="modal fade" id="print1" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form
                    action="{{route('identity.admin.disabilityIdentityCard.reportData',$disabilityIdentityCard)}}"
                    id="disabilityReportData">
                    @csrf
                    <p class="text-danger" id="error_message1"></p>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="doctor_name" class="form-label"> डाक्टर नाम</label>
                            <input class="form-control" name="doctor_name" id="doctor_name" placeholder="डाक्टर नाम">

                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="identity_no" class="form-label" data-bs-toggle="tooltip" data-bs-placement="top" title="Nepal Medical Council">NMC No</label>
                            <input class="form-control" name="identity_no" id="identity_no" placeholder="संकेत नं">
                        </div>

                    </div>
                    <button type="submit"
                            class="btn btn-xs btn-outline-primary printReportData mt-2">
                        Save
                    </button>
                    <button type="button"
                            class="btn btn-xs btn-outline-danger mt-2"
                            data-bs-dismiss="modal">Close
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
