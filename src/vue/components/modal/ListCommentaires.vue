<script>
import Commentaire from "./Commentaire.vue";
import Note from "../body/Note.vue";

export default {
  emits: ['closeModal', 'refreshNotes'],
  inject: ['connecte'],
  methods: {
    closeModal() {
      this.$emit('closeModal')
    },
    updateComments(){
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
          })
          .catch(err => {
            console.log(err);
          });
    },
    postComments(e){
      e.preventDefault()

      fetch("https://pj-web-pb.alwaysdata.net/php/insert_commentaire.php",{
        method: "POST",
        body: JSON.stringify({
          note: document.getElementsByName('note')[0].value,
          commentaire: document.getElementsByName('commentaire')[0].value,
          idRestaurant: document.getElementsByName('idRestaurant')[0].value
        })
      })
          .then(response => {
        if (response.ok) {
          this.$emit('refreshNotes', this.idRestaurant)
          this.$refs.formCommentaire.reset()
          this.updateComments()
        } else {
          alert("Server returned " + response.status + " : " + response.statusText);
        }
      })
    }
  },
  components: {
    Note,
    Commentaire
  },
  props: {
    idRestaurant: Number,
    nom: String,
    adresse: String,
    note: Number
  },
  data() {
    return {
      commentaires: [],
      connecte: this.connecte
    }
  },
  mounted() {
    this.updateComments()
  }
}
</script>

<template>
  <div @click.self="closeModal"
       class="fixed py-20 top-0 left-0 flex w-screen h-screen bg-black bg-opacity-50 justify-center md:px-48 sm:px-3"
       style="z-index: 1020">
    <div class="bg-white w-full h-fit relative rounded" style="z-index: 1030">

      <header class="w-full h-50 flex flex-row justify-between p-4 shadow-lg mb-4">
        <div>
          <h1 class="text-2xl font-bold mr-4 inline-block align-middle">{{ nom }}</h1>
          <Note>{{ note }}</Note>
        </div>

        <div>
          <img @click="closeModal" src="../../../../assets/close_icon.png"
               class="w-5 h-5 float-right hover:cursor-pointer my-auto">
        </div>
      </header>

      <div v-if="commentaires.length > 0" class="w-full h-80 overflow-y-scroll">
      <ul ref="listComms" class="flex flex-col">
        <li v-for="cmnt in commentaires" :key="cmnt.id" class="list-none inline-block mb-3 px-4">
          <Commentaire :nom="cmnt.nom" :prenom="cmnt.prenom" :date="cmnt.date" :message="cmnt.commentaire" :note="cmnt.note"/>
        </li>
      </ul>
      </div>

      <p v-else class="text-xl text-center font-thin text-gray-400 mb-4">Aucun commentaire pour le moment. Soyez le
        premier !</p>

      <footer class="h-fit p-4" style="box-shadow: 0px 0px 15px gray;">
        <form v-if="connecte" ref="formCommentaire" :onsubmit="postComments" method="post" class="flex h-full flex-col space-y-3 justify-start md:flex-row md:justify-between md:space-x-4 lg:flex-row lg:justify-between lg:space-x-4 ">

          <input name="idRestaurant" :value="this.idRestaurant" type="hidden">

          <div class="flex flex-row mr-4">
            <select name="note" class="h-fit w-fit mr-1 my-auto">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <img src="../../../../assets/star-icon.png" class="h-5 w-5 self-center aspect-square">
          </div>

          <textarea type="text" name="commentaire" class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white
             bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white
             focus:border-blue-600 focus:outline-none" placeholder="Racontez nous votre expérience."></textarea>
          <input type="submit" name="submit" class="px-7 py-3 h-fit my-auto bg-blue-600 text-white font-medium text-sm leading-snug
        uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg
        focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">

        </form>
        <p v-else class="text-xl text-center font-medium text-gray-400 my-auto">Veuillez vous connecter afin de pouboir laisser votre avis.</p>
      </footer>
    </div>
  </div>
</template>