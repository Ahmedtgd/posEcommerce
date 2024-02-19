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
        <h1>Orders</h1>
    </div>
             <!-- You -->

 <div class="col-md-6 search-section">
  <div class="form-group">
    <form method="get" action="/searchOrder">
      <div class="input-group">
        <input class="form-control" name="search" placeholder="Search...">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </form>
  </div>
</div>
</br>
<!---end-->
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Delivery Status</th>
                        <th>Vehicle</th>
                        <th>Customer ID</th>
                        <th>User</th>
                        <th>Product</th>
                   <!--     <th>Video</th>  -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($order->id); ?></td>
                            <td><?php echo e($order->deliveryStatus); ?></td>
                            <td><?php echo e($order->vehicle); ?></td>
                            <td><?php echo e($order->customer_id); ?></td>
                          <td>
                          Id:<?php echo e($order->user_id); ?>

                          </br>
                         Name:<?php echo e($order->user->name); ?>

                           </td>
                            <td>
                            <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($product->name); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <!--
                                <td>
                        <video width="240" height="120" controls>
                        <source src="<?php echo e(asset('storage/video/' . $order->fil)); ?>" type="video/mp4">
                         Your browser doesn't support HTML5 video.
                        </video>
                         </td>
                         -->
                            <td>
                                <a href="<?php echo e(route('orders.edit', $order->id)); ?>" class="btn btn-primary btn-sm">Edit</a>
                                <form action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" style="display: inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
</br>
        <div class="container-fluid">
        <div class="row justify-content-end">
            <div class="col-6">
                <!-- Your content goes here -->
            </div>
            <div class="col-6 text-right">
                <div class="pagination-container">
                    <?php echo e($orders->links()); ?>

                </div>
            </div>
        </div>
    </div>
</br>
        <a href="<?php echo e(route('orders.create')); ?>" class="btn btn-success">Create Order</a>
        </br>

    </div>
    </br>

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

<?php /**PATH /home/i/Documents/Laravel/mostDonePos/resources/views/orders/index.blade.php ENDPATH**/ ?>