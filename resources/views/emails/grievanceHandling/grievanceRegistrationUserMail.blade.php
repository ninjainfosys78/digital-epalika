<x-mail::message>
    तपाइको गुनासो सफलतापुर्बक पेश भएको छ ।
    <br>
    टोकन नम्बर : {{ $grievanceDetail->token }} <br>
    गुनासो बिषय : {{ $grievanceDetail->subject }} <br>
    गुनासो विवरण : {{ $grievanceDetail->description }} <br>

    धन्यबाद,
    {{ config('app.name') }}
</x-mail::message>
