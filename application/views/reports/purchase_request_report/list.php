<!-- message success -->
<?php if(!empty($this->session->flashdata('success'))){ ?>
<div class="row" id="alert-success">
    <div class="col-md-12">
        <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('success') ?></div>
    </div>
</div>
<?php } ?>
<!-- message error -->
<?php if(!empty($this->session->flashdata('error'))){ ?>
<div class="row" id="alert-error">
    <div class="col-md-12">
        <div class="alert alert-danger"><b><span class="glyphicon glyphicon-remove"></span></b> <?php echo $this->session->flashdata('error') ?></div>
    </div>
</div>
<?php } ?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <?php echo lang($title); ?>
        </div>
        <div class="db-header-extra form-inline">
            <!-- filter -->
            <div class="input-group input-sm">
                <span class="input-group-addon" style="background-color: #286091;border-color: #286091;color:#ffffff; font-size: 13px;">Filter</span>
                <select id="filter" class="form-control input-sm" data-live-search="true" tabindex="-1" aria-hidden="true">
                    <option value=""> None </option>
                    <option value="all"> All </option>
                    <option value="approved"> Approved Report </option>
                    <option value="approved_detail"> Approved Detail Report </option>
                    <option value="unauthorize"> Unauthorize Report </option>
                    <option value="unauthorize_detail"> Unauthorize Detail Report </option>
                </select>
            </div>          
            <!-- search -->
            <?php if($this->authorization->hasPermission($moduleName, "search")): ?>
            <div class="form-group has-feedback no-margin">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
                    <div class="input-group-btn">
                        <input type="hidden" id="search_type" value="0">
                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!-- button add -->
            <?php if($this->authorization->hasPermission($moduleName, "export")): ?>
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="export_excel();"><?php echo lang('export'); ?></a>
            <?php endif; ?>
            <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Open modal for @mdo</button> -->
        </div>
    </div>
    
    <!-- filter -->
    <div class="panel panel-default" id="filter_report" style="display: none;">
        <div class="panel-heading"><b>Filter By:</b></div>
            <div class="panel-body">
                <div class="col-md-12 table-responsive">
                    <style type="text/css">
                        .borderless td, .borderless th {
                            border: none !important;
                        }
                    </style>
                    <table class="table borderless" style="border-spacing: 0 0px;">
                        <tbody>
                            <tr>
                                <th>From Date:</th>
                                <td>
                                    <!-- from_date -->
                                    <input class='form-control input-sm from_date' type="text" name="from_date" id="from_date" value="<?php echo set_value('from_date'); ?>" placeholder="dd-mm-yyyy"/>
                                </td>
                                <th>To Date:</th>
                                <td>
                                    <!-- to_date -->
                                    <input class='form-control input-sm to_date' type="text" name="to_date" id="to_date" value="<?php echo set_value('to_date'); ?>" placeholder="dd-mm-yyyy"/>
                                </td>
                                <th>Department</th>
                                <td>
                                    <select name="department" id="department" onchange="changeDepartment();" class="form-control select2 department" style="width: 100%">
                                        <option value="">none</option>
                                        <?php if(!empty(listDepartmentActive())): ?>
                                            <?php foreach(listDepartmentActive() as $row): ?>
                                                <option value="<?php echo $row->id_department; ?>" <?php echo set_select('department', $row->id_department); ?>><?php echo $row->department_name; ?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </td>
                                <th>Include Sub</th>
                                <td>
                                    <select name="sub_dept" id="sub_dept" class="form-control select2" style="width: 100%">
                                        <option value="">none</option>
                                        <option value="include">Include</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Branch</th>
                                <td>
                                    <select name="branch" id="branch" onchange="changeBranch()" class="form-control select2 branch" style="width: 100%">
                                        <option value="">none</option>
                                        <?php if(!empty(listBranchActive())): ?>
                                            <?php foreach(listBranchActive() as $row): ?>
                                                <option value="<?php echo $row->id_branch; ?>" <?php echo set_select('branch', $row->id_branch); ?>><?php echo $row->branch_name; ?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </td>
                                <th>Project</th>
                                <td>
                                    <select name="project" id="project" onchange="changeProject()" class="form-control select2 project" style="width: 100%">
                                        <option value="">none</option>
                                        <?php if(!empty($projects)): ?>
                                            <?php foreach ($projects as $key => $value) : ?>
                                                <option value="<?php echo $value->id; ?>" <?php echo set_select('project', $value->id); ?>><?php echo $value->project_name; ?></option>
                                            <?php endforeach ?>
                                        <?php endif; ?>
                                    </select>
                                </td>
                                <th>Checked By</th>
                                <td>
                                    <select name="checked_by" id="checked_by" onchange="changeCheckedBy()" class="form-control select2 checked_by" style="width: 100%">
                                        <option value="">none</option>
                                        <?php if(!empty(getAllUsers())): ?>
                                            <?php foreach (getAllUsers() as $key => $u) : ?>
                                                <option value="<?php echo $u->ID; ?>" <?php echo set_select('checked_by', $u->ID); ?>> <?php echo $u->first_name.' '.$u->last_name; ?></option>
                                            <?php endforeach ?>
                                        <?php endif; ?>
                                    </select>
                                </td>
                                <th>Approved By</th>
                                <td>
                                    <select name="approved_by" id="approved_by" onchange="changeApprovedBy()" class="form-control select2 approved_by" style="width: 100%">
                                        <option value="">none</option>
                                        <?php if(!empty(getAllUsers())): ?>
                                            <?php foreach (getAllUsers() as $key => $u) : ?>
                                                <option value="<?php echo $u->ID; ?>" <?php echo set_select('approved_by', $u->ID); ?>> <?php echo $u->first_name.' '.$u->last_name; ?></option>
                                            <?php endforeach ?>
                                        <?php endif; ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- button action -->
                <div class="text-right">                    
                    <!-- button submit -->
                    <a href="javascript:void(0)" id="btn_export" onclick="show_report();" data-toggle="tooltip" data-placement="bottom" title="Click show result" data-original-title="Click show result">Luanch</a> 
                    <!-- button reset -->
                    | <a href="javascript:void(0)" id="btn_reset" onclick="reset();" data-toggle="tooltip" data-placement="bottom" title="Cancel" data-original-title="View">Reset</a> 
                </div>  
            </div>
        </div>
    </div>
    <!-- end filter -->
    
    <div class="panel panel-default" id="show_list_report">
            <div class="panel-body">
                <div class="table-responsive" id="table-list">
                    <table id="table" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr class="table-header">
                                <td>Ref No. <span id="all-items" data-toggle="tooltip" data-placement="bottom" title="Click hide items" data-original-title="Click hide items" class="glyphicon glyphicon-minus text-right" onclick="hideAllItems('all-items');"></span></td>
                                <td>Project Name</td>
                                <td>Department</td>              
                                <td>Branch</td>
                                <td>Purpose</td>
                                <td>R.Date</td>
                                <td>Deadline</td>
                                <td><?php echo lang('reference');?></td>
                                <td class="center-table-data"><?php echo lang('status'); ?></td>
                                <td>Prepared By</td>
                                <td>Checked By</td>
                                <td>Approved By</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody id="list-data" class="small-text">
                                <?php 
                                    $total_amount = 0;
                                    foreach ($data as $row): ?>
                                    <tr>
                                        <td><b><?php echo $row->ref_no; ?></b> <span id="item-<?php echo $row->id; ?>" data-toggle="tooltip" data-placement="bottom" title="Click hide item" data-original-title="Click hide item" class="glyphicon glyphicon-minus text-right" onclick="hideItem('item-<?php echo $row->id; ?>');"></span></td>
                                        <td><?php echo findProjectName($row->project); ?></td>
                                        <td><?php echo getDepartmentName($row->department); ?></td>
                                        <td><?php echo getBranchName($row->branch); ?></td>
                                        <td><?php echo $row->purpose; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($row->r_date)); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($row->deadline)); ?></td>
                                        <td><?php echo $row->reference; ?></td>
                                        <td class="center-table-data"><?php echo findStatus($row->authorize_status); ?></td>
                                        <td><?php echo getUserFullName($row->created_by); ?></td>
                                        <td><?php echo getUserFullName($row->checked_by); ?></td>
                                        <td><?php echo getUserFullName($row->approved_by); ?></td>
                                        <td><?php echo currency_format(1, $row->total_amount); ?></td>
                                    </tr>

                                    <!-- <?php $items = findPurchaseRequestItemByID($row->id); ?>
                                    <?php if(!empty($items)): ?>

                                        <tr class="item-<?php echo $row->id; ?> all-items">
                                            <td colspan="2" class="text-right"><b>No.</b></td>
                                            <td style="display: none;"></td>
                                            <td><b>Description</b></td>
                                            <td><b>UOM</b></td>
                                            <td><b>Quantity</b></td>
                                            <td><b>Price</b></td>
                                            <td><b>Total</b></td>
                                            <td colspan="7"><b>Remarks</b></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                        </tr>

                                        <?php foreach ($items as $key => $item): ?>

                                        <tr class="item-<?php echo $row->id; ?> all-items">
                                            <td colspan="2" class="text-right"><?php echo $key+1; ?></td>
                                             <td style="display: none;"></td>
                                            <td><?php echo $item->description; ?></td>
                                            <td><?php echo findMeasurementName($item->uom); ?></td>
                                            <td><?php echo $item->quantity; ?></td>
                                            <td><?php echo currency_format(1, $item->price); ?></td>
                                            <td><?php echo currency_format(1, $item->total); ?></td>
                                            <td colspan="7"><?php echo $item->remark; ?></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                            <td style="display: none;"></td>
                                        </tr>

                                        <?php endforeach; ?>
                                    <?php endif; ?> -->
                                
                                <?php $total_amount += $row->total_amount; ?>
                                <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="10" style="text-align:right">Total:</th>
                                <th colspan="3" class="text-right"><?php echo currency_format(1, $total_amount); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $this->load->view('layout/modal_confirm'); ?>
<style type="text/css">
.dataTables_wrapper .dataTables_filter {
    visibility: hidden; /* hide datatable search box */
}
</style>
<script type="text/javascript">
    // var total_page = '<?php //echo count($data); ?>';
    // if(total_page > 10){
    //     total_page = '400px';
    // }else{
    //     total_page =  '200px';
    // }

    // var table = $('#table').DataTable( {
    //     "ordering": false,
    //     "scrollY": total_page,
    //     "paging": false,
    // } );

    var table;
    var baseURL = "<?php echo site_url($link); ?>";

    table = $('#table').DataTable({
        "ordering": false,
        "bLengthChange": false, // hide show entities
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 12 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 12, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 12 ).footer() ).html(
                '$'+pageTotal.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') +' ( $'+ total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') +' total)'
            );
        }
    });
    $('.dataTables_wrapper .dataTables_filter').remove();

    $('#form-search-input').on('keyup change', function () {
        table.search(this.value).draw();
    });

    var filter = "";
    var department = "";
    var branch = "";
    var project = "";
    var checked_by = "";
    var approved_by = "";

    $('#filter').on('change', function () {
        filter = this.value;
        if(this.value == ''){
            location.href = global_base_url+ "<?php echo $link;?>";
        }else if(this.value == 'all'){
           $('#filter_report').hide();
           reset();
           show_all_report();
        }else{
            $('#filter_report').show();
        }
    });
    function show_all_report(){
        $.ajax({
            url: global_base_url + "<?php echo $link;?>/findFilter",
            method: 'get',
            data:{
                'filter': filter,
                'from_date': '',
                'to_date': '',
                'department': '',
                'branch': '',
                'project': '',
                'checked_by': '',
                'approved_by': ''
            },
            success: function (response) {
                $('#table-list').html(response);
            }
        });
    }
    function show_report(){
        $.ajax({
            url: global_base_url + "<?php echo $link;?>/findFilter",
            type: "get",
            data:{
                'filter': filter,
                'from_date': $('#from_date').val(),
                'to_date': $('#to_date').val(),
                'department': department,
                'branch': branch,
                'project': project,
                'checked_by': checked_by,
                'approved_by': approved_by
            },
            success: function (response) {
                $('#table-list').html(response);
            }
        });
    }
    function  changeBranch() {  
       if($('.branch').val() != ""){
         branch = $('.branch').val();
       }else{
         branch = "";
       }
    }  
    function changeDepartment() {  
        if($('.department').val() != ""){
         department = $('.department').val();
       }else{
         department = "";
       }
    } 
    function changeProject() {  
        if($('.project').val() != ""){
         project = $('.project').val();
       }else{
         project = "";
       }
    } 
    function changeCheckedBy() {  
        if($('.checked_by').val() != ""){
         checked_by = $('.checked_by').val();
       }else{
         checked_by = "";
       }
    } 
    function changeApprovedBy() {  
        if($('.approved_by').val() != ""){
         approved_by = $('.approved_by').val();
       }else{
         approved_by = "";
       }
    } 
    function export_excel(){
        location.href = global_base_url+ "<?php echo $link;?>/export_excel"+"?filter="+filter+"&from_date="+$('#from_date').val()+"&to_date="+$('#to_date').val()+"&department="+department+"&branch="+branch+"&project="+project+"&checked_by="+checked_by+"&approved_by="+approved_by;

        // $.ajax({
        //     url: global_base_url + "<?php //echo $link;?>/export_excel",
        //     type: "get",
        //     data:{
        //         'export': true,
        //         'filter': filter,
        //         'from_date': $('#from_date').val(),
        //         'to_date': $('#to_date').val(),
        //         'department': department,
        //         'branch': branch,
        //         'project': project,
        //         'checked_by': checked_by,
        //         'approved_by': approved_by
        //     },
        //     success: function (response) {
        //         console.log('exported');
        //     }
        // });
    }

    function reset(){
        from_date = $('.from_date').val('');
        to_date = $('.to_date').val('');
        department = $('.department').val('').trigger('change');
        branch = $('.branch').val('').trigger('change');
        project = $('.project').val('').trigger('change');
        checked_by = $('.checked_by').val('').trigger('change');
        approved_by = $('.approved_by').val('').trigger('change');
    }

</script>
<script type="text/javascript">
    function showItem(param){
        $('.'+param).show();
        // change item
        $('#'+param).attr('class','glyphicon glyphicon-minus');
        $('#'+param).attr('onclick','hideItem("'+param+'")');
        $('#'+param).attr('title','Click hide item');
        $('#'+param).data('original-title','Click hide item');
    }
    function hideItem(param){
        $('.'+param).hide();
        // change item icon
        $('#'+param).attr('class','glyphicon glyphicon-plus');
        $('#'+param).attr('onclick','showItem("'+param+'")');
        $('#'+param).attr('title','Click show item');
        $('#'+param).data('original-title','Click show item');
    }

    function showAllItems(param){
        // $.ajax({
        //     url: global_base_url + "<?php echo $link;?>/showAllItems",
        //     type: "get",
        //     success: function (response) {
        //         $('#table-list').html(response);
        //     }
        // });

        $('.'+param).show();
        // change items icon
        $('#'+param).attr('class','glyphicon glyphicon-minus');
        $('#'+param).attr('onclick','hideAllItems("'+param+'")');
        $('#'+param).attr('title','Click hide items');
        $('#'+param).data('original-title','Click hide item');  
        // change item icon
        $('span.glyphicon-plus').attr('class','glyphicon glyphicon-minus');
        $('span.glyphicon-plus').attr('title','Click hide item');
        $('span.glyphicon-plus').data('original-title','Click hide item');
    }
    function hideAllItems(param){
        // table.search('').draw();
        $('.'+param).hide();
        // change items icons
        $('#'+param).attr('class','glyphicon glyphicon-plus');
        $('#'+param).attr('onclick','showAllItems("'+param+'")');
        $('#'+param).attr('title','Click show items');
        $('#'+param).data('original-title','Click show item');
        // change item icon
        $('span.glyphicon-minus').attr('class','glyphicon glyphicon-plus');
        $('span.glyphicon-minus').attr('title','Click show items');
        $('span.glyphicon-minus').data('original-title','Click show item');
    }
</script>

<script>
    $('.select2').select2();
    $("#alert-success").fadeTo(8000, 8000).slideUp(500, function(){
        $("#alert-success").alert('close');
    });
    $("#alert-error").fadeTo(9000, 9000).slideUp(500, function(){
        $("#alert-error").alert('close');
    });

    $(function () {
        $("#from_date").datepicker({ 
            dateFormat: 'dd-mm-yy',
            onClose: function(dfr){
            // set minDate to from
            $("#to_date").datepicker("option", "minDate", dfr);
            }
        });
    });
    $(function () {
        $("#to_date").datepicker({ 
            dateFormat: 'dd-mm-yy',
        });
    });
</script>
