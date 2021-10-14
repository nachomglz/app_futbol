function indexOfRegex(arr, regex) {
  var indexes = [];
  arr.forEach(element => {
    if (regex.test(element)) {
      indexes.push(arr.indexOf(element));
    }
  });
  return indexes
}
function filterPlayers() {
  // Escribir query teniendo en cuenta los filtros
  var query_fields = [];
  var filters = {};

  $('.filter-wrapper .filtros select').each(function (index, filter) { 
    filter.addEventListener('change', (e) => {
      filter = {}
      query_fields = []
      switch (e.target.getAttribute('id')) {
        case 'height-filter':
          filters.height = parseFloat(e.target.value);
          break;
          case 'weight-filter':
            filters.weight = parseFloat(e.target.value);
          break;
        case 'age-filter':
          filters.age = parseInt(e.target.value);
          break;
        case 'country-filter':
          filters.country = e.target.value;
          break;
        case 'position-filter':
          filters.position = parseInt(e.target.value);
          break;
        case 'lateralidad-filter':
          filters.lateralidad = e.target.value;
          break;
      }
    })
  });

  $('#filter-submit').click( () => {
    query_fields = []
    var query = "SELECT * FROM player";
    var order = $('#filter-order').val()
    for(key in filters) {
      query_fields.push(`${key} ${typeof(filters[key]) === 'number' ? '>' : '='} ${typeof(filters[key]) === 'number' ? filters[key] : "'" + filters[key] + "'"}`)
    }

    for (let i = 0; i < query_fields.length; i++) {
      if (i === 0) {
        query += ' where ' + query_fields[0]
        continue
      }
      query += ' and ' + query_fields[i];
    }

    query += ` order by insert_date ${order}`

    $.ajax({
      type: "GET",
      url: `/admin/properties/getPlayers.php`,
      data: {
        query: query
      },
      dataType: "html",
      success: function (res) {
        $(".players").html(res);
      }
    });

  })

}
function getPlayers() {
  $.ajax({
    type: "GET",
    url: "/admin/properties/getPlayers.php",
    dataType: "html",
    success: function (res) {
      $(".players").html(res);
    },
    complete: function (res) {
      descartarSeleccionar();
    },
  });
}
function getCountries() {
  $.ajax({
    type: "GET",
    url: "/countries.php",
    dataType: "json",
    success: function (res) {
      res.forEach((pais) => {
        $("#country-filter").append(
          `<option value="${pais.Codigo}">${pais.Pais}</option>`
        );
      });
    },
  });
}
function getPositions() {
  $.ajax({
    type: "GET",
    url: "/positions.php",
    dataType: "json",
    success: function (res) {
      res.forEach((position) => {
        $("#position-filter").append(
          `<option value="${position.id}">${position.name}</option>`
        );
      });
    },
  });
}
function descartarSeleccionar() {
  $(".descartar-seleccionar form").each(function (index, value) {
    value.addEventListener("submit", function (e) {
      e.preventDefault();

      var player_id = e.target.children[0].value;
      var action = e.target.children[1].value;

      if (player_id && action) {
        (action == 1) ? descartarPlayer(player_id) : seleccionarPlayer(player_id);
      }
    });
  });
}
function descartarPlayer(id) {
  $.ajax({
    type: "post",
    url: "/admin/properties/descartar-player.php",
    data: {
      id: id,
    },
    success: function (res) {
      getPlayers();
    },
  });
}
function seleccionarPlayer(id) {
  $.ajax({
    type: "post",
    url: "/admin/properties/seleccionar-player.php",
    data: {
      id: id,
    },
    success: function (res) {
      getPlayers();
    },
  });
}

// indexOfRegex(['height > 20', 'height > 83.2', 'height = "Zurdo"'], /height [=><] */);

getPlayers();
getCountries();
getPositions();
filterPlayers();
descartarSeleccionar();
