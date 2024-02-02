<div>
    <form wire:submit.prevent="saveFormData">
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="registration_no" class="form-label">दर्ता नं.</label>
                <input type="text" wire:model="form.registration_no" class="form-control" id="registration_no"
                    placeholder="दर्ता नं." />
                @error('form.registration_no')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="is_hardcopy" class="form-label">हार्डकपि/सफ्टकपि *</label>
                <select wire:model="form.is_hardcopy" id="is_hardcopy" class="form-select">
                    <option value="1">हार्डकपि</option>
                    <option value="0">सफ्टकपि</option>
                </select>
                @error('form.is_hardcopy')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <fieldset class="m-2">
                <legend>File Activity</legend>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="date_bs" class="form-label">मिति<span class="text-danger">*</span></label>
                        <input type="text" wire:model="form.fileActivity.date_bs" class="form-control" id="date_bs"
                            placeholder="मिति" />
                        @error('form.fileActivity.date_bs')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="assigned_branch_id" class="form-label">शाखा *</label>
                        <select wire:model="form.fileActivity.assigned_branch_id" id="assigned_branch_id" class="form-select">
                            <option value="">- - छान्नुहोस् - -</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                @foreach ($branch->branches as $subBranch)
                                    <option value="{{ $subBranch->id }}">
                                        --- {{ $subBranch->branch_name }}
                                    </option>
                                @endforeach
                                <option value="{{ $branch->id }}">
                                    {{ $branch->branch_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('form.fileActivity.assigned_branch_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="users" class="form-label">प्रयोगकर्ताहरु</label>
                        <div class="row">
                            @foreach($users as $user)
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox"
                                               class="form-check-input"
                                               wire:model="form.fileActivity.users"
                                               value="{{$user->id}}"
                                               id="users-{{ $user->id }}" >
                                        <label class="form-check-label"
                                               for="users-{{ $user->id }}">{{ $user->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="fileActivity.remarks" class="form-label">कैफ़ियत</label>
                        <textarea id="fileActivity.remarks" cols="30" rows="5" wire:model="form.fileActivity.remarks"
                            class="form-control @error('form.fileActivity.remarks') is-invalid @enderror" placeholder="कैफ़ियत"></textarea>
                        @error('form.fileActivity.remarks')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </fieldset>

            <div class="col-md-12 mb-2">
                <label for="form.remarks" class="form-label">कैफ़ियत</label>
                <textarea name="form.remarks" id="form.remarks" cols="30" rows="5" wire:model="form.remarks"
                    class="form-control @error('form.remarks') is-invalid @enderror" placeholder="कैफ़ियत"></textarea>
                @error('form.remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12 mb-2">
                <h5>फाइलहरु</h5>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                        <th>क्र.सं.</th>
                        <th>फाइलको नाम</th>
                        <th>विवरण</th>
                        <th>फाइल</th>
                        <th>
                            <button type="button" wire:click="addFileTrackingFiles" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus"></i>
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($form['fileTrackingFiles'] as $key=>$file)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <input type="text" wire:model="form.fileTrackingFiles.{{ $key }}.title" class="form-control"
                                       placeholder="शिर्षक">
                            </td>
                            <td>
                                <input type="text" wire:model="form.fileTrackingFiles.{{ $key }}.description" class="form-control"
                                       placeholder="विवरण">
                            </td>
                            <td>
                                <input type="file" wire:model="form.fileTrackingFiles.{{ $key }}.files" multiple class="form-control">
                            <td>
                                <button type="button" wire:click="removeFileTrackingFile({{$key}})" class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @error('form.fileTrackingFiles')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                @error('form.fileTrackingFiles.*.title')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                @error('form.fileTrackingFiles.*.description')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
                @error('form.fileTrackingFiles.*.files.*')
                <div class="invalid-feedback">{{$message}}</div>
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
        <script type="text/javascript">
            $(document).ready(function() {
                $("#date_bs").nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    onChange: function() {
                        let inputFieldDate = $("#date_bs").val();
                        let parsedDate = NepaliFunctions.ParseDate(inputFieldDate);
                        let englishDate = NepaliFunctions.BS2AD(parsedDate.parsedDate)
                        let formattedDate = NepaliFunctions.ConvertDateFormat(englishDate, "YYYY-MM-DD")

                        Livewire.emit('dateChanged', inputFieldDate, formattedDate);
                    }
                });
            });
        </script>
    @endpush
</div>
