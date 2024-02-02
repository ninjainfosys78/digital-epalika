<div>
    <form wire:submit.prevent="saveData()">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="taxPayerDetail.tax_payer_type_id" class="form-label">करदाताको प्रकार</label>
                @if(!$openAddTypeForm)
                    <select
                        name="taxPayerDetail.tax_payer_type_id"
                        class="form-select @error('taxPayerDetail.tax_payer_type_id') is-invalid @enderror"
                        wire:model="taxPayerDetail.tax_payer_type_id"
                        id="taxPayerDetail.tax_payer_type_id" data-width="100%" required>
                        <option value="">--- छान्नुहोस् ---</option>
                        @foreach($taxPayerTypes as $taxPayerType)
                            <option
                                value="{{$taxPayerType->id}}"
                                {{old('taxPayerDetail.tax_payer_type_id') == $taxPayerType->id ? 'selected' : ''}}
                            >
                                {{$taxPayerType->title}}
                            </option>

                        @endforeach
                    </select>
                    <button class="btn btn-primary" wire:click.prevent="openAddMoreTypeForm()" type="button"><i
                            class="fa fa-plus"></i></button>
                    @error('taxPayerDetail.tax_payer_type_id')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                @else
                    <input
                        type="text"
                        name="newTaxPayerType.title"
                        value="{{old('newTaxPayerType.title')}}"
                        wire:model="newTaxPayerType.title"
                        class="form-control @error('newTaxPayerType.title') is-invalid @enderror"
                        id="newTaxPayerType.title"
                        placeholder="करदाताको प्रकार"
                        required
                    />
                    <input
                        type="text"
                        name="newTaxPayerType.code"
                        value="{{old('newTaxPayerType.code')}}"
                        wire:model="newTaxPayerType.code"
                        class="form-control @error('newTaxPayerType.code') is-invalid @enderror"
                        id="newTaxPayerType.code"
                        placeholder="कोड"
                        required
                    />

                    <button class="btn btn-success" wire:click.prevent="saveTaxPayerType()" type="button"><i
                            class="fa fa-save"></i></button>
                @endif
            </div>

            <div class="col-md-6 mb-2">
                <label for="name" class="form-label">करदाताको नाम *</label>
                <div class="input-group">
                    <input
                        type="text"
                        name="taxPayerDetail.name"
                        value="{{old('taxPayerDetail.name')}}"
                        wire:model="taxPayerDetail.name"
                        class="form-control @error('taxPayerDetail.name') is-invalid @enderror"
                        id="taxPayerDetail.name"
                        placeholder="नेपाली"
                        required
                    />
                    <input
                        type="text"
                        name="taxPayerDetail.name_en"
                        value="{{old('taxPayerDetail.name_en')}}"
                        wire:model="taxPayerDetail.name_en"
                        class="form-control @error('taxPayerDetail.name_en') is-invalid @enderror"
                        id="taxPayerDetail.name_en"
                        placeholder="English"
                        required
                    />
                </div>
                <div class="d-flex">
                    @error('taxPayerDetail.name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    @error('taxPayerDetail.name_en')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerDetail.phone" class="form-label">फोन *</label>
                <input
                    type="text"
                    name="taxPayerDetail.phone"
                    value="{{old('taxPayerDetail.phone')}}"
                    wire:model="taxPayerDetail.phone"
                    class="form-control @error('taxPayerDetail.phone') is-invalid @enderror"
                    id="taxPayerDetail.phone"
                    placeholder="फोन"
                    required
                />
                @error('taxPayerDetail.phone')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerDetail.email" class="form-label">इमेल *</label>
                <input
                    type="email"
                    name="taxPayerDetail.email"
                    value="{{old('taxPayerDetail.email')}}"
                    wire:model="taxPayerDetail.email"
                    class="form-control @error('taxPayerDetail.email') is-invalid @enderror"
                    id="taxPayerDetail.email"
                    placeholder="इमेल"
                />
                @error('taxPayerDetail.email')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerDetail.occupation" class="form-label">पेशा</label>
                <input
                    type="text"
                    name="taxPayerDetail.occupation"
                    value="{{old('taxPayerDetail.occupation')}}"
                    wire:model="taxPayerDetail.occupation"
                    class="form-control @error('taxPayerDetail.occupation') is-invalid @enderror"
                    id="taxPayerDetail.occupation"
                    placeholder="पेशा"
                    required
                />
                @error('taxPayerDetail.occupation')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerDetail.gender" class="form-label">लिंग</label>
                <select
                    name="taxPayerDetail.gender"
                    wire:model="taxPayerDetail.gender"
                    class="form-select @error('taxPayerDetail.gender') is-invalid @enderror"
                    id="taxPayerDetail.gender" data-width="100%" required>
                    <option value="">--- छान्नुहोस् ---</option>
                    @foreach(\App\Enums\Gender::cases() as $gender)
                        <option
                            value="{{$gender->value}}"
                            {{old('taxPayerDetail.gender') == $gender->value ? 'selected' : ''}}
                        >
                            {{$gender->label()}}
                        </option>

                    @endforeach
                </select>
                @error('taxPayerDetail.gender')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="taxPayerDetail.father_name" class="form-label">बुवाको नाम *</label>
                <input
                    type="text"
                    name="taxPayerDetail.father_name"
                    wire:model="taxPayerDetail.father_name"
                    value="{{old('taxPayerDetail.father_name')}}"
                    class="form-control @error('taxPayerDetail.father_name') is-invalid @enderror"
                    id="taxPayerDetail.father_name"
                    placeholder="बुवाको नाम" required
                />
                @error('taxPayerDetail.father_name')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="taxPayerDetail.grandfather_name" class="form-label">हजुरबुवाको नाम *</label>
                <input
                    type="text"
                    name="taxPayerDetail.grandfather_name"
                    wire:model="taxPayerDetail.grandfather_name"
                    value="{{old('taxPayerDetail.grandfather_name')}}"
                    class="form-control @error('taxPayerDetail.grandfather_name') is-invalid @enderror"
                    id="taxPayerDetail.grandfather_name"
                    placeholder="हजुरबुवाको नाम" required
                />
                @error('taxPayerDetail.grandfather_name')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="taxPayerDetail.citizenship_no" class="form-label">नागरिकता नम्बर/दर्ता नं. *</label>
                <input
                    type="text"
                    name="taxPayerDetail.citizenship_no"
                    wire:model="taxPayerDetail.citizenship_no"
                    value="{{old('taxPayerDetail.citizenship_no')}}"
                    class="form-control @error('taxPayerDetail.citizenship_no') is-invalid @enderror"
                    id="taxPayerDetail.citizenship_no"
                    placeholder="नागरिकता नम्बर" required
                />
                @error('taxPayerDetail.citizenship_no')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="taxPayerDetail.issued_district" class="form-label">नागरिकता जारी जिल्ला</label>
                <select
                    name="taxPayerDetail.issued_district"
                    wire:model="taxPayerDetail.issued_district"
                    class="form-select @error('taxPayerDetail.issued_district') is-invalid @enderror"
                    id="taxPayerDetail.issued_district" data-width="100%" required>
                    <option value="">--- छान्नुहोस् ---</option>
                    @foreach(get_districts() as $district)
                        <option
                            value="{{$district->district}}"
                            {{old('taxPayerDetail.issued_district') == $district->district ? 'selected' : ''}}
                        >
                            {{$district->district}}
                        </option>

                    @endforeach
                </select>
                @error('taxPayerDetail.issued_district')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="issued_date">जारि मिति</label>
                <input type="text" name="issued_date" wire:model="taxPayerDetail.issued_date" class="form-control"
                       id="issued_date" required>
            </div>
            <div class="col-md-6 mb-2">
                <label for="province_id" class="form-label">प्रदेश *</label>
                <select
                    name="taxPayerDetail.province_id"
                    wire:model="taxPayerDetail.province_id"
                    class="form-select @error('taxPayerDetail.province_id') is-invalid @enderror"
                    id="taxPayerDetail.province_id" required>
                    <option value="">प्रदेश छान्नुहोस्</option>
                    @foreach($provinces as $province)
                        <option value="{{$province->id}}">
                            {{$province->province}}
                        </option>
                    @endforeach
                </select>
                @error('taxPayerDetail.province_id')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="taxPayerDetail.district_id" class="form-label">जिल्ला *</label>
                <select
                    name="taxPayerDetail.district_id"
                    wire:model="taxPayerDetail.district_id"
                    class="form-select @error('taxPayerDetail.district_id') is-invalid @enderror"
                    id="taxPayerDetail.district_id" required>
                    <option value="">जिल्ला छान्नुहोस्</option>
                    @foreach($districts as $district)
                        <option value="{{$district->id}}">
                            {{$district->district}}
                        </option>
                    @endforeach
                </select>
                @error('taxPayerDetail.district_id')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="taxPayerDetail.local_body_id" class="form-label">पालिका *</label>
                <select
                    name="taxPayerDetail.local_body_id"
                    wire:model="taxPayerDetail.local_body_id"
                    class="form-select @error('taxPayerDetail.local_body_id') is-invalid @enderror"
                    id="taxPayerDetail.local_body_id" required>
                    <option value="">पालिका छान्नुहोस्</option>
                    @foreach($localBodies as $localBody)
                        <option value="{{$localBody->id}}">
                            {{$localBody->local_body}}
                        </option>
                    @endforeach
                </select>
                @error('taxPayerDetail.local_body_id')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="taxPayerDetail.ward" class="form-label">वडा नं.</label>
                <select
                    name="taxPayerDetail.ward"
                    wire:model="taxPayerDetail.ward"
                    class="form-select @error('taxPayerDetail.ward') is-invalid @enderror"
                    id="taxPayerDetail.ward" required>
                    <option value="">वडा नं. छान्नुहोस्</option>
                    @foreach($wards as $ward)
                        <option value="{{$ward}}">
                            {{$ward}}
                        </option>
                    @endforeach
                </select>
                @error('taxPayerDetail.ward')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerDetail.tole" class="form-label">टोल *</label>
                <input
                    type="text"
                    name="taxPayerDetail.tole"
                    wire:model="taxPayerDetail.tole"
                    value="{{old('taxPayerDetail.tole')}}"
                    class="form-control @error('taxPayerDetail.tole') is-invalid @enderror"
                    id="taxPayerDetail.tole"
                    placeholder="टोल" required
                />
                @error('taxPayerDetail.tole')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerDetail.village" class="form-label">गाउँ</label>
                <input
                    type="text"
                    name="taxPayerDetail.village"
                    wire:model="taxPayerDetail.village"
                    value="{{old('taxPayerDetail.village')}}"
                    class="form-control @error('taxPayerDetail.village') is-invalid @enderror"
                    id="taxPayerDetail.village"
                    placeholder="गाउँ"
                    required
                />
                @error('taxPayerDetail.village')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerDetail.address" class="form-label">ठेगाना *</label>
                <input
                    type="text"
                    name="taxPayerDetail.address"
                    wire:model="taxPayerDetail.address"
                    value="{{old('taxPayerDetail.address')}}"
                    class="form-control @error('taxPayerDetail.address') is-invalid @enderror"
                    id="taxPayerDetail.address"
                    placeholder="ठेगाना"
                />
                @error('taxPayerDetail.address')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerDetail.house_no" class="form-label">घर नं.</label>
                <input
                    type="text"
                    name="taxPayerDetail.house_no"
                    wire:model="taxPayerDetail.house_no"
                    value="{{old('taxPayerDetail.house_no')}}"
                    class="form-control @error('taxPayerDetail.house_no') is-invalid @enderror"
                    id="taxPayerDetail.house_no"
                    placeholder="घर नं."
                />
                @error('taxPayerDetail.house_no')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <table class="table table-striped ">
                    <thead>
                    <th>क्र.सं.</th>
                    <th>नाम</th>
                    <th>सम्बन्ध</th>
                    <th>
                        <button type="button" class="btn btn-primary" wire:click.prevent="addFamily()">+</button>
                    </th>
                    </thead>
                    <tbody>
                    @foreach($taxPayerFamilies as $taxPayerFamily)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <input type="text" class="form-control"
                                       wire:model="taxPayerFamilies.{{$loop->index}}.name">

                                @error('taxPayerFamilies.'.$loop->index.'.name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" class="form-control"
                                       wire:model="taxPayerFamilies.{{$loop->index}}.relation">

                                @error('taxPayerFamilies.'.$loop->index.'.relation')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger"
                                        wire:click.prevent="removeFamily({{$loop->index}})">-
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
            <div class="col-md-12 mb-2">
                <label for="taxPayerDetail.remarks" class="form-label">कैफियत</label>
                <textarea class="form-control @error('taxPayerDetail.remarks') is_invalid @enderror"
                          wire:model="taxPayerDetail.remarks" name="taxPayerDetail.remarks" id="taxPayerDetail.remarks"
                          cols="30" rows="5">{{old('taxPayerDetail.remarks')}}</textarea>
                @error('taxPayerDetail.remarks')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
    @push('scripts')
        <script src="{{asset('assets/backend/js/plugins/datepicker.min.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#issued_date").nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    onChange: function () {
                        let inputFieldDate = $("#issued_date").val();
                        Livewire.emit('setTaxPayerIssuedDate', inputFieldDate);
                    }
                });
            });
        </script>
    @endpush
</div>
