<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">






        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <?php if(Auth::user()->profile_photo_path == null): ?>
                    <img src="<?php echo e(asset('assets/HMS/default/user.png')); ?>" alt="user-image" class="rounded-circle">
                <?php else: ?>
                    <img src="<?php echo e(asset('assets/HMS/employees/' . Auth::user()->profile_photo_path)); ?>" alt="user-image"
                        class="rounded-circle">
                <?php endif; ?>

                <span class="pro-user-name ml-1">
                    <?php echo e(Auth::user()->name); ?> <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h6 class="m-0">
                        Welcome !
                    </h6>
                </div>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="dripicons-user"></i>
                    <span>My Account</span>
                </a>

                <a href="javascript:void(0);" class="dropdown-item notify-item" data-toggle="modal"
                    data-target="#attendance">
                    <i class="dripicons-user"></i>
                    <span>Attendance</span>
                </a>

                <a href="javascript:void(0);" class="dropdown-item notify-item" data-toggle="modal"
                    data-target="#dailyactivities">
                    <i class="dripicons-user"></i>
                    <span>Daily Activity</span>
                </a>

                <a href="javascript:void(0);" class="dropdown-item notify-item" data-toggle="modal"
                data-target="#support">
                    <i class="dripicons-help"></i>
                    <span>Support</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="<?php echo e(route('logout')); ?>" class="dropdown-item notify-item"
                    onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="dripicons-power"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>

            </div>
        </li>

    </ul>

    <ul class="list-unstyled menu-left mb-0">
        <li class="float-left">
            <a href="#" class="logo">
                <span class="logo-lg">
                    <img src="<?php echo e(asset('assets/images/logo-light.png')); ?>" alt="" height="22">
                </span>
                <span class="logo-sm">
                    <img src="<?php echo e(asset('assets/images/logo-sm.png')); ?>" alt="" height="24">
                </span>
            </a>
        </li>
        <li class="float-left">
            <a class="button-menu-mobile navbar-toggle">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </a>
        </li>
        <li class="app-search d-none d-md-block">
            <form>
                <input type="text" placeholder="Search..." class="form-control">
                <button type="submit" class="sr-only"></button>
            </form>
        </li>
    </ul>
</div>


<!-- Attendance Modal -->
<div class="modal fade" id="attendance" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Daily Attendance</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                    date_default_timezone_set('Asia/Dhaka');
                    $date = date('d/m/Y');
                    $time = date('H:i:s');
                    $items = DB::table('attendances')
                        ->where('user_id', Auth::user()->id)
                        ->get();

                    $items2 = DB::table('attendances')
                        ->where('user_id', Auth::user()->id)
                        ->get()
                        ->count();

                    $items3 = DB::table('attendances')
                        ->where('user_id', Auth::user()->id)
                        ->where('enter_date', $date)
                        ->get()
                        ->count();

                    $items4 = DB::table('attendances')
                        ->where('user_id', Auth::user()->id)
                        ->where('enter_date', $date)
                        ->latest()
                        ->first();
                    // ->get()
                ?>
                <?php if($items2 == 0): ?>
                    <div class="alert alert-primary" role="alert">
                        Welcome to the system. Please take your <strong>attendance</strong>.
                    </div>
                    <form role="form" class="parsley-examples" id="AttendanceForm" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input value="<?php echo e(Auth::user()->id); ?>" name="user_id" style="display: none">
                        <input id="entry_date" value="<?php echo e($date); ?>" name="entry_date" style="display: none">
                        <input id="entry_time" value="<?php echo e($time); ?>" name="entry_time" style="display: none">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Entry
                            </button>
                        </div>
                    </form>
                <?php elseif($items2 > 0 && $items3 == 0): ?>
                    <div class="alert alert-primary" role="alert">
                        Welcome to the system. Please take your <strong>attendance</strong>.
                    </div>
                    <form role="form" class="parsley-examples" id="AttendanceForm" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input value="<?php echo e(Auth::user()->id); ?>" name="user_id" style="display: none">
                        <input id="entry_date" value="<?php echo e($date); ?>" name="entry_date" style="display: none">
                        <input id="entry_time" value="<?php echo e($time); ?>" name="entry_time" style="display: none">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Entry
                            </button>
                        </div>
                    </form>
                <?php elseif($items3 == 1 && $items4->exit_date == null): ?>
                    <div class="alert alert-primary" role="alert">
                        We Recoard Your Enter Time At <strong><?php echo e($items4->enter_date); ?>

                            (<?php echo e($items4->enter_time); ?>)</strong>
                    </div>
                    <form role="form" class="parsley-examples" id="ExitForm" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="text" value="<?php echo e($items4->id); ?>" id="id" style="display:none">
                        <input value="<?php echo e(Auth::user()->id); ?>" id="user_id_" name="user_id_" style="display: none">
                        <input id="exit_date" value="<?php echo e($date); ?>" name="exit_date" style="display: none">
                        <input id="exit_time" value="<?php echo e($time); ?>" name="exit_time" style="display: none">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Exit
                            </button>
                        </div>
                    </form>
                <?php elseif($items4->exit_date != null): ?>
                    <div class="alert alert-primary" role="alert">
                        We Recoard Your Exit Time At <strong><?php echo e($items4->exit_date); ?>

                            (<?php echo e($items4->exit_time); ?>)</strong>
                    </div>
                <?php endif; ?>


            </div>
        </div>
    </div>
</div>

<!-- Activites Modal -->
<div class="modal fade" id="dailyactivities" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Daily Activities</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                    date_default_timezone_set('Asia/Dhaka');
                    $date = date('d/m/Y');

                    $items = DB::table('attendances')
                        ->where('user_id', Auth::user()->id)
                        ->get();

                    $items2 = DB::table('dailyactivities')
                        ->where('user_id', Auth::user()->id)
                        ->get()
                        ->count();

                    $items3 = DB::table('dailyactivities')
                        ->where('user_id', Auth::user()->id)
                        ->where('date', $date)
                        ->get()
                        ->count();

                    $items4 = DB::table('dailyactivities')
                        ->where('user_id', Auth::user()->id)
                        ->where('date', $date)
                        ->latest()
                        ->first();
                    // ->get()
                ?>
                <?php if($items2 == 0): ?>
                    <div class="alert alert-primary" role="alert">
                        Please take your <strong>Record Your Daily Activities</strong>.
                    </div>
                    <form role="form" class="parsley-examples" id="ActivitiesForm" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input value="<?php echo e(Auth::user()->id); ?>" name="user_id" style="display: none">
                        <input id="date" value="<?php echo e($date); ?>" name="date" style="display: none">

                        <div class="form-group row">
                            <label for="activity" class="col-sm-2 col-form-label">Daily Activity<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <textarea id="activity" name="activity" class="activity" required></textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Save
                            </button>
                        </div>
                    </form>

                <?php elseif($items2 > 0 && $items3 == 0): ?>
                <div class="alert alert-primary" role="alert">
                    Please take your <strong>Record Your Daily Activities</strong>.
                </div>
                <form role="form" class="parsley-examples" id="ActivitiesForm" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input value="<?php echo e(Auth::user()->id); ?>" name="user_id" style="display: none">
                    <input id="date" value="<?php echo e($date); ?>" name="date" style="display: none">

                    <div class="form-group row">
                        <label for="activity" class="col-sm-2 col-form-label">Daily Activity<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <textarea id="activity" name="activity" class="activity" required></textarea>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                            Save
                        </button>
                    </div>
                </form>

                <?php elseif($items3 == 1): ?>
                    <div class="alert alert-primary" role="alert">
                        Your Today Activities are <strong>Recoded If You Want You Can Change !!</strong>
                    </div>
                    <form role="form" class="parsley-examples" id="updateActivitiesForm" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="text" value="<?php echo e($items4->id); ?>" id="ac_id" name="ac_id" style="display:none">
                    <input value="<?php echo e(Auth::user()->id); ?>" name="user_id" style="display: none">

                    <div class="form-group row">
                        <label for="activity_" class="col-sm-2 col-form-label">Daily Activity<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <textarea id="activity_" name="activity_" class="activity" required><?php echo $items4->activity; ?></textarea>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                            Update
                        </button>
                    </div>
                </form>

                <?php endif; ?>


            </div>
        </div>
    </div>
</div>


<!-- Activites Modal -->
<div class="modal fade" id="support" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Support Desk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    <p class="text-center font-weight-bold">If You Face Any Error Please Inform Us</p>
                </div>

                <h4>Email: hasibulhasan442@gmail.com</h4>
                <h4>Whatsup: +8801311210119</h4>

            </div>
        </div>
    </div>
</div>

<script>
    $('#AttendanceForm').on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var myformData = new FormData($('#AttendanceForm')[0]);
        $.ajax({
            type: "post",
            url: "/Attendance/add",
            data: myformData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                console.log(response);
                $("#AttendanceForm").find('input').val('');
                $('#attendance').modal('hide');
                // $('#medicineaddform')[0].reset();
                Swal.fire({
                    position: 'top-mid',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 1800
                });
                // table.draw();
                location.reload();
            },
            error: function(error) {
                console.log(error);
                alert("Data Not Save");
            }
        });
    });

    $('#ExitForm').submit(function(e) {
        e.preventDefault();

        let id = $('#id').val();
        // let user_id_ = $('#user_id_').val();
        let exit_date = $('#exit_date').val();
        let exit_time = $('#exit_time').val();
        let _token = $('input[name=_token]').val();

        $.ajax({
            type: "PUT",
            url: "/Attendance/update",
            data: {
                id: id,
                // user_id_: user_id_,
                exit_date: exit_date,
                exit_time: exit_time,
                _token: _token,
            },
            dataType: "json",
            success: function(response) {
                Swal.fire({
                    position: 'top-mid',
                    icon: 'success',
                    title: 'Update Successfull',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 1800
                });
                location.reload();
                $('#ExitForm')[0].reset();

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


    $('#ActivitiesForm').on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var myformData = new FormData($('#ActivitiesForm')[0]);
        $.ajax({
            type: "post",
            url: "/activities/add",
            data: myformData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                console.log(response);
                $("#ActivitiesForm").find('input').val('');
                $('#dailyactivities').modal('hide');
                // $('#medicineaddform')[0].reset();
                Swal.fire({
                    position: 'top-mid',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 1800
                });
                // table.draw();
                location.reload();
            },
            error: function(error) {
                console.log(error);
                alert("Data Not Save");
            }
        });
    });

    $('#updateActivitiesForm').submit(function(e) {
        e.preventDefault();

        let ac_id = $('#ac_id').val();
        let activity_ = $('#activity_').val();
        let _token = $('input[name=_token]').val();

        $.ajax({
            type: "PUT",
            url: "/activities/update",
            data: {
                ac_id: ac_id,
                // user_id_: user_id_,
                activity_: activity_,
                _token: _token,
            },
            dataType: "json",
            success: function(response) {
                Swal.fire({
                    position: 'top-mid',
                    icon: 'success',
                    title: 'Update Successfull',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 1800
                });
                location.reload();
                $('#updateActivitiesForm')[0].reset();

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

<script>
    $(document).ready(function() {
        $('.activity').summernote({
            height: 300,
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['height', ['height']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ]
        });
    });
</script>
<?php /**PATH /Users/mac/Downloads/Laboratory-Management/resources/views/Include/topbar.blade.php ENDPATH**/ ?>