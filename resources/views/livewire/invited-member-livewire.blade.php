
    <div class="border border-secondary p-2 mb-2">
        <legend class="font-16 text-secondary">
            <strong> आमंत्रित सदस्यहरु </strong>
        </legend>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>

                                <th>नाम</th>
                                <th>पद</th>
                                <th>फोन</th>
                                <th>इमेल</th>
                                <th>
                                    <button type="button" wire:click="addInvitedMemberRow" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($invitedMembers as $key=>$invitedMember)
                        <tr>
                            <td>
                                <input type="text" wire:model="invitedMembers.{{$key}}.name" name="invitedMember[{{$key}}][name]" class="form-control"
                                       placeholder="नाम">
                                       @error('invitedMember.*.name')
                                       <div class="invalid-feedback">{{$message}}</div>
                                       @enderror
                            </td>
                            <td>
                                <input type="text" wire:model="invitedMembers.{{$key}}.designation"  name="invitedMember[{{$key}}][designation]" class="form-control"
                                placeholder="पद">
                                @error('invitedMember.*.designation')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" wire:model="invitedMembers.{{$key}}.phone"  name="invitedMember[{{$key}}][phone]" class="form-control"
                                placeholder="फोन">
                                @error('invitedMember.*.phone')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </td>
                            <td>
                                <input type="text" wire:model="invitedMembers.{{$key}}.email"  name="invitedMember[{{$key}}][email]" class="form-control"
                                placeholder="इमेल">
                                @error('invitedMember.*.email')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </td>

                            <td>
                                <button type="button" wire:click="removeInvitedMemberRow({{$key}})" class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @error('invitedMember')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror


                </div>
            </div>
        </div>
    </div>

