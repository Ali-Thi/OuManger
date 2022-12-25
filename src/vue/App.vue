<script>
import Navbar from './components/Navbar.vue'
import Main from './components/Main.vue'
import Modal from './components/modal/Modal.vue';

export default {
  components: {
    Navbar,
    Main,
    Modal,
  }
}

</script>

<template>
  <header class="bg-white fixed top-0 w-full shadow" style="z-index: 1000">
  <Navbar />
  </header>

  <div class="fixed absolute top-20 w-auto h-auto bg-black bg-opacity-0 z-50">
      <Modal type="connexion"/>
  </div>

  <Main/>
</template>