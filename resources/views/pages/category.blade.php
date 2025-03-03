@extends('layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ajouter une category</h4>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Titre</span>
                                </div>
                                <input type="text" class="form-control form-control-sm" placeholder="nom de la categorie" aria-label="Username">
                            </div>
                            <div class="template-demo mt-4">
                                <button type="button" class="btn btn-primary">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Mes categories</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Modifier</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Technologies</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary btn-sm">
                                            Modifier
                                        </button>
                                    </td>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
