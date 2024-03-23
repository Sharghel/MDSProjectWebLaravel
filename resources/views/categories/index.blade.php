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
    <!-- Default box -->
    <div class="card">
        <button type="button" data-toggle="modal" data-target="#modal-creation" class="btn btn-block btn-primary">Ajouter une catégorie</button>
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
      <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 5%" class="text-center">
                        Enable
                    </th>
                    <th style="width: 20%">
                        Nom de la catégorie
                    </th>
                    <th style="width: 30%" class="text-center">
                        Nom des sous-catégorie
                    </th>
                    {{-- <th style="width: 15%" class="text-center">
                        Actions
                    </th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>
                        <a>{{ $category->id }}</a>
                    </td>
                    <td class="project-state">
                        <span class="badge badge-success">Enabled</span>
                    </td>
                    <td>
                        <form action="{{route('category.update', $category->id)}}" method="POST" style="display: inline-block;">
                            @csrf @method('PUT') 
                            <input type="text" class="category-name" name='name' value="{{$category->name}}" disabled>
                            <a class="btn btn-info btn-sm edit-category-btn"><i class="fas fa-pencil-alt"></i></a>
                            <button type="submit" class="btn btn-success btn-sm btn_confirm" hidden><i class="fas fa-check"></i></button>
                        </form>
                        <a class="btn btn-danger btn-sm btn_cancel" hidden><i class="fas fa-times"></i></a>
                        <button type="button" data-toggle="modal" data-target="#modal-danger-parent" data-url="{{route('category.destroy', $category->id)}}" hidden class="btn btn-danger btn-sm btn_delete"><i class="fas fa-trash"></i></button>
                    </td>
                    <td>
                        @foreach ($category->children as $child)
                        <div>    
                            <form action="{{route('category.update', $child->id)}}" method="POST" style="display: inline-block;">
                                @csrf @method('PUT') 
                                <input type="text" class="category-nameChild" name='name' value="{{$child->name}}" disabled>
                                <a class="btn btn-info btn-sm edit-category-btnChild"><i class="fas fa-pencil-alt"></i></a>
                                <button type="submit" class="btn btn-success btn-sm btn_confirmChild" hidden><i class="fas fa-check"></i></button>
                            </form>
                            <a class="btn btn-danger btn-sm btn_cancelChild" hidden><i class="fas fa-times"></i></a>
                            <form action="{{route('category.edit', $child->id)}}" method="POST" style="display: inline-block;">@csrf @method('GET')<button type="submit" class="btn btn-info btn-sm btn_plusChild" hidden><i class="fa fa-plus"></i></button></form>
                            <button type="button" data-toggle="modal" data-target="#modal-danger-child" data-url="{{route('category.destroy', $child->id)}}" hidden class="btn btn-danger btn-sm btn_deleteChild"><i class="fas fa-trash"></i></button>
                        </div>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</section>

{{-- Début Modale suppression Parent--}}
    <div class="modal fade" id="modal-danger-parent">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Supprimer la catégorie parent</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Êtes-vous certains de vouloir supprimer cette catégorie ? Si vous supprimez une catégorie parent, cela supprimera aussi les catégories enfants.
                    </p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                    <form action="" id="ModaleDeleteParent" method="POST" style="display: inline-block;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm">Confirmer</button></form>
                </div>
            </div>
        </div>
    </div>
{{-- Fin Modale suppression Parent --}}
{{-- Début Modale suppression Enfant--}}
    <div class="modal fade" id="modal-danger-child">
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
                    <form action="" id="ModaleDeleteChild" method="POST" style="display: inline-block;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm">Confirmer</button></form>
                </div>
            </div>
        </div>
    </div>
{{-- Fin Modale suppression Enfant --}}
{{-- Début Modale Création --}}
    <div class="modal fade" id="modal-creation">
        <div class="modal-dialog" role="creation">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nom de la catégorie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nom de la catégorie</label>
                            <input name="name" type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="parent-category" class="col-form-label">Catégorie parent</label>
                            <select name="parent_id" id="parent-category" class="form-control">
                                <option value="">Aucun parent</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- Fin Modale Création --}}
@endsection
@section('scripts')
<script>    
    const TextParents = document.querySelectorAll('.category-name');
    const ModifParents = document.querySelectorAll('.edit-category-btn');
    const ConfirmParents = document.querySelectorAll('.btn_confirm');
    const CancelParents = document.querySelectorAll('.btn_cancel');
    const EditParents = document.querySelectorAll('.btn_plus');
    const DeleteParents = document.querySelectorAll('.btn_delete');
    
    const TextChildren = document.querySelectorAll('.category-nameChild');
    const ModifChildren = document.querySelectorAll('.edit-category-btnChild');
    const ConfirmChildren = document.querySelectorAll('.btn_confirmChild');
    const CancelChildren = document.querySelectorAll('.btn_cancelChild');
    const EditChildren = document.querySelectorAll('.btn_plusChild');
    const DeleteChildren = document.querySelectorAll('.btn_deleteChild');
    
    function handleCategoryEdit(Modif, Text, Confirm, Cancel, Edit, Delete, OriginalText) {
        Modif.forEach((element, index) => {
            element.addEventListener("click", function(event){
                event.preventDefault();
                OriginalText[index] = Text[index].value; // Store the original text
                Text[index].disabled = false;
                element.hidden = true;
                Confirm[index].hidden = false;
                Cancel[index].hidden = false;
                Delete[index].hidden = false;
                Edit[index].hidden = false;
            });
        });

        Cancel.forEach((element, index) => {
            element.addEventListener("click", function(event){
                event.preventDefault();
                Text[index].value = OriginalText[index]; // Reset text to original value
                Text[index].disabled = true;
                Modif[index].hidden = false;
                Confirm[index].hidden = true;
                element.hidden = true;
                Delete[index].hidden = true;
                Edit[index].hidden = true;
                })
            });
        }
    const OriginalTextParents = [];
    const OriginalTextChildren = [];

    handleCategoryEdit(ModifParents, TextParents, ConfirmParents, CancelParents, EditParents, DeleteParents, OriginalTextParents);
    handleCategoryEdit(ModifChildren, TextChildren, ConfirmChildren, CancelChildren, EditChildren, DeleteChildren, OriginalTextChildren);

    const ModaleParent = document.querySelector('#ModaleDeleteParent');
    const ModaleChild = document.querySelector('#ModaleDeleteChild');

    DeleteParents.forEach((DeleteParent, index) => {
        DeleteParent.addEventListener("click", function(event) {
            const url = this.getAttribute('data-url'); // Get the data-url attribute value
            ModaleParent.setAttribute('action', url); // Set the form action attribute with the obtained URL
        });
    });

    DeleteChildren.forEach((DeleteChild, index) => {
        DeleteChild.addEventListener("click", function(event) {
            const url = this.getAttribute('data-url'); // Get the data-url attribute value
            ModaleChild.setAttribute('action', url); // Set the form action attribute with the obtained URL
        });
    });
</script>
@endsection
