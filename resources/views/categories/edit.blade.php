@extends('layout.main')
@section('css')

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
                <img class="profile-user-img img-fluid img-circle" src="{{asset('img/user4-128x128.jpg')}}" alt="Image for the category">
              </div>

              <h3 class="profile-username text-center">Choisir une autre image</h3>
              <p class="text-muted text-center">SELECTION</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Catégorie Parent</b> <a class="float-right">{{$category->parent_id}}</a>
                </li>
                <li class="list-group-item">
                  <b>Catégorie</b> <a class="float-right">{{$category->name}}</a>
                </li>
              </ul>

              <a href="#" class="btn btn-danger btn-block"><b>Supprimer</b></a>
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
                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Modification</a></li>
                <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="active tab-pane" id="timeline">
                    
                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- The timeline -->
                        <div class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-primary"> Catégorie Parent </span>
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
                        <div>
                            <i class="fas fa-user bg-primary"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header">Renommer la catégorie : </h3>
                                
                                <div class="timeline-body">
                                    <input type="text" name="name" placeholder="name" value="{{ $category->name ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                    </div>
                    <input type="submit" class="btn btn-block btn-primary" value="Modifier">
                    <a href="{{ route('category.index') }}" class="btn btn-block btn-secondary">Annuler</a>
                </form>
                </div>
                <div class="tab-pane" id="activity">
                  <!-- Post -->
                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="{{asset('img/user1-128x128.jpg')}}" alt="user image">
                      <span class="username">
                        <a href="#">Article 1</a>
                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                      </span>
                      <span class="description">Shared publicly - 7:30 PM today</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      Lorem ipsum represents a long-held tradition for designers,
                      typographers and the like. Some people hate it and argue for
                      its demise, but others ignore the hate as they create awesome
                      tools to help create filler text for everyone from bacon lovers
                      to Charlie Sheen fans.
                    </p>

                    <p>
                      <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                    </p>
                  </div>
                  <!-- /.post -->

                  <!-- Post -->
                  <div class="post clearfix">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="{{asset('img/user7-128x128.jpg')}}" alt="User Image">
                      <span class="username">
                        <a href="#">Article 2</a>
                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                      </span>
                      <span class="description">Sent you a message - 3 days ago</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                      Lorem ipsum represents a long-held tradition for designers,
                      typographers and the like. Some people hate it and argue for
                      its demise, but others ignore the hate as they create awesome
                      tools to help create filler text for everyone from bacon lovers
                      to Charlie Sheen fans.
                    </p>

                    <p>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                    </p>
                  </div>
                  <!-- /.post -->

                  <!-- Post -->
                  <div class="post">
                    <div class="user-block">
                      <img class="img-circle img-bordered-sm" src="{{asset('img/user6-128x128.jpg')}}" alt="User Image">
                      <span class="username">
                        <a href="#">Article 3</a>
                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                      </span>
                      <span class="description">Posted 5 photos - 5 days ago</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="row mb-3">
                      <div class="col-sm-6">
                        <img class="img-fluid" src="{{asset('img/photo1.png"')}} alt="Photo">
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-6">
                        <div class="row">
                          <div class="col-sm-6">
                            <img class="img-fluid mb-3" src="{{asset('img/photo2.png"')}} alt="Photo">
                            <img class="img-fluid" src="{{asset('img/photo3.jpg"')}} alt="Photo">
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-6">
                            <img class="img-fluid mb-3" src="{{asset('img/photo4.jpg"')}} alt="Photo">
                            <img class="img-fluid" src="{{asset('img/photo1.png"')}} alt="Photo">
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <p>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                    </p>
                  </div>
                  <!-- /.post -->
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



@endsection
@section('scripts')

@endsection