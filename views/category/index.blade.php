@extends('news::category.template')

@section('page.head.menu')
    <div class="ui secondary menu">
        <a class="item" href="{{ route('news.category.create') }}">
            <i class="add icon"></i>{{ ___('Add Category') }}
        </a>
    </div>
@endsection

@section('content')
    <table class="ui selectable very basic table">
        <thead>
            <tr>
                <th>{{ ___('Category Name') }}</th>
                <th class="center aligned collapsing">{{ ___('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr data-category-id="{{ $category->id }}">
                    <td>{{ $category->title }}</td>
                    <td class="right aligned collapsing">
                        <div class="ui compact text menu">
                            <a class="item" href="{{ route('news.category.edit', $category->id) }}">
                                <i class="pencil icon"></i>
                                {{ ___('Edit') }}
                            </a>
                            @button(___('Delete'), [
                                'method' => 'delete',
                                'location' => 'news.category.destroy',
                                'type' => 'route',
                                'confirm' => 'Are you sure you want to delete this news category?</br>This cannot be undone.',
                                'class' => 'item',
                                'prepend' => '<i class="delete icon"></i>',
                                'model' => $category,
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

{{ $categories->links('pagination.default') }}

@endsection