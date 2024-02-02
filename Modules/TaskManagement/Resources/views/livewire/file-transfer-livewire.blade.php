<div>
    <form wire:submit.prevent="saveFormData">
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="date_bs" class="form-label">मिति<span class="text-danger">*</span></label>
                <input type="text" wire:model="form.date_bs" class="form-control" id="date_bs"
                    placeholder="मिति" />
                @error('form.date_bs')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="assigned_branch_id" class="form-label">शाखा *</label>
                <select wire:model="form.assigned_branch_id" id="assigned_branch_id" class="form-select">
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
                @error('form.assigned_branch_id')
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
                                       wire:model="form.users"
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
                <label for="remarks" class="form-label">कैफ़ियत</label>
                <textarea id="remarks" cols="30" rows="3" wire:model="form.remarks"
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
