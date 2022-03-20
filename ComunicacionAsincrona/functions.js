$(document).ready(function() {



	$("#loadJson").click(function() {

		jQuery.ajax({
			type: "POST",
			url: "scriptJSON.php",
			data: {
				id: $("#textId").val(),
				name: $("#textName").val(),
				action: "loadJson",
			},
			success: function(output) {

				$(".col-md-4").append(output);
				$("#loadJson").prop("disabled", true);

			}
		});

	});


});

$(document).on('click', '#seleccionar', function() {

	$array = [];
	$(this).parent().siblings().each(function() {
		$array.push($(this).attr("id"));
	});

	jQuery.ajax({
		type: "POST",
		url: "scriptJSON.php",
		data: {
			id: $array[0],
			name: $array[1],
			action: "savePokemon",
		},
		success: function(data) {
			$parse = jQuery.parseJSON(data);
			if ($parse['statusCode'] == 200) {
				alert("El registro se ha guardado correctamente.");
			} else {
				alert("El registro no ha podido guardarse o ya existe.");
			}

			$(this).prop("disabled", true);

		}
	});

});

$(document).on('click', '#mostrar', function() {


	jQuery.ajax({
		type: "POST",
		url: "scriptJSON.php",
		datatype: "JSON",
		data: {
			action: "showPokemon",
		},
		success: function(output) {

			alert("La consulta se ha realizado correctamente.");

			var parse = jQuery.parseJSON(output);
			var items = [];

			var table = document.getElementById("table-bordered");
			while(table.hasChildNodes()) {
				table.removeChild(table.firstChild);
			}
			

			for (var i = 0; i < parse.length; i++) {

				$(".table-bordered").append("<tr id='info" + i + "'>");
				$("#info" + i).append("<td>" + parse[i]["id"] + "</td>");
				$("#info" + i).append("<td>" + parse[i]["name"] + "</td>");
				$("#info" + i).append("<button type='button' class='borrar' id='" + parse[i]["id"] + "'> Borrar </button>");
				$(".table-bordered").append("</tr>");

			}



		},
		error: function() {
			alert("La consulta ha sufrido un error.");
		}
	});

});

$(document).on('click', '.borrar', function() {


	jQuery.ajax({
		type: "POST",
		url: "scriptJSON.php",
		data: {
			action: "deletePokemon",
			id: $(this)[0].getAttribute("id"),
		},
		success: function(output) {

			alert("El registro se ha borrado correctamente.");

		}
	});

});