


async function tryRegister(event) {

    event.preventDefault();

    let form = event.target;
    let formData = new FormData(form);

    let url = 'app/controllers/AuthController.php?login';
    
    let data = {
        username: formData.get('username'),
        password: formData.get('password'),
    };


    try {

        let response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(data)
        });

        let json = await response.json();

        document.cookie = encodeURIComponent("session_id") + '=' + encodeURIComponent(json[0]) + '; expires=' + json[1] + '; path=/'; //expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/

        window.location = 'todo.php';

    } catch {
        
    }
}


async function tryLogin(event) {

    event.preventDefault();

    let form = event.target;
    let formData = new FormData(form);

    let url = 'app/controllers/AuthController.php?login';
    
    let data = {
        username: formData.get('username'),
        password: formData.get('password'),
    };


    try {

        let response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(data)
        });

        let json = await response.json();

        document.cookie = encodeURIComponent("session_id") + '=' + encodeURIComponent(json[0]) + '; expires=' + json[1] + '; path=/'; //expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/

        window.location = 'todo.php';

    } catch {
        
    }
}

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : '';
}


async function checkLogin() {
    
    let sid = getCookie("session_id");
    let url = 'app/controllers/AuthController.php?checklogin='+sid;

    try {
        let response = await fetch(url);
        let json = await response.json();

        document.cookie = encodeURIComponent("session_id") + '=' + encodeURIComponent(json[0]) + '; expires=' + json[1] + '; path=/'; //expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/

        window.location = 'todo.php';

    } catch {
        window.location = 'login.php';
    }
      
       

}