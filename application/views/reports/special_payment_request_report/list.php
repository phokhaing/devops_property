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
                    <option value="all"> All </option>
                    <option value="approved"> Approved Report </option>
                    <option value="unauthorize"> Unauthorize Report </option>
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
                                <td>No.</td>
                                <td>Full Name</td>
                                <td>Gender</td>              
                                <td>Position</td>
                                <td>Division</td>
                                <td>Staff ID</td>
                                <td>Subject</td>
                                <td>Content</td>
                                <td>Reason</td>
                                <td>Reference</td>
                                <td class="center-table-data"><?php echo lang('status'); ?></td>
                                <td>Date</td>
                                <td>Created By</td>
                                <td>Created At</td>
                                <td>Prepared By</td>
                                <td>Prepared At</td>
                                <td>Checked By</td>
                                <td>Checked At</td>
                                <td>Approved By</td>
                                <td>Approved At</td>
                                <td>Rejected By</td>
                                <td>Rejected At</td>
                            </tr>
                        </thead>
                        <tbody id="list-data" class="small-text">
                                <?php 
                                    foreach ($data as $row): ?>
                                    <tr>
                                        <td><b><?php echo $row->id; ?></b></td>
                                        <td><?php echo $row->fullname; ?></td>
                                        <td><?php echo $row->gender; ?></td>
                                        <td><?php echo $row->position; ?></td>
                                        <td><?php echo $row->division; ?></td>
                                        <td><?php echo $row->staff_id; ?></td>
                                        <td><?php echo $row->subject; ?></td>
                                        <td><?php echo $row->content; ?></td>
                                        <td><?php echo $row->reason; ?></td>
                                        <td><?php echo $row->reference; ?></td>
                                        <td class="center-table-data"><?php echo findStatus($row->authorize_status); ?></td>
                                        <td><?php echo ($row->date != null ? date('d/m/Y', strtotime($row->date)) : ''); ?></td>
                                        <td><?php echo getUserFullName($row->created_by); ?></td>
                                        <td><?php echo ($row->created_at != null ? date('d/m/Y H:i:sa', strtotime($row->created_at)) : ''); ?></td>
                                        <td><?php echo getUserFullName($row->created_by); ?></td>
                                        <td><?php echo ($row->created_at != null ? date('d/m/Y H:i:sa', strtotime($row->created_at)) : ''); ?></td>
                                        <td><?php echo getUserFullName($row->checked_by); ?></td>
                                        <td><?php echo ($row->checked_at != null ? date('d/m/Y H:i:sa', strtotime($row->checked_at)) : ''); ?></td>
                                        <td><?php echo getUserFullName($row->approved_by); ?></td>
                                        <td><?php echo ($row->approved_at != null ? date('d/m/Y H:i:sa', strtotime($row->approved_at)) : ''); ?></td>
                                        <td><?php echo getUserFullName($row->rejected_by); ?></td>
                                        <td><?php echo ($row->rejected_at != null ? date('d/m/Y H:i:sa', strtotime($row->rejected_at)) : ''); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                        </tbody>
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

    var filter = "all";
    var checked_by = "";
    var approved_by = "";

    $('#filter').on('change', function () {
        filter = this.value;
        if(this.value == 'all'){
           $('#filter_report').hide();
           reset();
           show_report();
        }else{
            $('#filter_report').show();
        }
    });

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

    function show_report(){
        $.ajax({
            url: global_base_url + "<?php echo $link;?>/findFilter",
            type: "get",
            data:{
                'filter': filter,
                'from_date': $('#from_date').val(),
                'to_date': $('#to_date').val(),
                'checked_by': checked_by,
                'approved_by': approved_by
            },
            success: function (response) {
                $('#table-list').html(response);
            }
        });
    }
    function export_excel(){
        location.href = global_base_url+ "<?php echo $link;?>/export_excel"+"?filter="+filter+"&from_date="+$('#from_date').val()+"&to_date="+$('#to_date').val()+"&checked_by="+checked_by+"&approved_by="+approved_by;

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
