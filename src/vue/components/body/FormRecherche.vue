<script>

export default {
  emits: ['restaurants', 'coords', 'rayon'],
  data() {
    return {
      input: '',
      listSuggestions: [],
      showListSuggestions: false,
      msg: '',
      apiKey: '99980416dac743c597689a95b89879cd',
      restaurants: [],
      rayon: 5
    }
  },
  watch: {
    input() {
      if (this.input === '') {
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
    rechercher(e) {
      e.preventDefault()
      this.showListSuggestions = false
      this.restaurants = []

      fetch("https://nominatim.openstreetmap.org/search?q=" + this.input + "&addressdetails=1&format=json&limit=1")
          .then(response => {
            if (response.ok) {
              return response.json();
            } else {
              alert("Server returned " + response.status + " : " + response.statusText);
            }
          })
          .then(coord => {
            this.$emit('coords', [coord[0].lat, coord[0].lon])
            this.$emit('rayon', this.rayon)
            fetch("https://api.geoapify.com/v2/places?categories=catering.restaurant&apiKey=" + this.apiKey + "&filter=circle:" + coord[0].lon + "," + coord[0].lat + "," + this.rayon*1000)
                .then(response => {
                  if (response.ok) {
                    return response.json();
                  } else {
                    alert("Server returned " + response.status + " : " + response.statusText);
                  }
                })
                .then(data => {
                  data.features.forEach(element => {
                    this.restaurants.push({
                      id: 0,
                      nom: element.properties.name,
                      adresse: element.properties.address_line2,
                      coord: [element.properties.lat, element.properties.lon],
                      note: ''
                    })
                  })

                  fetch("https://opendata.paris.fr/api/records/1.0/search/?dataset=restaurants-casvp&q=&refine.code=" + coord[0].address['postcode'])
                      .then(response => {
                        if (response.ok) {
                          return response.json();
                        } else {
                          alert("Server returned " + response.status + " : " + response.statusText);
                        }
                      })
                      .then(data => {
                        data.records.forEach(element =>{
                          if(this.restaurants.find((restaurant) => {restaurant.coord === element.fields.tt}) === undefined) {
                            this.restaurants.push({
                              id: 0,
                              nom: element.fields.nom_restaurant,
                              adresse: element.fields.adresse.replaceAll(",", "") + ", " + element.fields.code + ", PARIS",
                              coord: element.fields.tt,
                              note: ''
                            })
                          }
                        })
                        this.$emit('restaurants', this.restaurants)
                        })
                      .catch(err => {console.log(err);})
                })
                .catch(err => {
                              console.log(err);
                            });
          })
          .catch(err => {
            console.log(err);
          });
    }
  }
}
</script>

<template>
  <form class="text-center text-2xl flex justify-center items-center space-x-4" autocomplete="off" method="post">
    <div class="relative" style="z-index: 1010">
      <div class="flex items-start h-fit mx-auto mt-4">
        <input v-model="input" type="search" class="py-0.5 px-4 rounded-l inline-block" @focus="() => {this.showListSuggestions = true}">
        <img src="../../../../assets/search-icon.png" @click="rechercher" class="h-9 bg-white hover:cursor-pointer inline-block">
        <select v-model="rayon" class="border-none h-9 rounded-r">
          <option value="5">5km</option>
          <option value="10">10km</option>
          <option value="15">15km</option>
          <option value="20">20km</option>
          <option value="25">25km</option>
          <option value="30">30km</option>
        </select>
      </div>

      <ul v-if="this.listSuggestions.length > 0 && this.showListSuggestions"
          class="absolute top-full w-full mt-2 bg-white rounded list-none">
        <li v-for="suggestion in this.listSuggestions" :key="this.listSuggestions.indexOf(suggestion)"
            class="px-3 w-full text-start border-b-2 hover:bg-gray-200 hover:cursor-pointer"
            @click="() => {
              this.input=suggestion.address_line1 + ', ' + suggestion.state + ', ' + suggestion.country
              this.$refs.btnSubmit.click()
            }">
          <span class="text-lg"><strong>{{ suggestion.address_line1 }}</strong></span>
          <span class="font-normal text-sm text-gray-600 italic">, {{ suggestion.state }}, {{ suggestion.country }}</span>
        </li>
      </ul>
    </div>

    <div v-if="this.listSuggestions.length > 0 && this.showListSuggestions" class="fixed top-0 left-0 h-screen w-screen" style="z-index: 1001" @click="() => {this.showListSuggestions = false}"></div>

    <input ref="btnSubmit" @click="rechercher" type="submit" class="hidden">
  </form>
</template>