<script>
export default {
  emits: ['switch'],
  methods: {
    created() {
      this.$emit('switch')
    }
  }
}
</script>

<template>
  <div class="grid grid-cols-1 place-items-center gap-y-6">
    <img src="../../../../assets/icon_user.png" class="w-16 h-16"
         alt="https://www.vecteezy.com/vector-art/3586429-people-icon-user-icon-vector-illustration"/>
    <h1 class="uppercase font-bold text-gray-600 font-sans text-2xl">Inscription</h1>
    <form class="grid grid-cols-1 gap-4 place-items-start" action="/php/index.php" method="POST">
      <input type="text" name="inscription_nom"
             class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white
             bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white
             focus:border-blue-600 focus:outline-none"
             placeholder="Nom"/>

      <input type="text" name="inscription_prenom"
             class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white
             bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white
             focus:border-blue-600 focus:outline-none"
             placeholder="Prénom"/>

      <input type="email" name="inscription_email"
             class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white
             bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white
             focus:border-blue-600 focus:outline-none"
             placeholder="Adresse mail"/>

      <input type="password" name="inscription_mdp"
             class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border
             border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white
             focus:border-blue-600 focus:outline-none"
             placeholder="Mot de passe"/>

      <input type="submit" name="inscription_submit" class="px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug
        uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg
        focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
      <p class="text-sm font-sans mt-2 pt-1 mb-0">
        Vous avez déjà un compte ?
        <span @click="created" class="text-blue-700 hover:text-blue-800 hover:cursor-pointer focus:text-blue-800 transition duration-200 ease-in-out">Connexion</span>
      </p>
    </form>
  </div>
</template>