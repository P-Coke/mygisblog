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

  L.control.zoom({
    position: 'bottomright'
  }).addTo(map);

  const NorthControl = L.Control.extend({
    options: {
      position: 'topright'
    },
    onAdd() {
      const container = L.DomUtil.create('div', 'paper-map-north-control');
      container.innerHTML = '<span class="paper-map-north-control__arrow" aria-hidden="true"></span><span class="paper-map-north-control__label">北</span>';
      L.DomEvent.disableClickPropagation(container);
      L.DomEvent.disableScrollPropagation(container);
      return container;
    }
  });

  new NorthControl().addTo(map);

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
