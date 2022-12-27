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
  <ul class="w-full grid grid-rows-1">
    <li v-for="data in this.datas" :key="data.id" class="list-none">
<!--    <li class="list-none">-->
      <TilePresentation :nom="data.text" :adresse="data.adresse" note="3"/>
    </li>
  </ul>
</template>