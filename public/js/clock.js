function clock() {
  let time = new Date()

  let hours = time.getHours()
  let minutes = time.getMinutes()
  let seconds = time.getSeconds()

  hours = ('0' + hours).slice(-2)
  minutes = ('0' + minutes).slice(-2)
  seconds = ('0' + seconds).slice(-2)

  let jam = document.getElementById('jam')
  jam.innerHTML = hours + ' : ' + minutes + ' : ' + seconds

  setTimeout(clock, 500)
}

clock()
