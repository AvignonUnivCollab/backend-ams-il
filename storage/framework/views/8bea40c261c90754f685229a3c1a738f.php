<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ajouter une category</h4>
                        <form action="<?php echo e(route('category.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Titre</span>
                                </div>
                                <input type="text" name="name" class="form-control form-control-sm" placeholder="Nom de la catégorie" required>
                            </div>
                            <div class="template-demo mt-4">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Mes categories</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Modifier</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php if($categories->isEmpty()): ?>
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Aucune catégorie disponible.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($category->name); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#updateCategoryModal-<?php echo e($category->id); ?>">
                                                    Modifier
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Update Category Modal -->
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" id="updateCategoryModal-<?php echo e($category->id); ?>" tabindex="-1" aria-labelledby="updateCategoryModalLabel-<?php echo e($category->id); ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier l'utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo e(route('category.update', $category->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-4">
                                <label for="name-<?php echo e($category->id); ?>" class="form-label">Nom</label>
                                <input type="text" id="name-<?php echo e($category->id); ?>" name="name" class="form-control" value="<?php echo e($category->name); ?>" required>
                            </div>

                            <div class="mt-3 d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg" >Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/webgrp04/backend-ams-il/resources/views/pages/category.blade.php ENDPATH**/ ?>