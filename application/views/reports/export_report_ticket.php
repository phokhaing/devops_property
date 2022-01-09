<?php
// Export mode
$mode = 1;
if (isset($_GET['mode'])) {
    $mode = intval($_GET['mode']);
}
?>

<div class="white-area-content">
    <div class="db-header clearfix">
        <div class="page-header-title"> <span class="glyphicon glyphicon-list-alt"></span> <a href="<?php echo base_url('reports/').$page; ?>"><?php echo lang("ctn_542") ?></a>/Export As</div>
        <div class="db-header-extra form-inline">
            
            <!-- <div class="btn-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" <?php if($progress=='true') echo "checked";?> type="checkbox" name="status-progress" id="status-progress" value="<?php echo $progress;?>">
                    <label class="form-check-label" for="status-progress"> Progress</label>

                    <input class="form-check-input" <?php if($close=='true') echo "checked";?> type="checkbox" id="status-close" name="status-close" value="<?php echo $close;?>">
                    <label class="form-check-label" for="status-close"> Close</label>
                </div>
            </div>  -->

            <div class="btn-group">
                <?php 
                $status = '';
                if(isset($_GET['progress']) && isset($_GET['close'])){
                    $status = '?progress='.$_GET['progress'].'&close='.$_GET['close'];
                } ?>
                <!-- <?php //echo form_open(site_url("reports")) ?> -->
                <form method="get" action="<?php echo site_url('reports/'.$page.'/'.$catid)?>">
                <div class="form-group">
                    <input type="text" name="start_date" class="input-sm form-control datepicker" value="<?php echo $start_date; ?>" placeholder="00-00-0000">
                    <!--  value="<?php //echo date("m/d/Y", time() - (3600 * 24 * 7)) ?> -->
                </div>
                <div class="form-group">
                    <input type="text" name="end_date" class="input-sm form-control datepicker"​ value="<?php echo $end_date; ?>" placeholder="00-00-0000">
                </div>
                <!-- <div class="form-check form-check-inline"> -->
                <div class="form-group">
                    <input class="form-check-input" <?php if($progress=='true') echo "checked";?> type="checkbox" name="progress" id="status-progress" value="<?php echo $progress;?>">
                    <label class="form-check-label" for="status-progress"> Progress</label>
                </div>
                <div class="form-group">
                    <input class="form-check-input" <?php if($close=='true') echo "checked";?> type="checkbox" id="status-close" name="close" value="<?php echo $close;?>">
                    <input type="hidden" name="mode" value="1">
                    <label class="form-check-label" for="status-close"> Close</label>
                </div>
                <!-- </div> -->
                <div class="form-group">
                    <input type="submit" class="btn btn-default btn-sm" value="<?php echo 'Search' ?>" >
                </div>
                <?php echo form_close() ?>
            </div> 

            <?php $default_order = null; ?>
            <?php if ($views->num_rows() > 0) : ?>
                <?php
                $current_view = lang("ctn_642");
                $default_order = null;
                if ($this->user->info->custom_view > 0) {
                    foreach ($views->result() as $r) {
                        if ($r->ID == $this->user->info->custom_view) {
                            $current_view = $r->name;
                            $default_order = $r->order_by;
                            $default_order_type = $r->order_by_type;
                        }
                    }
                }
                ?>
                <div class="btn-group">
                    <div class="dropdown">
                        <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <?php echo $current_view ?>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <li><a href="<?php echo site_url("tickets/active_view/0/" . $page) ?>"><?php echo lang("ctn_643") ?></a></li>
                            <?php foreach ($views->result() as $r) : ?>
                                <li><a href="<?php echo site_url("tickets/active_view/" . $r->ID . "/" . $page) ?>"><?php echo $r->name ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <div class="btn-group">
                <div class="dropdown">
                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <?php echo lang("ctn_462") ?>
                        <span class="caret"></span> 
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="<?php echo site_url("reports/" . $page) ?>"><?php echo lang("ctn_600") ?></a></li>
                        <li>
                            <?php 
                            $status_filter = '';
                            $date_filter = '';
                            $andor = '?';
                            if(isset($_GET['progress']) && isset($_GET['close'])){
                                $andor = '&';
                                $status_filter = '&progress='.$_GET['progress'].'&close='.$_GET['close'];
                            }elseif(isset($_GET['progress']) && !isset($_GET['close'])){
                                $andor = '&';
                                $status_filter = '&progress='.$_GET['progress'];
                            }elseif(!isset($_GET['progress']) && isset($_GET['close'])){
                                $andor = '&';
                                $status_filter = '&close='.$_GET['close'];
                            }

                            if(isset($_GET['start_date']) && isset($_GET['end_date'])){
                                $date_filter = $andor.'start_date='.$_GET['start_date'].'&end_date='.$_GET['end_date'];
                            }elseif(isset($_GET['start_date']) && !isset($_GET['end_date'])){
                                $date_filter = $andor.'start_date='.$_GET['start_date'];
                            }elseif(isset($_GET['start_date']) && !isset($_GET['end_date'])){
                                $date_filter = $andor.'end_date='.$_GET['end_date'];
                            }


                            ?>
                            <?php foreach ($categories->result() as $r) : ?>
                                <a href="<?php echo site_url("reports/" . $page . "/".$r->ID.'?mode=1'.$status_filter.$date_filter) ?>"><?php echo $r->name ?></a>
                                    <?php if(!empty(getSubCategoryByParent($r->ID))): ?>
                                        <?php foreach (getSubCategoryByParent($r->ID) as $sub):?>
                                          <ul style='list-style:none;' class='sub_links'>
                                            <li>
                                              <a href="<?php echo site_url("reports/" . $page . "/" . $sub->ID.'?mode=1'.$status_filter.$date_filter) ?>"><?php echo $sub->name ?></a>
                                            </li>
                                          </ul>
                                       <?php endforeach; ?>
                                    <?php endif; ?>
                            <?php endforeach; ?>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- <div class="btn-group">
                <div class="dropdown">
                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <?php //echo lang("ctn_462") ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="<?php //echo site_url("tickets/" . $page) ?>"><?php //echo lang("ctn_600") ?></a></li>
                        <?php //foreach ($categories->result() as $r) : ?>
                            <li><a href="<?php //echo site_url("reports/" . $page . "/" . $r->ID) ?>"><?php //echo $r->name ?></a></li>
                        <?php //endforeach; ?>
                    </ul>
                </div>
            </div> -->

            <?php if($this->authorization->hasPermission($moduleName, "search")): ?>
            <div class="form-group has-feedback no-margin">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
                    <div class="input-group-btn">
                        <input type="hidden" id="search_type" value="0">
                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        <ul class="dropdown-menu small-text" style="min-width: 90px !important; left: -90px;">
                            <li><a href="#" onclick="change_search(0)"><span class="glyphicon glyphicon-ok" id="search-like"></span> <?php echo lang("ctn_337") ?></a></li>
                            <li><a href="#" onclick="change_search(1)"><span class="glyphicon glyphicon-ok no-display" id="search-exact"></span> <?php echo lang("ctn_338") ?></a></li>
                            <li><a href="#" onclick="change_search(2)"><span class="glyphicon glyphicon-ok no-display" id="title-exact"></span> <?php echo lang("ctn_425") ?></a></li>
                            <li><a href="#" onclick="change_search(3)"><span class="glyphicon glyphicon-ok no-display" id="title2-exact"></span> <?php echo lang("ctn_481") ?></a></li>
                            <li><a href="#" onclick="change_search(4)"><span class="glyphicon glyphicon-ok no-display" id="title3-exact"></span> <?php echo lang("ctn_550") ?></a></li>
                            <li><a href="#" onclick="change_search(5)"><span class="glyphicon glyphicon-ok no-display" id="title4-exact"></span> <?php echo lang("ctn_551") ?></a></li>
                            <li><a href="#" onclick="change_search(6)"><span class="glyphicon glyphicon-ok no-display" id="title5-exact"></span> <?php echo lang("ctn_552") ?></a></li>
                            <li><a href="#" onclick="change_search(7)"><span class="glyphicon glyphicon-ok no-display" id="title6-exact"></span> <?php echo lang("ctn_611") ?></a></li>
                        </ul>
                    </div><!-- /btn-group -->
                </div>
            </div>
            <?php endif; ?>
            <!-- <?php //if($this->authorization->hasPermission($moduleName, "create")): ?>
            <a href="<?php //echo site_url("tickets/add?page=".$page) ?>" class="btn btn-primary btn-sm"><?php //echo lang("ctn_553") ?></a>
            <?php //endif; ?> -->
        </div>
    </div>

    <!-- <?php //if($this->authorization->hasPermission($moduleName, "export")): ?>
        <?php //if ($mode == 0) : ?>
            <a href="<?php //echo site_url("reports/" . $page . "/" . $catid . "?mode=1") ?>" class="btn btn-default"><?php //echo lang("ctn_855") ?></a>
        <?php //endif; ?> -->
    <?php //endif; ?>
    <div class="table-responsive">
        <table id="ticket-table" class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="table-header">
                    <td><?php echo lang("ctn_611") ?></td>
                    <td><?php echo lang("ctn_11") ?></td>
                    <td><?php echo lang("ctn_428") ?></td>
                    <td><?php echo lang("ctn_391") ?></td>
                    <td><?php echo lang("ctn_462") ?></td>
                    <td><?php echo 'Dept./Branch' ?></td>
                    <td><?php echo lang("environment") ?></td>
                    <td><?php echo lang("ctn_481") ?></td>
                    <td><?php echo lang("ctn_550") ?></td>
                    <td><?php echo "Request Date" ?></td> 
                    <td><?php echo lang("ctn_463") ?></td>
                    <td><?php echo "Ticket Time" ?></td>
                </tr>
            </thead>
            <tbody class="small-text">
            </tbody>
        </table>
    </div>
</div>

<?php 
    $s_date = '';
    $e_date = '';
    if(isset($_GET['start_date']) && $_GET['start_date'] != null){
        $s_date = '&start_date='.$_GET['start_date'];
    }
    if(isset($_GET['end_date']) && $_GET['end_date'] != null){
        $e_date = '&end_date='.$_GET['end_date'];
    }

 ?>

<script type="text/javascript">
    var close = false;
    var progress = false;
    var s_date = '<?php echo $s_date?>';
    var e_date = '<?php echo $e_date?>';

    // check status progress
    $('#status-progress').click(function(){
        close = $('#status-close').val();
        if($(this).prop("checked") == true){
          progress = true;
        }
        else if($(this).prop("checked") == false){
          progress = false;
        }

        window.location.href = "<?php echo base_url().'reports/'.$page.'/'.$catid.'?mode=1'.'&progress='?>"+progress+'&close='+close+s_date+e_date;

    });

    // check status close
    $('#status-close').click(function(){
        progress = $('#status-progress').val();
        if($(this).prop("checked") == true){
          close = true;
        }
        else if($(this).prop("checked") == false){
          close = false;            
        }
        window.location.href = "<?php echo base_url().'reports/'.$page.'/'.$catid.'?mode=1'.'&progress='?>"+progress+'&close='+close+s_date+e_date;
    });

    $(document).ready(function() {
        $.ajax({
            url : "<?php echo site_url("reports/ticket_page/" . $page . "/" . $catid . "/" . $mode."?start_date=".$start_date."&end_date=".$end_date."&close=".$close."&progress=".$progress) ?>",
            type : 'GET',
            data : function (d) {
                console.log(d);
            }   
        });
        

    var st = $('#search_type').val();
    var table = $('#ticket-table').DataTable({
            // "lengthMenu": [[2,10, 25, 50, -1], [2,10, 25, 50, "All"]],
            "dom" : "<?php if ($mode == 1) : ?>B<?php endif; ?><'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "processing": false,
            "pageLength" : 10,
            "bPaginate": false, // disable next previous
            "pagingType" : "full_numbers",
            "serverSide": true,
            "orderMulti": false,
            <?php if ($mode == 1) : ?>
                    buttons: [
                    { "extend": 'copy', "text":'<?php echo lang("ctn_847") ?>', "className": 'btn btn-default btn-sm' },
                    { "extend": 'csv', "text":'<?php echo lang("ctn_848") ?>', "className": 'btn btn-default btn-sm' },
                    { "extend": 'excel', "text":'<?php echo lang("ctn_849") ?>', "className": 'btn btn-default btn-sm' },
                    { "extend": 'pdf', "text":'<?php echo lang("ctn_850") ?>', "className": 'btn btn-default btn-sm' },
                    { "extend": 'print', "text":'<?php echo lang("ctn_851") ?>', "className": 'btn btn-default btn-sm' }
                    ],
            <?php endif; ?>
                "order": [
            <?php if ($default_order != null) : ?>
                    [<?php echo $default_order ?>, "<?php echo $default_order_type ?>"]
            <?php else : ?>
                    [6, "desc"]
            <?php endif; ?>
                ],
            "columnDefs": [
            { className: "center-table-data", "targets": [ 0,2, 3, 4, 5, 6, 7, 8, 9,10,11] }
            ],      
            "columns": [
                    null,
                    null,
                    null,
                    null,
                    null,      
            { "orderable": false },
            { "orderable": false },
                    null,
                    null,
                    null,
            { "orderable": false },
                    null,
            ],
            "ajax": {
                url : "<?php echo site_url("reports/ticket_page/" . $page . "/" . $catid . "/" . $mode."?start_date=".$start_date."&end_date=".$end_date."&close=".$close."&progress=".$progress) ?>",
                type : 'GET',
                data : function (d) {
                    console.log(d);
                    d.search_type = $('#search_type').val();
                }   
            },
            "drawCallback": function(settings, json) {
            $('[data-toggle="tooltip"]').tooltip();
            },
            'rowCallback': function(row, data, index){
               <?php foreach ($statuses->result() as $r) : ?>
                if (data[3].statusid == <?php echo $r->ID ?>){
                $(row).find('td:eq(3)').css('color', '#<?php echo $r->text_color ?>');
                $(row).find('td:eq(3)').css('background', '#<?php echo $r->color ?>');
                $(row).find('td:eq(3)').css('text-align', 'center');
                $(row).find('td:eq(3)').css('font-weight', '600');
                $(row).find('td:eq(3)').css('font-size', '14px');
                $(row).find('td:eq(3)').text(data[3].name);
                }
               <?php endforeach; ?>
            }
    });
    $('#form-search-input').on('keyup change', function () {
    table.search(this.value).draw();
    });
    });
    function change_search(search)
    {
    var options = [
            "search-like",
            "search-exact",
            "title-exact",
            "title2-exact",
            "title3-exact",
            "title4-exact",
            "title5-exact",
            "title6-exact",
    ];
    set_search_icon(options[search], options);
    $('#search_type').val(search);
    $("#form-search-input").trigger("change");
    }

    function set_search_icon(icon, options)
    {
    for (var i = 0; i < options.length; i++) {
    if (options[i] == icon) {
    $('#' + icon).fadeIn(10);
    } else {
    $('#' + options[i]).fadeOut(10);
    }
    }
    }


</script>
