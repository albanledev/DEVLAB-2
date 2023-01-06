
    


    chercherMovie()

    function chercherMovie(){

        let str = document.querySelector("#searchbar");
        let propositions = document.querySelector("#submenu");

        str.addEventListener("keyup", function(){
            if (str.value !== ""){
                axios.get('https://api.themoviedb.org/3/search/movie?api_key=db5946f8d90a2a4716c7c2c3520a77b3&query='+str.value)
    
                    .then (response => {
    

                        console.log(response.data.results);

                        let movie = response.data.results
                        
                        propositions.innerHTML = "";
    
                        for (let i = 0; i <= 4; i++) {
                            let resultat = document.createElement("li");
                            let myLink = "movie.php?id="+movie[i].id+"&name=" + movie[i].title + "&bin=" + movie[i]['poster_path']
                            resultat.innerHTML = "<div class='flex'><img class='w-auto h-[50px]'src='https://www.themoviedb.org/t/p/w600_and_h900_bestv2"+ movie[i].poster_path+"' alt>"+ "<div>                    <p><a href="+myLink+">"+movie[i].original_title+"</a></p></div></div>"
                            propositions.appendChild(resultat);
                        }
                    })

            }else{
                propositions.innerHTML = "";
            }
    
        })
        }
    
      



