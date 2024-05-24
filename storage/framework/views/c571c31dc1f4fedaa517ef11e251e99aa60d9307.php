<?php $__env->startSection('title', 'Company Details'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Lab Information</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Lab Information</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="card">
            <div class="card-body">
                <h3 class="text-center">Lab Information</h3>

                <div class="row">
                    <?php $__currentLoopData = App\Models\MainCompanys::where('id', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Lab Name:</th>
                                        <td><?php echo e($lab->lab_name); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Address:</th>
                                        <td><?php echo e($lab->lab_address); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td><?php echo e($lab->lab_phone); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td><?php echo e($lab->lab_email); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="text-right"><a href="javascript:void(0);" class="btn btn-info btn-sm editbtn"
                                    data-id=<?php echo e($lab->id); ?>><i class="fas fa-edit"></i></a></div>
                            <img src="<?php echo e(asset('/assets/HMS/lablogo/' . $lab->lab_image)); ?>" alt="<?php echo e($lab->lab_name); ?>"
                                class="img-fluid" />
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade modal-demo2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Update Lab Information</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" id="lab_infoForm" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        
                        <input type="hidden" name="id" id="id">

                        <div class="form-group row">
                            <label for="lab_name" class="col-sm-4 col-form-label">Lab Name<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" required parsley-type="text" class="form-control" id="lab_name"
                                    name="lab_name" placeholder="Please Insert Lab Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lab_phone" class="col-sm-4 col-form-label">Phone<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" required parsley-type="text" class="form-control" id="lab_phone"
                                    name="lab_phone" placeholder="Phone Number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lab_email" class="col-sm-4 col-form-label">Email<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="email" required class="form-control" id="lab_email" name="lab_email"
                                    placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lab_image" class="col-sm-4 col-form-label">Lab Logo<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control border-0" id="lab_image" name="lab_image">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lab_address" class="col-sm-4 col-form-label">Address<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <textarea required class="form-control" id="lab_address" name="lab_address"></textarea>
                            </div>
                        </div>


                        <div class="text-center pb-2">
                            <button type="button" class="btn btn-secondary"
                                onclick="Custombox.modal.close()";>Close</button>
                            <input type="submit" class="btn btn-success" name="submit" id="submit"
                                value="Submit" />
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <script>
        $('body').on('click', '.editbtn', function() {
            var id = $(this).data('id');
            var url = "<?php echo e(URL::route('labdetails.edit', '')); ?>/" + id;
            $.ajax({
                dataType: "json",
                url: url,
                method: 'get',
                success: function(labtest) {
                    $('#id').val(labtest.id);
                    $('#lab_name').val(labtest.lab_name);
                    $('#lab_phone').val(labtest.lab_phone);
                    $('#lab_email').val(labtest.lab_email);
                    $('#lab_address').val(labtest.lab_address);
                    $('.modal-demo2').modal('show');
                },
                error: function(error) {
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

        $('#lab_infoForm').submit(function(e) {
            e.preventDefault();

            let id = $('#id').val();
            let lab_name = $('#lab_name').val();
            let lab_phone = $('#lab_phone').val();
            let lab_email = $('#lab_email').val();
            let lab_address = $('#lab_address').val();
            let lab_image = $('#lab_image').val();
            let _token = $('input[name=_token]').val();

            $.ajax({
                type: "PUT",
                url: "<?php echo e(route('labdetails.update')); ?>",
                data: {
                    id: id,
                    lab_name: lab_name,
                    lab_phone: lab_phone,
                    lab_email: lab_email,
                    lab_address: lab_address,
                    lab_image: lab_image,
                    _token: _token,
                },
                dataType: "json",
                success: function(response) {

                    $('.modal-demo2').modal("toggle");
                    $('.modal-demo2').modal("hide");
                    Swal.fire({
                        position: 'top-mid',
                        icon: 'success',
                        title: 'Update Successfull',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 1800
                    });
                    location.reload();
                    $('#lab_infoForm')[0].reset();

                },
                error: function(data) {
                    Swal.fire({
                        title: 'Alert!',
                        text: 'Something Wrong',
                        icon: 'warning',
                        showConfirmButton: false,
                    });
                    // console.log('Error:', data);
                }
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mac/Downloads/Laboratory-Management/resources/views/maincompany/details.blade.php ENDPATH**/ ?>