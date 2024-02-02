<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form wire:submit.prevent="save">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="mb-0 header-title">कार्यालयको नाम सेटअप</h4>
                    <button class="btn btn-xs btn-primary" wire:click.prevent="addOfficeHeader">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <fieldset>
                    <legend>
                        कार्यालयको नाम
                    </legend>
                    @if($officeHeaders)
                        @foreach($officeHeaders as $index=>$officeHeader)
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title.{{$index}}">शिर्षक *</label>
                                        <input type="text" id="title.{{$index}}" name="officeHeaders[{{$index}}][title]"
                                               placeholder="शिर्षक" value="{{old('title')}}"
                                               wire:model="officeHeaders.{{$index}}.title" class="form-control">
                                        @error("officeHeaders.$index.title")
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title_en.{{$index}}">शिर्षक (English) *</label>
                                        <input type="text" id="title_en.{{$index}}"
                                               name="officeHeaders[{{$index}}][title_en]"
                                               placeholder="शिर्षक (English)" value="{{old('title_en')}}"
                                               wire:model="officeHeaders.{{$index}}.title_en" class="form-control">
                                        @error("officeHeaders.$index.title_en")
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="font_color.{{$index}}">फन्ट रङ *</label>
                                        <input type="color" id="font_color.{{$index}}"
                                               name="officeHeaders[{{$index}}][font_color]"
                                               placeholder="फन्ट रङ" value="{{old('font_color')}}"
                                               wire:model="officeHeaders.{{$index}}.font_color" class="form-control">
                                        @error("officeHeaders.$index.font_color")
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="font_size.{{$index}}">फन्ट साइज *</label>
                                        <input type="text" id="font_size.{{$index}}"
                                               name="officeHeaders[{{$index}}][font_size]"
                                               placeholder="फन्ट साइज (.rem)" value="{{old('font_size')}}"
                                               wire:model="officeHeaders.{{$index}}.font_size" class="form-control">
                                        @error("officeHeaders.$index.font_size")
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="card_font.{{$index}}">कार्ड फन्ट साइज *</label>
                                        <input type="text" id="card_font.{{$index}}"
                                               name="officeHeaders[{{$index}}][card_font]"
                                               placeholder="कार्ड फन्ट साइज" value="{{old('card_font')}}"
                                               wire:model="officeHeaders.{{$index}}.card_font" class="form-control">
                                        @error("officeHeaders.$index.card_font")
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="font.{{$index}}">फन्ट *</label>
                                        <input type="text" id="font.{{$index}}"
                                               name="officeHeaders[{{$index}}][font]"
                                               placeholder="फन्ट" value="{{old('font')}}"
                                               wire:model="officeHeaders.{{$index}}.font" class="form-control">
                                        @error("officeHeaders.$index.font")
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position.{{$index}}">स्थान </label>
                                        <input type="number" id="position.{{$index}}"
                                               name="officeHeaders[{{$index}}][position]"
                                               placeholder="स्थान" value="{{old('position')}}"
                                               wire:model="officeHeaders.{{$index}}.position" class="form-control">
                                        @error("officeHeaders.$index.position")
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-1 mt-1">
                                    <div class="form-group">
                                        <button class="btn btn-danger btn-sm"
                                                wire:click.prevent="removeOfficeHeader({{$index}})">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12 mt-5">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Submit
                            </button>
                        </div>
                    @endif

                </fieldset>
            </div>
        </div>
    </form>
</div>

