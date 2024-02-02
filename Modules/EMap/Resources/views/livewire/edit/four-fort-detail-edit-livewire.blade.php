<form class="mb-2">
    <fieldset>
        <legend>१. चार किल्लाको विवरण</legend>
        <div class="table-responsive">
            <table class="table table-sm table-responsive table-bordered">
                <thead>
                <tr>
                    <th width="20%">विवरण</th>
                    <th>पूर्व</th>
                    <th>दक्षिण</th>
                    <th>पश्चिम</th>
                    <th>उत्तर</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($fourFortDetails as $key=>$fourFort)
                    <tr>
                        <td>
                            <label class="form-label" for="fourFortDetail.detail">
                                १.{{$loop->iteration}} {{\Modules\EMap\Enums\FourSideParticularEnum::tryFrom($fourFort['detail'])->label()}}
                            </label>
                            <input type="hidden"
                                   id="fourFortDetails.{{$key}}.detail"
                                   wire:model="fourFortDetails.{{$key}}.detail"
                                   disabled>
                            @error("fourFortDetails.$key.detail")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text"
                                   id="fourFortDetails.{{$key}}.east"
                                   wire:model="fourFortDetails.{{$key}}.east"
                                {{$dataToEdit !== $key ?'disabled':''}}
                            class="form-control form-control-sm">
                            @error("fourFortDetails.$key.east")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text"
                                   id="fourFortDetails.{{$key}}.south"
                                   wire:model="fourFortDetails.{{$key}}.south"
                                {{$dataToEdit !== $key ?'disabled':''}}
                                   class="form-control form-control-sm">
                            @error("fourFortDetails.$key.south")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text"
                                   id="fourFortDetails.{{$key}}.west"
                                   wire:model="fourFortDetails.{{$key}}.west"
                                {{$dataToEdit !== $key ?'disabled':''}}
                                   class="form-control form-control-sm">
                            @error("fourFortDetails.$key.west")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            <input type="text"
                                   id="fourFortDetails.{{$key}}.north"
                                   wire:model="fourFortDetails.{{$key}}.north"
                                {{$dataToEdit !== $key ?'disabled':''}}
                                   class="form-control form-control-sm">
                            @error("fourFortDetails.$key.north")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </td>
                        <td>
                            @if($dataToEdit === null)
                                    <button type="button" class="btn btn-xs btn-outline-primary"
                                            wire:click.prevent="setDataForEdit({{$key}})"><i class="fa fa-pen"></i>
                                    </button>
                            @else
                                @if($dataToEdit===$key)
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn btn-xs btn-outline-success"
                                                wire:click.prevent="saveFormData"><i class="fa fa-save"></i></button>
                                        <button type="button" class="btn btn-xs btn-outline-danger"
                                                wire:click.prevent="setDataForEdit()"><i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                @endif
                            @endif
                        </td>
                    </tr>

                @endforeach

                </tbody>

            </table>
        </div>
    </fieldset>
</form>
