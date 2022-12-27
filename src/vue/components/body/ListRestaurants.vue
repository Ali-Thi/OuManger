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
  <ul class="w-full flex flex-col">
    <li v-for="data in this.datas" :key="data.id" class="list-none inline-block mb-3">
      <TilePresentation :nom="data.text" :adresse="data.adresse" :note="data.note"/>
    </li>
  </ul>
</template>