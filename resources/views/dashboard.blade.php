@extends('layout.main')
@section('css')

@endsection
@section('main')


<div class="col-md-12">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tableau de bord</h1>
          </div>
        </div>
      </div>
  </section>
  {{-- <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-default">
      Ajouter un flux
  </button> --}}
  <div class="card">
      <div class="card-body">
          <div class="tab-content">
              <div id="activity">
                  @if (empty($items))
                      <p>Aucun flux RSS trouvé parmis toutes les catégories.</p>
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
@endsection
@section('scripts')

@endsection