<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="activity_type" class="form-label">प्रकार *</label>
                <select wire:model="form.activity_type" id="activity_type" class="form-select">
                    <option value="">- - प्रकार छान्नुहोस् - -</option>
                    @foreach (Modules\TaskManagement\Enums\ActivityTypeEnum::cases() as $activityType)
                        <option value="{{ $activityType->value }}">
                            {{ $activityType->label() }}
                        </option>
                    @endforeach
                </select>
                @error('form.activity_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-2 {{ $form['activity_type'] != 'daily' ? 'd-none' : '' }}">
                <label for="date" class="form-label">मिति<span class="text-danger">*</span></label>
                <input type="text" wire:model="form.date" class="form-control" id="date" placeholder="मिति" />
                @error('form.date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @if (in_array($form['activity_type'], ['monthly', 'tri_monthly', 'quarterly']))
                <div class="col-md-6 mb-2">
                    <label for="month_range" class="form-label">महिना *</label>
                    <select wire:model="form.month_range" id="month_range" class="form-select">
                        <option value="">- - छान्नुहोस् - -</option>
                        @if ($form['activity_type'] == 'monthly')
                            @foreach ($months as $key => $month)
                                <option value="{{ $key + 1 }}">
                                    {{ $month }}
                                </option>
                            @endforeach
                        @else
                            @foreach ($monthRanges as $quarter)
                                <option value="{{ $quarter['quarter_value'] }}">
                                    {{ $quarter['quarter'] }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('form.month_range')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endif

            <div class="col-md-12 my-2">
                <fieldset>
                    <legend>क्रियाकलाप</legend>
                    <button class="btn btn-sm btn-outline-primary float-end" type="button"
                        wire:click.prevent="addActivity">
                        <i class="fas fa-plus"></i>
                    </button>
                    @foreach ($form['activity_lists'] as $index => $activityList)
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="title" class="form-label">शिर्षक *</label>
                                <input type="text" name="title"
                                    wire:model="form.activity_lists.{{ $index }}.title"
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="शिर्षक" />
                                @error('form.activity_lists.' . $index . '.title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="documents" class="form-label">डकुमेन्ट </label>
                                <input type="file" name="form.activity_lists.{{ $index }}.documents[]"
                                    wire:model="form.activity_lists.{{ $index }}.documents"
                                    class="form-control @error('form.activity_lists.' . $index . 'documents') is-invalid @enderror"
                                    id="Documents" multiple />
                                @error('form.activity_lists.' . $index . 'documents')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('form.activity_lists.' . $index . 'documents.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="form.activity_lists.{{ $index }}.description"
                                    class="form-label">विवरण</label>
                                <textarea name="form[activity_lists][{{ $index }}][description]"
                                    wire:model="form.activity_lists.{{ $index }}.description"
                                    id="form.activity_lists.{{ $index }}.description" cols="30" rows="5"
                                    class="form-control ckEditor @error('form.activity_lists.' . $index . 'description') is-invalid @enderror"
                                    placeholder="विवरण"></textarea>
                                @error('form.activity_lists.' . $index . 'description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="remarks" class="form-label">कैफ़ियत</label>
                                <textarea name="form.[activity_lists][{{ $index }}][remarks]"
                                    wire:model="form.activity_lists.{{ $index }}.remarks" id="remarks" cols="30" rows="5"
                                    class="form-control @error('form.activity_lists.' . $index . 'remarks') is-invalid @enderror" placeholder="कैफ़ियत"></textarea>
                                @error('form.activity_lists.' . $index . 'remarks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-sm btn-outline-danger float-end" type="button"
                            wire:click.prevent="removeActivity({{ $index }})">
                            <i class="fas fa-minus"></i>
                        </button>
                    @endforeach
                </fieldset>

            </div>

            <div class="col-md-12 mb-2">
                <label for="form.remarks" class="form-label">कैफ़ियत</label>
                <textarea name="form.remarks" id="form.remarks" cols="30" rows="5" wire:model="form.remarks"
                    class="form-control @error('form.remarks') is-invalid @enderror" placeholder="कैफ़ियत"></textarea>
                @error('form.remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>

    @once
        @push('scripts')
            <script src="{{ asset('assets/backend/js/plugins/datepicker.min.js') }}"></script>
        @endpush
    @endonce
    @push('scripts')
        {{--        <script src="{{asset('assets/backend/ckeditor/ckeditor.js')}}"></script> --}}
        {{--        <script src="{{asset('assets/backend/ckeditor/editor.js')}}"></script> --}}
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

                @if (!$DbActivity)
                    let todayBsDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(),
                        "YYYY-MM-DD")
                    let todayAdDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentAdDate(),
                        "YYYY-MM-DD")
                    Livewire.emit('dateChanged', todayBsDate, todayAdDate);
                @endif
            });
        </script>
    @endpush
</div>
