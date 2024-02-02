<div>
    <form wire:submit.prevent="save">
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="structureAssessmentRate.sector_id" class="form-label">क्षेत्र *</label>
                <select
                    name="structureAssessmentRate.sector_id"
                    class="form-select @error('structureAssessmentRate.sector_id') is-invalid @enderror"
                    wire:model="structureAssessmentRate.sector_id"
                    id="structureAssessmentRate.sector_id" data-width="100%" required>
                    <option value="">--- छान्नुहोस् ---</option>
                    @foreach($sectors as $sector)
                        <option
                            value="{{$sector->id}}"
                            {{old('structureAssessmentRate.sector_id') == $sector->id ? 'selected' : ''}}
                        >
                            {{$sector->title}}
                        </option>

                    @endforeach
                </select>
                @error('structureAssessmentRate.sector_id')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="structureAssessmentRate.physical_structure_type_id" class="form-label">स्ट्रकचर *</label>
                <select
                    name="structureAssessmentRate.physical_structure_type_id"
                    class="form-select @error('structureAssessmentRate.physical_structure_type_id') is-invalid @enderror"
                    wire:model="structureAssessmentRate.physical_structure_type_id"
                    id="structureAssessmentRate.physical_structure_type_id" data-width="100%" required>
                    <option value="">--- छान्नुहोस् ---</option>
                    @foreach($physicalStructureTypes as $physicalStructureType)
                        <option
                            value="{{$physicalStructureType->id}}"
                            {{old('taxPayerDetail.physical_structure_type_id') == $physicalStructureType->id ? 'selected' : ''}}
                        >
                            {{$physicalStructureType->title}}
                        </option>

                    @endforeach
                </select>
                @error('structureAssessmentRate.physical_structure_type_id')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="structureAssessmentRate.usage" class="form-label">प्रयोजन *</label>
                <input
                    type="text"
                    name="structureAssessmentRate.usage"
                    wire:model="structureAssessmentRate.usage"
                    value="{{old('structureAssessmentRate.usage')}}"
                    class="form-control @error('structureAssessmentRate.usage') is-invalid @enderror"
                    id="structureAssessmentRate.usage"
                    placeholder="प्रयोजन" required
                />
                @error('structureAssessmentRate.usage')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-2">
                <label for="structureAssessmentRate.rate" class="form-label">दर (वर्ग फीटमा) *</label>
                <input
                    type="number"
                    min="0"
                    step="0.01"
                    name="structureAssessmentRate.rate"
                    wire:model="structureAssessmentRate.rate"
                    value="{{old('structureAssessmentRate.rate')}}"
                    class="form-control @error('structureAssessmentRate.rate') is-invalid @enderror"
                    id="structureAssessmentRate.rate"
                    placeholder="दर" required
                />
                @error('structureAssessmentRate.rate')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
</div>
