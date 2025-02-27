<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <a class="navbar-brand brand-logo me-5" href="index.html"><img src="assets/images/logo.svg" class="me-2" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->

        <!-- NAVBAR -->
        @include('menu.menu')
        <!-- NAVBAR -->

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                <h3 class="font-weight-bold">Bienvenu</h3>
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
                                        <p class="fs-30 mb-2">4006</p>
                                        <p>10.00% (30 jours)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-dark-blue">
                                    <div class="card-body">
                                        <p class="mb-4">Total vues</p>
                                        <p class="fs-30 mb-2">61344</p>
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
                                        <p class="fs-30 mb-2">34040</p>
                                        <p>2.00% (30 jours)</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 stretch-card transparent">
                                <div class="card card-light-danger">
                                    <div class="card-body">
                                        <p class="mb-4">Total commentaires</p>
                                        <p class="fs-30 mb-2">47033</p>
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
                                            <td><iframe width="220" height="90" src="https://www.youtube.com/embed/tgbNymZ7vqY" style="border-radius: 15px; overflow: hidden; border: none;"></iframe></td>
                                            <td>Search Engine Marketing</td>
                                            <td class="font-weight-bold">$362</td>
                                            <td>21 Sep 2018</td>
                                            <td class="font-weight-medium">
                                                <div class="badge badge-success">Completed</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><iframe width="220" height="90" src="https://www.youtube.com/embed/tgbNymZ7vqY" style="border-radius: 15px; overflow: hidden; border: none;"></iframe></td>
                                            <td>Search Engine Optimization</td>
                                            <td class="font-weight-bold">$116</td>
                                            <td>13 Jun 2018</td>
                                            <td class="font-weight-medium">
                                                <div class="badge badge-success">Completed</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><iframe width="220" height="90" src="https://www.youtube.com/embed/tgbNymZ7vqY" style="border-radius: 15px; overflow: hidden; border: none;"></iframe></td>
                                            <td>Display Advertising</td>
                                            <td class="font-weight-bold">$551</td>
                                            <td>28 Sep 2018</td>
                                            <td class="font-weight-medium">
                                                <div class="badge badge-warning">Pending</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><iframe width="220" height="90" src="https://www.youtube.com/embed/tgbNymZ7vqY" style="border-radius: 15px; overflow: hidden; border: none;"></iframe></td>
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
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">&copy; {{ date('Y') }}. Tous droits réservé à Moi</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Fais par Lionel NKEOUA <i class="ti-heart text-danger ms-1"></i></span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="dashboard/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="dashboard/assets/vendors/chart.js/chart.umd.js"></script>
<script src="dashboard/assets/vendors/datatables.net/jquery.dataTables.js"></script>
<!-- <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script> -->
<script src="dashboard/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
<script src="dashboard/assets/js/dataTables.select.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="dashboard/assets/js/off-canvas.js"></script>
<script src="dashboard/assets/js/template.js"></script>
<script src="dashboard/assets/js/settings.js"></script>
<script src="dashboard/assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="dashboard/assets/js/jquery.cookie.js" type="text/javascript"></script>
<script src="dashboard/assets/js/dashboard.js"></script>
<!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
<!-- End custom js for this page-->
</body>
</html>
