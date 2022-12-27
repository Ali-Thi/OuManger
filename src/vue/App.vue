<script>
import Navbar from './components/Navbar.vue'
import Main from './components/Main.vue'
import Modal from './components/modal/Modal.vue';

export default {
  components: {
    Navbar,
    Main,
    Modal,
  },
  methods: {
    handleNavEvent(text){
      this.showModal = true
      this.typeModal = text.toLowerCase()
    }
  },
  data(){
    return{
      showModal: false,
      typeModal: ''
    }
  }
}

</script>

<template>
  <header class="bg-white top-0 w-full shadow" style="z-index: 1001">
  <Navbar @event="handleNavEvent"/>
  </header>

  <div v-if="this.showModal">
    <div @click.self="() => {this.showModal = false}" class="fixed top-0 left-0 flex w-screen h-screen bg-black bg-opacity-50 justify-center" style="z-index: 1020">
        <Modal :type="this.typeModal" @close="() => {this.showModal = false}"/>
    </div>
  </div>

  <div class="lg:h-full">
    <Main />
  </div>
</template>