function seleccionarMatchGame(matchgameId) {
    const select_zone = document.getElementById("zoneId");
    const options = [];

    if (matchgameId === "-1") {
        select_zone.innerHTML = "";
    } else {
        fetch("/show/" + matchgameId)
            .then((response) => response.json())
            .then((data) => {
                data.data.map((zone) => {
                    options.push(
                        '<option value="' +
                            zone.zone_id +
                            ' ">' +
                            zone.zone_id +
                            " - " +
                            zone.stadium_location +
                            "</option>"
                    );
                });
                select_zone.innerHTML = options.join("");
            });
    }
}

function editTicketModal(ticketId, zoneId, basePrice, matchgameId) {
    // Actualizar los valores de los campos del modal con los valores del ticket seleccionado
    document.getElementById("zone_id_input").value = zoneId;
    document.getElementById("base_price_input").value = basePrice;
    document.getElementById("matchgame_id_input").value = matchgameId;

    // Actualizar la URL del formulario de edición
    var form = document.getElementById("editTicketForm");
    var formAction = form.getAttribute("action").replace("/0", "");
    console.log(formAction);
    var newFormAction = `${formAction}/${ticketId}`;
    console.log(newFormAction);
    form.setAttribute("action", newFormAction);
}
