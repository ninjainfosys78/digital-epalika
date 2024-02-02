<form wire:submit.prevent="submitFormData">
    <div class="table-responsive">
        <table class="table table-sm table-bordered">
            <thead>
            <tr>
                <th>क्र.स</th>
                <th style="min-width: 220px">विवरण</th>
                <th>परिमाण</th>
                <th style="min-width: 90px">इकाई</th>
                <th>दर</th>
                <th class="text-center" style="min-width: 90px">रकम</th>
                <th>
                    <button type="button" wire:click="addTechnicalCostEstimates" class="btn btn-xs btn-outline-primary">
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($technicalCostEstimates as $key=>$technicalCostEstimate)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        <input
                            type="text"
                            wire:model="technicalCostEstimates.{{$key}}.detail"
                            class="form-control form-control-sm"
                            placeholder="विवरण"
                        />
                    </td>
                    <td>
                        <input
                            type="number"
                            wire:model="technicalCostEstimates.{{$key}}.quantity"
                            class="form-control form-control-sm"
                            placeholder="परिमाण *"
                        />
                    </td>
                    <td>
                        <select
                            wire:model="technicalCostEstimates.{{$key}}.unit_id"
                            class="form-select form-select-sm">
                            <option value="">-- छान्नुहोस् --</option>
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}">
                                    {{$unit->title}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input
                            type="number"
                            wire:model="technicalCostEstimates.{{$key}}.rate"
                            class="form-control form-control-sm"
                            placeholder="दर *"
                        />
                    </td>
                    <td class="text-center">
                        {{(double)($technicalCostEstimate['quantity']??0)*(double)($technicalCostEstimate['rate']??0)}}
                    </td>
                    <td>
                        <button type="button" wire:click="removeTechnicalCostEstimate({{$key}})"
                                class="btn btn-xs btn-outline-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="10">
                        विवरण थप्न प्लस बटन क्लिक गर्नुहोस्
                    </td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <th colspan="5">जम्मा रकम</th>
                <td colspan="2">रू. {{$project->technicalCostEstimates->sum('amount')}}</td>
            </tr>
            </tfoot>
        </table>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">
        Save
    </button>
</form>
