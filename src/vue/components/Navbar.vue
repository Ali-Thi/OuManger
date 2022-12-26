<script>
import NavItem from './nav/NavItem.vue';

let id = 1;

export default {
  emits: ['event'],
  methods: {
    created(text){
      const boutonAuteur = this.boutons.find((element) => {return element.text === text})
      if(boutonAuteur.modalType !== "none")
        this.$emit('event', boutonAuteur.modalType)
    }
  },
  components: {
    NavItem,
  },
  data() {
    return {
      boutons: [
        { id: id++, text: 'Login', modalType: "connexion"},
        { id: id++, text: "S'inscrire", modalType: "inscription"},
      ],
    };
  },
};
</script>

<template>
  <nav class=" bg-white max-w-7xl mx-auto font-poppins p-3.5 flex items-center justify-between">
      <span aria-hidden="true" class="text-lg lg:text-xl">
        PJ <strong>WEB</strong>
      </span>
    <ul class="w-full static top-full left-0 text-gray-800 border-gray-200 border-b flex items-center w-min border-none flex-row">
      <li v-for="element in boutons" :key="element.id">
        <NavItem :text="element.text" @event="created"/>
      </li>
    </ul>
  </nav>
</template>
