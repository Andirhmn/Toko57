function index() {
  let header = document.getElementById('headerJadwal')
  let div = document.createElement('div')
  div.innerHTML = 'ISLAMIC PRAYER TIMES'
  header.appendChild(div)
  
  userLocation()
}

index()

function userLocation() {
  if(!navigator.geolocation) {
    alert('Geolocation tidak didukung di browser anda!')	  
  } else {
    navigator.geolocation.getCurrentPosition(success, error)
  }
}	  

function success(position, data) {
  prayerTimes(position.coords.latitude, position.coords.longitude)
}

function error() {
  prayerTimes(-6.21154400, 106.84517200)

  let body = document.getElementById('bodyJadwal')
  let h5 = document.createElement('h5')
  h5.innerHTML = 'Akses lokasi anda ditolak !! (Default time from Jakarta)'
 
  body.appendChild(h5)
}

function prayerTimes(latitude, longitude) {
  const baseUrl = 'https://api.aladhan.com/v1/calendar?'
  const lat = `latitude=${latitude}`
  const long = `&longitude=${longitude}`
  const method = '&method=11'

  fetch(`${baseUrl}${lat}${long}`)
  .then(data => data.json())
  .then(function(res) {
    let date = new Date()
    let today = date.getDate() - 1
    let data = (res.data[today].timings)
    let timezone = (res.data[today].meta.timezone)
    let readable = (res.data[today].date.readable)

    const tanggal = document.getElementById('tanggal')
    tanggal.innerHTML = readable+' |'

    let body = document.getElementById('bodyJadwal')

    let h5 = document.createElement('h5');
    h5.innerHTML = 'Timezone: '+timezone
    body.appendChild(h5)

    let table = document.createElement('table')
    for(index in data) {
      let row = table.insertRow()
      let name = row.insertCell(0)
      let time = row.insertCell(1)
      name.innerHTML = index 
      time.innerHTML = data[index]

      table.appendChild(row)
    }
    body.appendChild(table)

    let div = document.createElement('div')
    div.innerHTML = 'Semangat, Jangan lupa Sholat &#128519'
    body.appendChild(div)

  })
}

