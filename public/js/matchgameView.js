const deleteMatchgame = (matchgameId) => {
    console.log(matchgameId);
    fetch("/matchgames/delete/" + matchgameId, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then((response) => response.json())
        .then((response) => {
            console.log(response);
        });
};
