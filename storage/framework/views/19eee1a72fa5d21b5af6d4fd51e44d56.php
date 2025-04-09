<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Les messages</h3>
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

        <div class="row mt-0">
            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 mt-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-1">
                                <strong><?php echo e($message->sender_name); ?></strong>
                            </h5>
                            <h6 class="text-muted" style="font-size: 0.9rem;">
                                <?php echo e($message->sent_at); ?> - <span class="badge bg-primary"><?php echo e($message->room_name); ?></span>
                            </h6>
                            <p class="card-text mt-2">
                                <?php echo e($message->content); ?>

                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>


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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webgrp04/backend-ams-il/resources/views/pages/message.blade.php ENDPATH**/ ?>