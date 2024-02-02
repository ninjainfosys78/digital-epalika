<form class="mb-2">
    <fieldset>
        <legend>भवन सम्बन्धि विवरण</legend>
        <table class="table table-sm table-responsive table-bordered">
            <thead>
            <tr>
                <th>क्र.सं</th>
                <th colspan="2" class="text-center">विवरण</th>
                <th>कैफियत</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @foreach($buildingDetails as $key=>$buildingDetail)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <label
                            for="name">
                            {{\Modules\EMap\Enums\BuildingDetailEnum::tryFrom($buildingDetail['detail'])->label()}}
                        </label>
                        <input type="hidden"
                               id="detail"
                               wire:model="buildingDetails.{{$key}}.detail"
                            {{$dataToEdit !== $key ?'disabled':''}}
                        >
                        @error("buildingDetails.$key.detail")
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </td>
                    <td>
                        <input type="text"
                               wire:model="buildingDetails.{{$key}}.description"
                            {{$dataToEdit !== $key ?'disabled':''}}
                        class="form-control form-control-sm">
                        @error("buildingDetails.$key.description")
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </td>
                    <td>
                        <input type="text"
                               wire:model="buildingDetails.{{$key}}.remarks"
                            {{$dataToEdit !== $key ?'disabled':''}}
                               class="form-control form-control-sm">
                        @error("buildingDetails.$key.remarks")
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </td>
                    <td>
                        @if($dataToEdit === null)
                                <button type="button" class="btn btn-xs btn-outline-primary"
                                        wire:click.prevent="setDataForEdit({{$key}})"><i
                                        class="fa fa-pen"></i>
                                </button>
                        @else

                            @if($dataToEdit===$key)
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-xs btn-outline-primary"
                                            wire:click.prevent="saveFormData"><i
                                            class="fa fa-save"></i></button>
                                    <button type="button" class="btn btn-xs btn-outline-danger"
                                            wire:click.prevent="setDataForEdit()"><i
                                            class="fa fa-trash"></i>
                                    </button>
                                </div>
                            @endif

                        @endif
                    </td>
                </tr>
            @endforeach
            @error("buildingDetails")
            <p class="text-danger">{{$message}}</p>
            @enderror
            </tbody>
        </table>
    </fieldset>
</form>
