<form wire:submit.prevent="submitFormData">
  
    <div class="row mb-2">
        <div class="col-md-12">
            <fieldset class="mb-2">
                <legend>
                    <h4 class="text-info">निवेदक को विवरण</h4>
                </legend>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label for="applicant_name" class="form-label"> नाम <span class="text-danger">*</span></label>
                        <input type="text" wire:model="form.applicant_name" class="form-control" id="applicant_name"
                            placeholder="निवेदक को नाम" required />
                        @error('form.applicant_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="applicant_phone" class="form-label"> फोन न:<span
                                class="text-danger">*</span></label>
                        <input type="text" wire:model="form.applicant_phone" class="form-control"
                            id="applicant_phone" placeholder="फोन न" required />
                        @error('form.applicant_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="applicant_address" class="form-label">ठेगाना</label>
                        <input type="text" wire:model="form.applicant_address" class="form-control"
                            id="applicant_address" placeholder="ठेगाना" />
                        @error('form.applicant_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="applicant_signature" class="form-label">सहि</label>
                        <input type="file" wire:model="form.applicant_signature" class="form-control"
                            id="applicant_signature" placeholder="सहि" />
                        @error('form.applicant_signature')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-12 mb-2">
            @foreach ($form['complainants'] as $key => $complainant)
                <fieldset class="mb-2">
                    <legend>
                        <h4 class="text-info">वादीको विवरण</h4>
                    </legend>
                    <div class="col-md-3 mb-2">
                        <label for="complainants.{{ $key }}.complain_type" class="form-label">वादीको प्रकार
                            छान्नुहोस्<span class="text-danger">*</span></label>
                        <select wire:model="form.complainants.{{ $key }}.complain_type" class="form-select"
                            id="complainants.{{ $key }}.complain_type" required>
                            <option value="">--छान्नुहोस्--</option>
                            @foreach (Modules\JudicialCommittee\Enums\ComplainTypeEnum::cases() as $complainTypeEnum)
                                <option value="{{ $complainTypeEnum->value }}">{{ $complainTypeEnum->label() }}</option>
                            @endforeach
                        </select>
                        @error('form.complainants.*.complain_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-2">
                            {{-- <label for="complainants.{{ $key }}.name"
                                class="form-label">{{ $form['complainants'][$key]['complain_type'] ?? null &&
                                $form['complainants'][$key]['complain_type'] == 'organizational' ? 'संस्थागत' : 'वादी' }}को
                                नाम<span class="text-danger">*</span></label> --}}

                                <label for="complainants.{{ $key }}.name" class="form-label">
                                    @if(isset($form['complainants'][$key]['complain_type']) && $form['complainants'][$key]['complain_type'] == 'organizational')
                                        संस्थाको नाम
                                    @else
                                        वादीको नाम
                                    @endif
                                    <span class="text-danger">*</span>
                                </label>
                            <input type="text" wire:model="form.complainants.{{ $key }}.name"
                                class="form-control" id="complainants.{{ $key }}.name"
                                placeholder="नाम" required />
                            @error("form.complainants.$key.name")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if (($form['complainants'][$key]['complain_type'] ?? null) &&
                                $form['complainants'][$key]['complain_type'] != 'organizational')
                            <div class="col-md-2 mb-2">
                                <label for="complainants.{{ $key }}.age" class="form-label">उमेर <span
                                        class="text-danger">*</span></label>
                                <input type="number" wire:model="form.complainants.{{ $key }}.age"
                                    class="form-control" id="complainants.{{ $key }}.age" placeholder="उमेर"
                                    required />
                                @error("form.complainants.$key.age")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="complainants.{{ $key }}.father_name" class="form-label">बुवाको नाम
                                    <span class="text-danger">*</span></label>
                                <input type="text" wire:model="form.complainants.{{ $key }}.father_name"
                                    class="form-control" id="complainants.{{ $key }}.father_name"
                                    placeholder="बुवाको नाम" required />
                                @error("form.complainants.$key.father_name")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="complainants.{{ $key }}.grandfather_name"
                                    class="form-label">हजुरबुबाको नाम</label>
                                <input type="text"
                                    wire:model="form.complainants.{{ $key }}.grandfather_name"
                                    class="form-control" id="complainants.{{ $key }}.grandfather_name"
                                    placeholder="हजुरबुबाको नाम" />
                                @error("form.complainants.$key.grandfather_name")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="complainants.{{ $key }}.spouse_name"
                                    class="form-label">पति/पत्नीको
                                    नाम </label>
                                <input type="text" wire:model="form.complainants.{{ $key }}.spouse_name"
                                    class="form-control" id="complainants.{{ $key }}.spouse_name"
                                    placeholder="पति/पत्नीको नाम" />
                                @error("form.complainants.$key.spouse_name")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>

                    <fieldset class="mb-2">
                        <legend>
                            <h5 class="text-info">ठेगाना</h5>
                        </legend>
                        <div class="row">
                            <div class="col-md-2 mb-2">
                                <label for="complainants.{{ $key }}.province_id" class="form-label">प्रदेश
                                    <span class="text-danger">*</span></label>
                                <select wire:model="form.complainants.{{ $key }}.province_id"
                                    class="form-select" id="complainants.{{ $key }}.province_id" required>
                                    <option value=""> - - छान्नुहोस् - - </option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->province }}</option>
                                    @endforeach
                                </select>
                                @error("form.complainants.$key.province_id")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="complainants.{{ $key }}.district_id" class="form-label">जिल्ला
                                    <span class="text-danger">*</span></label>
                                <select wire:model="form.complainants.{{ $key }}.district_id"
                                    class="form-select" id="complainants.{{ $key }}.district_id" required>
                                    <option value="">- - छान्नुहोस् - -</option>
                                    @foreach (!empty($form['complainants'][$key]['province_id']) ? get_districts(province_ids: $form['complainants'][$key]['province_id']) : [] as $district)
                                        <option value="{{ $district->id }}">{{ $district->district }}</option>
                                    @endforeach
                                </select>
                                @error("form.complainants.$key.district_id")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="complainants.{{ $key }}.local_body_id" class="form-label">पालिका
                                    <span class="text-danger">*</span></label>
                                <select wire:model="form.complainants.{{ $key }}.local_body_id"
                                    class="form-select" id="complainants.{{ $key }}.local_body_id" required>
                                    <option value="">- - छान्नुहोस् - -</option>
                                    @foreach (!empty($form['complainants'][$key]['district_id']) ? get_local_bodies(district_ids: $form['complainants'][$key]['district_id']) : [] as $localBody)
                                        <option value="{{ $localBody->id }}">{{ $localBody->local_body }}</option>
                                    @endforeach
                                </select>
                                @error("form.complainants.$key.local_body_id")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="complainants.{{ $key }}.ward_no" class="form-label">वार्ड
                                    न:<span class="text-danger">*</span></label>
                                <select wire:model="form.complainants.{{ $key }}.ward_no"
                                    class="form-select" id="complainants.{{ $key }}.ward_no" required>
                                    <option value="">- - छान्नुहोस् - -</option>
                                    @foreach (!empty($form['complainants'][$key]['local_body_id']) ? get_local_bodies(localBodyId: $form['complainants'][$key]['local_body_id'])->ward_no : [] as $ward)
                                        <option value="{{ $ward }}">{{ $ward }}</option>
                                    @endforeach
                                </select>
                                @error("form.complainants.$key.ward_no")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="complainants.{{ $key }}.tole" class="form-label">टोल</label>
                                <input type="text" wire:model="form.complainants.{{ $key }}.tole"
                                    class="form-control" id="complainants.{{ $key }}.tole"
                                    placeholder="टोल" />
                                @error("form.complainants.$key.tole")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                </fieldset>
                @if (!$loop->first)
                    <button type="button" class="btn btn-sm btn-danger"
                        wire:click.prevent="removeComplainant({{ $key }})">
                        <i class="fa fa-minus"></i>
                    </button>
                @endif
                @if ($loop->last)
                    <button type="button" wire:click.prevent="addComplainants" class="btn btn-sm btn-info">
                        <i class="fa fa-plus"></i>
                    </button>
                @endif
                @if (!$loop->last)
                    <hr class="border border-info">
                @endif
            @endforeach
        </div>
        <div class="col-md-12 mb-2">
            @foreach ($form['defendants'] as $key => $defendant)
                <fieldset class="mb-2">
                    <legend>
                        <h4 class="text-info">प्रतिवादीको विवरण</h4>
                    </legend>

                    <div class="col-md-3 mb-2">
                        <label for="defendants.{{ $key }}.complain_type" class="form-label">प्रतिवादीको
                            प्रकार छान्नुहोस्<span class="text-danger">*</span></label>
                        <select wire:model="form.defendants.{{ $key }}.complain_type" class="form-select"
                            id="defendants.{{ $key }}.complain_type" required>
                            <option value="">--छान्नुहोस्--</option>
                            @foreach (Modules\JudicialCommittee\Enums\ComplainTypeEnum::cases() as $complainTypeEnum)
                                <option value="{{ $complainTypeEnum->value }}">{{ $complainTypeEnum->label() }}
                                </option>
                            @endforeach
                        </select>
                        @error('form.defendants.*.complain_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label for="defendants.{{ $key }}.name" class="form-label">
                                @if(isset($form['defendants'][$key]['complain_type']) && $form['defendants'][$key]['complain_type'] == 'organizational')
                                    संस्थाको नाम
                                @else
                                    प्रतिवादीको नाम
                                @endif
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" wire:model="form.defendants.{{ $key }}.name"
                                class="form-control" id="defendants.{{ $key }}.name"
                                placeholder="नाम" required />
                            @error("form.defendants.$key.name")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if (($form['defendants'][$key]['complain_type'] ?? null) &&
                                $form['defendants'][$key]['complain_type'] != 'organizational')
                            <div class="col-md-2 mb-2">
                                <label for="defendants.{{ $key }}.age" class="form-label">उमेर <span
                                        class="text-danger">*</span></label>
                                <input type="number" wire:model="form.defendants.{{ $key }}.age"
                                    class="form-control" id="defendants.{{ $key }}.age"
                                    placeholder="उमेर" />
                                @error("form.defendants.$key.age")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="defendants.{{ $key }}.father_name" class="form-label">बुवाको नाम
                                    <span class="text-danger">*</span></label>
                                <input type="text" wire:model="form.defendants.{{ $key }}.father_name"
                                    class="form-control" id="defendants.{{ $key }}.father_name"
                                    placeholder="बुवाको नाम" />
                                @error("form.defendants.$key.father_name")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="defendants.{{ $key }}.grandfather_name"
                                    class="form-label">हजुरबुबाको नाम</label>
                                <input type="text"
                                    wire:model="form.defendants.{{ $key }}.grandfather_name"
                                    class="form-control" id="defendants.{{ $key }}.grandfather_name"
                                    placeholder="हजुरबुबाको नाम" />
                                @error("form.defendants.$key.grandfather_name")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="defendants.{{ $key }}.spouse_name"
                                    class="form-label">पति/पत्नीको
                                    नाम </label>
                                <input type="text" wire:model="form.defendants.{{ $key }}.spouse_name"
                                    class="form-control" id="defendants.{{ $key }}.spouse_name"
                                    placeholder="पति/पत्नीको नाम" />
                                @error("form.defendants.$key.spouse_name")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <fieldset class="mb-2">
                        <legend>
                            <h5 class="text-info">ठेगाना</h5>
                        </legend>
                        <div class="row">
                            <div class="col-md-2 mb-2">
                                <label for="defendants.{{ $key }}.province_id" class="form-label">प्रदेश
                                    <span class="text-danger">*</span></label>
                                <select wire:model="form.defendants.{{ $key }}.province_id"
                                    class="form-select" id="defendants.{{ $key }}.province_id">
                                    <option value=""> - - छान्नुहोस् - - </option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->province }}</option>
                                    @endforeach
                                </select>
                                @error("form.defendants.$key.province_id")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="defendants.{{ $key }}.district_id" class="form-label">जिल्ला
                                    <span class="text-danger">*</span></label>
                                <select wire:model="form.defendants.{{ $key }}.district_id"
                                    class="form-select" id="defendants.{{ $key }}.district_id">
                                    <option value="">- - छान्नुहोस् - -</option>
                                    @foreach (!empty($form['defendants'][$key]['province_id']) ? get_districts(province_ids: $form['defendants'][$key]['province_id']) : [] as $district)
                                        <option value="{{ $district->id }}">{{ $district->district }}</option>
                                    @endforeach
                                </select>
                                @error("form.defendants.$key.district_id")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="defendants.{{ $key }}.local_body_id" class="form-label">पालिका
                                    <span class="text-danger">*</span></label>
                                <select wire:model="form.defendants.{{ $key }}.local_body_id"
                                    class="form-select" id="defendants.{{ $key }}.local_body_id">
                                    <option value="">- - छान्नुहोस् - -</option>
                                    @foreach (!empty($form['defendants'][$key]['district_id']) ? get_local_bodies(district_ids: $form['defendants'][$key]['district_id']) : [] as $localBody)
                                        <option value="{{ $localBody->id }}">{{ $localBody->local_body }}</option>
                                    @endforeach
                                </select>
                                @error("form.defendants.$key.local_body_id")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="defendants.{{ $key }}.ward_no" class="form-label">वार्ड न:<span
                                        class="text-danger">*</span></label>
                                <select wire:model="form.defendants.{{ $key }}.ward_no" class="form-select"
                                    id="defendants.{{ $key }}.ward_no">
                                    <option value="">- - छान्नुहोस् - -</option>
                                    @foreach (!empty($form['defendants'][$key]['local_body_id']) ? get_local_bodies(localBodyId: $form['defendants'][$key]['local_body_id'])->ward_no : [] as $ward)
                                        <option value="{{ $ward }}">{{ $ward }}</option>
                                    @endforeach
                                </select>
                                @error("form.defendants.$key.ward_no")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="defendants.{{ $key }}.tole" class="form-label">टोल</label>
                                <input type="text" wire:model="form.defendants.{{ $key }}.tole"
                                    class="form-control" id="defendants.{{ $key }}.tole"
                                    placeholder="टोल" />
                                @error("form.defendants.$key.tole")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                </fieldset>
                @if (!$loop->first)
                    <button type="button" class="btn btn-sm btn-danger"
                        wire:click.prevent="removeDefendant({{ $key }})">
                        <i class="fa fa-minus"></i>
                    </button>
                @endif
                @if ($loop->last)
                    <button type="button" wire:click.prevent="addDefendants" class="btn btn-sm btn-info">
                        <i class="fa fa-plus"></i>
                    </button>
                @endif
                @if (!$loop->last)
                    <hr class="border border-info">
                @endif
            @endforeach
        </div>
        <div class="col-md-12">
            <fieldset class="mb-2">
                <legend>
                    <h4 class="text-info">उजुरी विवरण</h4>
                </legend>
                <div class="row pb-2">

                    <div class="col-md-6 mb-2">
                        <label for="complaint_subject_id" class="form-label">विषय<span
                                class="text-danger">*</span></label>
                        <select wire:model="form.complaint_subject_id" class="form-select" id="complaint_subject_id"
                            required>
                            <option value="">--छान्नुहोस्--</option>
                            @foreach ($complaintSubjects as $complaintSubject)
                                <option value="{{ $complaintSubject->id }}">
                                    {{ $complaintSubject->subject }}
                                </option>
                            @endforeach
                        </select>
                        @error('form.complaint_subject_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="date" class="form-label">मिति<span class="text-danger">*</span></label>
                        <input type="text" wire:model="form.date" class="form-control" id="date"
                            placeholder="मिति" required />
                        @error('form.date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="complaint_detail" class="form-label">उजुरी विवरण <span
                                class="text-danger">*</span></label>
                        <textarea id="complaint_detail" wire:model="form.complaint_detail"
                            class="form-control @error('form.complaint_detail') is-invalid @enderror" cols="100" placeholder="विवरण"
                            required></textarea>
                        @error('form.complaint_detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="complaint_detail" class="form-label">साक्षीहरु</label>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0 table-bordered">
                                <thead>
                                    <tr>
                                        <th>क्र.स.</th>
                                        <th>नाम</th>
                                        <th>उमेर</th>
                                        <th>फोन</th>
                                        <th>ठेगाना</th>
                                        <th>
                                            <button type="button" wire:click="addWitnesses"
                                                class="btn btn-xs btn-outline-primary" title="नयाँ सदस्य थप्नुहोस्">
                                                <i class="fa fa-plus-circle"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($form['witnesses'] as $key=>$witness)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <input type="text"
                                                    wire:model="form.witnesses.{{ $key }}.name"
                                                    class="form-control form-control-sm" placeholder="नाम" required />
                                                @error("form.witnesses.$key.name")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number"
                                                    wire:model="form.witnesses.{{ $key }}.age"
                                                    class="form-control form-control-sm" placeholder="उमेर" />
                                                @error("form.witnesses.$key.age")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text"
                                                    wire:model="form.witnesses.{{ $key }}.phone"
                                                    class="form-control form-control-sm" placeholder="फोन" />
                                                @error("form.witnesses.$key.phone")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text"
                                                    wire:model="form.witnesses.{{ $key }}.address"
                                                    class="form-control form-control-sm" placeholder="ठेगाना" />
                                                @error("form.witnesses.$key.address")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <button type="button"
                                                    wire:click="removeWitness({{ $key }})"
                                                    class="btn btn-xs btn-outline-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="7">
                                                विवरण थप्न प्लस बटन क्लिक गर्नुहोस्
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @error('form.witnesses')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="supported_documents" class="form-label">सम्बन्धित कागजातहरू</label>
                        <div class="table-responsive">
                            <table class="table table-sm mb-0 table-bordered">
                                <thead>
                                    <tr>
                                        <th>क्र.स.</th>
                                        <th>फाइलको नाम</th>
                                        <th>फाइल</th>
                                        <th>
                                            <button type="button" wire:click="addSupportedDocuments"
                                                class="btn btn-xs btn-outline-primary" title="नयाँ फाइल थप्नुहोस्">
                                                <i class="fa fa-plus-circle"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($form['supportedDocuments'] as $key=>$document)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <input type="text"
                                                    wire:model="form.supportedDocuments.{{ $key }}.document_name"
                                                    class="form-control form-control-sm" placeholder="फाइलको नाम"
                                                    required />
                                                @error("form.supportedDocuments.$key.document_name")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="file"
                                                    wire:model="form.supportedDocuments.{{ $key }}.document"
                                                    class="form-control form-control-sm" placeholder="फाइल"
                                                    required />
                                                @error("form.supportedDocuments.$key.document")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <button type="button"
                                                    wire:click="removeSupportedDocument({{ $key }})"
                                                    class="btn btn-xs btn-outline-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="7">
                                                विवरण थप्न प्लस बटन क्लिक गर्नुहोस्
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">
                पेश गर्नुहोस्
            </button>
        </div>
    </div>
</form>

@push('scripts')
    <script src="{{ asset('assets/backend/js/plugins/datepicker.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#date").nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                onChange: function() {
                    let inputFieldDate = $("#date").val();
                    let parsedDate = NepaliFunctions.ParseDate(inputFieldDate);
                    let englishDate = NepaliFunctions.BS2AD(parsedDate.parsedDate)
                    let formattedDate = NepaliFunctions.ConvertDateFormat(englishDate, "YYYY-MM-DD")
                    $("#en_date").val(formattedDate);

                    Livewire.emit('dateChanged', inputFieldDate, formattedDate);
                }
            });

            @if (!$compliantRegistration)
                let todayBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(),
                    "YYYY-MM-DD")
                let todayAdDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentAdDate(),
                    "YYYY-MM-DD")
                Livewire.emit('dateChanged', todayBsDate, todayAdDate);
            @endif
        });
    </script>
@endpush
