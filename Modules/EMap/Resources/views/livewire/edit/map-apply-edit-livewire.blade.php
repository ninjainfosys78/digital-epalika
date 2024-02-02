<form wire:submit.prevent="saveFormData" class="mb-2">
    <fieldset>
        <legend>१. प्रस्तावित भवनको विवरण</legend>
        <button class="btn btn-xs float-end btn-outline-primary waves-effect waves-light"
                wire:click.prevent="setEditForm"><i
                class="fa fa-pen"></i>
        </button>
        <div class="mb-2">
            <label class="form-label fw-bold">१.१ निर्माण कार्यको किसिम *</label>
            <div class="col">
                @foreach(\Modules\EMap\Enums\TypeOfConstructionWorkEnum::cases() as $constructionType)
                    <div class="form-check form-check-inline">
                        <input type="radio"
                               id="{{$constructionType->name}}"
                               wire:model="applyMap.construction_type"
                               value="{{$constructionType->value}}"
                               {{$editForm ? '' : 'disabled'}}
                               class="form-check-input">
                        <label class="form-check-label"
                               for="{{$constructionType->name}}">{{$constructionType->label()}}</label>
                    </div>
                @endforeach
                @error('applyMap.construction_type')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">१.२ प्रयोजन *</label>
            <div class="col">
                @foreach(\Modules\EMap\Enums\BuildingUsageEnum::cases() as $usages)
                    <div class="form-check form-check-inline">
                        <input type="radio"
                               id="{{$usages->name}}"
                               wire:model="applyMap.usage"
                               value="{{$usages->value}}"
                               {{$editForm ? '' : 'disabled'}}
                               class="form-check-input">
                        <label class="form-check-label" for="{{$usages->name}}">{{$usages->label()}}</label>
                    </div>
                @endforeach
                @error('applyMap.usage')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">१.३ भवन ऐन अनुसार वर्गीकरण *</label>
            <div class="col">
                @foreach(\Modules\EMap\Enums\CategorizationEnum::cases() as $categorization)
                    <div class="form-check form-check-inline">
                        <input type="radio"
                               id="{{$categorization->name}}"
                               wire:model="applyMap.building_category"
                               value="{{$categorization->value}}"
                               {{$editForm ? '' : 'disabled'}}
                               class="form-check-input">
                        <label class="form-check-label"
                               for="{{$categorization->name}}">{{$categorization->label()}}</label>
                    </div>
                @endforeach
                @error('applyMap.building_category')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <b class="form-label">१.४ स्ट्रकचर टाईप *</b> <br>
            <div class="col">
                @foreach($structureTypes as $structureType)
                    <div class="form-check form-check-inline">
                        <input type="radio"
                               id="structure-type-{{$loop->index}}"
                               wire:model="applyMap.structure_type_id"
                               value="{{$structureType->id}}"
                               {{$editForm ? '' : 'disabled'}}
                               class="form-check-input">
                        <label class="form-check-label"
                               for="structure-type-{{$loop->index}}">{{$structureType->title}}</label>
                    </div>
                @endforeach
                    <div class="form-check form-check-inline">
                        <input type="radio"
                               id="open_structure_type"
                               wire:model="open_structure_type"
                               value="1"
                               {{$editForm ? '' : 'disabled'}}
                               class="form-check-input">
                        <label class="form-check-label"
                               for="open_structure_type" wire:click.prevent="setStructureType">अन्य</label>
                    </div>
                    @if($open_structure_type)
                        <div class="col-md-3">
                            <label for="structure-type">
                                <input type="text"
                                       wire:model="applyMap.structure_type"
                                       id="structure-type"
                                    {{$editForm ? '' : 'disabled'}}
                                class="form-control">
                            </label>
                        </div>
                    @endif
                @error('structure_type_id')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="mb-1">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold" for="applyMap.current_storey">१.५ हाल निर्माण गर्ने तल्ला
                        संख्या </label>
                    <input type="number" class="form-control form-control-sm" id="applyMap.current_storey"
                           wire:model="applyMap.current_storey"
                           placeholder="तल्ला संख्या अंकमा" min="0" {{$editForm ? '' : 'disabled'}}>
                    @error('applyMap.current_storey')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold" for="applyMap.area_of_plinth">१.६ प्लिन्थको क्षेत्रफल</label>
                    <input type="number" class="form-control form-control-sm" id="applyMap.area_of_plinth"
                           wire:model="applyMap.area_of_plinth"
                           placeholder="प्लिन्थको क्षेत्रफल (वर्ग मिटर)" min="0" {{$editForm ? '' : 'disabled'}}>
                    @error('applyMap.area_of_plinth')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold" for="applyMap.future_storey">१.७ भविष्यमा निर्माण गर्ने तल्ला
                        संख्या </label>
                    <input type="number" class="form-control form-control-sm" id="applyMap.future_storey"
                           wire:model="applyMap.future_storey"
                           min="0" placeholder="भविष्यमा निर्माण गर्ने तल्ला संख्या" {{$editForm ? '' : 'disabled'}}>
                    @error('applyMap.future_storey')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold" for="applyMap.length">१.८ कुल भवनको लम्बाई </label>
                    <input type="number" class="form-control form-control-sm" id="applyMap.length"
                           wire:model="applyMap.length"
                           placeholder="कुल भवनको लम्बाई (मिटर)" min="0" {{$editForm ? '' : 'disabled'}}>
                    @error('applyMap.length')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold" for="applyMap.breadth">१.९ कुल भवनको चौडाई</label>
                    <input type="number" class="form-control form-control-sm" id="applyMap.breadth"
                           wire:model="applyMap.breadth"
                           placeholder="कुल भवनको चौडाई (मिटर)" min="0" {{$editForm ? '' : 'disabled'}}>
                    @error('applyMap.breadth')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold" for="applyMap.height">१.१० भवनको कुल उचाई जमिनको सतहबाट</label>
                    <input type="number" class="form-control form-control-sm" id="applyMap.height"
                           wire:model="applyMap.height"
                           placeholder="भवनको कुल उचाई जमिनको सतहबाट (मिटर)" min="0" {{$editForm ? '' : 'disabled'}}>
                    @error('applyMap.height')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>
        @if($editForm)
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-sm btn-primary rounded-pill waves-effect waves-light">
                    <i class="fa fa-save px-1"></i>पेश गर्नुहोस्
                </button>
            </div>
        @endif
    </fieldset>
</form>
