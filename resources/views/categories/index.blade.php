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
        <a type="button" class="btn btn-block btn-primary" href="{{ route('category.create') }}">Ajouter une catégorie</a>
      <div class="card-header">
        <h3 class="card-title">Projects</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
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
                        Nombre de sous-dossiers
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
                        <form action="{{route('category.edit', $category->id)}}" method="POST" style="display: inline-block;">@csrf @method('GET')<button type="submit" class="btn btn-info btn-sm btn_plus" hidden><i class="fa fa-plus"></i></button></form>
                        <form action="{{route('category.destroy', $category->id)}}" method="POST" style="display: inline-block;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm btn_delete" hidden><i class="fas fa-trash"></i></button></form>
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
                            <form action="{{route('category.destroy', $child->id)}}" method="POST" style="display: inline-block;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm btn_deleteChild" hidden><i class="fas fa-trash"></i></button></form>
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
                Edit[index].hidden = false;
                Delete[index].hidden = false;
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
                Edit[index].hidden = true;
                Delete[index].hidden = true;
                })
            });
        }
    const OriginalTextParents = [];
    const OriginalTextChildren = [];

    handleCategoryEdit(ModifParents, TextParents, ConfirmParents, CancelParents, EditParents, DeleteParents, OriginalTextParents);
    handleCategoryEdit(ModifChildren, TextChildren, ConfirmChildren, CancelChildren, EditChildren, DeleteChildren, OriginalTextChildren);

</script>
@endsection
