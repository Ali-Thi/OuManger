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
      console.log("handleNavEvent")
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
  <header class="bg-white fixed top-0 w-full shadow" style="z-index: 1000">
  <Navbar @event="handleNavEvent"/>
  </header>

  <div v-if="this.showModal" class="flex justify-center">
    <div class="fixed absolute top-20 w-auto h-auto z-50">
        <Modal :type="this.typeModal" @close="() => {this.showModal = false}"/>
    </div>
  </div>

  <Main/>
</template>