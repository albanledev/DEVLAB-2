

<template>
    <div>
      <h1 class="text-blue-500">Nom de pays</h1>
    </div>
  
    <div :key="index" v-for="(pays, index) in pays">
      <h2 class='font-bold'> {{ pays.name }} </h2><br>
      <p>{{ pays.overview }}</p>
      <div>
      <img :src="`https://www.themoviedb.org/t/p/w300_and_h450_bestv2/` + pays.poster_path" alt="">
    </div>
    </div>
  
  </template>
  
  <!-- <script setup>
  // export default {
  //   name: 'HelloWorld',
  //   mounted(){
  
  //   }}  
  </script> -->
  
  
  <script>
  import axios from "axios"
  
  export default{
    name:"HelloWorld",
    data(){
      return {
        pays:null
      }
    },
    mounted(){
      axios.get('https://api.themoviedb.org/3/tv/popular?api_key=64f788e08bd9e0a43741986b76b23424&language=en-US&page=1')
          .then((response) =>{
            this.pays = response.data.results
            console.log(this.pays)
          })
              // Handling the images here by using picsumImages
          },
  
    }
  
  </script>
  
  <style scoped>
  
  
  </style>
  