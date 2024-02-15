function myPass() {
  var pass = document.getElementById('inputPass');
  var view = document.getElementById('viewPass');

  if(pass.type === 'password') {
    pass.type = 'text'
    view.innerHTML = 'visibility_off'
  } else {
    pass.type = 'password'
    view.innerHTML = 'visibility'
  }
}

function myPassConfirm() {
  var pass = document.getElementById('inputPassConfirm');
  var view = document.getElementById('viewPassConfirm');

  if(pass.type === 'password') {
    pass.type = 'text'
    view.innerHTML = 'visibility_off'
  } else {
    pass.type = 'password'
    view.innerHTML = 'visibility'
  }
}
