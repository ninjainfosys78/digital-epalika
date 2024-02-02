<div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">व्यवसाय दर्ता रिपोर्ट</h4>

                        <button class="btn btn-primary" type="button" wire:click.prevent="showFilterForm">
                            <i class="fa fa-filter"></i>
                        </button>
                    </div>
                </div>
                <form wire:submit.prevent="submitForm">
                    <fieldset class="border p-2 mb-2">
                        <legend class="font-16 text-info">
                            <strong>मिति </strong>
                        </legend>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="from_date">देखि</label>
                                <input
                                    type="text"
                                    name="from_date"
                                    value="{{old('from_date')}}"
                                    wire:model.debounce="form.date.from_date"
                                    class="form-control nepali_date @error('from_date') is-invalid @enderror"
                                    id="from_date"
                                    placeholder="देखि "
                                />
                                @error('form.date.from_date')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="to_date">सम्म</label>
                                <input
                                    type="text"
                                    name="to_date"
                                    wire:model.debounce="form.date.to_date"
                                    value="{{old('to_date')}}"
                                    class="form-control nepali_date @error('to_date') is-invalid @enderror"
                                    id="to_date"
                                    placeholder="सम्म "
                                />
                                @error('form.date.to_date')
                                {{--                                    <div class="text-danger">{{$message}}</div>--}}
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="col-md-4">
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-info">
                                    <strong>आर्थिक बर्ष </strong>
                                </legend>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <label for="fiscal_year">आर्थिक बर्ष</label>
                                        <select name="fiscal_year" multiple
                                                wire:model="form.fiscal_year" id="fiscal_year" class="form-control">
                                            {{--                                        <option value=""> --आर्थिक बर्ष--</option>--}}
                                            @foreach($fiscalYears as $fiscalYear)
                                                <option value="{{$fiscalYear->id}}">{{$fiscalYear->title}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-info">
                                    <strong>
                                        व्यवसाय प्रकृति
                                    </strong>
                                </legend>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <label for="business_nature">व्यवसाय प्रकृति अनुसार</label>
                                        <select name="business_nature" multiple
                                                wire:model="form.business_nature" id="business_nature"
                                                class="form-control">
                                            <option value=""> --व्यवसाय प्रकृति अनुसार--</option>
                                            @foreach(\Modules\BusinessRegistration\Enums\BusinessNature::cases() as $businessNature)
                                                <option
                                                    value="{{$businessNature->value}}">{{$businessNature->label()}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-info">
                                    <strong>
                                        दर्ता र नविकरण
                                    </strong>
                                </legend>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <label for="registration_renewal">दर्ता र नविकरण अनुसार</label>
                                        <select name="registration_renewal" id="registration_renewal" multiple
                                                wire:model="form.registration_renewal"
                                                class="form-control">
                                            <option value=""> --दर्ता र नविकरण अनुसार--</option>
                                            @foreach(\Modules\BusinessRegistration\Enums\BusinessTypeEnum::cases() as $businessTypeEnum)
                                                <option
                                                    value="{{$businessTypeEnum->value}}">{{$businessTypeEnum->label()}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-info">
                                    <strong>
                                        उदेश्य
                                    </strong>
                                </legend>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <label for="business_purpose">उदेश्य अनुसार</label>
                                        <select name="business_purpose" multiple
                                                wire:model="form.business_purpose"
                                                id="business_purpose" class="form-control">
                                            <option value=""> --उदेश्य अनुसार--</option>
                                            @foreach($businessPurposes as $businessPurpose)
                                                <option
                                                    value="{{$businessPurpose->id}}">{{$businessPurpose->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-info">
                                    <strong>
                                        कारोबार वस्तु
                                    </strong>
                                </legend>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <label for="object_transaction">कारोबार वस्तु अनुसार</label>
                                        <select name="object_transaction" wire:model="form.object_transaction"
                                                multiple
                                                id="object_transaction" class="form-control">
                                            <option value=""> --कारोबार वस्तु--</option>
                                            @foreach($objectTransactions as $objectTransaction)
                                                <option
                                                    value="{{$objectTransaction->id}}">{{$objectTransaction->title}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-info">
                                    <strong>
                                        पुँजीगत लगानी र राजस्वो
                                    </strong>
                                </legend>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <label for="investment_revenue">पुँजीगत लगानी र राजस्वो</label>
                                        <select name="investment_revenue" id="investment_revenue" multiple
                                                wire:model="form.investment_revenue"
                                                class="form-control">
                                            <option value=""> --पुँजीगत लगानी र राजस्वो--</option>
                                            @foreach($investmentRevenues as $investmentRevenue)
                                                <option
                                                    value="{{$investmentRevenue->id}}">{{$investmentRevenue->title}}
                                                    ({{$investmentRevenue->registration_amount}})
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-info">
                                    <strong>
                                        लगानी
                                    </strong>
                                </legend>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="investment.from">देखि</label>
                                        <input type="number" name="investment[from]"
                                               wire:model="form.investment.from"
                                               id="investment.from" class="form-control" placeholder="लगानी अनुसार">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="investment.to">सम्म</label>
                                        <input type="number" name="investment[to]" wire:model="form.investment.to"
                                               id="investment.to" class="form-control" placeholder="लगानी अनुसार">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-info">
                                    <strong>
                                        रोजगार संख्या
                                    </strong>
                                </legend>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="employment.from">देखि</label>
                                        <input type="number" name="employment[from]"
                                               wire:model="form.employment.from"
                                               id="employment.from" class="form-control" placeholder="लगानी अनुसार">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="employment.to">सम्म</label>
                                        <input type="number" name="employment[to]" wire:model="form.employment.to"
                                               id="employment.to" class="form-control" placeholder="लगानी अनुसार">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="border p-2 mb-2">
                                <legend class="font-16 text-info">
                                    <strong>
                                        परिचय पाटी
                                    </strong>
                                </legend>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="introBoard.from">देखि</label>
                                        <input type="number" name="introBoard[from]"
                                               wire:model="form.introBoard.from"
                                               id="introBoard.from" class="form-control" placeholder="लगानी अनुसार">
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="introBoard.to">सम्म</label>
                                        <input type="number" name="introBoard[to]" wire:model="form.introBoard.to"
                                               id="introBoard.to" class="form-control" placeholder="लगानी अनुसार">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <fieldset class="border p-2 mb-2">
                        <legend class="font-16 text-info">
                            <strong>
                                व्यवसाय स्थापना साल
                            </strong>
                        </legend>
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="business_year">साल</label>
                                <select name="business_year" id="business_year" multiple
                                        wire:model="form.business_year"
                                        class="form-control">
                                    <option value=""> --साल--</option>
                                    @foreach($businessYears as $year)
                                        <option value="{{$year}}">{{$year}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border p-2 mb-2">
                        <legend class="font-16 text-info">
                            <strong>
                                Columns
                            </strong>
                        </legend>
                        <div class="row">
                            @foreach($columnData as $columns)
                                <div class="col-md-6 mb-2">
                                    <label for="form.column">{{$columns['name']}}</label>
                                    <select name="form.column" id="form.column" multiple
                                            wire:model="form.column.{{$columns['table_name']}}"
                                            class="form-control">
                                        <option value="">--select Column--</option>

                                        @foreach($columns['columns'] as $column)
                                            <option value="{{$column['column'] ?? ''}}">{{$column['name'] ?? ''}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            @endforeach

                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-primary">
                        Filter
                    </button>

                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title"> व्यवसाय दर्ता रिपोर्ट</h4>
                        <a href="" class="btn btn-primary btn-sm">
                            <i class="fa fa-print"></i>
                            Print
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 table-striped table-hover">
                            <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>नाम</th>
                                <th>दर्ता नं</th>
                                <th>दर्ता मिति.</th>
                                <th>व्यवसाय ठेगाना</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($businessDetails as $businessDetail)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$businessDetail->proprietorDetail->name??''}}</td>
                                    <td>{{$businessDetail->registration_no??''}}</td>
                                    <td>{{$businessDetail->registration_date_en}}</td>
                                    <td><span>{{$businessDetail->localBody->local_body??''}}
                                - {{$businessDetail->ward_no??''}} </span></td>
                                    <td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{asset('assets/backend/js/plugins/datepicker.min.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#from_date").nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    onChange: function () {
                        let inputFieldDate = $("#from_date").val();
                        Livewire.emit('fromDateChanged', inputFieldDate);
                    }
                });

                $("#to_date").nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    onChange: function () {
                        let inputFieldDate = $("#to_date").val();
                        Livewire.emit('toDateChanged', inputFieldDate);
                    }
                });
            });
        </script>
    @endpush
</div>
