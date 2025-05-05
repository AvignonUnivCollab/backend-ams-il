@extends('layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Mes playlists</h3>
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
            </div>
        </div>
    </div>

    <!-- Cartes -->
    <div class="row mt-0">
        @foreach ($playlistVideos as $playlistVideo)
            <div class="col-md-3 mt-4">
                <div class="card clickable-card" 
                     data-bs-toggle="modal" 
                     data-bs-target="#playlistModal-{{ $playlistVideo['room_id'] }}"
                     style="cursor: pointer;">
                    <div class="position-relative">
                        <img 
                            src="{{ asset('storage/' . $playlistVideo['room_thumbnail']) }}" 
                            alt="Image"
                            class="card-img-top card-img-custom"
                        >
                    </div>
                    <div class="card-body text-left">
                        <h5 class="card-title"> {{ $playlistVideo['room_name'] }}</h5>
                            <p> {{ $playlistVideo['video_count']}} vidéos </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modals dynamiques pour chaque playlist -->
@foreach ($playlistVideos as $playlistVideo)

<div class="modal fade" id="playlistModal-{{ $playlistVideo['room_id'] }}" tabindex="-1"
     aria-labelledby="playlistModalLabel-{{ $playlistVideo['room_id'] }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="playlistModalLabel-{{ $playlistVideo['room_id'] }}">
                  
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Première colonne: Room Info -->
                    <div class="col-md-6">
                        <h3>Informations sur la Room</h3>
                        <p><strong>Nom de la room :</strong> {{ $playlistVideo['room_name'] }}</p>
                        <img width="90%" height="480" src="{{ asset('storage/' . $playlistVideo['room_thumbnail']) }}" class="img-fluid rounded mb-3" alt="Room Thumbnail"/>
                        <p><strong>Description :</strong> {{ $playlistVideo['room_description'] }}</p>
                    </div>

                    <!-- Deuxième colonne: Liste des vidéos -->
                    <div class="col-md-6">
                        <h5>Liste des vidéos</h5>
                            @foreach ($playlistVideo['videos'] as $video)
                                @php
                                    $videoId = null;
                                    if (filter_var($video['video_url'], FILTER_VALIDATE_URL)) {
                                        parse_str(parse_url($video['video_url'], PHP_URL_QUERY), $query);
                                        $videoId = $query['v'] ?? null;
                                    }
                                @endphp
                                <iframe width="25%" height="110"
                                        src="https://www.youtube.com/embed/{{ $videoId }}"
                                        frameborder="0"
                                        allowfullscreen>
                                </iframe>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

<!-- Styles -->
<style>
    .card-img-custom {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border-radius: 10px;
        overflow: hidden;
    }

    .card:hover {
        transform: scale(1.1);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
        z-index: 10;
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
        color: white;
        padding: 8px;
        border-radius: 50%;
        font-size: 18px;
        cursor: pointer;
        display: none;
        transition: background 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    .card:hover .edit-icon {
        display: block;
        transform: scale(1.1);
    }

    .edit-icon:hover {
        background: rgba(0, 0, 0, 0.8);
    }

    .modal-body {
        padding: 20px;
    }

    .modal-header {
        background-color: #f7f7f7;
        border-bottom: 1px solid #ddd;
    }

    .modal-content {
        border-radius: 8px;
    }

    .card-img-custom {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .col-md-6 {
        padding: 10px;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }
</style>
@endsection
