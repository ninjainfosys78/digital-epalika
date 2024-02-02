<x-mail::message>
    गुनासो विवरण <br>
    टोकन नम्बर : {{ $grievanceDetail->token }} <br>
    गुनासो बिषय : {{ $grievanceDetail->subject }} <br>
    विवरण : {{ $grievanceDetail->description }} <br> <br>
    Your above grievance is assigned to {{ $grievanceAssign->user->name }} for further inspection. <br>
    धन्यबाद, {{ config('app.name') }}
</x-mail::message>
