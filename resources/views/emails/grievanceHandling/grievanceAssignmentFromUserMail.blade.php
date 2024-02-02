<x-mail::message>
    गुनासो विवरण <br>
    टोकन नम्बर : {{ $grievanceDetail->token }} <br>
    गुनासो बिषय : {{ $grievanceDetail->subject }} <br>
    विवरण : {{ $grievanceDetail->description }} <br> <br>
    गुनासो प्रयोगकर्ता विवरण <br>
    नाम : {{ $grievanceDetail->grievanceUser->name ?? '' }} <br>
    फोन : {{ $grievanceDetail->grievanceUser->phone ?? '' }} <br>
    इमेल : {{ $grievanceDetail->grievanceUser->email ?? '' }} <br>
    ठेगाना : {{ $grievanceDetail->grievanceUser->address ?? '' }} <br> <br>
    Above grievance has been transferred from you to {{ $grievanceAssign->user->email ?? '' }} <br>
    धन्यबाद, {{ config('app.name') }}
</x-mail::message>
