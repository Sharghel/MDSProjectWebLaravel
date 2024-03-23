@extends('layout.main')
@section('css')

@endsection
@section('main')
<div class="col-md-12">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>{{$category->name}}</h1>
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
                <div id="activity">
                    @if (empty($items))
                        <p>Aucun flux RSS trouvé pour cette catégorie.</p>
                    @else    
                        @foreach ($items as $item)
                            <div class="callout callout-info">
                                @php
                                    $enclosure = $item->get_enclosure(0); // Récupère la première enclosure
                                    $image_url = null;
                                    if ($enclosure && $enclosure->get_type() === 'image/jpeg') { // Vérifie si l'enclosure est une image JPEG
                                        $image_url = $enclosure->get_link();
                                    }
                                @endphp
            
                                @if ($image_url)
                                    <img src="{{ $image_url }}" alt="Image">
                                @else
                                    <a style="color: blue; text-decoration: none;" href="{{$item->get_permalink()}}" target="_blank"><h5>{{$item->get_title()}}</h5></a>
                                    <p>{{$item->get_date()}}</p>
                                    <p>{{strip_tags($item->get_description())}}</p>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
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