<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('manager/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('manager/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('manager/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('manager/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('manager/assets/extra-libs/sparkline/sparkline.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('manager/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('manager/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('manager/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
<script src="{{ asset('manager/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
<script src="{{ asset('manager/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('manager/assets/libs/jquery-asColor/dist/jquery-asColor.min.js') }}"></script>
<script src="{{ asset('manager/assets/libs/jquery-asGradient/dist/jquery-asGradient.js') }}"></script>
<script src="{{ asset('manager/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js') }}"></script>
<script src="{{ asset('manager/assets/libs/jquery-minicolors/jquery.minicolors.min.js') }}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
<script src="{{ asset('manager/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('manager/assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<!-- include summernote js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{ asset('dist/lang/summernote-pt-BR.js') }}"></script>

<script src="{{ asset('manager/dist/js/custom.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.min.js') }}"></script>

<script type="text/javascript">
  /**
   * Variables
  */
  let date_format = "dd/mm/yyyy";
  let pt_br_link = "//cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json";
  let pt_br = "pt-BR";
  let options_date_picker = {
      format: date_format,
      language: pt_br,
      todayBtn: "linked",
      todayHighlight: true,
      toggleActive: true,
      changeMonth: true,
      changeYear: true
  }
  $(".select2").select2();

  $('#date').datepicker(options_date_picker);

  $('.form-delete').on('click', function(e) {
    e.preventDefault();
    var form = $(this);
    $('#delete-modal .item-name').html($(this).attr('data-name'));
    $('#delete-button').attr('data-id', $(this).attr('data-id'));

    $('#delete-button').on('click', function() {
        form.submit();
    });
  });

  $(function() {
    $('#zero_config').DataTable({
      order: [[0, 'asc']],
      responsive: true,
      language: {
          "url": pt_br_link
      }
    });

    // Summernote Editor for textarea
    $('#summernote').summernote({
        height: 210, //set editable area's height
        codemirror: { // codemirror options
            theme: 'monokai'
        }
    });

    $("#imageUploader").change(function() {
      const files = !!this.files ? this.files : []
      if (!files.length || !window.FileReader) return;

      if (/^image/.test(files[0].type)) {
        const reader = new FileReader()
        reader.readAsDataURL(files[0])
        reader.onloadend = function() {
          $('#imgUploader').attr('src', this.result)
        }
      }
    });
  });

</script>
