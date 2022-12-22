// const { default: axios } = require("axios")

const getBtn = document.querySelector('#getBtn')
const postBtn = document.querySelector('#postBtn')
const container = document.querySelector('.container')
const getData = () => {
    axios.get('https://api.themoviedb.org/3/movie/popular?api_key=64f788e08bd9e0a43741986b76b23424&language=en-US&page=1').then(response => {
        console.log(response.data.results)
        response.data.results.forEach(element => {
            container.innerHTML += "<div>" + 
            '<h2>' + element.original_title + '</h2>' + 
            '<p>' + element.overview + '</p>' + 
            "<img src='https://www.themoviedb.org/t/p/w600_and_h900_bestv2/"  + element.poster_path +  "' alt=''>" + 
            // "`https://www.themoviedb.org/t/p/w300_and_h450_bestv2/` + pays.poster_path" alt=""
            "</div>"
            
            // container.innerHTML = '<h2>'+element.original_title+'</h2>'+ '<h1>lololo</h1>'
        });
    })
}

getBtn.addEventListener('click', getData);


{/* <div>
<h1 class="text-blue-500">Nom de pays</h1>
</div>

<div :key="index" v-for="(pays, index) in pays">
<h2 class='font-bold'> {{ pays.name }} </h2><br>
<p>{{ pays.overview }}</p>
<div>
<img :src="`https://www.themoviedb.org/t/p/w300_and_h450_bestv2/` + pays.poster_path" alt="">
</div>
</div> */}
    
    
