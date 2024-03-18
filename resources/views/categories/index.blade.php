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
      <div class="card-header">
        <h3 class="card-title">Projects</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
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
                            <button type="submit" class="btn btn-success btn-sm" hidden><i class="fas fa-check"></i></button>
                        </form>
                        <a class="btn btn-danger btn-sm btn_cancel" hidden><i class="fas fa-times"></i></a>
                        <form action="{{route('category.destroy', $category->id)}}" method="POST" style="display: inline-block;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm btn_delete" hidden><i class="fas fa-trash"></i></button></form>
                        <form action="{{route('category.edit', $category->id)}}" method="POST" style="display: inline-block;">@csrf @method('GET')<button type="submit" class="btn btn-info btn-sm btn_plus" hidden><i class="fa fa-plus"></i></button></form>
                    </td>
                    <td>
                        @foreach ($category->children as $child)
                        <form action="{{route('category.update', $child->id)}}" method="POST" style="display: inline-block;">
                            @csrf @method('PUT') 
                            <input type="text" class="category-name" name='name' value="{{$child->name}}" disabled>
                            <a class="btn btn-info btn-sm edit-category-btn"><i class="fas fa-pencil-alt"></i></a>
                            <button type="submit" class="btn btn-success btn-sm" hidden><i class="fas fa-check"></i></button>
                        </form>
                        <a class="btn btn-danger btn-sm btn_cancel" hidden><i class="fas fa-times"></i></a>
                        <form action="{{route('category.destroy', $child->id)}}" method="POST" style="display: inline-block;">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm btn_delete" hidden><i class="fas fa-trash"></i></button></form>
                        <br>
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
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.edit-category-btn').forEach(function (editButton) {
            editButton.addEventListener('click', function () {
                let categoryRow = this.closest('tr');
                let categoryNameInput = categoryRow.querySelector('.category-name');

                categoryNameInput.disabled = false; // Enable the input
                let txt = categoryNameInput.value;
                this.style.display = 'none'; // Hide the pencil button

                // Show the submit button, cancel button, and delete button
                categoryRow.querySelector('button[type="submit"]').hidden = false;
                categoryRow.querySelector('.btn_cancel').hidden = false;
                categoryRow.querySelector('.btn_delete').hidden = false;
                categoryRow.querySelector('.btn_plus').hidden = false;
                
                // Click event for the cancel button
                categoryRow.querySelector('.btn_cancel').addEventListener('click', function () {
                    // Disable the input
                    categoryNameInput.disabled = true;
                    categoryNameInput.value = txt;

                    // Show the pencil button
                    editButton.style.display = 'inline-block';
                    
                    // Hide the submit, cancel, and delete buttons
                    categoryRow.querySelector('button[type="submit"]').hidden = true;
                    categoryRow.querySelector('.btn_cancel').hidden = true;
                    categoryRow.querySelector('.btn_delete').hidden = true;
                    categoryRow.querySelector('.btn_plus').hidden = true;
                });
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.edit-category-btn-child').forEach(function (editButton) {
            editButton.addEventListener('click', function () {
                let categoryRow = this.closest('tr');
                let categoryNameInput = categoryRow.querySelector('.category-name');

                categoryNameInput.disabled = false; // Enable the input
                let txt = categoryNameInput.value;
                this.style.display = 'none'; // Hide the pencil button

                // Show the submit button, cancel button, and delete button
                categoryRow.querySelector('button[type="submit"]').hidden = false;
                categoryRow.querySelector('.btn_cancel').hidden = false;
                categoryRow.querySelector('.btn_delete').hidden = false;

                // Click event for the cancel button
                categoryRow.querySelector('.btn_cancel').addEventListener('click', function () {
                    // Disable the input
                    categoryNameInput.disabled = true;
                    categoryNameInput.value = txt;

                    // Show the pencil button
                    editButton.style.display = 'inline-block';

                    // Hide the submit, cancel, and delete buttons
                    categoryRow.querySelector('button[type="submit"]').hidden = true;
                    categoryRow.querySelector('.btn_cancel').hidden = true;
                    categoryRow.querySelector('.btn_delete').hidden = true;
                });
            });
        });
    });
</script>
@endsection
