@extends('layout.main')
@section('css')
<style>
  input[disabled] {
    border: none;
    background-color: transparent;
    outline: none;
    padding: 0;
    color:#212529;
    }
</style>
@endsection
@section('main')
<section class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <i class="fas fa-file fa-7x"></i>
                {{-- <img class="profile-user-img img-fluid img-circle" src="{{asset('img/user4-128x128.jpg')}}" alt="Image for the category"> --}}
              </div>
              <h3 class="profile-username text-center">Logo de la catégorie</h3>
              {{-- <ul>
                <li><i class="fas fa-file"></i></li>
                <li><i class="fas fa-filter"></i></li>
                <li><i class="fas fa-folder"></i></li>
                <li><i class="fas fa-folder-open"></i></li>
                <li><i class="fas fa-code"></i></li>
                <li><i class="fas fa-bug"></i></li>
                <li><i class="fas fa-user-secret"></i></li>
                <li><i class="fas fa-microchip"></i></li>
                <li><i class="fas fa-terminal"></i></li>
                <li><i class="fas fa-keyboard"></i></li>
                <li><i class="fas fa-laptop-code"></i></li>
              </ul> --}}
              {{-- <select name="logo" id="logo">
                <option value="1"><i class="fas fa-shield-halved"></i></option>
                <option value="2"><i class="fas fa-file"></i></option>
                <option value="3"><i class="fas fa-gear"></i></option>
                <option value="4"><i class="fas fa-filter"></i></option>
                <option value="5"><i class="fas fa-folder"></i></option>
                <option value="6"><i class="fas fa-folder-open"></i></option>
                <option value="7"><i class="fas fa-code"></i></option>
                <option value="8"><i class="fas fa-bug"></i></option>
                <option value="9"><i class="fas fa-user-secret"></i></option>
                <option value="10"><i class="fas fa-microchip"></i></option>
                <option value="11"><i class="fas fa-terminal"></i></option>
                <option value="12"><i class="fas fa-keyboard"></i></option>
                <option value="13"><i class="fas fa-laptop-code"></i></option>
              </select> --}}
              </p>
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Catégorie Parent</b> <a class="float-right">{{$category->parent->name}}</a>
                </li>
                <li class="list-group-item">
                  <b>Catégorie</b> <a class="float-right">{{$category->name}}</a>
                </li>
              </ul>
              {{-- <form action="{{route('category.destroy', $category->id)}}" method="POST">@csrf @method('DELETE')<input type="submit" class="btn btn-block btn-danger btn_delete" value="Supprimer"></input></form> --}}
              <button type="button" data-toggle="modal" data-target="#modal-danger-category" class="btn btn-block btn-danger">Supprimer</button>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link {{ $activeTab === 'modification' ? 'active ' : '' }}" href="#modification" data-toggle="tab">Modification</a></li>
                <li class="nav-item"><a class="nav-link {{ $activeTab === 'flux' ? 'active ' : '' }}" href="#flux" data-toggle="tab">Flux</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="{{ $activeTab === 'modification' ? 'active ' : '' }} tab-pane" id="modification">
                  <form action="{{ route('category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-primary">Nom de la Catégorie Parent</span>
                      </div>
                      <div>
                        <i class="fas fa-user bg-primary"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Choix d'une catégorie parent : </h3>    
                          <div class="timeline-body">
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
                          </div>
                        </div>
                      </div>
                      <!-- timeline item -->
                      
                      <div class="time-label">
                        <span class="bg-primary"> Nom de la Catégorie</span>
                      </div>
                      <div>
                        <i class="fas fa-user bg-primary"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Renommer la catégorie : </h3>          
                          <div class="timeline-body">
                            <input type="text" name="name" placeholder="name" value="{{ $category->name ?? '' }}">
                          </div>
                        </div>
                      </div>
                      
                      <div class="time-label">
                        <span class="bg-info"> Logo de la Catégorie</span>
                      </div>
                      <div>
                        <i class="fab fa-joomla bg-info"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Changer le logo : </h3>          
                          <div class="timeline-body">
                            <input type="text" name="name" placeholder="name" value="{{ $category->name ?? '' }}">
                          </div>
                        </div>
                      </div>  
                    </div>
                    <input type="submit" class="btn btn-block btn-primary" value="Modifier">
                    <a href="{{ route('category.index') }}" class="btn btn-block btn-secondary">Annuler</a>
                  </form>
                </div>
              <!-- END timeline item -->
              <div class="{{ $activeTab === 'flux' ? 'active ' : '' }} tab-pane" id="flux">
                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal-default">
                  Ajouter un flux
                </button>
                <div class="card-body p-0">
                  <table class="table table-striped projects">
                    <thead>
                      <tr>
                        <th style="width: 1%">
                          #
                        </th>
                        <th style="width: 20%" class="text-center">
                          Nom du flux
                        </th>
                        <th style="width: 55%">
                          Lien du flux
                        </th>
                        <th style="width: 20%">
                          Actions
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($fluxes as $flux)
                      <form action="{{route('flux.update', $flux->id)}}" method="POST" style="display: inline-block;">
                        @csrf @method('PUT') 
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <tr>
                          <td>
                            <a>{{ $flux->id }}</a>
                          </td>
                          <td>
                            <input type="text" class="flux-name form-control" name='name' value="{{$flux->name}}" disabled>
                          </td>
                          <td>
                            <input type="text" class="flux-link form-control" name='link' value="{{$flux->link}}" disabled>
                          </td>
                          <td>
                            <a class="btn btn-info btn-sm edit-flux-btn"><i class="fas fa-pencil-alt"></i></a>
                            <button type="submit" class="btn btn-success btn-sm btn_confirm" hidden><i class="fas fa-check"></i></button>
                            <a class="btn btn-danger btn-sm btn_cancel" hidden><i class="fas fa-times"></i></a>
                            <button type="button" data-toggle="modal" data-target="#modal-danger-flux" data-url="{{route('flux.destroy', $flux->id)}}" class="btn btn-danger btn-sm btn_delete"><i class="fas fa-trash"></i></button>
                          </td>
                        </tr>
                      </form>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>  

{{-- Début Modale Création Flux --}}
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
                      <input type="hidden" name="redirection" value="edit">
                      
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
{{-- Fin Modale Création Flux --}}
{{-- Début Modale suppression Catégorie--}}
  <div class="modal fade" id="modal-danger-category">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Supprimer la catégorie enfant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Êtes-vous certains de vouloir supprimer cette catégorie ? Si vous supprimez cette catégoie tout les flux seront perdu.
                </p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                <form action="{{route('category.destroy', $category->id)}}" method="POST">@csrf @method('DELETE')<input type="submit" class="btn btn-block btn-danger" value="Confirmer"></input></form>
                {{-- <form action="" id="ModaleDeleteChild" method="POST" style="display: inline-block;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm">Confirmer</button></form> --}}
            </div>
        </div>
    </div>
  </div>
{{-- Fin Modale suppression Catégorie --}}
{{-- Début Modale suppression Flux--}}
  <div class="modal fade" id="modal-danger-flux">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Supprimer le flux</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>
            Êtes-vous certains de vouloir supprimer ce flux ? Si vous supprimez ce flux, vous ne pourrez plus le récuperer.
          </p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
          <form action="" id="ModaleDeleteFlux" method="POST" style="display: inline-block;">@csrf @method('DELETE')
            <input type="hidden" name="category_id" value="{{$category->id}}">
            <button type="submit" class="btn btn-danger btn-sm">Confirmer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
{{-- Fin Modale suppression Flux --}}
@endsection
@section('scripts')
<script>
  const ModifFluxesNames = document.querySelectorAll('.edit-flux-btn');
  const TextFluxesNames = document.querySelectorAll('.flux-name');
  const TextFluxesLinks = document.querySelectorAll('.flux-link');
  const ConfirmFluxes = document.querySelectorAll('.btn_confirm');
  const CancelFluxes = document.querySelectorAll('.btn_cancel');
  const DeleteFluxes = document.querySelectorAll('.btn_delete');
  
  const OriginalTextFluxesNames = [];
  const OriginalTextFluxesLinks = [];
  
  const ModaleFlux = document.querySelector('#ModaleDeleteFlux');
  
  function handleCategoryEdit(Modif, Text1, Text2, Confirm, Cancel, Delete, OriginalText1, OriginalText2) {
    Modif.forEach((element, index) => {
      element.addEventListener("click", function(event){
        event.preventDefault();
        OriginalText1[index] = Text1[index].value
        OriginalText2[index] = Text2[index].value
        Text1[index].disabled = false;
        Text2[index].disabled = false;
        element.hidden = true;
        Confirm[index].hidden = false;
        Cancel[index].hidden = false;
        Delete[index].hidden = false;
      });
    });

    Cancel.forEach((element, index) => {
      element.addEventListener("click", function(event){
        event.preventDefault();
        Text1[index].value = OriginalText1[index]; // Reset text to original value
        Text2[index].value = OriginalText2[index];
        Text1[index].disabled = true;
        Text2[index].disabled = true;
        Modif[index].hidden = false;
        Confirm[index].hidden = true;
        element.hidden = true;
        Delete[index].hidden = true;
      })
    });
  }

  handleCategoryEdit(ModifFluxesNames, TextFluxesNames, TextFluxesLinks, ConfirmFluxes, CancelFluxes, DeleteFluxes, OriginalTextFluxesNames, OriginalTextFluxesLinks);

  DeleteFluxes.forEach((DeleteFlux, index) => {
    DeleteFlux.addEventListener("click", function(event) {
          const url = this.getAttribute('data-url'); // Get the data-url attribute value
          ModaleFlux.setAttribute('action', url); // Set the form action attribute with the obtained URL
      });
  });
</script>
@endsection