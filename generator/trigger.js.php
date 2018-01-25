<script type="text/javascript" >
  jQuery("li#wp-admin-bar-shifter_support_terminate .ab-item").on( "click", function() {
    swal({
      title: "You are about to run 'Terminate'. Are you sure?",
      text: "You will not be able to access this WordPress.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((isOK) => {
      if (isOK) {
        call_shifter_operation("shifter_app_terminate");
        swal("Your Shifter app is terminated. Check your dashborad!", { icon: "success" });
      }
    });
  });

  jQuery("li#wp-admin-bar-shifter_support_generate .ab-item").on( "click", function() {
    swal({
      title: "You are about to run 'Generate'. Are you sure?",
      text: "You will not be able to access this WordPress.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((isOK) => {
      if (isOK) {
        call_shifter_operation("shifter_app_generate");
        swal("Generating artifact is starting now. Check your dashborad!", { icon: "success" });
      }
    });
  });

  function call_shifter_operation(action) {
    jQuery.ajax({
      method: "POST",
      url: ajaxurl,
      data: { "action": action }
    }).done((response) => {
      error_log(response);
    });
  }
</script>
