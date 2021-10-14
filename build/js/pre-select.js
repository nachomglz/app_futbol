function getPreselected() {
   $.ajax({
      type: "GET",
      url: "/admin/properties/getPlayers.php",
      data: {
         properties: {
            preselected: true
         }
      },
      dataType: "html",
      success: function (res) {
        $(".players").html(res);
      }
    });
}

getPreselected();