<div class="field{{ $errors->has('title') ? ' error' : '' }}">
	<label for="title">{{ ___('Title') }}</label>
	<input type="text" id="title" name="title" placeholder="Title" value="{{ old('title', $category->title) }}">
</div>
<div class="field{{ $errors->has('content') ? ' error' : '' }}">
	<label for="content">{{ ___('Content') }}</label>
	<textarea id="content" name="content" placeholder="Content">{{ old('content', $category->content) }}</textarea>
</div>

@section('head')
{{-- <link rel="stylesheet" type="text/css" href="/css/trix.css"> --}}
{{-- <script type="text/javascript" src="/js/trix.js"></script> --}}
@endsection