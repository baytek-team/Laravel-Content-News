@extends('news::news.template')

@section('page.head.menu')
    <div class="ui secondary contextual menu">
        <div class="item">
            @can('View News Category')
            <a class="ui button" href="{{ route('news.category.index') }}">
                <i class="add icon"></i>{{ ___('News Categories') }}
            </a>
            &nbsp;
            @endcan
            @can('Create News')
            <a class="ui primary button" href="{{ route('news.create') }}">
                <i class="add icon"></i>{{ ___('Add News') }}
            </a>
            @endcan
        </div>
    </div>
@endsection

@if(count($news))
    @section('content')
        <table class="ui selectable very basic table">
            <thead>
                <tr>
                    <th class="nine wide">{{ ___('News Title') }}</th>
                    <th>{{ ___('News Date') }}</th>
                    <th class="center aligned collapsing">{{ ___('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $item)
                    <tr class="nine wide" data-news-id="{{ $item->id }}">
                        <td>{{ str_limit($item->title, 100) }}</td>
                        <td>{{ (new Carbon\Carbon($item->getMeta('news_date')))->formatLocalized(___('%B %e, %Y')) }}</td>
                        <td class="right aligned collapsing">
                            <div class="ui compact text menu">
                                @can('Update News')
                                <a class="item" href="{{ route('news.edit', $item->id) }}">
                                    <i class="pencil icon"></i>
                                    {{-- {{ ___('Edit') }} --}}
                                </a>
                                @endcan
                                @can('Delete News')
                                @button('', [
                                    'method' => 'delete',
                                    'location' => 'news.destroy',
                                    'type' => 'route',
                                    'confirm' => 'Are you sure you want to delete this news?</br>This cannot be undone.',
                                    'class' => 'item action',
                                    'prepend' => '<i class="delete icon"></i>',
                                    'model' => $item,
                                ])
                                @endcan
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
@else
    @section('outer-content')
        <div class="ui middle aligned padded grid no-result">
            <div class="column">
                <div class="ui center aligned padded grid">
                    <div class="column">
                        <h2>{{ ___('We couldn\'t find anything') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif