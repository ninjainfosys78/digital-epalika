<?php

namespace Modules\ExecutiveMeeting\Http\Requests\CommitteeMember;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreCommitteeMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('committeeMember_create');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'designation' => ['required', 'string', 'max:255'],
            'phone' => ['nullable'],
            'photo' => ['nullable', 'mimes:png,jpg,jpeg'],
            'email' => ['nullable', 'email'],
            'province_id' => ['required', Rule::exists('provinces', 'id')->withoutTrashed()],
            'district_id' => ['required', Rule::exists('districts', 'id')->withoutTrashed()],
            'local_body_id' => ['required', Rule::exists('local_bodies', 'id')->withoutTrashed()],
            'ward_no' => ['required', 'integer'],
            'tole' => ['nullable'],
            'position' => ['nullable', 'integer']
        ];
    }
}
