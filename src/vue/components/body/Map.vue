<script>
import "leaflet/dist/leaflet.css";
import L from 'leaflet'
export default {
  props: {
    datas: []
  },
  mounted() {
    this.mymap = L.map('map').setView([48.866295694987045, 2.3440361022949223], 12);
    L.tileLayer('http://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(this.mymap);

    this.datas.forEach(element => {
      const marker = L.marker(element.coord, {riseOnHover: true}).addTo(this.mymap);
      const popup = L.popup().setContent('<strong>' + element.text + '</strong><p>' + element.adresse + '</p>');
      console.log(marker)
      marker.bindPopup(popup);
    })
  },
  data() {
    return {
      mymap: Object,
      markers: []
    }
  },
  watch: {
    datas(newVal){
      this.markers.forEach(marker => {
        marker.remove(this.mymap);
      })

      newVal.forEach(element => {
        const marker = L.marker(element.coord, {riseOnHover: true}).addTo(this.mymap)
        const popup = L.popup().setContent(
            '<strong>' + element.text + '</strong>' +
            '<span style="margin-left: 1rem">' + element.note + '</span>' +
            '<img src="/src/assets/star-icon.png" style="display: inline-block; height: 1.25rem; width: 1.25rem;">' +
            '<p>' + element.adresse + '</p>');
        marker.bindPopup(popup);
        this.markers.push(marker);
      })
    }
  }
}
</script>

<template>
  <div id="map" class="w-full h-full"></div>
</template>
