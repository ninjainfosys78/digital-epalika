<div class="col-md-12">
    <fieldset>
        <legend>फारम</legend>
        <div class="row">
            <div class="col-md-12 mb-2">
                <label for="form.revenue">राजस्वको शिर्षक</label>
                <input type="text" id="form.revenue"
                       class="form-control @error('form.revenue') is-invalid @enderror"
                       wire:model="form.revenue">
                @error('form.revenue')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-2 mb-2">
                <label for="form.quantity">क्षेत्रफल (वर्ग मीटरमा)</label>
                <input type="number" id="form.quantity"
                       class="form-control @error('form.quantity') is-invalid @enderror"
                       wire:model="form.quantity" value="1" step="0.01" min="0">
                @error('form.quantity')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-2 mb-2">
                <label for="form.rate">दर</label>
                <input type="number" id="form.rate" class="form-control @error('form.rate') is-invalid @enderror"
                       wire:model="form.rate" value="0" step="0.01" min="0">
                @error('form.rate')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-2 mb-2">
                <label for="form.due">ब.आ.व</label>
                <input type="number" id="form.due" class="form-control @error('form.due') is-invalid @enderror"
                       wire:model="form.due" value="0" min="0">
                @error('form.due')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-2 mb-2">
                <label for="form.fine">जरिवाना</label>
                <input type="number" id="form.fine" class="form-control @error('form.fine') is-invalid @enderror"
                       wire:model="form.fine" value="0" step="0.01" min="0">
                @error('form.fine')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="form.remarks">कैफियत</label>
                <input type="text" id="form.remarks" class="form-control @error('form.remarks') is-invalid @enderror"
                       wire:model="form.remarks">
                @error('form.remarks')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>
        <button type="button" class="btn btn-primary btn-sm" wire:click.prevent="addDetail()">
            <i class="fa fa-save"></i>
        </button>
    </fieldset>

    <table class="table table-bordered table-sm mt-2">
        <thead>
        <tr>
            <th>क्र.सं</th>
            <th>विवरण</th>
            <th>क्षेत्रफल (वर्ग मीटरमा)</th>
            <th>दर</th>
            <th>रकम</th>
            <th>ब.आ.व</th>
            <th>बक्यौता</th>
            <th>जरिवाना</th>
            <th>जम्मा</th>
            <th>कैफियत</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        @foreach($particulars as $index=>$detail)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    <input type="hidden" name="particulars[{{$index}}][revenue]"
                           value="{{$detail['revenue']?? ''}}" required>
                    {{$detail['revenue'] ?? 0}}

                    @error('particulars.'.$index.'.revenue')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </td>
                <td>
                    <input type="hidden" name="particulars[{{$index}}][quantity]"
                           value="{{$detail['quantity']?? ''}}" required>
                    {{$detail['quantity'] ?? 0}}
                    @error('particulars.'.$index.'.quantity')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </td>
                <td>
                    <input type="hidden" name="particulars[{{$index}}][rate]"
                           value="{{$detail['rate']?? ''}}" required>
                    {{$detail['rate'] ?? 0}}
                    @error('particulars.'.$index.'.rate')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </td>

                <td>
                    {{($detail['rate'] ?? 0) * ($detail['quantity'] ?? 0)}}
                </td>
                <td>
                    <input type="hidden" name="particulars[{{$index}}][due]"
                           value="{{$detail['due']?? ''}}" required>
                    {{$detail['due'] ?? 0}}
                    @error('particulars.'.$index.'.due')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </td>
                <td>
                    {{( ($detail['rate'] ?? 0) * ($detail['quantity'] ?? 0) ) * ($detail['due'] ?? 0)}}
                </td>
                <td>
                    <input type="hidden" name="particulars[{{$index}}][fine]"
                           value="{{$detail['fine']}}">
                    {{$detail['fine'] ?? 0}}
                    @error('particulars.'.$index.'.fine')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </td>
                <td>
                    {{ (($detail['rate'] ?? 0) * ($detail['quantity'] ?? 0))
                        + ((($detail['rate'] ?? 0) * ($detail['quantity'] ?? 0)) * ($detail['due'] ?? 0))
                        + ($detail['fine'] ?? 0)}}
                </td>
                <td>
                    <input type="hidden" name="particulars[{{$index}}][remarks]"
                           value="{{$detail['remarks']}}">
                    {{$detail['remarks'] ?? ''}}
                </td>
                <td class="d-flex">
                    <button type="button" class="btn btn-warning text-white mx-1 btn-sm"
                            wire:click.prevent="editDetail({{$index}})">
                        <i class="fa fa-pen"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm"
                            wire:click.prevent="removeDetail({{$index}})">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>
