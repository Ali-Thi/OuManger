<script>

export default {
  emits: ['restaurants'],
  data() {
    return {
      input: '',
      listSuggestions: [],
      inputFocus: false,
      msg: '',
      apiKey: '99980416dac743c597689a95b89879cd',
      restaurants: []
    }
  },
  mounted() {
    this.$refs.input.addEventListener('focusin', () => {
      this.inputFocus = true
    })
    this.$refs.input.addEventListener('focusout', () => {
      this.inputFocus = false
    })
  },
  watch: {
    input() {
      if (this.input == '') {
        this.listSuggestions = []
      } else {
        fetch("https://api.geoapify.com/v1/geocode/autocomplete?text=" + this.input + "&lang=fr&limit=5&filter=countrycode:fr&format=json&apiKey=99980416dac743c597689a95b89879cd")
            .then(response => {
              if (response.ok) {
                return response.json();
              } else {
                alert("Server returned " + response.status + " : " + response.statusText);
              }
            })
            .then(data => {
              this.listSuggestions = data.results
            })
            .catch(err => {
              console.log(err);
            });
      }
    }
  },
  methods: {
    emitDatas() {
      this.$emit('restaurants', this.restaurants)
    },

    rechercher(e) {
      e.preventDefault()

      fetch("https://nominatim.openstreetmap.org/search?q=" + this.input + "&addressdetails=1&format=json&limit=1")
          .then(response => {
            if (response.ok) {
              return response.json();
            } else {
              alert("Server returned " + response.status + " : " + response.statusText);
            }
          })
          .then(data => {
            fetch("https://api.geoapify.com/v2/places?categories=catering.restaurant&apiKey=" + this.apiKey + "&filter=circle:" + data[0].lon + "," + data[0].lat + ",10000")
                .then(response => {
                  if (response.ok) {
                    return response.json();
                  } else {
                    alert("Server returned " + response.status + " : " + response.statusText);
                  }
                })
                .then(data => {
                  console.log(data)
                  this.restaurants = []
                  data.features.forEach(element => {
                    this.restaurants.push({
                      id: 0,
                      nom: element.properties.name,
                      adresse: element.properties.address_line2,
                      rue: element.properties.street,
                      codePostal: element.properties.postcode,
                      ville: element.properties.city,
                      pays: element.properties.country,
                      coord: [element.properties.lat, element.properties.lon],
                      note: ''
                    })
                  })
                  this.emitDatas()
                })
                .catch(err => {
                  console.log(err);
                });

          })
          .catch(err => {
            console.log(err);
          });

      /*fetch("https://opendata.paris.fr/api/records/1.0/search/?dataset=restaurants-casvp&q=&refine.code=" + this.input, {
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
                note: ''
              })
            })
            this.emitDatas()
          })
          .catch(err => {
            console.log(err);
          });*/
    },


  }
}
</script>

<template>
    <form class="relative flex flex-row justify-center text-center text-2xl" autocomplete="off" method="post">
      <div class="flex grow-0 items-start h-fit mx-auto mt-4">
        <input ref="input" v-model="input" type="search" class="py-0.5 px-4 rounded-l inline-block focus:border-hidden focus:ring-hidden active:border-hidden active:ring-hidden">
        <img src="../../../assets/search-icon.png" alt="https://www.vecteezy.com/vector-art/633234-search-icon-symbol-sign"
             class="rounded-r h-9 bg-white hover:cursor-pointer inline-block"
             @click="rechercher">
        <input ref="btnSubmit" @click="rechercher" type="submit" class="hidden">
      </div>

      <ul v-if="this.listSuggestions.length > 0 && this.inputFocus"
          class="absolute top-full w-full mt-2 bg-white rounded list-none" style="z-index: 1010">
        <li v-for="suggestion in this.listSuggestions" :key="this.listSuggestions.indexOf(suggestion)"
            class="px-3 w-full text-start border-b-2 hover:bg-gray-200"
            @click="() => {
              this.input=suggestion.address_line1 + ', ' + suggestion.state + ', ' + suggestion.country
              this.$refs.btnSubmit.click()
            }">
          <span class="text-lg"><strong>{{ suggestion.address_line1 }}</strong></span>
          <span class="font-normal text-sm text-gray-600 italic">, {{ suggestion.state }}, {{ suggestion.country }}</span>
        </li>
      </ul>
    </form>
</template>