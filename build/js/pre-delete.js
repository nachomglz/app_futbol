function getPredeleted() {
   $.ajax({
      type: "GET",
      url: "/admin/properties/getPlayers.php",
      data: {
         properties: {
            predeleted: true
         }
      },
      dataType: "html",
      success: function (res) {
        $(".players").html(res);
      }
    });
}

getPredeleted();
