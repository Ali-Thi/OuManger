<script>

export default {
  emits: ['restaurants'],
  data() {
    return {
      input: '',
      msg: '',
      restaurants: []
    }
  },
  methods: {
    created() {
      this.$emit('restaurants', this.restaurants)
    },

    rechercher: function (e) {
      e.preventDefault()
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
              this.restaurants.push({id: 0,
                nom: element.fields.nom_restaurant,
                adresse: element.fields.adresse + ", " + element.fields.code + ", PARIS",
                coord: element.fields.tt,
                note: '?'
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
            type="submit">
      Rechercher un restaurant
    </button>
    <p>{{ msg }}</p>
  </form>

  <div ref="msg">

  </div>
</template>