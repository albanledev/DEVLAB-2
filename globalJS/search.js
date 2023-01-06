// const inputField = document.querySelector('#search-input');

// inputField.addEventListener('input', () => {
//   // Effectuez la recherche et affichez les résultats ici
// });


// const axios = require('axios');

// async function searchMovies(searchTerm) {
//   const apiKey = 'your_api_key';
//   const url = `https://api.themoviedb.org/3/search/movie?api_key=${apiKey}&query=${searchTerm}`;
//   try {
//     const response = await axios.get(url);
//     return response.data.results;
//   } catch (error) {
//     console.error(error);
//   }
// }

// inputField.addEventListener('input', async () => {
//   const searchResults = await searchMovies(inputField.value);
//   // Affichez les résultats de la recherche ici
// });






find()

function find(){
    // Requêter un utilisateur avec un ID donné.

    let str = document.querySelector("#searchbar");
    let propositions = document.querySelector("#submenu");

    if (str.value !== ""){
        axios.get(/* '/user?ID=2' */ 'https://api.themoviedb.org/3/search/movie?api_key=db5946f8d90a2a4716c7c2c3520a77b3&query='+str.value)

            .then(function (response) {
                // en cas de réussite de la requête
                console.log(response.data.results);
                let movie = response.data.results

                propositions.innerHTML = "";

                for (let i = 0; i <= 4; i++) {
                    let result = document.createElement("li");
                    let myLink = "single.php?id="+movie[i].id
                    result.innerHTML = "<p><a href="+myLink+">"+movie[i].original_title+"</a></p>"
                    propositions.appendChild(result);
                }
            })

            .catch(function (error) {
                // en cas d’échec de la requête
                console.log(error);
            })

            .then(function () {
                // dans tous les cas
                console.log("AAAAAAAAA");
            });
    }else{
        propositions.innerHTML = "";
    }

}

