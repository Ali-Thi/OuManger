<script>
export default {
  props: {
    nom: String,
    prenom: String,
    date: Date,
    message: String
  }
}
</script>

<template>
    <div class="flex m-2 mb-4">
    <div class="flex-shrink-0 mr-3">
        <img class="mt-2 w-8 h-8 sm:w-10 sm:h-10" src="../../../assets/icon_user.png" alt="">
      </div>
      <div class="flex-1 border rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
        <strong>{{ nom.toUpperCase() + " " + prenom.charAt(0).toUpperCase() + prenom.substring(1).toLowerCase()}}</strong> <span class="text-xs text-gray-400">{{ date }}</span>

        <p class="text-sm">{{message}}</p>
      </div>
    </div>
</template>