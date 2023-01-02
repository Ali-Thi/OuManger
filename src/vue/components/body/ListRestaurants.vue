<script>
import TilePresentation from "./TilePresentation.vue";
export default {
  emits: ['refreshNotes'],
  components: {
    TilePresentation
  },
  props: {
    datas: []
  }
}
</script>

<template>
  <ul class="w-full h-fit grid grid-rows-1 auto-cols-max grid-flow-col md:grid-cols-1 md:grid-flow-row gap-x-3 md:gap-y-3">
    <li v-for="data in this.datas" :key="data.id" class="list-none mb-3 md:mb-0 inline-block h-fit">
      <TilePresentation :idRestaurant="data.id" :nom="data.nom" :adresse="data.adresse" :note="data.note" @refreshNotes="(id) => {this.$emit('refreshNotes', id)}"/>
    </li>
  </ul>
</template>