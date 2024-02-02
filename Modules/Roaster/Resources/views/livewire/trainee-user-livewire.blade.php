<div class="overflow-hidden p-2">
    <ul class="nav nav-pills nav-justified form-wizard-header mb-1">
        <li class="nav-item">
            <a class="nav-link rounded-0 pt-2 pb-2 {{$currentStep===1 ? 'active' : ''}}">
                <i class="fa fa-building me-1"></i>
                <span class="d-none d-sm-inline">संगठन विवरण</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link rounded-0 pt-2 pb-2 {{$currentStep===2 ? 'active' : ''}}">
                <i class="fa fa-file-alt me-1"></i>
                <span class="d-none d-sm-inline">कागजातहरू</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link rounded-0 pt-2 pb-2 {{$currentStep===3 ? 'active' : ''}}">
                <i class="fa fa-lock me-1"></i>
                <span class="d-none d-sm-inline">प्रयोगकर्ता</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link rounded-0 pt-2 pb-2 {{$currentStep===4 ? 'active' : ''}}">
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
                <div class="company-document card p-2">
                    <div class="row">
                        <div class="col-md-3 mb-1">
                            <label for="organizationDetail.logo" class="form-label">कम्पनी लोगो
                                <span class="text-danger">*</span></label>
                            <input type="file"
                                   class="form-control {{$organizationDetail['logo'] ? 'is-valid' : ''}}"
                                   id="organizationDetail.logo"
                                   wire:model="organizationDetail.logo"/>
                            @error('organizationDetail.logo')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="organizationDetail.org_registration_document" class="form-label">कम्पनी
                                प्रमाणपत्र <span class="text-danger">*</span></label>
                            <input type="file"
                                   class="form-control {{$organizationDetail['org_registration_document'] ? 'is-valid' : ''}}"
                                   id="organizationDetail.org_registration_document"
                                   wire:model="organizationDetail.org_registration_document"/>
                            @error('organizationDetail.org_registration_document')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="organizationDetail.org_pan_document" class="form-label">पाना
                                प्रमाणपत्र <span class="text-danger">*</span></label>
                            <input type="file"
                                   class="form-control {{$organizationDetail['org_pan_document'] ? 'is-valid' : ''}}"
                                   id="organizationDetail.org_pan_document"
                                   wire:model="organizationDetail.org_pan_document"/>
                            @error('organizationDetail.org_pan_document')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="taxClearance.document" class="form-label">कर चुक्ता
                                <span class="text-danger">*</span></label>
                            <input type="file"
                                   class="form-control {{$taxClearance['document'] ? 'is-valid' : ''}}"
                                   id="taxClearance.document"
                                   wire:model="taxClearance.document"/>
                            @error('taxClearance.document')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="taxClearance.year" class="form-label">कर चुक्ता गरेको आर्थिक वर्ष
                                <span class="text-danger">*</span>
                            </label>
                            <input
                                name="taxClearance.year"
                                class="form-control @error('taxClearance.year') is-invalid @enderror"
                                type="text"
                                id="taxClearance.year"
                                placeholder="कर चुक्ता गरेको आर्थिक वर्ष"
                                wire:model="taxClearance.year"
                            />
                            @error('taxClearance.year')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="muncipalRegistration.palika_reg_no" class="form-label">पालिका दर्ता नं.
                                <span class="text-danger">*</span>
                            </label>
                            <input
                                name="muncipalRegistration.palika_reg_no"
                                class="form-control @error('muncipalRegistration.palika_reg_no') is-invalid @enderror"
                                type="number"
                                id="muncipalRegistration.palika_reg_no"
                                placeholder="पालिका दर्ता नं."
                                wire:model="muncipalRegistration.palika_reg_no"
                            />
                            @error('muncipalRegistration.palika_reg_no')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="muncipalRegistration.reg_date" class="form-label">दर्ता मिति (बि. स.)
                                <span class="text-danger">*</span>
                            </label>
                            <input
                                name="muncipalRegistration.reg_date"
                                class="form-control @error('muncipalRegistration.reg_date') is-invalid @enderror"
                                type="text"
                                id="muncipalRegistration.reg_date"
                                placeholder="दर्ता मिति (YYYY-MM-DD)"
                                wire:model="muncipalRegistration.reg_date"
                            />
                            @error('muncipalRegistration.reg_date')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="muncipalRegistration.file" class="form-label">फाइल
                                <span class="text-danger">*</span>
                            </label>
                            <input
                                name="muncipalRegistration.file"
                                class="form-control @error('muncipalRegistration.file') is-invalid @enderror"
                                type="file"
                                id="muncipalRegistration.file"
                                wire:model="muncipalRegistration.file"
                            />
                            @error('muncipalRegistration.file')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
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
                </div>
                @break
            @case(3)
                <div class=" card p-2 alert alert-info" role="alert">
                    निम्न प्रयोगकर्ताको इमेल, सम्पर्क नम्बर, र प्रयोगकर्ताको नाम, प्रणालीमा लग-इन गर्न प्रयोग हुनेछ
                    !!!
                </div>
                <div class="card p-2">
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
                </div>
                <ul class="list-inline wizard mt-3">
                    <li class="next d-flex justify-content-end">
                        <button type="button" wire:click.prevent="backStep(2)"
                                class="btn btn-info me-2">
                            <i class="fa fa-arrow-circle-left"></i> पछाडि
                        </button>
                        <button type="button"
                                wire:click.prevent="nextStep(4)"
                                class="btn btn-success">
                            <i class="fa fa-arrow-circle-right"></i> अर्को
                        </button>
                    </li>
                </ul>
                @break
            @case(4)
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills nav-fill navtab-bg">
                                    <li class="nav-item ">
                                        <a href="#timeline" data-bs-toggle="tab" aria-expanded="true"
                                           class="nav-link active">
                                            संगठनको विवरण
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
                                    <div class="tab-pane active" id="timeline">
                                        <table class="table table-sm mb-0 table-striped table-hover">
                                            <tr>
                                                <td>संगठनको नाम</td>
                                                <td>{{$organizationDetail['org_name_ne']}}
                                                    ({{$organizationDetail['org_name_en']}})
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>सम्पर्क नम्बर</td>
                                                <td>{{$organizationDetail['org_contact']}}</td>
                                            </tr>
                                            <tr>
                                                <td>इमेल</td>
                                                <td>{{$organizationDetail['org_email']}}</td>
                                            </tr>
                                            <tr>
                                                <td>पाना नं.</td>
                                                <td>{{$organizationDetail['org_pan_no']}}</td>
                                            </tr>
                                            <tr>
                                                <td>कम्पानी दर्ता नं.</td>
                                                <td>{{$organizationDetail['org_registration_no']}}</td>
                                            </tr>
                                            <tr>
                                                <td>ठेगाना</td>
                                                <td>
                                                    {{$address['organizationLocalBody']->local_body??''}}
                                                    {{$organizationDetail['ward']}}
                                                    - {{$organizationDetail['tole']}},
                                                    {{$address['organizationDistrict']->district??''}},
                                                    {{$address['organizationProvince']->province??''}}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="tab-pane" id="user">
                                        <table class="table table-sm mb-0 table-striped table-hover">
                                            <tr>
                                                <td>प्रयोगकर्ताको नाम</td>
                                                <td>
                                                    {{$user['name']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>इमेल</td>
                                                <td>{{$user['email']}}</td>
                                            </tr>
                                            <tr>
                                                <td>सम्पर्क नं</td>
                                                <td>{{$user['phone']}}</td>
                                            </tr>

                                        </table>
                                    </div>

                                    <div class="tab-pane" id="settings">
                                        <div class="card p-2">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @if ($organizationDetail['logo'])
                                                        <div class="card">
                                                            <div class="fw-bolder">कम्पनी लोगो</div>
                                                            <div class="card-body">
                                                                <img src="{{ $organizationDetail['logo']->temporaryUrl() }}"
                                                                     height="150"
                                                                     alt="">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    @if ($organizationDetail['org_registration_document'])
                                                        <div class="card">
                                                            <div class="fw-bolder">कम्पनी प्रमाणपत्र</div>
                                                            <div class="card-body">
                                                                <img
                                                                    src="{{ $organizationDetail['org_registration_document']->temporaryUrl() }}"
                                                                    height="250"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    @if ($organizationDetail['org_pan_document'])
                                                        <div class="card">
                                                            <div class="fw-bolder">पाना</div>
                                                            <div class="card-body">
                                                                <img
                                                                    src="{{ $organizationDetail['org_pan_document']->temporaryUrl() }}"
                                                                    height="250"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    @if ($taxClearance['document'])
                                                        <div class="card d-flex justify-content-between">
                                                            <div class="fw-bolder">कर चुक्ता ({{$taxClearance['year']}})
                                                            </div>
                                                            <div class="card-body">
                                                                <img src="{{ $taxClearance['document']->temporaryUrl() }}"
                                                                     height="250"
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
                </div>
                <div class="mt-3">
                    <div class="next d-flex justify-content-end">
                        <button type="button" wire:click.prevent="backStep(3)" class="btn btn-info me-2">
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
                <div class="card px-2 py-2">
                    <h4 class="title fw-bold">संगठन विवरण</h4>
                    <div class="row">
                        <div class="col-md-4 mb-1">
                            <label for="organizationDetail.org_name_ne" class="form-label">संगठनको नाम <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input name="organizationDetail.org_name_ne"
                                       class="form-control @error('organizationDetail.org_name_ne') is-invalid @enderror"
                                       type="text"
                                       id="organizationDetail.org_name_ne"
                                       placeholder="नेपालीमा"
                                       wire:model="organizationDetail.org_name_ne">
                                @error('organizationDetail.org_name_ne')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                                <input name="organizationDetail.org_name_en"
                                       class="form-control @error('organizationDetail.org_name_en') is-invalid @enderror"
                                       type="text"
                                       id="organizationDetail.org_name_en"
                                       placeholder="In English"
                                       wire:model="organizationDetail.org_name_en">
                                @error('organizationDetail.org_name_en')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="organizationDetail.org_email" class="form-label">इमेल
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                            <span class="input-group-text" id="organizationDetail.org_email">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                <input name="organizationDetail.org_email"
                                       class="form-control @error('organizationDetail.org_email') is-invalid @enderror"
                                       type="text"
                                       id="organizationDetail.org_email"
                                       placeholder="इमेल"
                                       wire:model="organizationDetail.org_email">
                            </div>
                            @error('organizationDetail.org_email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="organizationDetail.org_contact" class="form-label">सम्पर्क नम्बर
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                            <span class="input-group-text" id="organizationDetail.org_contact">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                <input name="organizationDetail.org_contact"
                                       class="form-control @error('organizationDetail.org_contact') is-invalid @enderror"
                                       type="text"
                                       id="organizationDetail.org_contact"
                                       placeholder="सम्पर्क नम्बर"
                                       wire:model="organizationDetail.org_contact">
                            </div>
                            @error('organizationDetail.org_contact')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-1">
                            <label for="organizationDetail.org_pan_no" class="form-label">पाना नं.</label>
                            <input
                                name="organizationDetail.org_pan_no"
                                class="form-control @error('organizationDetail.org_pan_no') is-invalid @enderror"
                                type="text"
                                id="organizationDetail.org_pan_no"
                                placeholder="पाना नं."
                                wire:model="organizationDetail.org_pan_no"
                            />
                            @error('organizationDetail.org_pan_no')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="organizationDetail.org_registration_no" class="form-label">कम्पनी दर्ता
                                नं:</label>
                            <input
                                name="org_registration_no"
                                class="form-control @error('organizationDetail.org_registration_no') is-invalid @enderror"
                                type="text"
                                id="organizationDetail.org_registration_no"
                                placeholder="कम्पनी दर्ता न:"
                                wire:model="organizationDetail.org_registration_no"
                            />
                            @error('organizationDetail.org_registration_no')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card px-2 py-2">
                    <h4 class="title fw-bold">ठेगाना</h4>
                    <div class="row">
                        <div class="col-md-2 mb-1">
                            <label for="organizationDetail.province_id" class="form-label">प्रदेश</label>
                            <select
                                class="form-select @error('organizationDetail.province_id') is-invalid @enderror"
                                id="organizationDetail.province_id" wire:model="organizationDetail.province_id">
                                <option selected>---प्रदेश छान्नुहोस् ----</option>
                                @foreach($provinces as $province)
                                    <option value="{{$province->id??''}}">{{$province->province ??''}}</option>
                                @endforeach
                            </select>
                            @error('organizationDetail.province_id')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-1">
                            <label for="organizationDetail.district_id" class="form-label">जिल्ला</label>
                            <select
                                class="form-select @error('organizationDetail.district_id') is-invalid @enderror"
                                id="organizationDetail.district_id" wire:model="organizationDetail.district_id">
                                <option value="">---जिल्ला छान्नुहोस् ----</option>
                                @foreach($address['organizationDistricts'] as $organizationDistrict)
                                    <option
                                        value="{{$organizationDistrict->id}}">{{$organizationDistrict->district}}</option>
                                @endforeach
                            </select>
                            @error('organizationDetail.district_id')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-1">
                            <label for="organizationDetail.local_body_id" class="form-label">पालिका</label>
                            <select
                                class="form-select @error('organizationDetail.local_body_id') is-invalid @enderror"
                                id="organizationDetail.local_body_id"
                                wire:model="organizationDetail.local_body_id">
                                <option value="">---पालिका छान्नुहोस् ----</option>
                                @foreach($address['organizationLocalBodies'] as $organizationLocalBody)
                                    <option
                                        value="{{$organizationLocalBody->id}}">{{$organizationLocalBody->local_body}}</option>
                                @endforeach
                            </select>
                            @error('organizationDetail.local_body_id')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-1">
                            <label for="organizationDetail.ward" class="form-label">वार्ड न:</label>
                            <select class="form-select @error('organizationDetail.ward') is-invalid @enderror"
                                    id="organizationDetail.ward" wire:model="organizationDetail.ward">
                                <option value="">---वडा छान्नुहोस् ----</option>
                                @foreach($address['organizationWards'] as $organizationWard)
                                    <option value="{{$organizationWard}}">{{$organizationWard}}</option>
                                @endforeach
                            </select>
                            @error('organizationDetail.ward')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="organizationDetail.tole" class="form-label">गाउ/टोल</label>
                            <input
                                name="organizationDetail.tole"
                                class="form-control @error('organizationDetail.tole') is-invalid @enderror"
                                type="text"
                                id="organizationDetail.tole"
                                placeholder="गाउ/टोल"
                                wire:model="organizationDetail.tole"
                            />
                            @error('organizationDetail.tole')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <ul class="list-inline wizard mt-3">
                    <li class="next d-flex justify-content-around">
                        <button type="button" wire:click.prevent="nextStep(2)" class="btn btn-info">
                            अर्को <i class="fa fa-arrow-circle-right"></i>
                        </button>

                    </li>
                </ul>
        @endswitch
    </form>
</div>
