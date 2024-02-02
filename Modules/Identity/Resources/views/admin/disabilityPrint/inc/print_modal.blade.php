<div class="modal fade" id="print{{ $disabilityIdentityCard->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('identity.admin.disabilityIdentityCard.updateSign', $disabilityIdentityCard) }}"
                    method="post" id="disabilitySign{{ $disabilityIdentityCard->id }}">
                    @csrf

                    <div class="row">
                        <p class="text-danger" id="error_message"></p>
                        <div class="col-md-12 mb-2">
                            <label for="employee_signature_id" class="form-label">हस्ताक्ष्रर *</label>
                            <select class="form-control" name="employee_signature_id" id="employee_signature_id">
                                <option value="">हस्ताक्ष्रर छान्नुहोस्</option>
                                @foreach ($employeeSignatures as $employeeSignature)
                                    <option value="{{ $employeeSignature->id }}">{{ $employeeSignature->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-xs btn-outline-primary printData mt-2" title="Save & Print">
                        <i class="fa fa-print"></i>&nbsp; Print
                    </button>
                    <button type="button" class="btn btn-xs btn-outline-danger mt-2"
                        data-bs-dismiss="modal">Close</button>
                </form>
            </div>

        </div>
    </div>
</div>
