<div class="white-area-content">
    <!-- if user can access module admin/members, user can see the admin dashboard -->
    <?php if($this->authorization->hasPermission("admin/members", "list")): ?>
    <div class="row">
        <div class="col-md-3">
            <div class="dashboard-window clearfix" style="background: #62acec; border-left: 5px solid #5798d1;">
                <div class="d-w-icon">
                    <span class="glyphicon glyphicon-send giant-white-icon"></span>
                </div>
                <div class="d-w-text">
                    <span
                        class="d-w-num"><?php echo number_format($stats->total_members) ?></span><br /><?php echo lang("ctn_136") ?>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-window clearfix" style="background: #5cb85c; border-left: 5px solid #4f9f4f;">
                <div class="d-w-icon">
                    <span class="glyphicon glyphicon-wrench giant-white-icon"></span>
                </div>
                <div class="d-w-text">
                    <span
                        class="d-w-num"><?php echo number_format($stats->new_members) ?></span><br /><?php echo lang("ctn_137") ?>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-window clearfix" style="background: #f0ad4e; border-left: 5px solid #d89b45;">
                <div class="d-w-icon">
                    <span class="glyphicon glyphicon-folder-close giant-white-icon"></span>
                </div>
                <div class="d-w-text">
                    <span
                        class="d-w-num"><?php echo number_format($stats->active_today) ?></span><br /><?php echo lang("ctn_138") ?>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-window clearfix" style="background: #d9534f; border-left: 5px solid #b94643;">
                <div class="d-w-icon">
                    <span class="glyphicon glyphicon-user giant-white-icon"></span>
                </div>
                <div class="d-w-text">
                    <span
                        class="d-w-num"><?php echo number_format($online_count) ?></span><br /><?php echo lang("ctn_139") ?>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-8">
            <div class="block-area align-center">
                <h4 class="home-label"><?php echo lang("ctn_140") ?></h4>
                <canvas id="myChart" class="graph-height"></canvas>
            </div>

            <div class="block-area">
                <?php echo lang("ctn_326") ?>
                <b><?php echo date($this->settings->info->date_format, $this->user->info->online_timestamp); ?></b>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block-area">
                <h4 class="home-label"><?php echo lang("ctn_141") ?></h4>
                <?php foreach($new_members->result() as $r) : ?>
                <div class="new-user">
                    <?php
						if($r->joined + (3600*24) > time()) {
							$joined = lang("ctn_144");
						} else {
							$joined = date($this->settings->info->date_format, $r->joined);
						}

						if($r->oauth_provider == "twitter") {
							$ava = "images/social/twitter.png";
						} elseif($r->oauth_provider == "facebook") {
							$ava = "images/social/facebook.png";
						} elseif($r->oauth_provider == "google") {
							$ava = "images/social/google.png";
						} else {
							$ava = $this->settings->info->upload_path_relative . "/default.png";
						}

					?>
                    <img src="<?php echo base_url() ?><?php echo $ava ?>" width="25" class="new-member-avatar" /> <a
                        href="<?php echo site_url("profile/" . $r->username) ?>"><?php echo $r->username ?></a>
                    <div class="new-member-joined"><?php echo $joined ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="block-area align-center" id="membersTypeChatArea">
                <h4 class="home-label"><?php echo lang("ctn_145") ?></h4>
                <canvas id="memberTypesChart"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="block-area">
                <h3>Online User</h3>
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Online</th>
                    </tr>
                    <?php
					foreach ($online_user as $r){      
						echo '<tr/><td>'.$r->last_name.' '.$r->first_name.'</td>';
						echo '<td> Online</td></tr>';
					}
					?>
                </table>
            </div>
        </div>
    </div>
    <?php endif;?>

    <style>
    .my-custom-scrollbar {
        position: relative;
        height: 150px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }
    </style>
    <div class="row">
        <!-- float advance -->
        <?php if($this->authorization->hasPermission("float_advance", "view")):?>
        <?php $findFloatAdvanceActive = findFloatAdvanceActive();
			$count = count($findFloatAdvanceActive);
			if($count > 0){
				$notification = '<span class="label label-danger pull-right"
				style="font-size: 10px;">'.$count.' New</span>';
        }else{
        $notification = '';
        }
        ?>

        <div class="col-md-6">
            <div class="block-area">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h4 class="home-label"><a href="<?php echo base_url('float_advance'); ?>">Float
                                Advance</a> <?php echo $notification;?></h4>
                        </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Ref No</th>
                                        <th>Project</th>
                                        <th>Total</th>
                                        <th>Request By</th>
                                        <th class="center-table-data"><?php echo lang('status'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="list-data" class="small-text">
                                    <?php 
									if(!empty($findFloatAdvanceActive)): 
										$i=1;
										foreach ($findFloatAdvanceActive as $row): 
										?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url('float_advance/view?id=').$row->id; ?>"><?php echo $row->ref_no; ?>
                                            </a>
                                        </td>
                                        <td><?php echo findProjectName($row->project); ?></td>
                                        <td><?php echo currency_format(1, $row->total_amount); ?></td>
                                        <td><?php echo getUserFullName($row->created_by); ?></td>
                                        <!-- status -->
                                        <td class="center-table-data">
                                            <?php echo findStatus($row->authorize_status); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else:?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Data!</td>
                                    </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.box-body -->
                    <!-- <div class="box-footer clearfix">
									<a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
									<a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All
										Orders</a>
								</div> -->
                    <!-- /.box-footer -->
                </div>
            </div>
        </div>
        <?php endif;?>

        <!-- advance clearing-->
        <?php if($this->authorization->hasPermission("advance_clearing", "view")):?>
        <?php $findAdvanceClearingActive = findAdvanceClearingActive();
		$count = count($findAdvanceClearingActive);
		if($count > 0){
			$notification = '<span class="label label-danger pull-right"
				style="font-size: 10px;">'.$count.' New</span>';
        }else{
        $notification = '';
        }?>
        <div class="col-md-6">
            <div class="block-area">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h4 class="home-label">
                            <a href="<?php echo base_url('advance_clearing'); ?>">Advance Clearing</a>
                            <?php echo $notification;?>
                        </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Ref No</th>
                                        <th>Project</th>
                                        <th>Total Debit</th>
                                        <th>Request By</th>
                                        <th class="center-table-data"><?php echo lang('status'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="list-data" class="small-text">
                                    <?php 
									if(!empty($findAdvanceClearingActive)): 
												$i=1;
												foreach ($findAdvanceClearingActive as $row): 
											?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url('advance_clearing/view?id=').$row->id; ?>"><?php echo $row->ref_no; ?>
                                            </a>
                                        </td>
                                        <td><?php echo findProjectName($row->project); ?></td>
                                        <td><?php echo currency_format(1, $row->total_debit); ?></td>
                                        <td><?php echo getUserFullName($row->created_by); ?></td>
                                        <!-- status -->
                                        <td class="center-table-data">
                                            <?php echo findStatus($row->authorize_status); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else:?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Data!</td>
                                    </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>

        <!-- Purchase Request-->
        <?php if($this->authorization->hasPermission("purchase_request", "view")):?>
        <?php $findPurchaseRequestActive = findPurchaseRequestActive();
		$count = count($findPurchaseRequestActive);
		if($count > 0){
			$notification = '<span class="label label-danger pull-right"
				style="font-size: 10px;">'.$count.' New</span>';
        }else{
        $notification = '';
        }
        ?>
        <div class="col-md-6">
            <div class="block-area">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h4 class="home-label">
                            <a href="<?php echo base_url('purchase_request'); ?>">Purchase Request</a>
                            <?php echo $notification; ?>
                        </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Ref No</th>
                                        <th>Project</th>
                                        <th>Total</th>
                                        <th>Request By</th>
                                        <th class="center-table-data"><?php echo lang('status'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="list-data" class="small-text">
                                    <?php 
									
									if(!empty($findPurchaseRequestActive)): 
										$i=1;
										foreach ($findPurchaseRequestActive as $row): 
									?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url('purchase_request/view?id=').$row->id; ?>"><?php echo $row->ref_no; ?>
                                            </a>
                                        </td>
                                        <td><?php echo findProjectName($row->project); ?></td>
                                        <td><?php echo currency_format(1, $row->total_amount); ?></td>
                                        <td><?php echo getUserFullName($row->created_by); ?></td>
                                        <!-- status -->
                                        <td class="center-table-data">
                                            <?php echo findStatus($row->authorize_status); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else:?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Data!</td>
                                    </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>

        <!-- Purchase Order-->
        <?php if($this->authorization->hasPermission("purchase_order", "view")):?>
        <?php $findPurchaseOrderActive = findPurchaseOrderActive();
		$count = count($findPurchaseOrderActive);
		if($count > 0){
			$notification = '<span class="label label-danger pull-right"
				style="font-size: 10px;">'.$count.' New</span>';
        }else{
        $notification = '';
        }?>
        <div class="col-md-6">
            <div class="block-area">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h4 class="home-label">
                            <a href="<?php echo base_url('purchase_order'); ?>">Purchase Order</a>
                            <?php echo $notification; ?>
                        </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Po No</th>
                                        <th>Project</th>
                                        <th>Total</th>
                                        <th>Request By</th>
                                        <th class="center-table-data"><?php echo lang('status'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="list-data" class="small-text">
                                    <?php 
									if(!empty($findPurchaseOrderActive)): 
											$i=1;
											foreach ($findPurchaseOrderActive as $row): 
										?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url('purchase_order/view?id=').$row->id; ?>"><?php echo $row->po_no; ?>
                                            </a>
                                        </td>
                                        <td><?php echo findProjectName($row->project); ?></td>
                                        <td><?php echo currency_format(1, $row->total_amount); ?></td>
                                        <td><?php echo getUserFullName($row->created_by); ?></td>
                                        <!-- status -->
                                        <td class="center-table-data">
                                            <?php echo findStatus($row->authorize_status); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else:?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Data!</td>
                                    </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>

        <!-- Payment Voucher-->
        <?php if($this->authorization->hasPermission("payment_voucher", "view")):?>
        <?php $findPaymentVoucherActive = findPaymentVoucherActive();
		$count = count($findPaymentVoucherActive);
		if($count > 0){
			$notification = '<span class="label label-danger pull-right"
				style="font-size: 10px;">'.$count.' New</span>';
        }else{
        $notification = '';
        }?>
        <div class="col-md-6">
            <div class="block-area">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h4 class="home-label">
                            <a href="<?php echo base_url('payment_voucher'); ?>">Payment Voucher</a>
                            <?php echo $notification; ?>
                        </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Po No</th>
                                        <th>Project</th>
                                        <th>Total</th>
                                        <th>Request By</th>
                                        <th class="center-table-data"><?php echo lang('status'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="list-data" class="small-text">
                                    <?php 
									if(!empty($findPaymentVoucherActive)): 
											$i=1;
											foreach ($findPaymentVoucherActive as $row): 
										?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url('payment_voucher/view?id=').$row->id; ?>"><?php echo $row->ref_no; ?>
                                            </a>
                                        </td>
                                        <td><?php echo findProjectName($row->project); ?></td>
                                        <td><?php echo currency_format(1, $row->total_debit); ?></td>
                                        <td><?php echo getUserFullName($row->created_by); ?></td>
                                        <!-- status -->
                                        <td class="center-table-data">
                                            <?php echo findStatus($row->authorize_status); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else:?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Data!</td>
                                    </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>

        <!-- Goods Received Note-->
        <?php if($this->authorization->hasPermission("goods_received_note", "view")):?>
        <?php $findGoodsReceivedNoteActive = findGoodsReceivedNoteActive(); 
		$count = count($findGoodsReceivedNoteActive);
		if($count > 0){
			$notification = '<span class="label label-danger pull-right"
				style="font-size: 10px;">'.$count.' New</span>';
        }else{
        $notification = '';
        }
        ?>
        <div class="col-md-6">
            <div class="block-area">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h4 class="home-label">
                            <a href="<?php echo base_url('goods_received_note'); ?>">Goods Received Note</a>
                            <?php echo $notification; ?>
                        </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>GRN No</th>
                                        <th>Received From</th>
                                        <th>Total</th>
                                        <th>Request By</th>
                                        <th class="center-table-data"><?php echo lang('status'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="list-data" class="small-text">
                                    <?php 
										if(!empty($findGoodsReceivedNoteActive)):
											$i=1;
											foreach ($findGoodsReceivedNoteActive as $row): 
										?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url('goods_received_note/view?id=').$row->id; ?>"><?php echo $row->grn_no; ?>
                                            </a>
                                        </td>
                                        <td><?php echo findSupplierName($row->received_from); ?></td>
                                        <td><?php echo currency_format(1, $row->total_amount); ?></td>
                                        <td><?php echo getUserFullName($row->created_by); ?></td>
                                        <!-- status -->
                                        <td class="center-table-data">
                                            <?php echo findStatus($row->authorize_status); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else:?>
                                    <tr>
                                        <td colspan="5" class="text-center">No Data!</td>
                                    </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="list-group">
                <a href="#" class="list-group-item active">DASHBOARD</a>
                <a href="<?php echo base_url('float_advance');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Float Advance</a>
                <a href="<?php echo base_url('advance_clearing');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Advance Clearing</a>
                <a href="<?php echo base_url('purchase_request');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Purchase Request</a>
                <a href="<?php echo base_url('purchase_order');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Purchase Order</a>
                <a href="<?php echo base_url('payment_voucher');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Payment Voucher</a>
                <a href="<?php echo base_url('goods_received_note');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Goods Received Note</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="list-group">
                <a href="#" class="list-group-item active">REPORTS</a>
                <a href="<?php echo base_url('reports/float_advance_report');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Report Float Advance</a>
                <a href="<?php echo base_url('reports/advance_clearing_report');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Report Advance Clearing</a>
                <a href="<?php echo base_url('reports/purchase_request_report');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Report Purchase Request</a>
                <a href="<?php echo base_url('reports/purchase_order_report');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Report Purchase Order</a>
                <a href="<?php echo base_url('reports/payment_voucher_report');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Report Payment Voucher</a>
                <a href="<?php echo base_url('reports/goods_received_note_report');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Report Goods Received Note</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="list-group">
                <a href="#" class="list-group-item active">SETTINGS</a>
                <a href="<?php echo base_url('menu');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Menu</a>
                <a href="<?php echo base_url('role');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> User</a>
                <a href="<?php echo base_url('permission');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Role</a>
                <a href="<?php echo base_url('branch');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Module</a>
                <a href="<?php echo base_url('department');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Permission</a>
                <a href="<?php echo base_url('position');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Branch</a>
                <a href="<?php echo base_url('division');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Department</a>
                <a href="<?php echo base_url('authorization');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Position</a>
                <a href="<?php echo base_url('division');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Division</a>
                <a href="<?php echo base_url('authorization');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Authorization</a>
            </div>
        </div>
        <div class="col-md-6">
            <a href="<?php echo base_url('adminpanel');?>" class="list-group-item active">Admin Panel</a>
            <a href="<?php echo base_url('admin/settings');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Global Settings</a>
            <a href="<?php echo base_url('admin/user_groups');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> User Groups</a>
            <a href="<?php echo base_url('admin/ipblock');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> IP Blocking</a>
            <a href="<?php echo base_url('admin/email_templates');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Email Template</a>
            <a href="<?php echo base_url('admin/email_members');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Email Members</a>
            <a href="<?php echo base_url('admin/tools');?>" class="list-group-item"><span class="glyphicon glyphicon-minus"></span> Tools</a>
        </div>
    </div>

</div>