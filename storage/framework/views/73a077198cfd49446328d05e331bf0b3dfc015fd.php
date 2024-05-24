<?php $__env->startSection('title', 'Lab Test Category'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Patient List</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Patient Report Genarate</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card">
            <div class="card-body">
                <h4 class="text-center mt-3 mb-3"><u>Filter</u></h4>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Gender</label>
                            <div class="col-sm-8">
                                <div id="gender"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">Referral By</label>
                            <div class="col-sm-8">
                                <div id="referr"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">From</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="min" name="min"
                                    placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-4 col-form-label text-dark">To</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="max" name="max"
                                    placeholder="mm/dd/yyyy">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="col-sm-12">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label text-dark">Export Data</label>
                        <div class="col-sm-10">
                            <div id='exp_buttons'></div>
                        </div>
                    </div>

                </div>
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table nowrap ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient ID</th>
                                <th>Name</th>
                                
                                <th>Phone</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Blood Group</th>
                                <th>Referral By</th>
                                <th>Create At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo e($item->patient_id); ?></td>
                                    <td><?php echo e($item->name); ?></td>
                                    <td><?php echo e($item->mobile_phone); ?></td>
                                    <td><?php echo e($item->age); ?></td>
                                    <td><?php echo e($item->gender); ?></td>
                                    <td><?php echo e($item->blood_group); ?></td>
                                    <td>
                                        <?php if($item->referred_by == 'none'): ?>
                                            None
                                        <?php else: ?>
                                            <?php echo e($item->referral->name); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($item->created_at->format('Y-m-d')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var minDate, maxDate;
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = minDate.val();
                    var max = maxDate.val();
                    var date = new Date(data[9]);
                    if (
                        (min === null && max === null) || (min === null && max >= date) || (min <= date &&
                            max === null) || (min <= date && max >= date)
                    ) {
                        return true;
                    }
                    return false;
                }
            );
            minDate = new DateTime($('#min'), {
                format: 'YYYY-MM-DD'
            });
            maxDate = new DateTime($('#max'), {
                format: 'YYYY-MM-DD'
            });
            var table = $('#datatable-buttons').DataTable({
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    //debugger;
                    var index = iDisplayIndexFull + 1;
                    $("td:first", nRow).html(index);
                    return nRow;
                },
                buttons: [
                    // {
                    // extend: 'copy',
                    // text: '<i class="fa fa-files-o"></i> <u>C</u>opy',
                    // className: 'btn btn-sm ',
                    // key: {
                    //     key: 'c',
                    //     altKey: true
                    //     },
                    //     exportOptions: {
                    //     columns: [':not(.hidden-print)'],
                    //     orthogonal: 'export'
                    //     },
                    // },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv"></i> C<u>S</u>V',
                        className: 'btn btn-sm ',
                        key: {
                            key: 's',
                            altKey: true
                        },
                        exportOptions: {
                            // columns: [':not(.hidden-print)'],
                            orthogonal: 'export'
                        },
                    }, {
                        extend: 'excelHtml5',
                        text: '<i class="far fa-file-excel"></i> <u>E</u>xcel',
                        className: 'btn btn-sm ',
                        key: {
                            key: 'e',
                            altKey: true
                        },
                        exportOptions: {
                            columns: [':not(.hidden-print)'],
                            orthogonal: 'export'
                        },
                    }, {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> <u>P</u>rint',
                        className: 'btn btn-sm ',
                        key: {
                            key: 'p',
                            altKey: true
                        },
                        exportOptions: {
                            columns: [':not(.hidden-print)'],
                            orthogonal: 'export'
                        },
                    }

                ],
                initComplete: function() {

                        // Gender dropdown filter
                        var column_gender = this.api().column(6);
                        var select_gender = $(
                                '<select class="form-control"><option value="">All</option></select>')
                            .appendTo($('#gender').empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column_gender.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column_gender.data().unique().sort().each(function(d, j) {
                            select_gender.append('<option value="' + d + '">' + d + '</option>');
                        });

                        // Referr dropdown filter
                        var column = this.api().column(8);
                        var select = $(
                                '<select class="form-control"><option value="">All</option></select>')
                            .appendTo($('#referr').empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                    }

                    ,
            });
            table.buttons().container().appendTo($('#exp_buttons'))
            //Date Filter
            $('#min, #max').on('change', function() {
                table.draw();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Downloads/Laboratory-Management/resources/views/allreport/patientlist.blade.php ENDPATH**/ ?>