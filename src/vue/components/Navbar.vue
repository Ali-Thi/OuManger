<script>
import NavItem from './nav/NavItem.vue';

let id = 1;

export default {
  components: {
    NavItem,
  },
  data() {
    return {
      boutons: [
        { id: id++, text: 'Login', modal: '', lien: '' },
        { id: id++, text: "S'inscrire", modal: '', lien: '' },
        { id: id++, text: 'Contact', modal: '', lien: '' },
      ],
    };
  },
};
</script>

<template>
  <nav
    id="main-nav"
    class="
      bg-white
      max-w-7xl
      mx-auto
      font-poppins
      p-3.5
      flex
      items-center
      justify-between
    "
  >
    <a href="top" class="flex" aria-label="Page d'accueil du portfolio">
      <span aria-hidden="true" class="text-lg lg:text-xl">
        PJ <strong>WEB</strong>
      </span>
    </a>
    <ul
      id="toggled-menu"
      class="
        w-full
        static
        top-full
        left-0
        text-gray-800
        border-gray-200 border-b
        flex
        items-center
        w-min
        border-none
        flex-row
      "
    >
      <li v-for="element in boutons" :key="element.id">
        <NavItem
          :text="element.text"
        />
      </li>
    </ul>
  </nav>
</template>
