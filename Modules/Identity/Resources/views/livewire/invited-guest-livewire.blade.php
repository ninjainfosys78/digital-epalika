<fieldset>
    <legend>आमन्त्रित:</legend>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>क्र.सं.</th>
            <th><label for="name">नाम</label></th>
            <th><label for="designation">पद</label></th>
            <th><label for="phone">फोन</label></th>
            <th>
                <button class="btn btn-primary btn-sm" wire:click.prevent="addGuest">
                    <i class="fa fa-plus-square"></i>
                </button>
            </th>
        </tr>
        </thead>

        <tbody>
        @foreach($guests as $index => $guest)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <input type="hidden" name="guests[{{$index}}][id]" id="name" wire:model="guests.{{ $index }}.id">
                    <input type="text" class="form-control" name="guests[{{$index}}][name]" id="name" wire:model="guests.{{ $index }}.name">
                </td>
                <td>
                    <input type="text" class="form-control" id="designation" name="guests[{{$index}}][designation]" wire:model="guests.{{ $index }}.designation">
                </td>
                <td>
                    <input type="text" class="form-control" id="phone" name="guests[{{$index}}][phone]" wire:model="guests.{{ $index }}.phone">
                </td>
                <td>
                        {{-- <button class="btn btn-danger btn-sm btn-icon btn-icon-only btn-round" type="button"
                                wire:click.prevent="removeGuest({{ $index }})">
                            <i class="fa fa-minus"></i>
                        </button> --}}
                    <button class="btn btn-danger btn-sm" wire:click.prevent="removeGuest({{$index}})">
                        <i class="fa fa-minus-square"></i>
                    </button>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
</fieldset>
