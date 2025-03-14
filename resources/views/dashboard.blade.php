@extends('layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Bienvenu {{$data['user']->name}}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                    <div class="card-people mt-auto">
                        <img src="assets/images/dashboard/people.svg" alt="people">
                        <div class="weather-info">
                            <div class="d-flex">
                                <div>
                                    <h2 class="mb-0 font-weight-normal"><i class="icon-sun me-2"></i>31<sup>C</sup></h2>
                                </div>
                                <div class="ms-2">
                                    <h4 class="location font-weight-normal">Avignon</h4>
                                    <h6 class="font-weight-normal">France</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total de vidéos</p>
                                <p class="fs-30 mb-2">{{ $data['videoCount'] }}</p>
                                <p>10.00% (30 jours)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total salons</p>
                                <p class="fs-30 mb-2">{{ $data['salonCount'] }}</p>
                                <p>22.00% (30 jours)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">vidéos playslists</p>
                                <p class="fs-30 mb-2">{{ $data['playlistCount'] }}</p>
                                <p>2.00% (30 jours)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Total commentaires</p>
                                <p class="fs-30 mb-2">{{ $data['messageCount'] }}</p>
                                <p>0.22% (30 jours)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Top vidéos</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                <tr>
                                    <th>Vidéo</th>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Source</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <iframe width="220" height="90" src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                                style="border-radius: 15px; overflow: hidden; border: none;"></iframe>
                                    </td>
                                    <td>Search Engine Marketing</td>
                                    <td class="font-weight-bold">$362</td>
                                    <td>21 Sep 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-success">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <iframe width="220" height="90" src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                                style="border-radius: 15px; overflow: hidden; border: none;"></iframe>
                                    </td>
                                    <td>Search Engine Optimization</td>
                                    <td class="font-weight-bold">$116</td>
                                    <td>13 Jun 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-success">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <iframe width="220" height="90" src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                                style="border-radius: 15px; overflow: hidden; border: none;"></iframe>
                                    </td>
                                    <td>Display Advertising</td>
                                    <td class="font-weight-bold">$551</td>
                                    <td>28 Sep 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <iframe width="220" height="90" src="https://www.youtube.com/embed/tgbNymZ7vqY"
                                                style="border-radius: 15px; overflow: hidden; border: none;"></iframe>
                                    </td>
                                    <td>Pay Per Click Advertising</td>
                                    <td class="font-weight-bold">$523</td>
                                    <td>30 Jun 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 stretch-card grid-margin">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Commentaires</p>
                        <ul class="icon-data-list">
                            <li>
                                <div class="d-flex">
                                    <img src="assets/images/faces/face1.jpg" alt="user">
                                    <div>
                                        <p class="text-info mb-1">Isabella Becker</p>
                                        <p class="mb-0">Sales dashboard have been created</p>
                                        <small>9:30 am</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <img src="assets/images/faces/face2.jpg" alt="user">
                                    <div>
                                        <p class="text-info mb-1">Adam Warren</p>
                                        <p class="mb-0">You have done a great job #TW111</p>
                                        <small>10:30 am</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <img src="assets/images/faces/face3.jpg" alt="user">
                                    <div>
                                        <p class="text-info mb-1">Leonard Thornton</p>
                                        <p class="mb-0">Sales dashboard have been created</p>
                                        <small>11:30 am</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <img src="assets/images/faces/face4.jpg" alt="user">
                                    <div>
                                        <p class="text-info mb-1">George Morrison</p>
                                        <p class="mb-0">Sales dashboard have been created</p>
                                        <small>8:50 am</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <img src="assets/images/faces/face5.jpg" alt="user">
                                    <div>
                                        <p class="text-info mb-1">Ryan Cortez</p>
                                        <p class="mb-0">Herbs are fun and easy to grow.</p>
                                        <small>9:00 am</small>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <img src="assets/images/faces/face1.jpg" alt="user">
                                    <div>
                                        <p class="text-info mb-1">Isabella Becker</p>
                                        <p class="mb-0">Sales dashboard have been created</p>
                                        <small>9:30 am</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
