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
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div id="activity">
                    @include('layout.flux_rss')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection