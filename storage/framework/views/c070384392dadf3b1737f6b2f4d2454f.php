<?php $__env->startSection('title', trns('Edit Admin')); ?>

<?php $__env->startSection('content'); ?>
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="<?php echo e(route($route . '.index')); ?>"><?php echo e(trns('Users')); ?></a> /
        </span> <?php echo e(trns('Edit Admin')); ?>

    </h4>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route($route . '.update', $obj->id)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="row m-3">

                    <div class="col-5">
                        <label class="form-label" for="title"><?php echo e(trns('title')); ?></label>
                        <input value="<?php echo e($obj->title); ?>" type="text" class="form-control" id="title" name="title" value="<?php echo e(old('title')); ?>"
                            required>
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="url"><?php echo e(trns('url')); ?></label>
                        <input value="<?php echo e($obj->url); ?>" type="text" class="form-control" id="url" name="url" value="<?php echo e(old('url')); ?>"
                            >
                    </div>

                     <div class="col-5">
                        <label class="form-label" for="category"><?php echo e(trns('category')); ?></label>
                        <input value="<?php echo e($obj->category); ?>" type="text" class="form-control" id="category" name="category" value="<?php echo e(old('category')); ?>"
                            required>
                    </div>

                     <div class="col-5">
                        <label class="form-label" for="sort_order"><?php echo e(trns('sort_order')); ?></label>
                        <input value="<?php echo e($obj->sort_order); ?>" type="number" class="form-control" id="sort_order" name="sort_order" value="<?php echo e(old('sort_order')); ?>"
                            >
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="description"><?php echo e(trns('description')); ?></label>
                        <textarea type="text" class="form-control" id="description" name="description"
                            required><?php echo e(old('description', $obj->description)); ?></textarea>
                    </div>

                     <div class="col-5">
                        <label class="form-label" for="partner_id"><?php echo e(trns('partner')); ?></label>
                        <select class="form-control" id="partner_id" name="partner_id">
                            <option value=""><?php echo e(trns('select_partner')); ?></option>
                            <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($partner->id); ?>"
                                    <?php echo e((old('partner_id') ?? $obj->partner_id) == $partner->id ? 'selected' : ''); ?>>
                                    <?php echo e($partner->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="collaboration"><?php echo e(trns('collaboration')); ?></label>
                        <select class="form-control" id="collaborator_ids" name="collaborator_ids[]" multiple>
                            <?php $__currentLoopData = $collaborations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>"
                                    <?php echo e((collect(old('collaborator_ids'))->contains($item->id)) || $obj->collaborators->contains($item->id) ? 'selected' : ''); ?>>
                                    <?php echo e($item->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="image"><?php echo e(trns('image')); ?></label>
                        <input  value="<?php echo e($obj->image); ?>" class="form-control" type="file" id="image" name="image">
                    </div>


                </div>

                <button type="submit" class="btn btn-primary"><?php echo e(trns('update')); ?></button>
                <a href="<?php echo e(route($route . '.index')); ?>" class="btn btn-secondary"><?php echo e(trns('cancel')); ?></a>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/contentNavbarLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/kariem/Documents/projects/dash_1/resources/views/content/project/partials/edit.blade.php ENDPATH**/ ?>