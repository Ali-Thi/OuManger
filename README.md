# OùManger?

## Introduction
Ce projet, consultable à partir de l’url https://pj-web-pb.alwaysdata.net/, est un site collaboratif full-stack, hébergé sur AlwaysData, qui affiche des restaurants, avec leurs notes globales et des avis des utilisateurs du site. Nous avons intitulé le site "OùManger?". Comme son nom l’indique, il va, par rapport à une adresse, un code postal, une ville, ou un lieu donnée, et pour un rayon choisi, afficher les restaurants qui se trouvent autour de ce point géographique dans le rayon donné. De plus, tous les utilisateurs connectés ont la possibilité de noter et de laisser un commentaire à chaque restaurant.

## Technologies utilisées
Les framework et librairies ont été installés via Node.js, et le projet développés avec WebStorm et PHPStorm
### Framework et librairies
- PostCSS
- Vite
- Tailwind
- Vue3
### API
- **Nominatim** afin de trouver les coordonnées géographiques d'une adresse, d'un code postal, d'une ville ou d'un lieu
- **Geoapify Places** afin de rechercher les restaurants aux alentours
- **Geoapify Autocomplete** afin de proposer des suggestions de complétion
- **OpenData Paris** afin de compléter les données de *Geoapify Place*, ainsi que respecter la consigne d'utilisation d'open data
### Hébergement et base de données
- **AlwaysData** est un hébergeur gratuit, intégrant une base de données **MySql** au site web hébergé

## Note d'intention
Ce projet a pour but principal la mise en pratique des connaissances théoriques accumulés en TD/TP. Ainsi, c'est pourquoi nous avons, dans un certain sens, délaissé l'ergonomie, le design, et l'UX du site.
