<?php $__env->startSection('title', 'Activities'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Activities</a></li>
                            <li class="breadcrumb-item active">Activities</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Activities List</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="text-center">All Activities List</h4>

                <div class="table-responsive">
                    <table class="table activities_datatable" id="activities_datatable">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Date</th>
                                <th>Employees Name</th>
                                
                                <th>Activity</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(function() {
            $('.activities_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(route('activities')); ?>',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    // { data: 'employeesid', name: 'employeesid' },
                    {
                        data: 'activity',
                        name: 'activity'
                    },
                ]
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Downloads/Laboratory-Management/resources/views/Activities/activities.blade.php ENDPATH**/ ?>