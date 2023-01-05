<script>

import Map from './body/Map.vue';
import FormRecherche from './body/FormRecherche.vue';
import ListRestaurants from "./body/ListRestaurants.vue";

export default {
  components: {
    Map,
    ListRestaurants,
    FormRecherche
  },
  data() {
    return {
      restaurants: [],
      coords: [],
      rayon: Number
    }
  },
  methods: {
    handleDatas(markers) {
      this.restaurants = markers
      this.restaurants.forEach(element =>
      {
        fetch("https://pj-web-pb.alwaysdata.net/php/get_info_restaurant.php?nom=" + element.nom.toUpperCase() + "&adresse=" + element.adresse.toUpperCase())
            .then(response => {
              if (response.ok) {
                return response.json();
              } else {
                alert("Server returned " + response.status + " : " + response.statusText);
              }
            })
            .then(data => {
              if(data.length === 2 && data[0] === false){
                alert(data[1]);
              } else {
                element.id = data['id']
                element.note = (data['note'] === null) ? '' : data['note']
              }
            })
            .catch(err => {
              console.log(err);
            });
      })
    },
    updateNote(id){
      fetch("https://pj-web-pb.alwaysdata.net/php/get_info_restaurant.php?id=" + id)
          .then(response => {
            if (response.ok) {
              return response.json();
            } else {
              alert("Server returned " + response.status + " : " + response.statusText);
            }
          })
          .then(data => {
            this.restaurants.find((element) => {return element.id === id}).note = data['note']
          })
          .catch(err => {
            console.log(err);
          });
    }
  }
}
</script>

<template>
  <div class="my-8">
    <h1 class="text-white uppercase font-bold text-bold text-center text-4xl">Bienvenue sur le site !</h1>
    <FormRecherche @coords="(coords) => {this.coords = coords}" @rayon="(rayon) => {this.rayon = rayon}" @restaurants="handleDatas"/>
  </div>

  <div class="grid grid-cols-1 grid-rows-3 h-screen gap-y-6 auto-cols-min lg:grid-rows-1 lg:h-2/3 lg:grid-cols-3">
    <div class="mx-auto w-4/5 lg:h-gull rounded row-span-2 lg:row-span-1 lg:col-span-2">
      <Map :coords="this.coords" :rayon="this.rayon" :datas="this.restaurants"/>
    </div>

    <div class="mx-auto px-4 w-full h-full grid grid-cols-1 gap-y-10 gap-x-8 overflow-x-scroll
     md:mr-10 md:overflow-y-scroll">

        <ListRestaurants :datas="this.restaurants" @refreshNotes="updateNote"/>

    </div>
  </div>
</template>
