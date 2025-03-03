@extends('layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Mes utilisateurs</h3>
                    </div>
                </div>
                <div class="row align-items-center mt-4">
                    <div class="col-md-8">
                        <div class="input-group">
                                    <span class="input-group-text" id="search">
                                        <i class="icon-search"></i>
                                    </span>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Rechercher..." aria-label="search" aria-describedby="search">
                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-primary btn-icon-text">
                            <i class="ti-plus btn-icon-prepend"></i> Ajouter
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Mes utilisateurs recement connecter</h4>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Visionnage/Mois passé</th>
                                <th>Modifier</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Jacob</td>
                                <td>Photoshop</td>
                                <td>nleou@gmail.com</td>
                                <td>il y'a 1 jour</td>
                                <td class="text-danger"> 28.76% <i class="ti-arrow-down"></i></td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-sm">
                                        Modifier
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>Messsy</td>
                                <td>Flash</td>
                                <td>yyyyre@gmail.com</td>
                                <td>il y'a 2 semaines</td>
                                <td class="text-danger"> 21.06% <i class="ti-arrow-down"></i></td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-sm">
                                        Modifier
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>John</td>
                                <td>Premier</td>
                                <td>nleou@gmail.com</td>
                                <td>il y'a 1 mois</td>
                                <td class="text-danger"> 35.00% <i class="ti-arrow-down"></i></td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-sm">
                                        Modifier
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Peter</td>
                                <td>After effects</td>
                                <td>nleou@gmail.com</td>
                                <td>il y'a 1 mois</td>
                                <td class="text-success"> 82.00% <i class="ti-arrow-up"></i></td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary btn-sm">
                                        Modifier
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Dave</td>
                                <td>53275535</td>
                                <td>nleou@gmail.com</td>
                                <td>il y'a 1 mois</td>
                                <td class="text-success"> 98.05% <i class="ti-arrow-up"></i></td>
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
@endsection
