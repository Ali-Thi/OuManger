<script>
import NavButton from './nav/NavButton.vue';

let id = 1;

export default {
  emits: ['logSignIn', 'logOut'],
  methods: {
    handleEvents(text){
      if(text === 'logOut'){
        this.$emit('logOut')
      }
      else {
        const boutonAuteur = this.boutons.find((element) => {
          return element.text === text
        })
        if (boutonAuteur.modalType !== "none")
          this.$emit('logSignIn', boutonAuteur.modalType)
      }
    }
  },
  props: {
    connecte: Boolean
  },
  components: {
    NavButton,
  },
  data() {
    return {
      boutons: [
        { id: id++, text: 'Login', modalType: "connexion"},
        { id: id++, text: "S'inscrire", modalType: "inscription"},
      ],
    };
  }
};
</script>

<template>
  <nav class="bg-white max-w-7xl mx-auto font-poppins p-3.5 flex items-center justify-between">
      <span aria-hidden="true" class="text-lg lg:text-xl">
        PJ <strong>WEB</strong>
      </span>
    <div v-if="connecte">
      <slot class="inline-block"></slot>
      <img src="../../assets/exit_icon.png" class="w-5 h-5 mx-3 inline-block hover:cursor-pointer"
           alt="https://www.vecteezy.com/vector-art/575503-logout-sign-icon"
           @click="handleEvents('logOut')"
      />
    </div>
    <ul v-else class="w-full static top-full left-0 text-gray-800 border-gray-200 border-b flex items-center w-min border-none flex-row">
      <li v-for="element in boutons" :key="element.id">
        <NavButton :text="element.text" @openModal="handleEvents"/>
      </li>
    </ul>
  </nav>
</template>
