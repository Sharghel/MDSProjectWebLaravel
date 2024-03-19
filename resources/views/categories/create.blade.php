@extends('layout.main')
@section('css')

@endsection
@section('main')

<h1>Creation d'une catégorie</h1>

<form action="{{ route('category.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="name">
    <select name="parent_id">
        <option value="">Sélectionner un parent si besoin</option>
        @if($parent_categories)
            @foreach($parent_categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        @endif
    </select>
    <input type="submit" value="Ajouter">
    <a href="{{ route('category.index') }}" class="btn btn-secondary">Annuler</a>

</form>

@endsection
@section('scripts')

@endsection