function seleccionarMatchGame(matchgameId) {
    const select_zone = document.getElementById('zone_id');
    const options = [];

    if(matchgameId === '-1'){
        select_zone.innerHTML = '';
    }
    else{
        fetch('/show/'+matchgameId)
            .then(response => response.json())
            .then((data) => {
                data.data.map((zone)=>{
                    options.push('<option value="'+ zone.zone_id+' ">'+zone.zone_id+' - ' +zone.stadium_location+'</option>');
                });
                select_zone.innerHTML = options.join('');
            });
    }

}
