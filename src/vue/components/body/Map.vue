<script>
import L from 'leaflet'

export default {
  props: {
    coords: [],
    datas: [],
    rayon: Number
  },
  data() {
    return {
      map: Object,
      markers: [],
      circle: Object
    }
  },
  mounted() {
    this.map = L.map('map').setView([48.866295694987045, 2.3440361022949223], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      zoomAnimation: false,
      maxZoom: 19,
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(this.map);
  },
  watch: {
    coords: {
      deep: true,
      handler(){
      this.map.setView(this.coords, 12-this.rayon/10);
      }
    },
    datas: {
      deep: true,
      handler() {
        this.markers.forEach(marker => {
          this.map.removeLayer(marker)
        })

        this.datas.forEach(element => {
          const marker = L.marker(element.coord, {riseOnHover: true}).addTo(this.map)
          const popup = L.popup().setContent(
              '<strong>' + element.nom + '</strong>' +
              '<span style="margin-left: 1rem">' + element.note + '</span>' +
              '<img src="/assets/star-icon-e38ac0a3.png" alt="https://www.vecteezy.com/vector-art/82125-star-vectors" style="display: inline-block; height: 1.25rem; width: 1.25rem;">' +
              '<p>' + element.adresse + '</p>');
          marker.bindPopup(popup);
          this.markers.push(marker);
        })
      }
    }
  }
}
</script>

<template>
  <div id="map" class="w-full h-full"></div>
</template>
