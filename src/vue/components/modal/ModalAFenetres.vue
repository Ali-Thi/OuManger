<script>
import Connexion from "./Connexion.vue"
import Inscription from "./Inscription.vue"

const EnumMode = {connexion: "connexion", inscription: "inscription"}

export default {
  emits: ['closeModal'],
  components: {
    Connexion,
    Inscription
  },
  props: {
    type: EnumMode
  },
  watch: {
    mode() {
      if (this.mode === EnumMode.inscription) {
        this.$refs.boutonInscription.classList = this.classBoutonGenerique + this.classBoutonActif;
        this.$refs.boutonConnexion.classList = this.classBoutonGenerique + this.classBoutonInactif;
      } else {
        this.$refs.boutonInscription.classList = this.classBoutonGenerique + this.classBoutonInactif;
        this.$refs.boutonConnexion.classList = this.classBoutonGenerique + this.classBoutonActif;
      }
    }
  },
  methods: {
    switchModal(e) {
      this.mode = (this.mode === EnumMode.inscription) ? EnumMode.connexion : EnumMode.inscription;
    },
    closeModal(){
      this.$emit('closeModal')
    }
  },
  mounted() {
    this.mode = this.type;
  },
  data() {
    return {
      mode: '',

      classBoutonGenerique: "h-full w-full text-center ",
      classBoutonActif: "border-t-4 border-blue-700",
      classBoutonInactif: "bg-gray-300 hover:cursor-pointer",
    }
  }
}
</script>

<template>
  <div @click.self="closeModal" class="fixed top-0 left-0 flex w-screen h-screen bg-black bg-opacity-50 justify-center" style="z-index: 1020">
    <div class="bg-white w-auto h-auto fixed top-20" style="z-index: 1030">
      <header class="flex flex-row h-8 w-full jusitfy-center">
        <span @click="switchModal" ref="boutonConnexion" class="h-full w-full text-center">Connexion</span>
        <span @click="switchModal" ref="boutonInscription" class="h-full w-full text-center">S'inscrire</span>
      </header>
      <div class="mb-8 pt-2 pr-2">
        <img @click="closeModal" src="../../../assets/close_icon.png" class="w-5 h-5 float-right hover:cursor-pointer">
      </div>


      <div class="px-16 pb-8">
        <Connexion v-if="this.mode === 'connexion'" @switch="switchModal"/>
        <Inscription v-else @switch="switchModal"/>
      </div>
    </div>

  </div>
</template>