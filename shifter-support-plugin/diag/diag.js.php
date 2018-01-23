<script type="text/javascript" >
  jQuery(document).ready(
    function($) {
      $("#shifter-support-diag-styled").show();
      $("#shifter-support-diag-text-target").hide();

      $("#shifter-support-diag-change-view").on("click", function(e) {
        $("#shifter-support-diag-styled-target").toggle();
        $("#shifter-support-diag-text-target").toggle();
      });
    }
  );
</script>
