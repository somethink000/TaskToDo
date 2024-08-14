

async function tryLogin(event) {

    event.preventDefault();

    let form = event.target;
    let formData = new FormData(form);

    let url = 'app/controllers/AuthController.php?login';
    
    let data = {
        username: formData.get('username'),
        password: formData.get('password'),
    };

    let response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    });

    
    
    if (response.ok){
        
        let json = await response.json();      
        
        let name = "session_id";
        let value = json;

        document.cookie = encodeURIComponent(name) + '=' + encodeURIComponent(value);

       // console.log(document.cookie);
        
    }
    
}

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
      "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : '';
}


async function checkLogin() {
    
    
    let url = 'app/controllers/AuthController.php?checklogin='+getCookie("session_id");
    let response = await fetch(url);

    if (response.ok) {

        let json = await response.json();
        let user = json[0];

        window.location = 'todo.php';

    }else{
        
        window.location = 'login.php';
    }
}