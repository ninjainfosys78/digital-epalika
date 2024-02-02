@extends('frontend.static.chat.master')
@section('chat')
    <div id="frame" class="rounded border mt-5">
        <div class="chat rounded">
            <ul class="sender">
                <li class="d-flex py-2">
                    <img src="{{asset('assets/frontend/image/avatar.png')}}" alt="">
                    <p>yयो सनेदेस्ज हो मैले पथको\ yयो सनेदेस्ज हो मैले पथको\ yयो सनेदेस्ज हो मैले पथको\ yयो सनेदेस्ज हो मैले पथको\ yयो सनेदेस्ज हो मैले पथको\ yयो सनेदेस्ज हो मैले पथको\ yयो सनेदेस्ज हो मैले पथको\</p>
                </li>
            </ul>
            <ul class="receiver">
                <li class="d-flex py-2">
                    <p>yयो सनेदेस्ज हो मैले पथको\ yयो सनेदेस्ज हो मैले पथको\ yयो सनेदेस्ज हो मैले पथको\ yयो सनेदेस्ज हो मैले पथको\ yयो सनेदेस्ज हो मैले पथको\ yयो सनेदेस्ज हो मैले पथको\ yयो सनेदेस्ज हो मैले पथको\</p>
                    <img src="{{asset('assets/frontend/image/avatar.png')}}" alt="">
                </li>
            </ul>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/chat.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/popup.css')}}">
@endpush
