@extends('layout.main')
@php
  $colors = ['Info', 'Success', 'Warning', 'Danger'];
@endphp
@section('css')

@endsection
@section('main')

<div class="col-md-12">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    {{$category->name}}
                    <form action="{{route('category.edit', $category->id)}}" method="POST" style="display: inline-block;">@csrf @method('GET')
                        <input type="hidden" name="redirection" value="edit">
                        <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></button>
                    </form>
                </h1>
            </div>
          </div>
        </div>
    </section>
    <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-default">
        Ajouter un flux
    </button>
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                @include('layout.flux_rss')
            </div>
        </div>
    </div>
</div>

{{-- Début Modale --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Création d'un nouveau flux</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('flux.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <input type="hidden" name="redirection" value="show">
                        
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nom du flux</label>
                            <input name="name" type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-link" class="col-form-label">Url du flux</label>
                            <input name="link" type="text" class="form-control" id="recipient-link">
                        </div>
                        <div class="form-group">
                            <label for="recipient-color" class="col-form-label">Couleur du flux</label>
                            <select name="color" id="recipient-color" class="form-control">
                              @foreach ($colors as $color)
                                @php $colorLower = strtolower($color); @endphp
                                <option value="{{ $colorLower }}" class="bg-{{ strtolower($color) }}">{{ $color }}</option>
                              @endforeach
                            </select>
                          </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
{{-- Fin Modale --}}
@endsection
@section('scripts')

@endsection