@extends('installer.app')
@section('title')
    <i class="fa fa-id-card fa-fw" aria-hidden="true"></i>
    License Setting
@endsection
@section('content')
    <form method="post" action="{{ route('installer.save-license') }}" class="tabs-wrap">
        @csrf
        <div class="tab" id="tab1content">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group {{ $errors->has('key') ? ' has-error ' : '' }}">
                <label for="key">
                    Key
                </label>
                <input type="text" name="key" id="key" value="" placeholder="License Key" required/>
                @if ($errors->has('key'))
                    <span class="error-block">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            {{ $errors->first('key') }}
                        </span>
                @endif
            </div>
            <div class="buttons">
                <button class="button" type="submit">
                    Check Requirements
                    <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </form>

@endsection

