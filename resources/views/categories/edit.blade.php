@extends('layout.main')
@section('css')

@endsection
@section('main')
<h1>Create category</h1>

<form action="{{ route('category.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" placeholder="name" value="{{ $category->name ?? '' }}">
    <select name="parent_id">
        <option value="">Sélectionner un parent si besoin</option>
        @if($parent_categories)
            @foreach($parent_categories as $parent_category)
                @if($parent_category->id == $category->parent_id)
                    <option value="{{ $parent_category->id }}" selected>{{ $parent_category->name }}</option>
                @else
                    <option value="{{ $parent_category->id }}">{{ $parent_category->name }}</option>
                @endif
            @endforeach
        @endif
    </select>
    <input type="submit" value="Modifier">

</form>
@endsection
@section('scripts')

@endsection