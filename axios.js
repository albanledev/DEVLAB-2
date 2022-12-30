//On affiche les genres
const containerGenre = document.querySelector('.containerGenre')
axios.get('https://api.themoviedb.org/3/genre/movie/list?api_key=64f788e08bd9e0a43741986b76b23424&language=en-US').then(response => {
    console.log(response.data.genres)
    response.data.genres.forEach(element => {

        containerGenre.innerHTML += " <div class='border-4 w-fit y-[50px] px-4 item bg-white'>" + 
        "<a href='genre.php' id='"+element.id + "> ' alt=''>"+ element.name + "</a>" + 

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

            container.innerHTML += "<div> <div class='border-4 border-indigo-600'>" + 
             
            // '<p>' + 
            "<a href='movie.php' id='"+element.id +"'><img src='https://www.themoviedb.org/t/p/w600_and_h900_bestv2/"  + element.poster_path +  "' alt=''></a>" + 
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
        
   


    





let id = "wallah"
localStorage.setItem("id_film",id)
    
