<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 main">
            <h3>Form List</h3>

            <?php
            if ($this->session->flashdata('message') != '') {
                echo $this->session->flashdata('message');
            }
            ?>

            <div class="pull-right" style="margin-bottom: 10px;">
                <?php echo form_open("xform/forms/", 'class="form-inline" role="form"'); ?>

                <div class="form-group">
                    <?php echo form_input(array('name' => 'name', 'id' => 'name', 'class' => "form-control", 'placeholder' => "Enter Form Name")); ?>
                </div>

                <div class="form-group">
                    <?php echo form_dropdown("access", array("" => "Choose Access", "public" => "Public", "private" => "Private"), NULL, 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_dropdown("status", array("" => "Choose status", "published" => "Published", "archived" => "Archived"), NULL, 'class="form-control"'); ?>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <?php echo form_submit("search", "Search", 'class="btn btn-primary"'); ?>
                    </div>
                </div>
                <?php echo form_close(); ?>

                <?php echo validation_errors(); ?>
            </div>

            <div class="">

                <?php if (!empty($forms)) { ?>

                    <table class="table table-striped table-responsive table-hover table-bordered" cellspacing="0"
                           cellpadding="0">
                        <tr>
                            <th><?php echo $this->lang->line("label_form_name"); ?></th>
                            <!--								<th>-->
                            <?php //echo $this->lang->line("label_form_id"); ?><!--</th>-->
                            <th><?php echo $this->lang->line("label_description"); ?></th>
                            <!--								<th>-->
                            <?php //echo $this->lang->line("label_xml"); ?><!--</th>-->
                            <th><?php echo $this->lang->line("label_access"); ?></th>
                            <th><?php echo $this->lang->line("label_date_created"); ?></th>
                            <th colspan="2" class="text-center"><?php echo $this->lang->line("label_action"); ?></th>
                        </tr>

                        <?php
                        $serial = 1;
                        foreach ($forms as $form) { ?>
                            <tr>
                                <td><?php echo $form->title; ?></td>
                                <!--									<td>-->
                                <?php //echo anchor("xform/form_data/" . $form->id, $form->form_id); ?><!--</td>-->
                                <td><?php echo $form->description; ?></td>
                                <td>
                                    <?php
                                    if ($form->access == "private") {
                                        echo "<span class='label label-warning'>" . ucfirst($form->access) . "</span>";
                                    } else {
                                        echo "<span class='label label-success'>" . ucfirst($form->access) . "</span>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo date('d-m-Y H:i:s', strtotime($form->date_created)); ?></td>
                                <!--									<td>-->
                                <?php //echo anchor_popup(base_url() . "assets/forms/definition/" . $form->filename, $form->filename); ?><!--</td>-->
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-danger dropdown-toggle" type="button"
                                                data-toggle="dropdown">View <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><?php echo anchor("xform/form_data/" . $form->id, "Data list"); ?></li>
                                            <li><?php echo anchor("form_visualization/chart/" . $form->form_id, "View Chart"); ?></li>
                                            <li><?php echo anchor("form_visualization/map/" . $form->form_id, "View Map"); ?></li>
                                            <li><?php echo anchor("form_visualization/line_chart/" . $form->form_id, "View Trend"); ?></li>
                                        </ul>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <?php echo anchor("xform/edit_form/" . $form->id, "Edit"); ?> |
                                    <?php if ($form->status == "archived") {
                                        echo anchor("xform/restore_from_archive/" . $form->id, "Restore", "class='unarchive'");
                                    } else {
                                        echo anchor("xform/archive_xform/" . $form->id, "Archive", "class='archive'");
                                    } ?>
                                    <!--TODO Implement dynamic js prompt -->
                                </td>
                            </tr>
                            <?php $serial++;
                        } ?>
                    </table>
                    <?php if (!empty($links)): ?>
                        <div class="widget-foot">
                            <?= $links ?>
                            <div class="clearfix"></div>
                        </div>
                    <?php endif; ?>
                <?php } else { ?>
                    <div class="fail_message">You don't have any form to display</div>
                <?php } ?>
            </div>

        </div>
    </div>
</div>