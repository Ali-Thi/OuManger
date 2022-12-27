<script>
export default {
  props: {
    nom: String,
    adresse: String,
    note: Number
  }
}
</script>

<template>
  <div class="bg-white px-4 shadow-lg rounded-lg">
    <h1>{{nom}}</h1>
    <p>{{adresse}}</p>
    <p>{{note}}</p>
  </div>
</template>