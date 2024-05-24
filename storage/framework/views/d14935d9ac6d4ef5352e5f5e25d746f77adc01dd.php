<?php $__env->startSection('title', 'Attendance'); ?>
<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Attendance</a></li>
                            <li class="breadcrumb-item active">Attendance</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Attendance List</h4>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="text-center">All Attendance List</h4>

                <div class="table-responsive">
                    <table class="table activities_datatable" id="activities_datatable">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Employees Name</th>
                                
                                <th>Enter Date & Time</th>
                                <th>Exit Date & Time</th>
                                
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
                ajax: '<?php echo e(route('Attendance')); ?>',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    // { data: 'employeesid', name: 'employeesid' },
                    {
                        data: 'enters_time',
                        name: 'enters_time'
                    },
                    {
                        data: 'exits_time',
                        name: 'exits_time'
                    },
                    // { data: 'activity', name: 'activity' },
                ]
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Downloads/Laboratory-Management/resources/views/Attendance/attendance.blade.php ENDPATH**/ ?>