<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InvitedMemberLivewire extends Component
{
    public $invitedMembers = [];

    public $meeting;
    public function mount($meeting = null)
    {
        if (!empty($meeting)) {

            $formDataTypeArray = [];

            foreach ($meeting->invitedMembers as $index => $invitedMember) {
                $formDataTypeArray[$index]['id'] = $invitedMember->id;
                $formDataTypeArray[$index]['name'] = $invitedMember->name;
                $formDataTypeArray[$index]['email'] = $invitedMember->email ?? '';
                $formDataTypeArray[$index]['phone'] = $invitedMember->phone ?? '';
                $formDataTypeArray[$index]['designation'] = $invitedMember->designation ?? '';
            }

            $this->invitedMembers = $formDataTypeArray;
        }
    }

    public function addInvitedMemberRow()
    {
        $this->invitedMembers[] = [];
    }

    public function removeInvitedMemberRow($index)
    {
        unset($this->invitedMembers[$index]);
        $this->invitedMembers = array_values($this->invitedMembers);
    }
    public function render()
    {
        return view('livewire.invited-member-livewire');
    }
}
