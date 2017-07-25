@extends('news::news.template')

@section('page.head.menu')
    <div class="ui secondary menu">
        @if(Auth::user()->can('Create Event'))
            <a class="item" href="{{ route('news.create') }}">
                <i class="add icon"></i>{{ ___('Add Event') }}
            </a>
        @endif
    </div>
@endsection

@section('content')
<div class="ui text menu">
    <div class="header item">
        <i class="filter icon"></i>
        {{ ___('Filter By') }}
    </div>
    <a class="item @if($filter && $filter == 'all') active @endif" href="{{ route('news.index') }}">{{ ___('All') }}</a>
    <a class="item @if($filter && $filter == 'upcoming') active @endif" href="{{ route('news.upcoming') }}">{{ ___('Upcoming') }}</a>
    <a class="item @if($filter && $filter == 'past') active @endif" href="{{ route('news.past') }}">{{ ___('Past') }}</a>
    <a class="item @if($filter && $filter == 'featured') active @endif" href="{{ route('news.featured') }}">{{ ___('Featured') }}</a>
</div>
<table class="ui selectable table">
    <thead>
        <tr>
            <th class="nine wide">{{ ___('Event Title') }}</th>
            <th>{{ ___('Event Date') }}</th>
            <th class="center aligned collapsing">{{ ___('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($news as $news)
            <tr class="nine wide" data-news-id="{{ $news->id }}">
                <td>{{ str_limit($news->title, 100) }}</td>
                <td>{{ (new Carbon\Carbon($news->getMeta('news_date')))->formatLocalized(___('%B %e, %Y')) }}</td>
                <td class="right aligned collapsing">
                    <div class="ui compact text menu">
                        <a class="item" href="{{ route('news.edit', $news->id) }}">
                            <i class="pencil icon"></i>
                            {{ ___('Edit') }}
                        </a>
                        @button(___('Delete'), [
                            'method' => 'delete',
                            'location' => 'news.destroy',
                            'type' => 'route',
                            'confirm' => 'Are you sure you want to delete this news?</br>This cannot be undone.',
                            'class' => 'item action',
                            'prepend' => '<i class="delete icon"></i>',
                            'model' => $news,
                        ])
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <div class="ui centered">{{ ___('There are no results') }}</div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $news->links('pagination.default') }}

@endsection