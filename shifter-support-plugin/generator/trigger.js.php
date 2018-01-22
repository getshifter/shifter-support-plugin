<script type="text/javascript" >
  jQuery("li#wp-admin-bar-shifter_support_terminate .ab-item").on( "click", function() {
    swal({
      title: "Are you sure?",
      text: "If you run terminattion, The shifter app could not be accessed.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((isRunTerminate) => {
      if (isRunTerminate) {
        call_shifter_operation(
          "shifter_app_terminate",
          "Shifter app is terminated. Check your dashborad!",
          "Shifter app termination was failed!"
        );
      }
    });
  });

  jQuery("li#wp-admin-bar-shifter_support_generate .ab-item").on( "click", function() {
    swal({
      title: "Are you sure?",
      text: "If you start generate, The shifter app could not be accessed.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((isRunTerminate) => {
      if (isRunTerminate) {
        call_shifter_operation(
          "shifter_app_generate",
          "Shifter app is generated. Check your dashborad!",
          "Shifter app generation was failed!"
        );
      }
    });
  });

  function call_shifter_operation(action, successMsg, failedMsg) {
    jQuery.ajax({
      method: 'POST',
      url: ajaxurl,
      data: { 'action': action }
    }).then((response) => {
      swal(successMsg, { icon: "success" });
    }).fail((response) => {
      swal(failedMsg, { icon: "warning" });
    })
  }
</script>
