<div class="card">
    <div class="card-body">
        <div class="text-center">
            <!-- progressbar -->
            <ul class="nav nav-pills nav-justified form-wizard-header my-0 mb-4">
                <li class="nav-item">
                    <a class="nav-link rounded-0 pt-2 pb-2 {{ $currentStep === 1 ? 'active' : '' }}">
                        <span class="d-none d-sm-inline">पहिलो स्टेप</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0 pt-2 pb-2 {{ $currentStep === 2 ? 'active' : '' }}">
                        <span class="d-none d-sm-inline">दोस्रो स्टेप</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0 pt-2 pb-2 {{ $currentStep === 3 ? 'active' : '' }}">
                        <span class="d-none d-sm-inline">अन्तिम</span>
                    </a>
                </li>
            </ul>
        </div>
        <form wire:submit.prevent="submitForm">
            @switch($currentStep)
                @case(2)
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <h6>
                                <label for="complaint_severity" class="form-label">
                                    के तपाईंलाई यो गुनासोको पासवर्ड चाहिन्छ ? *
                                </label>
                                <p class="mb-3">
                                    (यदि तपाईको गुनासोको नतिजा/स्थिती अझ सुरक्षित राख्नुछ भने मात्र)
                                </p>
                            </h6>

                            <div class="d-flex">
                                <div class="form-check" style="margin-right:15px">
                                    <input type="radio" class="form-check-input" wire:model="is_password" value="1"
                                        name="is_password" id="is_password1">
                                    <label class="form-check-label" for="is_password1">चाहिन्छ &nbsp;</label>
                                </div>
                                <div class="form-check" style="margin-right:15px">
                                    <input type="radio" class="form-check-input" wire:model="is_password" value="0"
                                        id="is_password2">
                                    <label class="form-check-label" for="is_password2">चाहिदैन &nbsp;</label>
                                </div>
                            </div>
                        </div>
                        @if ($is_password)
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" wire:model="form.password" class="form-control"
                                    placeholder="Password">
                                @error('form.password')
                                    <div class="text-danger p-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" wire:model="form.password_confirmation"
                                    class="form-label">Confirm Password</label>
                                <input type="password" id="password_confirmation" class="form-control"
                                    placeholder="Confirm Password">
                            </div>
                        @endif
                        <div class="col-md-12 mb-4">

                            <div class="d-flex">
                                <div class="form-check" style="margin-right:15px">
                                    <input type="radio" class="form-check-input" wire:model="form.is_anonymous" value="1"
                                        id="is_anonymous1">
                                    <label class="form-check-label" for="is_anonymous1">गोप्य रहनुहोस </label>
                                </div>

                            </div>
                            @error('form.is_anonymous')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- @if (!$form['is_anonymous'])
                            <div class="col-md-6 mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" wire:model="form.password" class="form-control"
                                    placeholder="Password">
                                @error('form.password')
                                    <div class="text-danger p-1">{{ $message }}
            </div>
            @enderror
    </div>

    @endif --}}

                        <div class="col-md-12 mb-4">
                            <h6>
                                <label for="is_open" class="form-label">
                                    के तपाईं आफ्नो विवरण खुलाउन चाहनुहुन्छ ?
                                </label>
                                <p class="mb-3">
                                    (यस् गुनासो/उजुरी सम्बन्धी कुनै जानकारी दिन परेमा यो विवरण चाहिने छ, तपाईंको विवरण हामी
                                    गोप्य राख्ने छौं र सम्बन्धित अधिकारीहरुले मात्र हेर्न पाउने छन्।)
                                </p>
                            </h6>

                            <div class="d-flex">
                                <div class="form-check" style="margin-right:15px">
                                    <input type="radio" class="form-check-input" name="is_open" wire:model="form.is_open"
                                        value="1" id="is_open1">
                                    <label class="form-check-label" for="is_open1">हुन्छ | &nbsp;</label>
                                </div>
                                <div class="form-check" style="margin-right:15px">
                                    <input type="radio" class="form-check-input" name="is_open" wire:model="form.is_open"
                                        value="0" id="is_open">
                                    <label class="form-check-label" for="is_open">हुदैन | &nbsp;</label>
                                </div>
                            </div>
                            @error('form.is_open')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>
                                <label for="name" class="form-label">पुरा नाम *</label>
                            </h6>
                            <input type="text" wire:model="form.name" class="form-control" id="name"
                                placeholder="पुरा नाम">
                            @error('form.name')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>
                                <label for="email" class="form-label">इमेल *</label>
                            </h6>
                            <input type="text" wire:model="form.email" class="form-control" id="email"
                                placeholder="इमेल">
                            @error('form.email')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>
                                <label for="phone" class="form-label">सम्पर्क नम्बर *</label>
                            </h6>
                            <input type="text" wire:model="form.phone" class="form-control" id="phone"
                                placeholder="सम्पर्क नम्बर ">
                            @error('form.phone')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>
                                <label for="address" class="form-label">ठेगाना *</label>
                            </h6>
                            <input type="text" wire:model="form.address" class="form-control" id="address"
                                placeholder="ठेगाना">
                            @error('form.address')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="text-end">
                            <button type="button" wire:click.prevent="backStep(1)" class="btn btn-light">
                                पहिले
                            </button>
                            <button type="button" wire:click.prevent="nextStep(3)" class="btn btn-primary">
                                अर्को
                            </button>
                        </div>
                    </div>
                @break

                @case(3)
                    <h6>तल दिएको विवरण ठीक छ छैन विचार गरी पठाउनुहोस् । </h6>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="font-size: 14px">गुनासोको प्रकार:</th>
                                <td>{{ $grievanceType->title }}</td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px">बिषय</th>
                                <td>{{ $form['subject'] }}</td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px">गुनासो पठाउन चाहाने कार्यालय</th>
                                <td>{{ $branch->branch_name }}</td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px">गुनासोको प्राथमिकता</th>
                                <td>
                                    @switch($form['complaint_severity'])
                                        @case('Simple')
                                            साधारण
                                        @break

                                        @case('Priority')
                                            प्राथमिकता
                                        @break

                                        @default
                                            उच्च प्राथमिकता
                                    @endswitch
                                </td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px">के तपाईं आफ्नो विवरण खुलाउन चाहनुहुन्छ</th>
                                <td>{{ $form['is_open'] ? 'हुन्छ ' : 'हुदैन ' }}</td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px">के तपाईले पासवोर्ड राख्नु भएको छ ?</th>
                                <td>{{ $is_password ? 'छ ' : 'छैन ' }}</td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px"> गुनासोको विवरण</th>
                                <td>{{ $form['description'] }}</td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px"> पुरा नाम</th>
                                <td>{{ $form['name'] }}</td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px">इमेल</th>
                                <td>{{ $form['email'] }}</td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px">सम्पर्क नम्बर</th>
                                <td>{{ $form['phone'] }}</td>
                            </tr>
                            <tr>
                                <th style="font-size: 14px">ठेगाना</th>
                                <td>{{ $form['address'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6>गुनासो सम्बन्धी कागजपत्र</h6>
                    @if (!empty($form['files']))
                        <div class="row mb-4">
                            @foreach ($form['files'] as $file)
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="{{ $file->temporaryUrl() }}"
                                                style="width: 100%;height: auto;object-fit: contain" alt="File">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @foreach ($form['files'] as $file)
                        @endforeach
                    @endif
                    <div class="text-end">
                        <div class="text-end">
                            <button type="button" wire:click.prevent="backStep(2)" class="btn btn-light">
                                पहिले
                            </button>
                            <button type="submit" class="btn btn-primary">
                                पेश गर्नुहोस्
                            </button>
                        </div>
                    </div>
                @break

                @default
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <h6>
                                <label for="grievance_type_id" class="form-label">
                                    १. गुनासोको प्रकार *
                                </label>
                            </h6>
                            <select name="grievance_type_id" wire:model="form.grievance_type_id" id="grievance_type_id"
                                class="form-select">
                                <option value="">गुनासो प्रकार छान्नुहोस्</option>
                                @foreach ($grievanceTypes as $grievanceType)
                                    <option value="{{ $grievanceType->id }}">{{ $grievanceType->title }}</option>
                                @endforeach
                            </select>
                            @error('form.grievance_type_id')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-4">
                            <h6>
                                <label for="subject" class="form-label">
                                    २. बिषय *
                                </label>
                            </h6>
                            <input type="text" class="form-control" id="subject" wire:model="form.subject"
                                placeholder="बिषय">
                            @error('form.subject')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-4">
                            <h6>
                                <label for="description" class="form-label">
                                    ३. गुनासोको विवरण *
                                </label>
                            </h6>
                            <textarea name="description" wire:model="form.description" id="description" class="form-control" cols="30"
                                rows="5" placeholder="गुनासोको विवरण"></textarea>
                            @error('form.description')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-4">
                            <h6>
                                <label for="files" class="form-label">
                                    ४. गुनासो सम्बन्धी कागजपत्र अथवा अन्य फाइल छ भने अपलोड गर्नुहोस्
                                </label>
                                <p class="mb-3">(तपाईले कुनै पनि कागजात, फोटो, भिडियो 10 MB सम्मको साइजको अपलोड गर्न
                                    सक्नुहुन्छ | )</p>
                            </h6>

                            <input type="file" name="files[]" multiple wire:model="form.files" id="files"
                                class="form-control">
                            @error('form.files')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                            @error('form.files.*')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-4">
                            <h6>
                                <label for="branch_id" class="form-label">
                                    ५. गुनासो पठाउन चाहाने कार्यालय *
                                </label>
                                <p class="mb-3">
                                    (यदि तपाँइ लाई गुनासो सँग सम्बन्धित कार्यालय थाहा छ भने छनोट गर्नुहोस्,
                                    अन्यथा हामी गुनासोको प्रकृति हेरेर सम्बन्धित कार्यालय मा पाठाउने छौं)
                                </p>
                            </h6>

                            <select name="branch_id" wire:model="form.branch_id" id="branch_id" class="form-select">
                                <option value=""> छान्नुहोस्</option>
                                @foreach ($branches as $branchData)
                                    <option value="{{ $branchData?->id }}">
                                        {{ $branchData->branch_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('form.branch_id')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-4">
                            <h6>
                                <label for="complaint_severity" class="form-label">
                                    ६ . गुनासोको प्राथमिकता *
                                </label>
                            </h6>
                            <div class="d-flex">
                                @foreach (\Modules\GrievanceHandling\Enums\GrievanceComplaintSeverity::cases() as $severity)
                                    <div class="form-check" style="margin-right:15px">
                                        <input type="radio" class="form-check-input" name="complaint_severity"
                                            wire:model="form.complaint_severity" value="{{ $severity->value }}"
                                            id="complaint_severity{{ $severity->name }}">
                                        <label class="form-check-label"
                                            for="complaint_severity{{ $severity->name }}">{{ $severity->label() }}
                                            &nbsp;</label>
                                    </div>
                                @endforeach
                            </div>

                            @error('form.complaint_severity')
                                <div class="text-danger p-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" wire:click.prevent="nextStep(2)" class="btn btn-primary text-end">
                            अर्को
                        </button>
                    </div>
            @endswitch
        </form>
    </div>
</div>
