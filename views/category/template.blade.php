@extends('contents::admin')

@section('page.head.header')
    <h1 class="ui header">
        <i class="newspaper icon"></i>
        <div class="content">
            {{ ___('News Categories') }}
            <div class="sub header">{{ ___('Manage the news categories.') }}</div>
        </div>
    </h1>
@endsection
