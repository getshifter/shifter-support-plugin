const copy = require('clipboard-copy');
const swal = require('sweetalert2');

export function shifter_dashboard_widget() {
  jQuery(document).ready(
    function($) {
      $("#shifter-support-diag-styled").show();
      $("#shifter-support-diag-text-target").hide();

      $("#shifter-support-diag-copy").on("click", function(e) {
        e.preventDefault();
        copy($('#shifter-debug-meta').text());
        swal({
          title: 'Copied to Clipboard',
          text: 'Share this with the Shifter Support Team',
          type: 'success',
          confirmButtonColor: '#bc4e9c',
        })
      });
    }
  );
};
