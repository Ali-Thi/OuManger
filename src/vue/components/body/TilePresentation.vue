<script>

import ListCommentaires from "../modal/ListCommentaires.vue";
import Note from "../body/Note.vue";

export default {
  emits: ['refreshNotes'],
  components: {
    ListCommentaires,
    Note
  },
  props: {
    idRestaurant: Number,
    nom: String,
    adresse: String,
    note: Number
  },
  data(){
    return {
      showCommentModal: false
    }
  }
}
</script>

<template>
  <ListCommentaires v-if="this.showCommentModal" :idRestaurant="idRestaurant" :nom="nom" :adresse="adresse" :note="note" @refreshNotes="(id) => {this.$emit('refreshNotes', id)}" @closeModal="() => {this.showCommentModal = false}"/>
  <div class="bg-white shadow-lg rounded-lg w-full h-fit flex flex-col">

    <header class="w-full flex flex-row justify-between align-center px-4 py-2 basis-1/3 shadow-lg">
      <h1 class="place-self-start font-semibold">{{ nom }}</h1>
      <div class="place-self-end">
        <Note>{{ note }}</Note>
      </div>
    </header>

    <div class="m-4 lg:flex lg:justify-between">
      <div>
        <img class="h-6 inline-block" src="../../../../assets/location_icon.png"
             alt="https://www.vecteezy.com/vector-art/362767-location-vector-icon">
        <span>{{ adresse }}</span>
      </div>
      <button @click="() => {this.showCommentModal = true}"
              class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
        Notez
      </button>
    </div>

  </div>
</template>