const copy = require('clipboard-copy');
const swal = require('sweetalert2');

export function shifter_dashboard_widget() {
  jQuery(document).ready(
    function($) {

      $("#shifter-support-diag-copy").on("click", function(e) {

        e.preventDefault();

        let system_report = $('#shifter-debug-meta').text();

        swal({
          title: 'Shifter System Report',
          text: 'Copy to your clipboard',
          type: 'info',
          showCancelButton: true,
          confirmButtonColor: '#bc4e9c',
          cancelButtonColor: '#333',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.value) {
            copy($('#shifter-debug-meta').text());
            swal(
              'Copied to Clipboard!',
              "Share this report in the <a href='https://support.getshifte.io'>support chat</a> or by email at <a href='mailto:support@getshifter.io'>support@getshifter.io</a>",
              'success'
            )
          }
        })
      });
    }
  );
};
