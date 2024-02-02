<x-mail::message>

    चलानी नं. : {{ $dispatchDetail->dispatch->dispatch_no ?? '' }}<br>
    चलानि मिति : {{ $dispatchDetail->dispatch->dispatch_date ?? '' }}<br>
    पाउने कार्यालय : {{ $dispatchDetail->dispatch->receiver_name }}<br>




    Thanks
    {{ config('app.name') }}
</x-mail::message>
