$("#country").change(() => {
  $("#city").html("");
  $.ajax({
    url: `cities.php?country_code=${$("#country").val()}`,
    type: "GET",
    dataType: "json",
    success: function (res) {
      res.forEach((city) => {
        $("#city").append(
          `<option value="${city.idCiudades}">${city.Ciudad}</option>`
        );
      });
    },
    error: function (e) {
      console.log(e);
    },
  });
});
function rellenarFechas() {
  const date_input = document.querySelector(".birthdate");
  var today = new Date();

  var dd = today.getDate();
  var mm = today.getMonth();
  var yyyy = today.getFullYear();

  dd = dd < 10 ? "0" + dd : dd;
  mm = mm < 10 ? "0" + mm : mm;

  today = yyyy + "-" + mm + "-" + dd;
  date_input.setAttribute("max", today);
}
function rellenarPaises() {
  // Realizar peticion AJAX al servidor
  $.ajax({
    url: "countries.php",
    type: "GET",
    dataType: "json",
    success: function (res) {
      res.forEach((pais) => {
        $("#country").append(
          `<option value="${pais.Codigo}">${pais.Pais}</option>`
        );
      });
    },
    error: function (e) {
      console.log(e);
    },
  });
}
function imageName() {
  $("#image").change(() => {
    console.log($("#image").width());
    console.log($("#image").height());
  });

  $("#image").change(() => {
    var file = $("#image")[0].files[0];
    var filename = file.name;
    $(".filename").html(filename);
  });
}
var validaciones = {
  name: /^[a-zA-Z ]{2,30}$/,
  surname: /[A-Za-z]{2,60}/,
  email:
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
  phone:
    /^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/i,
  weight: /[1-9]{2,3}(\.[0-9]{2,3})?/,
  height: /[1-9]{1,1}(\.[0-9]{2,3})?/,
};

function validarFormulario() {
  var val = false;
  $("#register-form").submit((e) => {
    e.preventDefault();
    const name = $("#name");
    const surname = $("#surname");
    const email = $("#email");
    const phone = $("#phone");
    const birthdate = $("#birthdate");
    const weight = $("#weight");
    const height = $("#height");
    const agency = $("#agency");
    const position = $("#position");
    const country = $("#country");
    const city = $("#city");
    const image = $("#image");

    name.attr("data-valid", () => {
      if (!validaciones.name.test(name.val())) {
        name.next().css("visibility", "visible");
      } else {
        name.next().css("visibility", "hidden");
      }
      return validaciones.name.test(name.val()) ? 1 : 0;
    });
    surname.attr("data-valid", () => {
      if (!validaciones.surname.test(surname.val())) {
        surname.next().css("visibility", "visible");
      } else {
        surname.next().css("visibility", "hidden");
      }
      return validaciones.surname.test(surname.val()) ? 1 : 0;
    });
    email.attr("data-valid", () => {
      if (!validaciones.email.test(email.val())) {
        email.next().css("visibility", "visible");
      } else {
        email.next().css("visibility", "hidden");
      }
      return validaciones.email.test(email.val()) ? 1 : 0;
    });
    phone.attr("data-valid", () => {
      if (!validaciones.phone.test(phone.val())) {
        phone.next().css("visibility", "visible");
      } else {
        phone.next().css("visibility", "hidden");
      }
      return validaciones.phone.test(phone.val()) ? 1 : 0;
    });
    birthdate.attr("data-valid", () => {
      if (birthdate.val().length === 0) {
        birthdate.next().css("visibility", "visible");
      } else {
        birthdate.next().css("visibility", "hidden");
      }
      return !(birthdate.val().length === 0) ? 1 : 0;
    });
    weight.attr("data-valid", () => {
      if (!validaciones.weight.test(weight.val())) {
        weight.next().css("visibility", "visible");
      } else {
        weight.next().css("visibility", "hidden");
      }
      return validaciones.weight.test(weight.val()) ? 1 : 0;
    });
    height.attr("data-valid", () => {
      if (!validaciones.height.test(height.val())) {
        height.next().css("visibility", "visible");
      } else {
        height.next().css("visibility", "hidden");
      }
      return validaciones.height.test(height.val()) ? 1 : 0;
    });
    agency.attr("data-valid", () => {
      if (agency.val() === "") {
        agency.next().css("visibility", "visible");
      } else {
        agency.next().css("visibility", "hidden");
      }
      return !(agency.val() === "") ? 1 : 0;
    });
    position.attr("data-valid", () => {
      if (position.val() == null) {
        position.next().css("visibility", "visible");
      } else {
        position.next().css("visibility", "hidden");
      }
      return !(position.val() == null) ? 1 : 0;
    });
    country.attr("data-valid", () => {
      if (country.val() == null) {
        country.next().css("visibility", "visible");
      } else {
        country.next().css("visibility", "hidden");
      }
      return !(country.val() == null) ? 1 : 0;
    });
    city.attr("data-valid", () => {
      if (city.val() == null) {
        city.next().css("visibility", "visible");
      } else {
        city.next().css("visibility", "hidden");
      }
      return !(city.val() == null) ? 1 : 0;
    });
    image.attr("data-valid", () => {
      if (image.val() === "") {
        image.next().css("visibility", "visible");
      } else {
        image.next().css("visibility", "hidden");
      }
      return !(image.val() === "") ? 1 : 0;
    });


    if ( name.attr('data-valid') == 1 &&
    surname.attr('data-valid') == 1 &&
    email.attr('data-valid') == 1 &&
    phone.attr('data-valid') == 1 &&
    birthdate.attr('data-valid') == 1 &&
    weight.attr('data-valid') == 1 &&
    height.attr('data-valid') == 1 &&
    agency.attr('data-valid') == 1 &&
    position.attr('data-valid') == 1 &&
    country.attr('data-valid') == 1 &&
    city.attr('data-valid') == 1 &&
    image.attr('data-valid') == 1 ) {
        $("#register-form")[0].submit();
        
    } else {
        console.log(' nooooooooo se va a enviar el formuilario papa')

    }


  });
}

$("#register-form input").change(validarFormulario());
$("#register-form input").blur(validarFormulario());

rellenarFechas();
rellenarPaises();
imageName();
