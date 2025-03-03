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
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Rechercher..." aria-label="search" aria-describedby="search">
                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#addSalonModal">
                            <i class="ti-plus btn-icon-prepend"></i> Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            @foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] as $film)
                @php
                    $nbVideos = rand(5, 20);
                    $nbVues = rand(100, 1000);
                @endphp
                <div class="col-md-3 mt-4">
                    <div class="card">
                        <div class="position-relative">
                            <img src="https://picsum.photos/200/300?random={{$film}}" class="card-img-top card-img-custom" alt="Film {{ $film }}">
                            <div class="play-icon">
                                <i class="bi bi-play-circle-fill"></i>
                            </div>
                        </div>
                        <div class="card-body text-left">
                            <h5 class="card-title">Salon {{ $film }}</h5>
                            <p class="card-text">Description rapide du film.</p>
                            <p>
                                <i>il y'a {{ $film * 5 }} minutes • {{ $nbVideos }} vidéos • {{ $nbVues }} vues</i>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addSalonModal" tabindex="-1" aria-labelledby="addSalonModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSalonModalLabel">Ajouter un Salon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        @csrf
                        <div class="mb-3">
                            <label for="nomSalon" class="form-label">Nom du salon</label>
                            <input type="text" class="form-control" id="nomSalon" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="descriptionSalon" class="form-label">Description</label>
                            <textarea class="form-control" id="descriptionSalon" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="nbVideos" class="form-label">Nombre de vidéos</label>
                            <input type="number" class="form-control" id="nbVideos" name="nb_videos" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
            color: rgba(255, 255, 255, 0.8);
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 10px;
        }

        .play-icon:hover {
            color: rgba(255, 255, 255, 1);
            background: rgba(0, 0, 0, 0.7);
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
    </style>
@endsection
