@extends('layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Mes videos</h3>
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
	    @if ($errors->any())
    		<div class="alert alert-danger">
        	   <ul>
            		@foreach ($errors->all() as $error)
                	  <li>{{ $error }}</li>
            		@endforeach
        	   </ul>
    		</div>
	    @endif


            @if ($videos->isEmpty())
                <tr>
                    <td colspan="3" class="text-center text-muted fw-bold fs-5">Aucune vidéos disponible.</td>
                </tr>
            @else
                @foreach ($videos as $video)

                    <div class="col-md-3 mt-4">
                        <div class="card">
                            <div class="position-relative">
                                <video width="320" height="240" autoplay muted>
                                    <source
                                        width="280"
                                        height="150"
                                        src="{{ asset('storage/' . $video->url) }}"
                                        style="border-radius: 15px; overflow: hidden; border: none;"
                                        type="video/mp4">
                                    Votre navigateur ne supporte pas ce format de video
                                </video>
                                <div class="play-icon">
                                    <button type="button" class="btn btn-primary btn-rounded btn-icon">
                                        <i class="fas fa-play"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body text-left">
                                <h5 class="card-title"> {{ $video->title }} </h5>
                                <p class="card-text"> {{ $video->description }}</p>
                            </div>

                            <!-- Icône de modification -->
                            <div class="edit-icon" data-bs-toggle="modal"
                                 data-bs-target="#updateSalonModal-{{ $video->id }}">
                                <i class="fas fa-edit text-white-50" style="font-size: 14px;"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>


    <!-- Add video Modal -->
    <div class="modal fade" id="addSalonModal" tabindex="-1" aria-labelledby="addSalonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSalonModalLabel">Ajouter un Salon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @php $roomId = request()->query('id') @endphp
                        <!-- Champ caché pour l'ID de la salle -->
                        <input type="hidden" name="room_id" value="{{ $roomId }}">

                        <div class="form-group mb-3">
                            <label>Image de fond</label>
                            <input type="file" name="thumbnail" class="file-upload-default d-none" accept="image/*">
                            <div class="input-group col-xs-12 d-flex align-items-center">
                                <input type="text" class="form-control file-upload-info"
                                       placeholder="Aucune image sélectionnée" readonly>
                                <span class="input-group-append ms-2">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    <button class="file-upload-clear btn btn-danger ms-2 d-none" type="button">Supprimer</button>
                                </span>
                            </div>
                            <div class="mt-2">
                                <img id="thumbnail-preview" src="#" alt="Aperçu" class="d-none"
                                     style="max-width: 200px; height: 150px;">
                            </div>
                        </div>


                        @csrf
                        <div class="form-group mb-3">
                            <label>Vidéo</label>
                            <input type="file" name="url" class="file-upload-default d-none" accept="video/*">
                            <div class="input-group col-xs-12 d-flex align-items-center">
                                <input type="text" class="form-control file-upload-info" placeholder="Aucune vidéo sélectionnée" readonly>
                                <span class="input-group-append ms-2">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    <button class="file-upload-clear btn btn-danger ms-2 d-none" type="button">Supprimer</button>
                                </span>
                            </div>
                            <div class="mt-2">
                                <video id="video-preview" class="d-none" controls style="max-width: 200px; height: auto;">
                                    <source id="video-source" src="#" type="video/mp4">
                                    Votre navigateur ne supporte pas la lecture de vidéos.
                                </video>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label
                                for="title"
                                class="form-label">Titre de la vidéo
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="title"
                                name="title" required>
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Catégorie</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Sélectionnez une catégorie</option>
                                @if(isset($categories) && $categories->count() > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled>Aucune catégorie disponible</option>
                                @endif
                            </select>
                            @error('category_id')
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

                        <div class="mb-3">
                            <label
                                for="duration"
                                class="form-label">Durée (en minutes)
                            </label>
                            <input
                                type="number"
                                class="form-control"
                                id="duration"
                                name="duration" required>
                            @error('duration')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4 d-grid gap-2">
                            <button type="submit"
                                    class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                S'enregistrer
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".file-upload-browse").forEach(function (button) {
                button.addEventListener("click", function () {
                    let fileInput = this.closest(".form-group").querySelector(".file-upload-default");
                    if (fileInput) {
                        fileInput.click();
                    }
                });
            });

            document.querySelectorAll(".file-upload-default").forEach(function (input) {
                input.addEventListener("change", function () {
                    let file = this.files.length > 0 ? this.files[0] : null;
                    let textInput = this.closest(".form-group").querySelector(".file-upload-info");
                    let clearButton = this.closest(".form-group").querySelector(".file-upload-clear");

                    if (file) {
                        textInput.value = file.name;
                        clearButton.classList.remove("d-none");

                        // Gestion de l'aperçu de l'image
                        if (this.name === "thumbnail") {
                            let imgPreview = document.getElementById("thumbnail-preview");
                            let reader = new FileReader();
                            reader.onload = function (e) {
                                imgPreview.src = e.target.result;
                                imgPreview.classList.remove("d-none");
                            };
                            reader.readAsDataURL(file);
                        }

                        // Gestion de l'aperçu de la vidéo
                        if (this.name === "url") {
                            let videoPreview = document.getElementById("video-preview");
                            let videoSource = document.getElementById("video-source");
                            let reader = new FileReader();
                            reader.onload = function (e) {
                                videoSource.src = e.target.result;
                                videoPreview.load();
                                videoPreview.classList.remove("d-none");
                            };
                            reader.readAsDataURL(file);
                        }
                    } else {
                        textInput.value = "Aucun fichier sélectionné";
                        clearButton.classList.add("d-none");
                    }
                });
            });

            document.querySelectorAll(".file-upload-clear").forEach(function (button) {
                button.addEventListener("click", function () {
                    let fileInput = this.closest(".form-group").querySelector(".file-upload-default");
                    let textInput = this.closest(".form-group").querySelector(".file-upload-info");
                    let imgPreview = document.getElementById("thumbnail-preview");
                    let videoPreview = document.getElementById("video-preview");
                    let videoSource = document.getElementById("video-source");

                    fileInput.value = "";
                    textInput.value = "Aucun fichier sélectionné";
                    this.classList.add("d-none");

                    if (fileInput.name === "thumbnail" && imgPreview) {
                        imgPreview.src = "#";
                        imgPreview.classList.add("d-none");
                    }

                    if (fileInput.name === "url" && videoPreview) {
                        videoSource.src = "#";
                        videoPreview.classList.add("d-none");
                    }
                });
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
