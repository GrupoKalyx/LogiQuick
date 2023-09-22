const address = "111 Wellington St, Ottawa, ON K1A 0A9, Canada";

fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${address}&key=AIzaSyC-Urqx_Ojb7fna6y25jNl9XeEuHCALwQo`)
.then((response) => {
    return response.json();
}).then(jsonData => {
    console.log(jsonData.results[0].geometry.location); // {lat: 45.425152, lng: -75.6998028}
})
.catch(error => {
    console.log(error);
})

https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyC-Urqx_Ojb7fna6y25jNl9XeEuHCALwQo