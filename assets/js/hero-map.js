document.addEventListener('DOMContentLoaded', () => {
  const target = document.getElementById('paper-hero-map');

  if (!target || typeof L === 'undefined') {
    return;
  }

  const center = [37.851111, 112.515833];

  const map = L.map(target, {
    zoomControl: false,
    attributionControl: false,
    scrollWheelZoom: false,
    dragging: true,
    doubleClickZoom: true,
    boxZoom: false,
    keyboard: false,
    tap: true
  }).setView(center, 17);

  L.tileLayer(
    'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
    {
      maxZoom: 19
    }
  ).addTo(map);

  L.marker(center, {
    interactive: false,
    icon: L.divIcon({
      className: 'paper-map-pin',
      html: '<span class="paper-map-pin__ring"></span><span class="paper-map-pin__cross"></span>',
      iconSize: [28, 28],
      iconAnchor: [14, 14]
    })
  }).addTo(map);
});
