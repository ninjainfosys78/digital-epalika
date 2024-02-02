<?php

namespace Modules\Identity\Http\Livewire;

use Exception;
use Livewire\Component;
use Modules\Identity\Entities\InvitedGuest;

class InvitedGuestLivewire extends Component
{
    public $guests = [];

    protected $listeners = ['deleteGuest'];

    public function mount($guests = []): void
    {
        if (!empty($guests)) {
            $this->guests = collect($guests)->map(function ($guest) {
                return [
                    'id' => $guest->id ?? null,
                    'name' => $guest->name ?? '',
                    'phone' => $guest->phone ?? '',
                    'designation' => $guest->designation ?? '',
                ];
            })
                ->toArray();
        }
    }

    public function addGuest(): void
    {
        $this->guests[] = [];
    }

    public function removeGuest($index): void
    {
        if (array_key_exists('id', $this->guests[$index]) && $this->guests[$index]['id'] !== null) {
            $this->dispatchBrowserEvent('guest-delete', ['name' => $this->guests[$index]['name'], "index" => $index]);
            return;
        }
        $this->removeArrayIndex($index);
    }

    public function deleteGuest($index): void
    {
        try {
            InvitedGuest::find($this->guests[$index]['id'])->delete();
            $this->removeArrayIndex($index);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('guest-delete-error', ['name' => $this->guests[$index]['name']]);
        }

    }


    public function render()
    {
        return view('identity::livewire.invited-guest-livewire');
    }

    /**
     * @param $index
     * @return void
     */
    public function removeArrayIndex($index): void
    {
        unset($this->guests[$index]);
        $this->guests = array_values($this->guests);
    }
}
