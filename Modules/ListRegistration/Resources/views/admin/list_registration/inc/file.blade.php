<div class="modal fade" id="staticBackdropListRegistration" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropListRegistration"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.listRegistrations.listRegistration.updateFile',$listRegistration)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label id="file">फाईल</label>
                        <input class="form-control" type="file" id="file" name="file" >
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
