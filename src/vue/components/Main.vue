<script>

import Map from './body/Map.vue';
import TilePresentation from './body/TilePresentation.vue';
import Titre from './body/Titre.vue';
import FormRecherche from './body/FormRecherche.vue';

export default {
  components: {
    Map,
    TilePresentation,
    FormRecherche,
    Titre
  },
  data() {
    return {
      input: '',
      msg: '',
    }
  },
  methods: {
    rechercher: function () {
      console.log(this.input);
      fetch("https://opendata.paris.fr/api/records/1.0/search/?dataset=restaurants-casvp&q=&refine.code=" + this.input, {
        "method": "GET",
      })
          .then(response => {
            if (response.ok) {
              console.log(response);
              return response.json();
            } else {
              alert("Server returned " + response.status + " : " + response.statusText);
            }
          })
          .then(data => {
            console.log(data);
            let tmp = "";
            console.log("test"); // c
            for (let i = 0; i < data.records.length; i++) {
              console.log(i); // c
              tmp += data.records[i].fields.nom_restaurant + "<br/>";
              console.log(tmp); // c
              this.msg = tmp;
            }
          })
          .catch(err => {
            console.log(err);
          });
    }
  }
}
</script>

<template>
  <div class="mt-28">
    <Titre msg="Bienvenue sur le site !"/>
    <form class="text-center text-2xl" method="post">
      <input v-model="input" class="mx-auto py-0.5 px-4 rounded mt-4" type="text">
      <button @click="rechercher" class="bg-gray-500 hover:bg-neutral-900 text-white font-bold py-1 px-4 rounded mt-4"
              type="button">
        Rechercher un restaurant
      </button>
      <p>{{ msg }}</p>
    </form>
  </div>

  <div class="content lg:flex justify-center mt-4">
    <div class="mx-auto">
      <Map/>
    </div>

    <div class="max-w-2xl w-fulll mx-auto px-4 py-8 grid grid-cols-1 lg:max-w-6xl lg:mr-10
      gap-y-10 gap-x-8 lg:grid-cols-2">
      <TilePresentation/>
      <TilePresentation/>
      <TilePresentation/>
      <TilePresentation/>
      <TilePresentation/>
    </div>
  </div>
</template>
