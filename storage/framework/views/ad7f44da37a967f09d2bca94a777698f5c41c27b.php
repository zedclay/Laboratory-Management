<?php $__env->startSection('title', 'Radiology'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Radiology</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Radiology Pending Test</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Today Pending Radiology Test</h1>

                <div class="table-responsive">
                    <table class="table display  pathelogytest_datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient Id</th>
                                <th>Patient Name</th>
                                <th>Invoice Number</th>
                                <th>Test Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;
                            ?>
                            <?php $__currentLoopData = App\Models\TestReport::orderBy('id', 'DESC')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item->test->department == 'Radiology' && $item->status == 'Pending'): ?>
                                    <tr>
                                        <td><?php echo e(++$i); ?></td>
                                        <td><?php echo e($item->patients->patient_id); ?></td>
                                        <td><?php echo e($item->patients->name); ?></td>
                                        <td><?php echo e($item->invoice->bill_no); ?></td>
                                        <td><?php echo e($item->test->cat_name); ?></td>
                                        <td><?php echo e($item->status); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('radiologyedit', $item->id)); ?>"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script>
        $('.pathelogytest_datatable').DataTable({});
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Downloads/Laboratory-Management/resources/views/Radiology/radiology.blade.php ENDPATH**/ ?>