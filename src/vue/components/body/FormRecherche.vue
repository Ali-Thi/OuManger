<script>

export default {
  data() {
    return {
      input: '',
      msg: this.$refs.msg,
    }
  },
  methods: {
    rechercher: function () {
      console.log(this.input);
      /*      this.responseAvailable = false;
            fetch("https://opendata.paris.fr/api/records/1.0/search/?dataset=restaurants-casvp&q=&refine.code=" + this.input, {
              "method": "GET",
            })
                .then(response => {
                  if (response.ok) {
                    return response.json()
                  } else {
                    alert("Server returned " + response.status + " : " + response.statusText);
                  }
                })
                .then(response => {
                  let tmp = "";
                  console.log("test"); // c
                  for (let i = 0; i < response.records.length; i++) {
                    console.log(i); // c
                    tmp += response.records[i].fields.nom_restaurant + "<br/>";
                    console.log(tmp); // c
                    msg.html(tmp);
                    this.responseAvailable = true;
                  }
                })
                .catch(err => {
                  console.log(err);
                });*/
    }
  }
}
</script>

<template>

  <form class="text-center text-2xl">
    <input class="mx-auto py-0.5 px-4 rounded mt-4" type="text"
           v-model="input">
    <button class="bg-gray-500 hover:bg-neutral-900 text-white font-bold py-1 px-4 rounded mt-4" type="button">
      Rechercher un restaurant
    </button>
  </form>
    <div ref="msg">

    </div>
</template>