<!-- show status approval -->
<?php if($this->approval->findApprovalStatus($data['module_id'], $data['record_id'])): ?>
    <tr>
        <td colspan="4">
        <table class="table borderless table-hover table-striped" style="width: 100%">
            <tr style="width: 100%;">
                <?php $approvalStatus = $this->approval->findApprovalStatus($data['module_id'], $data['record_id']); ?>
                <?php foreach ($approvalStatus as $key => $status): ?> 
                        <td style="border:1px solid #cdcdcd;">
                            <p style="text-align: center !important;"><?php echo $status->comment; ?><br/>
                            <b><?php echo ucfirst(strtolower($status->authorize_name)); ?> By</b></p>
                            <?php echo str_repeat('&nbsp;', 2); ?>Name:  <?php echo getUserFullName($status->from_user); ?><br/>
                            <?php
                                $date = strtotime($status->date);
                                $format_date = new DateTime(date('d-m-Y', $date));
                                echo str_repeat('&nbsp;', 2).'Date: '.$format_date->format("d/F/Y");
                            ?>
                        </td>
                <?php endforeach; ?>
            </tr>
        </table>
        </td>
    </tr>
<?php endif; ?>
<!-- end status approval -->