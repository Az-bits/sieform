<?php
defined('BASEPATH') or exit('No direct script access allowed');





$i = 1;
$user_active = array('class' => 'btn btn-success btn-sm', 'role' => 'button', 'style' => 'height: 26px; width: 80px; border-radius: 15px;');
$user_inactive = array('class' => 'btn btn-secondary btn-sm', 'role' => 'button', 'style' => 'height: 26px; width: 80px; border-radius: 15px; background: #e91e634d;');
$nbr_users = ($count_users > 0) ? ' <span class="badge badge-info" >' . $count_users . '</span>' : NULL;
?>
<?php if ($this->ion_auth->in_group('admin')) { ?>

    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs" role="tablist" style="background-color: rgb(156, 39, 176);">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#list" role="tab" style="min-width: 9rem; display: flex; justify-content: space-between;">{lang_list}<?php echo $nbr_users; ?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {lang_actions}</a>
                    <div class="dropdown-menu">
                        <?php echo anchor(base_url(Hasher::make(24)), '{lang_add_user}', array('class' => 'dropdown-item')); ?>
                        <!-- <?php echo anchor('#', '{lang_import_list}', array('class' => 'dropdown-item')); ?> -->
                        <div class="dropdown-divider"></div>
                        <?php echo anchor(base_url(Hasher::make(25)), '{lang_export_list}', array('class' => 'dropdown-item')); ?>
                    </div>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="list" role="tabpanel">

                    <br />
                    <script type="text/javascript">
                        $(document).ready(function() {
                            (function($) {
                                $('#filtrar').keyup(function() {
                                    var rex = new RegExp($(this).val(), 'i');
                                    $('.buscar tr').hide();
                                    $('.buscar tr').filter(function() {
                                        return rex.test($(this).text());
                                    }).show();
                                })
                            }(jQuery));
                        });
                    </script>
                    <div class="input-group" style="display: flex;align-items: center;"> <span class="input-group-addon">Buscar</span>
                        <input id="filtrar" type="text" class="form-control ml-2" placeholder="Ingrese nombre para busqueda...">
                    </div>
                    <div class="tab-content table-responsive">
                        <table class="table table-hover table-striped ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{lang_first_name}</th>
                                    <th>{lang_last_name}</th>
                                    <th>Usuario</th>
                                    <th>{lang_group}</th>
                                    <th>{lang_status}</th>
                                    <th>{lang_actions}</th>
                                </tr>
                            </thead>
                            <tbody class="buscar">
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++; ?></th>
                                        <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td style="color: green;"><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php foreach ($user->groups as $group) : ?>
                                                <span class="badge badge-default" style="border-radius: 15px;"><?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?></span>
                                            <?php endforeach; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($user->id != 1) {
                                                echo ($user->active) ? anchor('backend/users/deactivate/' . $user->id, '{lang_active}', $user_active) : anchor('backend/users/activate/' . $user->id, '{lang_inactive}', $user_inactive);
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo anchor(Hasher::make(5, $user->id), '{lang_edit}', array('class' => 'btn btn-primary btn-sm', 'role' => 'button')); ?>
                                            <?php ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>