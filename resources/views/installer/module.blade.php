@extends('installer.app')
@section('title')
    <i class="fa fa-id-card fa-fw" aria-hidden="true"></i>
    License Setting
@endsection
@section('content')
    <form method="post" action="{{ route('installer.save-modules') }}" class="tabs-wrap">
        @csrf
        <div class="tab" id="tab1content">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <fieldset>
                <legend>
                    Modules
                </legend>

                <div class="form-group {{ $errors->has('key') ? ' has-error ' : '' }}">

                    @foreach($modules as $module=>$value)
                        <div style="display: flex; gap: 10px; padding-inline: 10px">
                            <label for="{{$module}}" style="font-weight: bold">{{$module}}</label>
                            <input type="checkbox" name="modules[]" id="{{$module}}"
                                   {{$value ? 'checked' : ''}} value="{{$module}}">
                        </div>
                    @endforeach
                </div>
            </fieldset>

            <div class="buttons">
                <button class="button" type="submit">
                    Check Requirements
                    <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </form>

@endsection

