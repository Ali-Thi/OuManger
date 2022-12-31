<script>
import TilePresentation from "./TilePresentation.vue";
export default {
  components: {
    TilePresentation
  },
  props: {
    datas: []
  }
}
</script>

<template>
  <ul class="w-full grid grid-rows-1 auto-cols-max grid-flow-col md:grid-cols-1 md:grid-flow-row gap-3">
    <li v-for="data in this.datas" :key="data.id" class="list-none mb-5 md:mb-0 inline-block">
      <TilePresentation :idRestaurant="data.id" :nom="data.nom" :adresse="data.adresse" :note="data.note"/>
    </li>
  </ul>
</template>