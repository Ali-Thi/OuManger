<script>
import Navbar from './components/Navbar.vue'
import Main from './components/Main.vue'
import ModalAFenetres from './components/modal/ModalAFenetres.vue';
import {computed} from "vue";

export default {

  provide() {
    return {
      // explicitly provide a computed property
      connecte: computed(() => this.connecte)
    }
  },
  components: {
    Navbar,
    Main,
    ModalAFenetres,
  },
  methods: {
    showConnectionModal(text){
      this.showModal = true
      this.typeModal = text.toLowerCase()
    },
    deconnection(){
      this.connecte = false;
      this.nom = '';
      this.prenom = ''
      fetch("https://pj-web-pb.alwaysdata.net/php/logOut.php")
    }
  },
  mounted(){
    fetch("https://pj-web-pb.alwaysdata.net/php/session_access.php")
        .then(response => {
          if (response.ok) {
            return response.json();
          } else {
            alert("Server returned " + response.status + " : " + response.statusText);
          }
        })
        .then(data => {
          if(data !== null && data[0] !== false) {
            this.connecte = true;
            this.nom = data[0];
            this.prenom = data[1];
          } else if(data[0] === false){
            alert(data[1])
          }
        })
        .catch(err => {
          console.log(err);
        });
  },
  data(){
    return{
      showModal: false,
      typeModal: '',
      connecte: false,
      nom: '',
      prenom: ''
    }
  }
}

</script>

<template>
  <header class="bg-white top-0 w-full shadow" style="z-index: 1001">
  <Navbar :connecte="connecte" @openModal="showConnectionModal" @logOut="deconnection">{{nom.toUpperCase() + " " + prenom}}</Navbar>
  </header>

  <div v-if="this.showModal">
        <ModalAFenetres :type="this.typeModal" @closeModal="() => {this.showModal = false}"/>
=  </div>

  <div class="lg:h-full">
    <Main/>
  </div>
</template>