<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- End container-fluid-->
</div>
</div>
<!--End content-wrapper-->
<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->
<!--Start footer-->
<footer class="footer">
   <div class="container">
      <div class="row">
         <div class="col-md-6 col-sm-6 col-xs-12 text-left">
            <p style="margin-bottom: 0px; font-size: 12px;">Copyright © 2019, All Rights Reserved by <?php echo $this->lang->line('project_short_name'); ?></p>
         </div>
         <div class="col-md-6 col-sm-6 col-xs-12 text-right">
            <p style="margin-bottom: 0px; font-size: 12px;">Powered By <a href="http://cnvg.in/">Converge Infoservices Pvt. Ltd.</a></p>
         </div>
      </div>
   </div>
</footer>
<!--End footer-->
</div>
<!--End wrapper-->
<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/jquery-ui.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<!-- simplebar js -->
<script src="<?php echo base_url('assets/plugins/simplebar/js/simplebar.js'); ?>"></script>
<!-- sidebar-menu js -->
<script src="<?php echo base_url('assets/js/sidebar-menu.js'); ?>"></script>
<!-- Custom scripts -->
<script src="<?php echo base_url('assets/js/app-script.js'); ?>"></script>

<!--Data Tables js-->
<script src="<?php echo base_url('assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datatable/js/jszip.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datatable/js/pdfmake.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datatable/js/vfs_fonts.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datatable/js/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datatable/js/buttons.print.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js'); ?>"></script>


<script src="<?php echo base_url('assets/plugins/select2/js/select2.min.js'); ?>"></script>
<!--Inputtags Js-->
<script src="<?php echo base_url('assets/plugins/inputtags/js/bootstrap-tagsinput.js'); ?>"></script>

<!--Multi Select Js-->
<script src="<?php echo base_url('assets/plugins/jquery-multi-select/jquery.multi-select.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-multi-select/jquery.quicksearch.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.single-select').select2();
  
        $('.multiple-select').select2();

    //multiselect start

        $('#my_multi_select1').multiSelect();
        $('#my_multi_select2').multiSelect({
            selectableOptgroup: true
        });

        $('#my_multi_select3').multiSelect({
            selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            afterInit: function (ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });

     $('.custom-header').multiSelect({
          selectableHeader: "<div class='custom-header'>Selectable items</div>",
          selectionHeader: "<div class='custom-header'>Selection items</div>",
          selectableFooter: "<div class='custom-header'>Selectable footer</div>",
          selectionFooter: "<div class='custom-header'>Selection footer</div>"
        });


      });

</script>

<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

<script type="text/javascript">
   $(document).ready(function() {
      //Default data table
      $('#default-datatable').DataTable();
      var table = $('#example').DataTable({
         lengthChange: false,
         buttons: ['excel', 'pdf', 'print']
         //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
      });

      table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
   });
</script>

<script type="text/javascript">
   $('#alert_message').fadeOut(10000)
</script>
</body>
</html>