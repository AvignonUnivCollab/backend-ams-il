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
