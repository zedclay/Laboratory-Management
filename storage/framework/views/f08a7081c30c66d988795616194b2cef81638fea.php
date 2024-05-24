<?php $__env->startSection('title', 'Report Collection'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Report Collect</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Pending Report List</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card">
            <div class="card-body">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Invoice Number</th>
                            <th>Test Name</th>
                            <th>Report Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $testreport; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($item->patients->patient_id); ?></td>
                                <td><?php echo e($item->patients->name); ?></td>
                                <td><?php echo e($item->invoice->bill_no); ?></td>
                                <td><?php echo e($item->test->cat_name); ?></td>
                                <td>
                                    <input type="checkbox" class="status" id="status" data-toggle="toggle"
                                        data-on="Collected" data-off="Ready For Collect" data-onstyle="success"
                                        data-offstyle="danger" data-id="<?php echo e($item->id); ?>"
                                        <?php echo e($item->status == 'Collected' ? 'checked' : ''); ?>>
                                </td>
                                </td>
                                <td>
                                    <a href="<?php echo e(url('/report/details', $item->id)); ?>" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
        var table = $('.datatable').DataTable();

        $(document).on('change', '#status', function() {
            var id = $(this).attr('data-id');
            if (this.checked) {
                var catstatus = 'Collected';
            } else {
                var catstatus = 'Ready For Collect';
            }
            $.ajax({
                dataType: "json",
                url: '/reportbooth/status/' + id + '/' + catstatus,
                method: 'get',
                success: function(result1) {
                    // console.log(result1);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: catstatus,
                        text: "The user's status has been updated",
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 1800
                    });
                },
                error: function(error) {
                    // alert(catstatus);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'We have some error',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 1800
                    });
                }
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Downloads/Laboratory-Management/resources/views/XrayReport/reportbooth.blade.php ENDPATH**/ ?>