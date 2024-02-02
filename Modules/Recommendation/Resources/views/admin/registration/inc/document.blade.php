<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.recommendation.registrationDetail.ocFile',$registrationDetail)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label id="oc_file">फाईल</label>
                        <input class="form-control" type="file" id="oc_file" name="oc_file[]" multiple>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">रद्द गर्नुहोस्</button>
                        <button type="submit" class="btn btn-primary btn-sm">पेश गर्नुहोस</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
