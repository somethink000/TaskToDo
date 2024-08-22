


async function tryRegister(event) {

    event.preventDefault();

    let form = event.target;
    let formData = new FormData(form);

    let data = {
        username: formData.get('username'),
        password: formData.get('password'),
    };

    

    try {

        let url = 'app/controllers/AuthController.php?register';

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
        
        // .then(
        //     function(response) {
        //       //https://httpstatuses.com/422
        //       if (response.status === 422) {
        //         return Promise.reject(response.json());
        //       }
        //       //check for other things that could have gone wrong
        //       return response.json();
        //     }
        //   ).then(
        //     function(json) {
        //       console.log("received success json",json)
        //     }
        //     ,function(json) {
        //       console.log("received reject json",json)
        //     }
        //   )
          
        // php>>  http_response_code(422);
        // php>> echo json_encode(array("error" => "missing field", "field" => "email"));
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
       // window.location = 'login.php';
    }
      
       

}

// async function openLogin() {
    
    
    
// }