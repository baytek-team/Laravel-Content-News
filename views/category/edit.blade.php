@extends('news::category.template')

@section('content')
<div id="registration" class="ui container">
    <div class="ui hidden divider"></div>
    <form action="{{ route('news.category.update', $category->id) }}" method="POST" class="ui form">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        @include('news::category.form')
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>

        <div class="ui error message"></div>
        <div class="field actions">
            <a class="ui button" href="{{ route('news.category.index') }}">{{ ___('Cancel') }}</a>

            <button type="submit" class="ui right floated primary button">
                {{ ___('Update Content') }}
            </button>
        </div>
    </form>
</div>

@endsection