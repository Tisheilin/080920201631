function remove(id) {
  let body = {id: id};
  sendReq(body, 'remove');
}

function sendReq(body, url = '') {

  fetch('/' + url, {
    method: 'POST',
    cache: 'no-cache',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify(body)
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      let div = document.getElementById('addressList');
      div.innerHTML = "";
      for (let i = 0; i < data.length; i++) {
        const title = document.createElement("div");
        let text = data[i]['city'] + ', ' + data[i]['area'];
        if (data[i]['street']) {
          text = text + ', ' + data[i]['street'];
        }
        if (data[i]['house']) {
          text = text + ', ' + data[i]['house'];
        }
        let divContent =
          `<div class="item">
            <h3>${data[i]['name']}</h3>
            <p>${text}</p>
            <br>`
        if (data[i]['information']) {
          divContent = divContent + `<p>data[i]['information']</p>`
        }
        divContent = divContent + `
            <div class="map"></div>
            <div class="actbox">
              <a href="#" onclick="remove(${data[i]['id']})" class="bcross"></a>
            </div>
          </div>`;
        title.innerHTML = divContent;
        div.appendChild(title);
      }
    })
}

function mapsGeocoding(address) {
  return fetch('https://maps.googleapis.com/maps/api/geocode/json?address=' + address + '&key='+GOOGLE_MAPS_API_KEY)
    .then((data) => {
      return data.json();
    }).then(data => {
      return data.results[0].geometry.location;
    });
}
function initMap() {
  let containerMaps = document.getElementById('addressList');
  let addressesNodes = containerMaps.querySelectorAll('.item');
  addressesNodes.forEach((item) => {
    let mapContainer = item.querySelector('.map');
    let address = item.querySelector('p').innerHTML.trim();
    mapsGeocoding(address).then(geo => {
      // The map, centered at geo
      let map = new google.maps.Map(
        mapContainer, {zoom: 9, center: geo});
      // The marker, positioned at geo
      let marker = new google.maps.Marker({position: geo, map: map});
    });
  });

}
