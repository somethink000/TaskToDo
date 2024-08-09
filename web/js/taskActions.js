
async function createNewTask(title, curr, box) {

    
    
   // globalThis.tasksDataController.createTask(title, curr, box).then(() => {
    let url = 'app/controllers/TaskController.php?create';
    
    let data = {
        text: title,
        current: curr,
        taskBoxId: box,
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
        
        let url = 'app/controllers/TaskController.php?getLast';
        let res = await fetch(url);
        if (res.ok){
            let jsn = await res.json();
            let newtask = jsn[0]
            addTask(newtask, newtask.taskBoxId);
        }
    }
        
}
  

function createTaskForBox(event) {
    
    var input = document.getElementById("newTaskBoxInput");
    var taskBox = event.target.closest(".createTaskbox")
    
    createNewTask(input.value, false, taskBox.id)
    taskBox.remove();
}

function forceCurrent( event ) {
    let parentTask = event.target.parentNode.parentNode
    attachTask(parentTask, document.getElementById("taskbox0"), false)
}



async function checkTask(event) {
    let parentTask = event.target.parentNode.parentNode
    
    let url = 'app/controllers/TaskController.php?get='+parentTask.id;
    let response = await fetch(url);

    if (response.ok) {

        let json = await response.json();
        let taskData = json[0];

        if (taskData.done) {
            
            taskData.done = false;
            parentTask.classList.remove('taskcomplete')
            
            let url = 'app/controllers/TaskController.php?update='+taskData.id;
            await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(taskData)
            });

        } else {

            taskData.done = true;
            parentTask.classList.add('taskcomplete')

            let url = 'app/controllers/TaskController.php?update='+taskData.id;
            let res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(taskData)
            });

            if (res.ok){
                if (taskData.current) {
                    
                    if (taskData.taskBoxId != 0) {
                        attachTask(parentTask, document.getElementById("taskbox" + taskData.taskBoxId), false)
                    }
                }
            }
            
        }

    } else {
        alert("Ошибка HTTP: " + response.status);
    }


}



async function removeTask(event) {
    let parentTask = event.target.parentNode.parentNode

    let url = 'app/controllers/TaskController.php?delete='+parentTask.id;
    let response = await fetch(url);
    if(response.ok){
        
        parentTask.remove();
    }
  

}






