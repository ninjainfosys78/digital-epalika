<form class="mb-2">
    <fieldset>
        <legend>निर्माण हुने भवन तथा मापदण्ड सम्बन्धि संक्षिप्त विवरण</legend>
        <div class="col-md-12">
            <label class="form-label fw-bold">मापदण्ड सम्बन्धि विवरण</label>
            <div class="table-responsive mt-1">
                <table class="table table-sm table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th>क्र.सं</th>
                        <th>विवरण</th>
                        <th>मापदण्ड अनुसार</th>
                        <th>नक्सा अनुसार</th>
                        <th>अनुपालन</th>
                        <th>कैफियत</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($criteriaDetails as $key=>$criteriaDetail)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <label
                                    for="name">
                                    {{\Modules\EMap\Enums\DetailsRegardingCriteriaEnum::tryFrom($criteriaDetail['detail'])->label()}}
                                </label>
                                <input type="hidden"
                                       id="criteriaDetails.{{$key}}.detail"
                                       wire:model="criteriaDetails.{{$key}}.detail"
                                    {{$dataToEdit !== $key ?'disabled':''}}
                                >
                                @error("criteriaDetails.$key.detail")
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </td>
                            <td>
                                <input type="text"
                                       wire:model="criteriaDetails.{{$key}}.according_to_criteria"
                                    {{$dataToEdit !== $key ?'disabled':''}}
                                class="form-control form-control-sm">
                                @error("criteriaDetails.$key.according_to_criteria")
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </td>
                            <td>
                                <input type="text"
                                       wire:model="criteriaDetails.{{$key}}.according_to_map"
                                    {{$dataToEdit !== $key ?'disabled':''}}
                                class="form-control form-control-sm">
                                @error("criteriaDetails.$key.according_to_map")
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </td>
                            <td>
                                <input type="text"
                                       wire:model="criteriaDetails.{{$key}}.compliance"
                                    {{$dataToEdit !== $key ?'disabled':''}}
                                class="form-control form-control-sm">
                                @error("criteriaDetails.$key.compliance")
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </td>

                            <td>
                                <input type="text"
                                       wire:model="criteriaDetails.{{$key}}.remarks"
                                    {{$dataToEdit !== $key ?'disabled':''}}
                                class="form-control form-control-sm">
                                @error("criteriaDetails.$key.remarks")
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </td>
                            <td>
                                @if($dataToEdit === null)
                                        <button type="button" class="btn btn-xs btn-outline-primary"
                                                wire:click.prevent="setDataForEdit({{$key}})">
                                            <i class="fa fa-pen"></i>
                                        </button>
                                @else

                                    @if($dataToEdit===$key)
                                        <div class="d-flex gap-1">
                                            <button type="button" class="btn btn-xs btn-outline-success"
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
                    @error("criteriaDetails")
                    <p class="text-danger">{{$message}}</p>
                    @enderror

                    </tbody>

                </table>
            </div>
        </div>
    </fieldset>
</form>
