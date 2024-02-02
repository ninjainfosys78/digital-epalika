@props(['form-data-type','map-apply','form'])
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="header-title">{{$formDataType ->model?->title}}
                        थप्नुहोस्</h4>
                </div>
            </div>
            <div class="card-body">
                @if(count($mapApply->paymentStores->where('form_id', $form->id)) == 0)
                    <form
                        action="{{ route('organization.admin.appliedDocument.store', [$mapApply, $form, $formDataType]) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="bill" class="form-label">बिल *</label>
                                <input type="file" name="bill"
                                       class="form-control @error('bill') is-invalid @enderror"
                                       id="bill"/>
                                @error('bill')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="amount" class="form-label">रकम *</label>
                                <input type="number" name="amount"
                                       step="0.01"
                                       min="0"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       value="{{old('amount')}}"
                                       id="amount"/>
                                @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            save
                        </button>
                    </form>
                @else
                    <form
                        action="{{ route('organization.admin.appliedDocument.update', [$mapApply, $form, $formDataType,$mapApply->paymentStores->where('form_id', $form->id)->sortByDesc('created_at')->first()->id]) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="bill" class="form-label">बिल *</label>
                                <input type="file" name="bill"
                                       class="form-control @error('bill') is-invalid @enderror"
                                       id="bill"/>
                                @error('bill')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="amount" class="form-label">रकम *</label>
                                <input type="number" name="amount"
                                       step="0.01"
                                       min="0"
                                       class="form-control @error('amount') is-invalid @enderror"
                                       value="{{old('amount', $mapApply->paymentStores->where('form_id', $form->id)->sortByDesc('created_at')->first()->amount)}}"
                                       id="amount"/>
                                @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            save
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="header-title">
                        {{$formDataType->model?->title}} विवरण
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>क्र.स</th>
                            <th>बिल</th>
                            <th>रकम</th>
                            <th>स्थिति</th>
                            <th>मिति</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mapApply->paymentStores?->load('paymentStoreStatuses')?->where('form_id', $form->id) as $formStore)
                            <tr>
                                <td>{{ get_nepali_number($loop->iteration) }}</td>
                                <td>
                                    <a href="#"><i class="fa fa-download"></i></a>
                                </td>
                                <td>{{$formStore->amount}}</td>
                                <td>{{$formStore->status->label()}}</td>
                                <td>{{get_nepali_number($formStore->created_at->toDateString())}}</td>
                                <td></td>
                            </tr>
                            @foreach ($formStore->paymentStoreStatuses as $paymentStoreStatus)
                            <tr style="background-color: #e8e5e5;">
                                <td style="font-weight: bold;">{{ get_nepali_number($loop->iteration) }}</td>
                                <td> </td>
                                <td>{{$paymentStoreStatus->amount}}</td>
                                <td>{{$paymentStoreStatus->status->label()}}</td>
                                <td>{{get_nepali_number($paymentStoreStatus->created_at->toDateString())}}</td>
                                <td>

                                </td>
                            </tr>
                            @endforeach
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
