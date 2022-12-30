<script>

export default {
  emits: ['restaurants'],
  data() {
    return {
      id: 0,
      input: '',
      msg: '',
      restaurants: []
    }
  },
  methods: {
    created() {
      this.$emit('restaurants', this.restaurants)
    },

    rechercher: function () {
      fetch("https://opendata.paris.fr/api/records/1.0/search/?dataset=restaurants-casvp&q=&refine.code=" + this.input, {
        "method": "GET",
      })
          .then(response => {
            if (response.ok) {
              return response.json();
            } else {
              alert("Server returned " + response.status + " : " + response.statusText);
            }
          })
          .then(data => {
            this.restaurants = []
            data.records.forEach(element =>{
              this.restaurants.push({id: this.id++,
                nom: element.fields.nom_restaurant,
                adresse: element.fields.adresse + ", " + element.fields.code + ", PARIS",
                coord: element.fields.tt,
                note: '?',
                commentaires: []
              })
            })
            this.created()
          })
          .catch(err => {
            console.log(err);
          });
    }
  }
}
</script>

<template>
  <form class="text-center text-2xl" method="post">
    <input v-model="input" class="mx-auto py-0.5 px-4 rounded mt-4" type="text">
    <button @click="rechercher" class="bg-gray-500 hover:bg-neutral-900 text-white font-bold py-1 px-4 rounded mt-4"
            type="button">
      Rechercher un restaurant
    </button>
    <p>{{ msg }}</p>
  </form>

  <div ref="msg">

  </div>
</template>