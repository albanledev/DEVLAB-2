// // on affiche la barre input pour rechercher les movies

// // const inputField = document.querySelector('#search-input');

// inputField.addEventListener('input', () => {
//     // Effectuez la recherche ici
//   });



// // async function searchMovies(searchTerm) {
// //     const url = `https://api.themoviedb.org/3/search/movie?api_key=64f788e08bd9e0a43741986b76b23424&query=${searchTerm}`;
// //     try {
// //       const response = await axios.get(url);
// //       console.log(response.data.results);
// //     } catch (error) {
// //       console.error(error);
// //     }
// //   }



// const inputField = document.querySelector('#search-input');

// inputField.addEventListener('input', () => {
//     // Effectuez la recherche ici
//   });

//   const movieSearch = document.querySelector('.movieSearch')
//   axios.get(`https://api.themoviedb.org/3/search/movie?api_key=64f788e08bd9e0a43741986b76b23424&query=ava`).then(response => {
//       console.log(response.data.results)
//       response.data.results.forEach(element => {
  
//           movieSearch.innerHTML += " <div class='px-[10px] mt-[20px]'>" +
//           `<a href='genre.php?id=${element.id}'> ${element.title}</a>` + 
//           // `<a href='movie.php?id=${element.id}'><img src='https://www.themoviedb.org/t/p/w600_and_h900_bestv2/${element.poster_path}' alt=''></a>`
  
//           "</div>"
  
//       });

//     })
  















//On affiche les genres
const containerGenre = document.querySelector('.containerGenre')
axios.get('https://api.themoviedb.org/3/genre/movie/list?api_key=64f788e08bd9e0a43741986b76b23424&language=en-US').then(response => {
    console.log(response.data.genres)
    response.data.genres.forEach(element => {

        containerGenre.innerHTML += " <div class='px-[10px] mt-[20px]'>" +
        `<a href='genre.php?id=${element.id}'> ${element.name}</a>` + 
        // `<a href='movie.php?id=${element.id}'><img src='https://www.themoviedb.org/t/p/w600_and_h900_bestv2/${element.poster_path}' alt=''></a>`

        "</div>"

    });

})


// const { default: axios } = require("axios")

const getBtn = document.querySelector('#getBtn')
const postBtn = document.querySelector('#postBtn')
const container = document.querySelector('.container')
// const getData = () => {
    axios.get('https://api.themoviedb.org/3/movie/popular?api_key=64f788e08bd9e0a43741986b76b23424&language=en-US&page=1').then(response => {
        console.log(response.data.results)
        response.data.results.forEach(element => {

            container.innerHTML += "<div> <div class='ml-[4px] w-[145px] h-[250px] '>" +


             
            // <a href="article.php?articles_id=<?php echo $image['articles_id']?>"><div class="container <?php echo $image['articles_theme']?>"><img src="<?php echo $image["articles_image"] ?>" alt="<?php $image["articles_titre"]?>" class="img_blog nb6 im_jaune"><div class="text"><h3 class="B<?php echo $image['articles_theme'] ?>"><?php echo $image["articles_titre"]?></h3></div></div></a>


//Version qui marche
            // "<a href='movie.php?id='"+element.id +"'><img src='https://www.themoviedb.org/t/p/w600_and_h900_bestv2/"  + element.poster_path +  "' alt=''></a>" 

            `<a href='movie.php?id=${element.id}&name=${element.title}&bin=${element.poster_path}'><img class='object-cover rounded-[10px] ' src='https://www.themoviedb.org/t/p/w600_and_h900_bestv2/${element.poster_path}' alt=''></a>`
            + 
            // "`https://www.themoviedb.org/t/p/w300_and_h450_bestv2/` + pays.poster_path" alt=""
            "</div>"
            // container.innerHTML = '</div>'

            // container.innerHTML = '<h2>'+element.original_title+'</h2>'+ '<h1>lololo</h1>'
        });
        // console.log(document.querySelectorAll("div.container > div"))
        
        
       

        // response.data.results.forEach(item => {
            // console.log(item)
            // item.addEventListener('click',function(){
            //     console.log('issou')
            //  localStorage.setItem("id_film",item.id)

            // //     var filmId = item.id
            // //     console.log(filmId)
            // })
            
        });
        
   


    





    
