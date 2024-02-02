<form wire:submit.prevent="searchCitizenshipNo">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="is_minor" class="form-label">प्रकार</label>
            <select class="form-select @error('is_minor') is-invalid @enderror" name="is_minor" id="is_minor"
                    wire:model="is_minor">
                <option value="">छान्नुहोस्</option>
                <option value="0">बालिक</option>
                <option value="1">नाबालिक</option>
            </select>
            @error('citizenship_no')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="citizenship_no" class="form-label">{{!$is_minor ? "नागरिकता नं." : "जन्म दर्ता नं."}}</label>
            <input class="form-control  @error('citizenship_no') is-invalid @enderror" type="text" id="citizenship_no"
                   placeholder="{{!$is_minor ? "नागरिकता नं." : "जन्म दर्ता नं."}}" wire:model="citizenship_no"/>
            @error('citizenship_no')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-sm btn-primary">
        <i class="fa fa-search"></i> Submit
    </button>
</form>
