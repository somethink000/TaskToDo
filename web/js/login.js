

async function tryLogin(event) {

    event.preventDefault();

    let form = event.target;
    let formData = new FormData(form);

    let url = 'app/controllers/AuthController.php?login';
    
    let data = {
        username: "feefef",
        password: "fefefe",
    };
    
    console.log( formData.get('username') );
    console.log( formData.get('password') );

    let response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    });
    
    
    if (response.ok){
        
        let json = await response.json();      
        
        console.log( json);
    }
    
}