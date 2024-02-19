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
            <h1>Create Orders</h1>
        </div>
        <form action="<?php echo e(route('orders.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="deliveryStatus">Delivery Status:</label>
                <input type="text" id="deliveryStatus" name="deliveryStatus" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="vehicle">Vehicle:</label>
                <input type="text" id="vehicle" name="vehicle" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="customer_id">Customer ID:</label>
                <input type="number" id="customer_id" name="customer_id" class="form-control" required>
            </div>
            <br><br>
            <!-- Products Dropdown -->
            <div class="form-group container">
                <label for="category">1 - Category:</label>
                <select id="category" name="category_id" class="form-control">
                    <option value="">--- Select a Category ---</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>


                 <!-- Products Dropdown -->

                <label>1 - Products:</label>
                <select id="product" name="product_ids[]" class="form-control">
                    <option value="">--- No Value ----</option>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($product->id); ?>" data-category="<?php echo e($product->category_id); ?>"><?php echo e($product->name); ?> &nbsp; <?php echo e($product->quantity); ?>


                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <br>
                <input type="number" name="product_quantities[]" class="form-control" placeholder="Enter Quantity">
            </div>
            <div class="container">
                <div id="categoryFields" class="form-group">
                    <!-- New category fields will be added here dynamically -->
                </div>
                <div id="productFields" class="form-group">
                    <!-- New fields will be added here dynamically -->
                </div>
            </div>
            <button type="button" id="addProductButton" class="btn btn-secondary">Add product</button>

            <button type="submit" class="btn btn-primary">Create Order</button>
        </form>
    </div>

   <script>
    document.addEventListener('DOMContentLoaded', function() {
        const productFields = document.getElementById('productFields');
        const categoryFields = document.getElementById('categoryFields');
        const addProductButton = document.getElementById('addProductButton');
        let productCounter = 1;

        function filterProducts(categoryDropdown, productDropdown) {
            const selectedCategoryId = categoryDropdown.value;

            // Filter products based on the selected category
            Array.from(productDropdown.options).forEach(function(option) {
                if (selectedCategoryId === '' || option.getAttribute('data-category') === selectedCategoryId) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        }

        // Add an event listener to the category dropdown for the initial fields
        const initialCategoryDropdown = document.getElementById('category');
        const initialProductDropdown = document.getElementById('product');

        initialCategoryDropdown.addEventListener('change', function() {
            filterProducts(initialCategoryDropdown, initialProductDropdown);
        });

        // Event delegation for dynamically generated fields
        categoryFields.addEventListener('change', function(event) {
            const target = event.target;
            if (target.tagName === 'SELECT' && target.name === 'category_ids[]') {
                // Find the corresponding product dropdown
                const productDropdown = document.getElementById(`newProduct${target.dataset.counter}`);
                filterProducts(target, productDropdown);
            }
        });

        addProductButton.addEventListener('click', function() {
            const newCategoryField = `
            <br><br>
            <div class="form-group container">
                <label>${productCounter + 1} - Category</label>
                <select id="newCategory${productCounter}" name="category_ids[]" class="form-control" data-counter="${productCounter}">
                    <option value="">--- No Value ----</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

                <label>${productCounter + 1} - Product</label>
                <select id="newProduct${productCounter}" name="product_ids[]" class="form-control">
                    <option value="">--- No Value ----</option>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($product->id); ?>" data-category="<?php echo e($product->category_id); ?>"><?php echo e($product->name); ?> &nbsp; <?php echo e($product->quantity); ?>

                         <img class=" hover:shadow-lg" src=  "<?php echo e(asset('storage/img/' . $product->file)); ?>" width="240" height="120" style="border-radius: 10px;" class="card-img-top"   >
                         </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </br>
                <input type="number" name="product_quantities[]" class="form-control" placeholder="Enter Quantity">
                </br>
                 <div class="form-group">
            <label for="fil">video Image</label>
            <input type="file" name="fil" class="form-control-file"  accept=".mp4,.webm,.ogg">
        </div>
            </div>
        `;

            categoryFields.insertAdjacentHTML('beforeend', newCategoryField);
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
<?php /**PATH /home/i/Documents/Laravel/mostDonePos/resources/views/orders/create.blade.php ENDPATH**/ ?>