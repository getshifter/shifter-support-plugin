const copy = require('clipboard-copy');

export function shifter_dashboard_widget() {
  jQuery(document).ready(
    function($) {
      $("#shifter-support-diag-styled").show();
      $("#shifter-support-diag-text-target").hide();

      $("#shifter-support-diag-copy").on("click", function(e) {
        e.preventDefault();
        copy($('#shifter_app_diag').find('#shifter-support-diag').text());
        alert('Copied to Clipboard!')
      });
    }
  );
};
