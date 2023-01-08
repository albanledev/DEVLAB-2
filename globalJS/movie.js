const containerMovie = document.querySelector('.containerMovie')

// on récupère ici l'id dans l'url du film
let queryString = window.location.search;  // Get the query string from the URL
let params = new URLSearchParams(queryString);  // Create a URLSearchParams object from the query string
let paramValue = params.get('id');  // Get the value of the 'paramName' query parameter
console.log(paramValue)

axios.get(`https://api.themoviedb.org/3/movie/${paramValue}?api_key=64f788e08bd9e0a43741986b76b23424&language=en-US`).then(response => {

let dataArray = [response.data];  // Convert response.data to an array

    console.log(response.data)
    // console.log(dataArray)
    dataArray.forEach(element => {

        containerMovie.innerHTML =     "<h1 class='my-[30px] mx-[20px] font-poppins font-semibold text-[20px] text-orange-500'>" + element.title + '</h1>' + `<div class='lg:flex'><img class="w-[400px] lg:w-[400px] my-[40px] object-cover rounded-[9px] mx-[20px] sm:w-[500px]" src="https://image.tmdb.org/t/p/w500${element['backdrop_path']}" alt=''>` +

        '<p class="flex items-center mx-[20px] text-white">'+element.overview+'</p></div>'+
        "<div class='bg-orange-500 w-fit px-4 rounded-2xl m-auto'><div class='w-cover h-6 bg-orange-500  text-white my-6' ><i>Avis<i></div>"+
        "<div class='flex justify-center'><span class=' w-[50px] h-[50px] inline-block text-[50px]'> "+ element['vote_average'] +"/10</span><br><br>"+
        "<div class='flex justify-center'>pour " + element['vote_count'] + " personnes qui ont voté</div><div></div>"

// console.log(element['backdrop_path'])
// console.log(element)

        // `<img src="https://api.themoviedb.org/3/movie/${paramValue}${element['poster_path']}" alt=''>`

        // +
        // + 
        // `<a href='movie.php?id=${element.id}'><img src='https://www.themoviedb.org/t/p/w600_and_h900_bestv2/${element.poster_path}' alt=''></a>`+
        // // "`https://www.themoviedb.org/t/p/w300_and_h450_bestv2/` + pays.poster_path" alt=""
        // "</div>"
        // container.innerHTML = '</div>'

        // container.innerHTML = '<h2>'+element.original_title+'</h2>'+ '<h1>lololo</h1>'
    });
    // console.log(document.querySelectorAll("div.container > div"))

    });