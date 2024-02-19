<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>

<link href="node_modules/filepond/dist/filepond.css" rel="stylesheet">
<script src="node_modules/filepond/dist/filepond.js"></script>
<div class="container">
<div class="text-center mt-5">
<h1>Edit Products</h1>
    </div>
</br>
    <form action="<?php echo e(route('products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
       <label for="category_id">category</label>
      <select name="category_id" class="form-control">
      <option value="">Category</option>
      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == $product->category_id ? 'selected' : ''); ?>><?php echo e($category->category_name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo e($product->name); ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="5" required><?php echo e($product->description); ?></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="<?php echo e($product->price); ?>" required>
        </div>
        <div class="form-group">
            <label for="name">quantity</label>
            <input type="text" name="quantity" class="form-control" value="<?php echo e($product->quantity); ?>" required>
        </div>
</br>
        <div class="form-group">
            <label for="file">Upload Image</label>
           <img id="myImg" src="<?php echo e(asset('storage/img/' . $product->file)); ?>" width="240" height="120" style="border-radius: 10px;">
            </br>
            <input type="file" name="file" class="form-control-file"   accept=" .jpg, .jpeg, .png">
            </br>
            <small class="form-text text-muted">Upload a new file only if you want to replace the existing one.</small>
        </div>
</br>
        <div class="form-group">
            <label for="fil">Upload Video</label>
            <video id="previewImage" width="240" height="120" controls>
            <source src="<?php echo e(asset('storage/video/' . $product->fil)); ?>" type="video/mp4">
            </video>
            </br>
            <input type="file" name="fil" class="form-control-file"  accept=".mp4,.webm,.ogg">
            </br>
            <small class="form-text text-muted">Upload a new image only if you want to replace the existing one.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<script>
FilePond.create(document.querySelector('#imageUploader'));
</script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /home/i/Documents/Laravel/mostDonePosE/resources/views/products/edit.blade.php ENDPATH**/ ?>