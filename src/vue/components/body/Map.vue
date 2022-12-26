<script>
import "leaflet/dist/leaflet.css";
import L from 'leaflet'
export default {
  mounted() {
    this.mymap = L.map('map').setView([48.866295694987045, 2.3440361022949223], 13);
    L.tileLayer('http://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(this.mymap);
    console.log("fin mount Map")
  },
  data() {
    return {
      mymap: Object,
    }
  }
}
</script>

<template>
  <div id="map" class="w-full h-4/5"></div>
</template>
