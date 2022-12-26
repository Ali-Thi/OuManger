<script>
import Connexion from "./Connexion.vue"
import Inscription from "./Inscription.vue"

const EnumMode = {connexion: "connexion", inscription: "inscription"}

export default {
  emits: ['close'],
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
    created() {
      this.$emit('close')
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
    <div class="bg-white w-auto h-full">
      <header class="flex flex-row h-8 w-full jusitfy-center">
        <span @click="switchModal" ref="boutonConnexion" class="h-full w-full text-center">Connexion</span>
        <span @click="switchModal" ref="boutonInscription" class="h-full w-full text-center">S'inscrire</span>
      </header>
      <div class="mb-8 pt-2 pr-2">
        <img @click="created" src="../../../assets/close_icon.png" class="w-5 h-5 float-right hover:cursor-pointer">
      </div>


      <div class="px-16 pb-8">
        <Connexion v-if="this.mode === 'connexion'" @switch="switchModal"/>
        <Inscription v-else @switch="switchModal"/>
      </div>

    </div>
</template>