@extends('news::news.template')


@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <form action="{{route('news.store')}}" method="POST" class="ui form">
                {{ csrf_field() }}

                @include('news::news.form')
                <div class="ui hidden divider"></div>
                <div class="ui hidden divider"></div>

                <div class="field actions">
    	            <a class="ui button" href="{{ route('news.index') }}">{{ ___('Cancel') }}</a>
    	            <button type="submit" class="ui right floated primary button">
    	            	{{ ___('Create') }}
                	</button>
                </div>
            </form>
        </div>
    </div>
@endsection