<div class="overflow-hidden p-2">
    <ul class="nav nav-pills nav-justified form-wizard-header mb-1">
        <li class="nav-item">
            <a class="nav-link rounded-0 pt-2 pb-2 {{$currentStep===1 ? 'active' : ''}}">
                <i class="fa fa-user-circle me-1"></i>
                <span class="d-none d-sm-inline">व्यक्तिगत विवरण</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link rounded-0 pt-2 pb-2 {{$currentStep===2 ? 'active' : ''}}">
                <i class="fa fa-check-circle me-1"></i>
                <span class="d-none d-sm-inline">प्रमाणीकरण</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link rounded-0 pt-2 pb-2 {{$currentStep===3 ? 'active' : ''}}">
                <i class="fa fa-map-marker me-1"></i>
                <span class="d-none d-sm-inline">ठेगाना</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link rounded-0 pt-2 pb-2 {{$currentStep===4 ? 'active' : ''}}">
                <i class="fa fa-lock me-1"></i>
                <span class="d-none d-sm-inline">प्रयोगकर्ता</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link rounded-0 pt-2 pb-2 {{$currentStep===5 ? 'active' : ''}}">
                <i class="fa fa-clipboard-list me-1"></i>
                <span class="d-none d-sm-inline">पूर्ण विवरण</span>
            </a>
        </li>
    </ul>
    @if($progressPercentage>0)
        <div id="bar" class="progress mb-3" style="height: 7px;">
            <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"
                 style="width: {{$progressPercentage}}%"></div>
        </div>
    @endif
    <form wire:submit.prevent="submitFormData">
        @switch($currentStep)
            @case(2)
                <div class="row">
                    <div class="col-md-4 mb-1">
                        <label for="userDetail.pan_no" class="form-label">
                            पाना नं.
                        </label>
                        <input
                            name="userDetail.pan_no"
                            class="form-control @error('userDetail.pan_no') is-invalid @enderror"
                            wire:model="userDetail.pan_no"
                            type="text"
                            id="userDetail.pan_no"
                            placeholder="पाना नं."
                        />
                        @error('userDetail.pan_no')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="userDetail.nec_no" class="form-label">
                            NEC
                        </label>
                        <input
                            name="userDetail.nec_no"
                            class="form-control @error('userDetail.nec_no') is-invalid @enderror"
                            type="text"
                            id="userDetail.nec_no"
                            placeholder="NEC"
                            wire:model="userDetail.nec_no"
                        />
                        @error('userDetail.nec_no')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-1">
                        <label for="userDetail.nec_certificate" class="form-label">
                            Upload NEC Certificate
                        </label>
                        <input type="file"
                               class="form-control {{$userDetail['nec_certificate'] ? 'is-valid' : ''}}"
                               id="userDetail.nec_certificate"
                               wire:model="userDetail.nec_certificate"/>
                        @error('userDetail.nec_certificate')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <fieldset>
                    <legend class="title">नागरिकता बिबरण</legend>
                    <div class="row">
                        <div class="col-md-4 mb-1">
                            <label for="userDetail.citizenship_no" class="form-label">नागरिता नं. <span
                                    class="text-danger">*</span></label>
                            <input
                                name="userDetail.citizenship_no"
                                class="form-control @error('userDetail.citizenship_no') is-invalid @enderror"
                                type="text"
                                id="userDetail.citizenship_no"
                                placeholder="नागरिता नं."
                                wire:model="userDetail.citizenship_no"
                            />
                            @error('userDetail.citizenship_no')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="userDetail.citizenship_issued_district" class="form-label"> जारी जिल्ला
                                <span class="text-danger">*</span></label>
                            <select
                                class="form-select @error('userDetail.citizenship_issued_district') is-invalid @enderror"
                                id="userDetail.citizenship_issued_district"
                                wire:model="userDetail.citizenship_issued_district">
                                <option value="">---जारि जिल्ला ----</option>
                                @foreach($districts as $district)
                                    <option
                                        value="{{$district->id}}">{{$district->district}}</option>
                                @endforeach
                            </select>

                            @error('userDetail.citizenship_issued_district')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="userDetail.citizenship_issued_date" class="form-label">जारी मिति <span
                                    class="text-danger">*</span></label>
                            <input
                                name="userDetail.citizenship_issued_date"
                                class="form-control @error('userDetail.citizenship_issued_date') is-invalid @enderror"
                                type="text"
                                id="userDetail.citizenship_issued_date"
                                placeholder="जारी मिति"
                                wire:model="userDetail.citizenship_issued_date"
                            />
                            @error('userDetail.citizenship_issued_date')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="userDetail.citizenship_front" class="form-label">नागरिकता अपलोड
                                गर्नुहोस्
                                (आगाडी) <span class="text-danger">*</span></label>
                            <input type="file"
                                   class="form-control {{$userDetail['citizenship_front'] ? 'is-valid' : ''}}"
                                   id="userDetail.citizenship_front"
                                   wire:model="userDetail.citizenship_front"/>
                            @error('userDetail.citizenship_front')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="userDetail.citizenship_back" class="form-label">नागरिकता अपलोड गर्नुहोस्
                                (पछाडि)</label>
                            <input type="file"
                                   class="form-control {{$userDetail['citizenship_back'] ? 'is-valid' : ''}}"
                                   id="userDetail.citizenship_back"
                                   wire:model="userDetail.citizenship_back"/>
                            @error('userDetail.citizenship_back')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </fieldset>
                <ul class="list-inline wizard mt-3">
                    <li class="next d-flex justify-content-end">
                        <button type="button" wire:click.prevent="backStep(1)" class="btn btn-info me-2">
                            <i class="fa fa-arrow-circle-left"></i> पछाडि
                        </button>
                        <button type="button"
                                wire:click.prevent="nextStep(3)"
                                class="btn btn-success">
                            <i class="fa fa-arrow-circle-right"></i> अर्को
                        </button>
                    </li>
                </ul>
                @break
            @case(3)
                <div class="address">
                    <fieldset>
                        <legend class="title">स्थाहि ठेगाना</legend>
                        <div class="row">
                            <div class="col-md-2 mb-1">
                                <label for="userDetail.permanent_province_id" class="form-label">प्रदेश</label>
                                <select
                                    class="form-select @error('userDetail.permanent_province_id') is-invalid @enderror"
                                    id="userDetail.permanent_province_id"
                                    wire:model="userDetail.permanent_province_id">
                                    <option selected>---प्रदेश छान्नुहोस् ----</option>
                                    @foreach($provinces as $province)
                                        <option
                                            value="{{$province->id ??''}}">{{$province->province ??''}}</option>
                                    @endforeach
                                </select>
                                @error('userDetail.permanent_province_id')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-1">
                                <label for="userDetail.permanent_district_id" class="form-label">जिल्ला</label>
                                <select
                                    class="form-select @error('userDetail.permanent_district_id') is-invalid @enderror"
                                    id="userDetail.permanent_district_id"
                                    wire:model="userDetail.permanent_district_id">
                                    <option value="">---जिल्ला छान्नुहोस् ----</option>
                                    @foreach($address['permanentDistricts'] as $permanentDistrict)
                                        <option
                                            value="{{$permanentDistrict->id}}">{{$permanentDistrict->district}}</option>
                                    @endforeach
                                </select>
                                @error('userDetail.permanent_district_id')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-1">
                                <label for="userDetail.permanent_local_body_id" class="form-label">पालिका</label>
                                <select
                                    class="form-select @error('userDetail.permanent_local_body_id') is-invalid @enderror"
                                    id="userDetail.permanent_local_body_id"
                                    wire:model="userDetail.permanent_local_body_id">
                                    <option value="">---पालिका छान्नुहोस् ----</option>
                                    @foreach($address['permanentLocalBodies'] as $permanentLocalBody)
                                        <option
                                            value="{{$permanentLocalBody->id}}">{{$permanentLocalBody->local_body}}</option>
                                    @endforeach
                                </select>
                                @error('userDetail.permanent_local_body_id')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-1">
                                <label for="userDetail.permanent_ward" class="form-label">वार्ड न:</label>
                                <select class="form-select @error('userDetail.permanent_ward') is-invalid @enderror"
                                        id="userDetail.permanent_ward" wire:model="userDetail.permanent_ward">
                                    <option value="">---वडा छान्नुहोस् ----</option>
                                    @foreach($address['permanentWards'] as $permanentWard)
                                        <option value="{{$permanentWard}}">{{$permanentWard}}</option>
                                    @endforeach
                                </select>
                                @error('userDetail.permanent_ward')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="userDetail.permanent_tole" class="form-label">गाउ/टोल</label>
                                <input
                                    name="userDetail.permanent_tole"
                                    class="form-control @error('userDetail.permanent_tole') is-invalid @enderror"
                                    type="text"
                                    id="userDetail.permanent_tole"
                                    placeholder="गाउ/टोल"
                                    wire:model="userDetail.permanent_tole"
                                />
                                @error('userDetail.permanent_tole')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <div class="my-2">
                        <div class="form-check-primary0 d-flex">
                            <h5 class="fw-bold mt-1" for="address_check">
                                के स्थायी र अस्थायी ठेगाना एउटै हो?
                            </h5>
                            <div class="font px-2">
                                <i wire:click.prevent="checkSameAsPermanentAddress"
                                   class="fa fa-toggle-{{$is_same_as_permanent ? 'on' :'off' }} fa-2x"></i>
                            </div>
                        </div>
                    </div>
                    <fieldset>
                        <legend class="title">अस्थाहि ठेगाना</legend>
                        <div class="row">
                            <div class="col-md-2 mb-1">
                                <label for="userDetail.temporary_province_id" class="form-label">प्रदेश</label>
                                <select
                                    class="form-select @error('userDetail.temporary_province_id') is-invalid @enderror"
                                    id="userDetail.temporary_province_id"
                                    wire:model="userDetail.temporary_province_id">
                                    <option value="">---प्रदेश छान्नुहोस् ----</option>
                                    @foreach($provinces as $province)
                                        <option value="{{$province->id??''}}">{{$province->province ??''}}</option>
                                    @endforeach
                                </select>
                                @error('userDetail.temporary_province_id')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-1">
                                <label for="userDetail.temporary_district_id" class="form-label">जिल्ला</label>
                                <select
                                    class="form-select @error('userDetail.temporary_district_id') is-invalid @enderror"
                                    id="userDetail.temporary_district_id"
                                    wire:model="userDetail.temporary_district_id">
                                    <option value="">---जिल्ला छान्नुहोस् ----</option>
                                    @foreach($address['temporaryDistricts'] as $temporaryDistrict)
                                        <option
                                            value="{{$temporaryDistrict->id}}">{{$temporaryDistrict->district}}</option>
                                    @endforeach
                                </select>
                                @error('userDetail.temporary_district_id')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-1">
                                <label for="userDetail.temporary_local_body_id" class="form-label">पालिका</label>
                                <select
                                    class="form-select @error('userDetail.temporary_local_body_id') is-invalid @enderror"
                                    id="userDetail.temporary_local_body_id"
                                    wire:model="userDetail.temporary_local_body_id">
                                    <option value="">---पालिका छान्नुहोस् ----</option>
                                    @foreach($address['temporaryLocalBodies'] as $temporaryLocalBody)
                                        <option
                                            value="{{$temporaryLocalBody->id}}">{{$temporaryLocalBody->local_body}}</option>
                                    @endforeach
                                </select>
                                @error('userDetail.temporary_local_body_id')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-1">
                                <label for="userDetail.temporary_ward" class="form-label">वार्ड न:</label>
                                <select class="form-select @error('userDetail.temporary_ward') is-invalid @enderror"
                                        id="userDetail.temporary_ward" wire:model="userDetail.temporary_ward">
                                    <option value="">---वडा छान्नुहोस् ----</option>
                                    @foreach($address['temporaryWards'] as $temporaryWard)
                                        <option value="{{$temporaryWard}}">{{$temporaryWard}}</option>
                                    @endforeach
                                </select>
                                @error('userDetail.temporary_ward')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="userDetail.temporary_tole" class="form-label">गाउ/टोल</label>
                                <input
                                    name="userDetail.temporary_tole"
                                    class="form-control @error('userDetail.temporary_tole') is-invalid @enderror"
                                    type="text"
                                    id="userDetail.temporary_tole"
                                    placeholder="गाउ/टोल"
                                    wire:model="userDetail.temporary_tole"
                                />
                                @error('userDetail.temporary_tole')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <ul class="list-inline wizard mt-3">
                        <li class="next d-flex justify-content-around">
                            <button type="button" wire:click.prevent="backStep(2)" class="btn btn-info">
                                <i class="fa fa-arrow-circle-left"></i> पछाडि
                            </button>
                            <button type="button"
                                    wire:click.prevent="nextStep(4)"
                                    class="btn btn-success">
                                <i class="fa fa-arrow-circle-right"></i> अर्को
                            </button>
                        </li>
                    </ul>
                </div>
                @break

            @case(4)
                <div class="alert alert-info" role="alert">
                    निम्न प्रयोगकर्ताको इमेल, सम्पर्क नम्बर, र प्रयोगकर्ताको नाम, प्रणालीमा लग-इन गर्न प्रयोग हुनेछ
                    !!!
                </div>
                <div class="row">
                    <div class="col-md-3 mb-1">
                        <label for="user.name" class="form-label">प्रयोगकर्ताको नाम <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                                            <span class="input-group-text" id="user.name">
                                                <i class="fa fa-user"></i>
                                            </span>
                            <input name="user.name"
                                   class="form-control @error('user.name') is-invalid @enderror"
                                   type="text"
                                   id="user.name"
                                   placeholder="प्रयोगकर्ताको नाम"
                                   wire:model="user.name">
                        </div>
                        @error('user.name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-1">
                        <label for="user.email" class="form-label">इमेल <span class="text-danger">*</span></label>
                        <div class="input-group">
                                            <span class="input-group-text" id="user.email">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                            <input name="user.email"
                                   class="form-control @error('user.email') is-invalid @enderror"
                                   type="email"
                                   id="user.email"
                                   placeholder="इमेल"
                                   wire:model="user.email">
                        </div>
                        @error('user.email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-1">
                        <label for="user.phone" class="form-label">सम्पर्क नं. <span
                                class="text-danger">*</span></label>
                        <div class="input-group">
                                            <span class="input-group-text" id="user.email">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                            <input name="user.phone"
                                   class="form-control @error('user.phone') is-invalid @enderror"
                                   type="text"
                                   id="user.phone"
                                   placeholder="सम्पर्क नं"
                                   wire:model="user.phone">
                        </div>
                        @error('user.phone')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <ul class="list-inline wizard mt-3">
                    <li class="next d-flex justify-content-end">
                        <button type="button" wire:click.prevent="backStep(3)"
                                class="btn btn-info me-2">
                            <i class="fa fa-arrow-circle-left"></i> पछाडि
                        </button>
                        <button type="button"
                                wire:click.prevent="nextStep(5)"
                                class="btn btn-success">
                            <i class="fa fa-arrow-circle-right"></i> अर्को
                        </button>
                    </li>
                </ul>
                @break
            @case(5)
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills nav-fill navtab-bg">
                                    <li class="nav-item">
                                        <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false"
                                           class="nav-link active">
                                            व्यक्तिगत विवरण
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#user" data-bs-toggle="tab" aria-expanded="false"
                                           class="nav-link">
                                            प्रयोगकर्ता
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#settings" data-bs-toggle="tab" aria-expanded="false"
                                           class="nav-link">
                                            आवश्यक कागजातहरु
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="aboutme">
                                        <table class="table table-sm mb-0 table-striped table-hover">
                                            <tr>
                                                <th>नाम:</th>
                                                <td>
                                                    {{$userDetail['name_ne']}} ({{$userDetail['name_en']}})
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>इमेल :</th>
                                                <td>
                                                    {{$userDetail['email']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>फोन :</th>
                                                <td>{{$userDetail['phone']}}</td>
                                            </tr>
                                            <tr>
                                                <th>लिङ्ग :</th>
                                                <td>{{\App\Enums\Gender::tryFrom($userDetail['gender'])->label()}}</td>
                                            </tr>
                                            <tr>
                                                <th>वैवाहिक स्थिति :</th>
                                                <td>{{ !empty($userDetail['marital_status']) ? \App\Enums\MaritalStatusEnum::tryFrom($userDetail['marital_status'])->label() :''  }}</td>
                                            </tr>
                                            <tr>
                                                <th>बुवाको नाम :</th>
                                                <td>{{$userDetail['father_name']}}</td>
                                            </tr>
                                            <tr>
                                                <th>हजुरबुवाको नाम :</th>
                                                <td>{{$userDetail['grandfather_name']}}</td>
                                            </tr>
                                            <tr>
                                                <th>PAN नं :</th>
                                                <td>{{$userDetail['pan_no']}}</td>
                                            </tr>
                                            <tr>
                                                <th>NEC नं :</th>
                                                <td>{{$userDetail['nec_no']}}</td>
                                            </tr>
                                            <tr>
                                                <th>नागरिकता नं :</th>
                                                <td>{{$userDetail['citizenship_no']}}</td>
                                            </tr>
                                            <tr>
                                                <th>नागरिकता जारि भएको जिल्ला :</th>
                                                <td>{{$address['citizenshipIssuedDistrict']->district ?? ''}}</td>
                                            </tr>
                                            <tr>
                                                <th>नागरिकता जारि भएको मिति :</th>
                                                <td>{{$userDetail['citizenship_issued_date']}}</td>
                                            </tr>
                                            <tr>
                                                <th>स्थाई ठेगाना :</th>
                                                <td>
                                                    {{$address['permanentLocalBody']->local_body??''}}
                                                    - {{$userDetail['permanent_ward']}}
                                                    {{$userDetail['permanent_tole']}},
                                                    {{$address['permanentDistrict']->district??''}},
                                                    {{$address['permanentProvince']->province??''}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>अस्थायी ठेगाना :</th>
                                                <td>
                                                    {{$address['temporaryLocalBody']->local_body??''}}
                                                    - {{$userDetail['temporary_ward']}}
                                                    {{$userDetail['temporary_tole']}},
                                                    {{$address['temporaryDistrict']->district??''}},
                                                    {{$address['temporaryProvince']->province??''}}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="user">
                                        <table class="table table-sm mb-0 table-striped table-hover">
                                            <tr>
                                                <th>प्रयोगकर्ताको नाम</th>
                                                <td>
                                                    {{$user['name']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>इमेल</th>
                                                <td>
                                                    {{$user['email']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>सम्पर्क नं</th>
                                                <td>
                                                    {{$user['phone']}}
                                                </td>
                                            </tr>

                                        </table>
                                    </div>

                                    <div class="tab-pane" id="settings">
                                        <div class="row">
                                            <div class="col-md-4">
                                                @if ($userDetail['nec_certificate'])
                                                    <div class="card">
                                                        <div class="card-header">
                                                            NEC Certificate
                                                        </div>
                                                        <div class="card-body">
                                                            <img
                                                                src="{{ $userDetail['nec_certificate']->temporaryUrl() }}"
                                                                height="250"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                @if ($userDetail['citizenship_front'])
                                                    <div class="card">
                                                        <div class="card-header">नागरिकता अपलोड गर्नुहोस् (आगाडी)</div>
                                                        <div class="card-body">
                                                            <img
                                                                src="{{ $userDetail['citizenship_front']->temporaryUrl() }}"
                                                                height="200"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                @if ($userDetail['citizenship_back'])
                                                    <div class="card">
                                                        <div class="card-header">नागरिकता अपलोड गर्नुहोस् (पछाडि)</div>
                                                        <div class="card-body">
                                                            <img
                                                                src="{{ $userDetail['citizenship_back']->temporaryUrl() }}"
                                                                height="200"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="next d-flex justify-content-around">
                        <button type="button" wire:click.prevent="backStep(4)" class="btn btn-info">
                            <i class="fa fa-arrow-circle-left"></i> पछाडि
                        </button>
                        <button type="submit"
                                class="btn btn-primary">
                            <i class="fa fa-save"></i> पेश गर्नुहोस्
                        </button>
                    </div>
                </div>
                @break;
            @default

                <fieldset>
                    <legend class="title">ब्यतिगत बिबरण</legend>
                    <div class="row">
                        <div class="col-md-3 mb-1">
                            <label for="userDetail.name_ne" class="form-label">पुरा नाम <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text"
                                       class="form-control @error('userDetail.name_ne') is-invalid @enderror"
                                       placeholder="नेपालीमा नाम"
                                       id="userDetail.name_ne"
                                       wire:model="userDetail.name_ne">
                                @error('userDetail.name_ne')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                                <input type="text"
                                       class="form-control @error('userDetail.name_en') is-invalid @enderror"
                                       placeholder="In English"
                                       id="userDetail.name_en"
                                       wire:model="userDetail.name_en">
                                @error('userDetail.name_en')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="userDetail.email" class="form-label">इमेल
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                            <span class="input-group-text" id="userDetail.email">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                <input type="email"
                                       class="form-control @error('userDetail.email') is-invalid @enderror"
                                       id="userDetail.email"
                                       wire:model="userDetail.email"
                                       placeholder="इमेल">
                            </div>
                            @error('userDetail.email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="userDetail.phone" class="form-label">सम्पर्क नम्बर
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                <input type="text" class="form-control
                                            @error('userDetail.phone') is-invalid @enderror"
                                       id="userDetail.phone"
                                       wire:model="userDetail.phone"
                                       placeholder="सम्पर्क नम्बर">
                            </div>
                            @error('userDetail.phone')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="userDetail.gender" class="form-label">लिङ्ग
                                <span class="text-danger">*</span></label>
                            <select
                                class="form-select @error('userDetail.gender') is-invalid @enderror"
                                wire:model="userDetail.gender"
                                id="userDetail.gender">
                                <option value="">--- लिङ्ग छान्नुहोस् ---</option>
                                @foreach(\App\Enums\Gender::cases() as $gender)
                                    <option value="{{$gender->value}}">{{$gender->label()}}</option>
                                @endforeach
                            </select>
                            @error('userDetail.gender')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="userDetail.marital_status" class="form-label">वैवाहिक स्थिति
                            </label>
                            <select
                                class="form-select @error('userDetail.marital_status') is-invalid @enderror"
                                wire:model="userDetail.marital_status"
                                id="userDetail.marital_status">
                                <option value="">--- वैवाहिक स्थिति ---</option>
                                @foreach(\App\Enums\MaritalStatusEnum::cases() as $maritalStatus)
                                    <option value="{{$maritalStatus->value}}">{{$maritalStatus->label()}}</option>
                                @endforeach
                            </select>
                            @error('userDetail.marital_status')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="userDetail.father_name" class="form-label">बुवाको नाम
                                <span class="text-danger">*</span>
                            </label>
                            <input
                                class="form-control @error('userDetail.father_name') is-invalid @enderror"
                                wire:model="userDetail.father_name"
                                type="text"
                                id="userDetail.father_name"
                                placeholder="बुवाको नाम"
                            />
                            @error('userDetail.father_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="userDetail.grandfather_name" class="form-label">हजुर बुवाको नाम
                                <span class="text-danger">*</span>
                            </label>
                            <input
                                name="userDetail.grandfather_name"
                                class="form-control @error('userDetail.grandfather_name') is-invalid @enderror"
                                wire:model="userDetail.grandfather_name"
                                type="text"
                                id="userDetail.grandfather_name"
                                placeholder=" हजुर बुवाको नाम"
                            />
                            @error('userDetail.grandfather_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </fieldset>
                <ul class="list-inline wizard mt-3">
                    <li class="next d-flex justify-content-end">

                        <button type="button" wire:click.prevent="nextStep(2)" class="btn btn-success">
                            <i class="fa fa-arrow-circle-right"></i> अर्को
                        </button>

                    </li>
                </ul>
        @endswitch
    </form>
</div>

