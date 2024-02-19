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

    <div class="container">
    <div class="text-center mt-5">
        <h1>Edit Orders</h1>
    </div>
        <form action="<?php echo e(route('orders.update', $order->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="deliveryStatus">Delivery Status:</label>
                <input type="text" id="deliveryStatus" name="deliveryStatus" class="form-control" required value="<?php echo e($order->deliveryStatus); ?>">
            </div>

            <div class="form-group">
                <label for="vehicle">Vehicle:</label>
                <input type="text" id="vehicle" name="vehicle" class="form-control" required value="<?php echo e($order->vehicle); ?>">
            </div>

            <div class="form-group">
                <label for="customer_id">Customer ID:</label>
                <input type="number" id="customer_id" name="customer_id" class="form-control" required value="<?php echo e($order->customer_id); ?>">
            </div>
            <div class="form-group">
                <label for="user_id">User ID:</label>
                <input type="number" id="user_id" name="user_id" class="form-control" required value="<?php echo e($order->user_id); ?>">
            </div>

            <div class="form-group">
                <label>Products:</label>
                <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <select name="product_ids[]" class="form-control">
                        <option value="">--- No Value ----</option>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($productOption->id); ?>" <?php echo e($productOption->id === $product->id ? 'selected' : ''); ?>>
                                <?php echo e($productOption->name); ?> &nbsp; <?php echo e($productOption->quantity); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <br>
                    <input type="number" name="product_quantities[]" class="form-control"
                           value="<?php echo e($product->pivot->quantity); ?>" placeholder="Enter Quantity">
                    <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div id="productFields" class="form-group">
                <!-- New fields will be added here dynamically -->
            </div>
</br>
            <button type="button" id="addProductButton" class="btn btn-secondary">Add product</button>

            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productFields = document.getElementById('productFields');
            const addProductButton = document.getElementById('addProductButton');
            let productCounter = 0; // Start from 0 to correctly sync with loop

            addProductButton.addEventListener('click', function() {
                const newProductField = `

                    <div class="form-group">
                        <label>Product ${productCounter + 1}</label>
                        <select name="product_ids[]" class="form-control">
                            <option value="">--- No Value ----</option>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?> &nbsp; <?php echo e($product->quantity); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <br>
                        <input type="number" name="product_quantities[]" class="form-control" placeholder="Enter Quantity">
                    </br>
        <div class="form-group">
            <label for="file">Upload Image</label>
            <input type="file" name="file" class="form-control-file"   accept=" .jpg, .jpeg, .png">
            <small class="form-text text-muted">Upload a new file only if you want to replace the existing one.</small>
        </div>
</br>



                    </div>
                `;

                productFields.insertAdjacentHTML('beforeend', newProductField);
                productCounter++;
            });
        });
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
<?php /**PATH /home/i/Documents/Laravel/mostDonePos/resources/views/orders/edit.blade.php ENDPATH**/ ?>