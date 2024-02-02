<form wire:submit.prevent="searchCitizenshipNo">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="citizenship_no" class="form-label">नागरिकता नं.</label>
            <input class="form-control  @error('citizenship_no') is-invalid @enderror" type="text" id="citizenship_no"
                placeholder="नागरिकता नं." wire:model="citizenship_no" />
            @error('citizenship_no')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-sm btn-primary">
        <i class="fa fa-search"></i> Submit
    </button>
</form>
