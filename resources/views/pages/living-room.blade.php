@extends('layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Mes salons</h3>
                    </div>
                </div>
                <div class="row align-items-center mt-4">
                    <div class="col-md-8">
                        <div class="input-group">
                                    <span class="input-group-text" id="search">
                                        <i class="icon-search"></i>
                                    </span>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Rechercher..."
                                   aria-label="search" aria-describedby="search">
                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-primary btn-icon-text" data-bs-toggle="modal"
                                data-bs-target="#addSalonModal">
                            <i class="ti-plus btn-icon-prepend"></i> Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-0">
            @foreach ($rooms as $room)

                <div class="col-md-3 mt-4">
                    <div class="card">
                        <a href="{{ route('pages.video', ['id' => $room->id]) }}" style="color: gray; text-decoration: none;">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $room->thumbnail) }}" alt="Image" class="card-img-top card-img-custom">
                            <div class="play-icon">
                                <button type="button" class="btn btn-primary btn-rounded btn-icon">
                                    <i class="fas fa-play"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body text-left">
                            <h5 class="card-title"> {{ $room->name }}</h5>
                            <p class="card-text"> {{ $room->description }}</p>
                            <p>
                                <i> {{ $room->formatted_creation_date  }} • {{ $room->video_count}} vidéos • {{ $room->total_duration }} vues</i>
                                <span class="host-icon">{{ strtoupper(substr($room->host_name, 0, 2)) }}</span>
                            </p>
                        </div>

                        <!-- Icône de modification -->
                        <div class="edit-icon" data-bs-toggle="modal" data-bs-target="#updateSalonModal-{{ $room->id }}">
                            <i class="fas fa-edit text-white-50" style="font-size: 14px;"></i>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Add Salon Modal -->
    <div class="modal fade" id="addSalonModal" tabindex="-1" aria-labelledby="addSalonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSalonModalLabel">Ajouter un Salon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('living-room.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Image de fond</label>
                            <input type="file" name="thumbnail" class="file-upload-default d-none" accept="image/*">
                            <div class="input-group col-xs-12 d-flex align-items-center">
                                <input type="text" class="form-control file-upload-info" placeholder="Upload Image" readonly>
                                <span class="input-group-append ms-2">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    <button class="file-upload-clear btn btn-danger ms-2 d-none" type="button">Supprimer</button>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label
                                for="name"
                                class="form-label">Nom du salon
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label
                                for="description"
                                class="form-label">Description
                            </label>
                            <textarea
                                class="form-control"
                                id="description"
                                name="description"
                                rows="3"
                                required>
                            </textarea>
                            @error('description')
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
    @foreach($rooms as $room)
        <div class="modal fade" id="updateSalonModal-{{ $room->id }}" tabindex="-1" aria-labelledby="updateSalonModalLabel-{{ $room->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier le salon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('living-room.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label>Image de fond</label>
                                <input type="file" name="thumbnail" class="file-upload-default d-none" accept="image/*">
                                <div class="input-group col-xs-12 d-flex align-items-center">
                                    <input type="text" class="form-control file-upload-info" value="{{ $room->thumbnail }}" readonly>
                                    <span class="input-group-append ms-2">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    <button class="file-upload-clear btn btn-danger ms-2 d-none" type="button">Supprimer</button>
                                </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="name-{{ $room->id }}" class="form-label">Nom du host</label>
                                <input type="text" class="form-control" id="name-{{ $room->id }}" name="name" value="{{ $room->host_name }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="name-{{ $room->id }}" class="form-label">Nom du salon</label>
                                <input type="text" class="form-control" id="name-{{ $room->id }}" name="name" value="{{ $room->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description-{{ $room->id }}" class="form-label">Description</label>
                                <textarea class="form-control" id="description-{{ $room->id }}" name="description" rows="3" required>{{ $room->description }}</textarea>
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


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fileInput = document.querySelector(".file-upload-default");
            const uploadButton = document.querySelector(".file-upload-browse");
            const fileInfo = document.querySelector(".file-upload-info");
            const clearButton = document.querySelector(".file-upload-clear");

            uploadButton.addEventListener("click", function () {
                fileInput.click();
            });

            fileInput.addEventListener("change", function () {
                if (fileInput.files.length > 0) {

                    fileInfo.value = fileInput.files[0].name;
                    clearButton.classList.remove("d-none");
                    uploadButton.classList.add("d-none");
                } else {
                    fileInfo.value = "";
                    clearButton.classList.add("d-none");
                }
            });

            clearButton.addEventListener("click", function () {
                fileInput.value = "";
                fileInfo.value = "";
                clearButton.classList.add("d-none");
                uploadButton.classList.remove("d-none");
            });
        });
    </script>

    <style>
        .card-img-custom {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .position-relative {
            position: relative;
        }

        .play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 50px;
            border-radius: 50%;
            padding: 10px;
        }

        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            border-radius: 10px;
            overflow: hidden;
        }

        .card:hover {
            transform: scale(1.1); /* Agrandit la carte */
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3); /* Effet d'ombre */
            z-index: 10;
        }

        .card-img-custom {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body i {
            font-size: 12px;
            color: #6c757d;
        }

        .edit-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.6);
            color: white; /* L'icône reste blanche */
            padding: 8px;
            border-radius: 50%;
            font-size: 18px;
            cursor: pointer;
            display: none; /* Caché par défaut */
            transition: background 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .card:hover .edit-icon {
            display: block; /* Afficher au survol */
            transform: scale(1.1); /* Léger zoom */
        }

        .edit-icon:hover {
            background: rgba(0, 0, 0, 0.8);
            color: white; /* S'assurer que l'icône reste blanche même au survol */
        }

        .host-icon {
            position: absolute;
            bottom: 25px;
            right: 10px;
            background-color: rgba(255, 0, 0, 0.67);
            color: white;
            font-weight: bold;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

    </style>
@endsection
