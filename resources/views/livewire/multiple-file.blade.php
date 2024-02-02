<div>
    <table class="table table-bordered table-striped table-sm">
        <thead>
        <tr>
            <th>फाइलको नाम</th>
            <th>फाइल</th>
            <th>
                <button type="button" wire:click="addFileRow" class="btn btn-sm btn-outline-primary">
                    <i class="fa fa-plus"></i>
                </button>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($files as $key=>$file)
            <tr>
                <td>
                    <input type="text" name="files[{{$key}}][file_name]" class="form-control"
                           placeholder="फाइलको नाम">
                </td>
                <td>
                    <input type="file" name="files[{{$key}}][file]" class="form-control">
                <td>
                    <button type="button" wire:click="removeFileRow({{$key}})" class="btn btn-sm btn-outline-danger">
                        <i class="fa fa-minus"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @error('files')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
    @error('files.*.file_name')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
    @error('files.*.file')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>
