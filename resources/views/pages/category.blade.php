@extends('layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ajouter une category</h4>
                        <form action="{{ route('category.store') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Titre</span>
                                </div>
                                <input type="text" name="name" class="form-control form-control-sm" placeholder="Nom de la catégorie" required>
                            </div>
                            <div class="template-demo mt-4">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
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
                                    <th>Nom</th>
                                    <th>Modifier</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if ($categories->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Aucune catégorie disponible.</td>
                                    </tr>
                                @else
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#updateCategoryModal-{{ $category->id }}">
                                                    Modifier
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Update Category Modal -->
    @foreach($categories as $category)
        <div class="modal fade" id="updateCategoryModal-{{ $category->id }}" tabindex="-1" aria-labelledby="updateCategoryModalLabel-{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier l'utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('category.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name-{{ $category->id }}" class="form-label">Nom</label>
                                <input type="text" id="name-{{ $category->id }}" name="name" class="form-control" value="{{ $category->name }}" required>
                            </div>

                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg" >Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
