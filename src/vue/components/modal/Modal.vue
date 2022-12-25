<script>
import Connexion from "./Connexion.vue"
import Inscription from "./Inscription.vue"

const EnumMode = {connexion: "connexion", inscription: "inscription"}

export default {
  components: {
    Connexion,
    Inscription
  },
  props: {
    type: EnumMode
  },
  watch: {
    mode(){
      if(this.mode === EnumMode.inscription) {
        this.$refs.boutonInscription.classList = this.classBoutonGenerique + this.classBoutonActif;
        this.$refs.boutonConnexion.classList = this.classBoutonGenerique + this.classBoutonInactif;
      }
      else {
        this.$refs.boutonInscription.classList = this.classBoutonGenerique + this.classBoutonInactif;
        this.$refs.boutonConnexion.classList = this.classBoutonGenerique + this.classBoutonActif;
      }
    }
  },
  methods: {
    switchModal(e) {
      this.mode = (this.mode === EnumMode.inscription) ? EnumMode.connexion : EnumMode.inscription;
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
  <div class="bg-white w-full h-full">
    <header class="flex flex-row h-8 w-full jusitfy-center mb-8">
      <span @click="switchModal" ref="boutonConnexion" class="h-full w-full text-center">Connexion</span>
      <span @click="switchModal" ref="boutonInscription" class="h-full w-full text-center">S'inscrire</span>
    </header>

    <div class="px-16 pb-8">
      <Connexion v-if="this.mode === 'connexion'"/>
      <Inscription v-else/>
    </div>

  </div>
</template>