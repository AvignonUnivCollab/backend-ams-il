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
                        <button type="button" class="btn btn-outline-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#addUserModal">
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
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Membre depuis</th>
                                <th>dernière connection</th>
                                <th>Visionnage/Mois passé</th>
                                <th>Modifier</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)

                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->days_since_creation }} jour(s)</td>
                                        <td>{{$user->days_last_connection }} jour(s)</td>
                                        <td class="text-danger"> 28.76% <i class="ti-arrow-down"></i></td>
                                        <td>
                                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#updateUserModal-{{ $user->id }}">
                                                Modifier
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModal">Ajouter un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="pt-3" action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label
                                for="name"
                                class="form-label">Nom</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                placeholder="Name" required value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label
                                for="username"
                                class="form-label">Username</label>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control form-control-lg @error('username') is-invalid @enderror"
                                placeholder="Username" required value="{{ old('username') }}">
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label
                                for="email"
                                class="form-label">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control form-control-lg @error('email') is-invalid @enderror"
                                placeholder="Email" required value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label
                                for="password"
                                class="form-label">Password</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                placeholder="Password" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-3 d-grid gap-2">
                            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                S'enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Update User Modal -->
    @foreach($users as $user)
        <div class="modal fade" id="updateUserModal-{{ $user->id }}" tabindex="-1" aria-labelledby="updateUserModalLabel-{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier l'utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="name-{{ $user->id }}" class="form-label">Nom</label>
                                <input type="text" id="name-{{ $user->id }}" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="username-{{ $user->id }}" class="form-label">Username</label>
                                <input type="text" id="username-{{ $user->id }}" name="username" class="form-control" value="{{ $user->username }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="email-{{ $user->id }}" class="form-label">Email</label>
                                <input type="email" id="email-{{ $user->id }}" name="email" class="form-control" value="{{ $user->email }}" required>
                            </div>

                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

<script>
    function populateModal(user) {
        document.getElementById('updateUserModal').querySelector('#user_id').value = user.id;
        document.getElementById('updateUserModal').querySelector('#update_username').value = user.username;
        document.getElementById('updateUserModal').querySelector('#update_email').value = user.email;
    }

</script>

