<script>
import Commentaire from "./Commentaire.vue";

export default {
  emits: ['closeModal'],
  methods: {
    closeModal() {
      this.$emit('closeModal')
    }
  },
  components: {
    Commentaire
  },
  props: {
    nom: String,
    adresse: String,
    note: Number
  },
  data(){
    return {
      commentaires: []
    }
  },
  mounted(){
    fetch("https://pj-web-pb.alwaysdata.net/php/get_commentaires.php?nom=" + this.nom.toUpperCase() + "&adresse=" + this.adresse.toUpperCase())
        .then(response => {
          if (response.ok) {
            return response.json();
          } else {
            alert("Server returned " + response.status + " : " + response.statusText);
          }
        })
        .then(data => {
          this.commentaires = data;
          console.log(this.commentaires)
        })
        .catch(err => {
          console.log(err);
        });
    }
}
</script>

<template>
  <div @click.self="closeModal" class="fixed top-0 left-0 flex w-screen h-screen bg-black bg-opacity-50 justify-center px-16"
       style="z-index: 1020">
    <div class="bg-white w-full h-fit relative top-20 rounded" style="z-index: 1030">

      <header class="w-full flex flex-row justify-between p-4 shadow-lg mb-4">
        <div>
          <h1 class="text-2xl font-bold mr-4 inline-block align-middle">{{ nom }}</h1>
          <span class="text-2xl font-semibold align-middle">{{ note }}</span>
          <img src="../../../assets/star-icon.png" class="h-5 w-5 align-middle inline-block aspect-square py-auto">
        </div>

        <div>
          <img @click="closeModal" src="../../../assets/close_icon.png" class="w-5 h-5 float-right hover:cursor-pointer my-auto">
        </div>
      </header>

      <ul v-if="commentaires.length > 0" class="w-full flex flex-col">
        <li v-for="cmnt in commentaires" :key="cmnt.id" class="list-none inline-block mb-3 px-4">

          <Commentaire :nom="cmnt.nom" :prenom="cmnt.prenom" :date="cmnt.date" :message="cmnt.commentaire"/>

        </li>
      </ul>

      <p v-else class="text-xl text-center font-thin text-gray-400 mb-4">Aucun commentaire pour le moment. Soyez le premier !</p>

    </div>
  </div>
</template>