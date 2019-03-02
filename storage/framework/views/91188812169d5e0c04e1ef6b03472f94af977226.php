<?php $__env->startSection('template_title'); ?>
    <?php echo trans('usersmanagement.showing-user-deleted'); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }
        .users-table tr td:first-child {
            padding-left: 15px;
        }
        .users-table tr td:last-child {
            padding-right: 15px;
        }
        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: .15em;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <?php echo trans('usersmanagement.showing-user-deleted'); ?>

                            </span>
                            <div class="float-right">
                                <a href="<?php echo e(route('users')); ?>" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="<?php echo e(trans('usersmanagement.tooltips.back-users')); ?>">
                                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                    <?php echo trans('usersmanagement.buttons.back-to-users'); ?>

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <?php if(count($users) === 0): ?>

                            <tr>
                                <p class="text-center margin-half">
                                    <?php echo trans('usersmanagement.no-records'); ?>

                                </p>
                            </tr>

                        <?php else: ?>

                            <div class="table-responsive users-table">
                                <table class="table table-striped table-sm data-table">
                                    <caption id="user_count">
                                        <?php echo e(trans_choice('usersmanagement.users-table.caption', 1, ['userscount' => $users->count()])); ?>

                                    </caption>
                                    <thead>
                                        <tr>
                                            <th class="hidden-xxs">ID</th>
                                            <th><?php echo trans('usersmanagement.users-table.name'); ?></th>
                                            <th class="hidden-xs hidden-sm">Email</th>
                                            <th class="hidden-xs hidden-sm hidden-md"><?php echo trans('usersmanagement.users-table.fname'); ?></th>
                                            <th class="hidden-xs hidden-sm hidden-md"><?php echo trans('usersmanagement.users-table.lname'); ?></th>
                                            <th class="hidden-xs hidden-sm"><?php echo trans('usersmanagement.role'); ?></th>
                                            <th class="hidden-xs"><?php echo trans('usersmanagement.deleted'); ?></th>
                                            <th class="hidden-xs"><?php echo trans('usersmanagement.IpDeleted'); ?></th>
                                            <th><?php echo trans('usersmanagement.actions'); ?></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="hidden-xxs"><?php echo e($user->id); ?></td>
                                                <td><?php echo e($user->name); ?></td>
                                                <td class="hidden-xs hidden-sm"><a href="mailto:<?php echo e($user->email); ?>" title="email <?php echo e($user->email); ?>"><?php echo e($user->email); ?></a></td>
                                                <td class="hidden-xs hidden-sm hidden-md"><?php echo e($user->first_name); ?></td>
                                                <td class="hidden-xs hidden-sm hidden-md"><?php echo e($user->last_name); ?></td>
                                                <td class="hidden-xs hidden-sm">
                                                    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <?php if($user_role->name == 'User'): ?>
                                                            <?php $labelClass = 'primary' ?>

                                                        <?php elseif($user_role->name == 'Admin'): ?>
                                                            <?php $labelClass = 'warning' ?>

                                                        <?php elseif($user_role->name == 'Unverified'): ?>
                                                            <?php $labelClass = 'danger' ?>

                                                        <?php else: ?>
                                                            <?php $labelClass = 'default' ?>

                                                        <?php endif; ?>

                                                        <span class="label label-<?php echo e($labelClass); ?>"><?php echo e($user_role->name); ?></span>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </td>
                                                <td class="hidden-xs"><?php echo e($user->deleted_at); ?></td>
                                                <td class="hidden-xs"><?php echo e($user->deleted_ip_address); ?></td>
                                                <td>
                                                    <?php echo Form::model($user, array('action' => array('SoftDeletesController@update', $user->id), 'method' => 'PUT', 'data-toggle' => 'tooltip')); ?>

                                                        <?php echo Form::button('<i class="fa fa-refresh" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-block btn-sm', 'type' => 'submit', 'data-toggle' => 'tooltip', 'title' => 'Restore User')); ?>

                                                    <?php echo Form::close(); ?>

                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info btn-block" href="<?php echo e(URL::to('users/deleted/' . $user->id)); ?>" data-toggle="tooltip" title="Show User">
                                                        <i class="fa fa-eye fa-fw" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php echo Form::model($user, array('action' => array('SoftDeletesController@destroy', $user->id), 'method' => 'DELETE', 'class' => 'inline', 'data-toggle' => 'tooltip', 'title' => 'Destroy User Record')); ?>

                                                        <?php echo Form::hidden('_method', 'DELETE'); ?>

                                                        <?php echo Form::button('<i class="fa fa-user-times" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm inline','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')); ?>

                                                    <?php echo Form::close(); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

    <?php if(count($users) > 10): ?>
        <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>