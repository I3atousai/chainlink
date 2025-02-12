let box_amount = getCookie('box_amount');
console.log(box_amount);



let list_button_id = 'box_users_show_';

let list_div_id = 'box_users_';

function toggleVisibility(box_number) {
  
  let element = document.getElementById('box_users_' + box_number);
    if (element.style.display === 'none') {
        element.style.display = 'block';
    } else {
        element.style.display = 'none';
    }
}
console.log(list_div_id);

// let show_list = document.getElementById('box_users_show_1').onclick = toggleVisibility();

function clearLocalStorage() {
  localStorage.clear();
  
  // location.reload();
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
