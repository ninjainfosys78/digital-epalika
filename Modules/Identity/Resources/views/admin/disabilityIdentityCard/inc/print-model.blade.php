

<div class="modal fade" id="print" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form
                    action="{{route('identity.admin.disabilityIdentityCard.printData',$disabilityIdentityCard)}}"
                    id="disabilityPrint">
                    @csrf
                    <div class="row">
                        <p class="text-danger" id="error_message"></p>
                        <div class="col-md-12 mb-2">
                            <label for="hospital_id" class="form-label">अस्पताल
                                *</label>
                            <select class="form-control" name="hospital_id"
                                    id="hospital_id">
                                <option value="">अस्पताल छान्नुहोस्</option>
                                @foreach($hospitals as $hospital)
                                    <option
                                        value="{{$hospital->id}}">{{$hospital->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-12">
                            <x-date-input-component
                                container="#print"
                                nameNe="date" labelNe="मिति"
                            />
                        </div>
                    </div>
                    <button type="submit"
                            class="btn btn-xs btn-outline-primary printData mt-2">
                        Save & Print <i class="fa fa-print"></i>
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
