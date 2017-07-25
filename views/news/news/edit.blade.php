@extends('news::news.template')

@section('content')
    <div id="registration" class="ui container">
        <div class="ui hidden divider"></div>
        <form action="{{ route('news.update', $news->id) }}" method="POST" class="ui form">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            @include('news::news.form')
            {{-- <div class="field">
                <div class="ui toggle checkbox">
                    <input type="checkbox" name="notify" tabindex="0" class="hidden">
                    <label for="notify">{{ ___('Notify members of news updates') }}</label>
                </div>
            </div> --}}
            <div class="ui hidden divider"></div>

            <div class="ui hidden error message"></div>
            <div class="field actions">
                <a class="ui button" href="{{ route('news.index') }}">{{ ___('Cancel') }}</a>

                <button type="submit" class="ui right floated primary button">
                    {{ ___('Update') }}
                </button>
            </div>
        </form>
    </div>
@endsection