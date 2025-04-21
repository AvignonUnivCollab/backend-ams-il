<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Bienvenu <?php echo e($data['user']->name); ?> (<?php echo e($data['user']->role); ?>)</h3>
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
                                <p class="mb-4">Total utilisateur</p>
                                <p class="fs-30 mb-2"><?php echo e($data['userCount']); ?></p>
                                <p>10.00% (30 jours)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Total salons</p>
                                <p class="fs-30 mb-2"><?php echo e($data['salonCount']); ?></p>
                                <p>22.00% (30 jours)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Total de vidéos</p>
                                <p class="fs-30 mb-2"><?php echo e($data['videoCount']); ?></p>
                                <p>2.00% (30 jours)</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Total commentaires</p>
                                <p class="fs-30 mb-2"><?php echo e($data['messageCount']); ?></p>
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
                                    <th>Catégories</th>
                                    <th>Host</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $data['videos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <img
                                                width="220"
                                                height="90"
                                                src="<?php echo e(asset('storage/' . $video->thumbnail)); ?>"
                                                alt="Image"
                                                style="border-radius: 15px; overflow: hidden; border: none;">

                                        </td>
                                        <td><?php echo e($video->video_name); ?></td>
                                        <td class="font-weight-bold"><?php echo e($video->description); ?></td>
                                        <td><?php echo e($video->category_name); ?></td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-success"><?php echo e($video->username); ?></div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 stretch-card grid-margin">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Commentaries</p>
                        <ul class="icon-data-list">
                            <?php $__currentLoopData = $data['messages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <div class="d-flex">
                                        <div>
                                            <p class="text-info mb-1"><?php echo e($message->username); ?></p>
                                            <p class="mb-0"><?php echo e($message->content); ?></p>
                                            <small><?php echo e($message->created_at); ?></small>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webgrp04/backend-ams-il/resources/views/dashboard.blade.php ENDPATH**/ ?>