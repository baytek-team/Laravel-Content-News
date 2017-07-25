@extends('contents::admin')

@section('page.head.header')
    <h1 class="ui header">
        <i class="newspaper icon"></i>
        <div class="content">
            {{ ___('News') }}
            <div class="sub header">{{ ___('Manage the news of the system.') }}</div>
        </div>
    </h1>
@endsection
