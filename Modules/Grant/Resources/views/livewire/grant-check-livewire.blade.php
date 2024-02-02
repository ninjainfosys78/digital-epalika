<div>
    <form wire:submit.prevent="submitFormData">
        <fieldset>
            <legend><h4 class="text-info">अनुदान जारी </h4></legend>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <label for="citizenship_no" class="form-label">नागरिकता नं. *</label>
                    <input
                        type="text"
                        wire:model="citizenship_no"
                        value="{{old('citizenship_no')}}"
                        class="form-control @error('citizenship_no') is-invalid @enderror"
                        id="citizenship_no"
                        placeholder="अनुदानग्राहीको लगानी"
                    />
                    @error('citizenship_no')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">
                चेक गर्नुहोस
            </button>
        </div>
    </form>
    @if(!empty($families))
        <div class="table-responsive">
            <table class="table table-bordered table-sm mt-3">
                <thead>
                <tr>
                    <th scope="col">क्र.स</th>
                    <th scope="col">नाम</th>
                    <th scope="col">नागरिकता नं</th>
                    <th scope="col">नाता</th>
                    <th scope="col">अहिलेसम्म लागेको अनुदान</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($families as $family)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$family['name'] ?? ''}}</td>
                        <td>{{$family['citizenship_no'] ?? ''}}</td>
                        <td>{{$family['relationship']['title'] ?? 'घरमुली'}}</td>
                        <td></td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @include('grant::admin.inc.farmer_form')
    @include('grant::admin.inc.group_form')
    @include('grant::admin.inc.cooperative_form')
    @include('grant::admin.inc.enterprise_form')

    @once
        @push('scripts')
            <script>
                $(document).ready(function () {
                    setTargetForm($('#grant_for').val())
                    $("#grant_for").on('change', function () {
                        setTargetForm($(this).val())
                    })

                    function setTargetForm(grant_for) {
                        switch (grant_for) {
                            case 'cooperative':
                                setButtonAttribute('cooperative-modal')
                                break;
                            case 'group':
                                setButtonAttribute('group-modal')
                                break;
                            case 'enterprise':
                                setButtonAttribute('enterprise-modal')
                                break;
                            default:
                                setButtonAttribute('farmer-modal')
                        }
                    }

                    function setButtonAttribute(attrVal) {
                        $('#form-popup-button').attr('data-bs-target', '#' + attrVal)
                    }
                });
            </script>
        @endpush
    @endonce
</div>
