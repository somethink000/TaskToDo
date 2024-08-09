
async function syncTasksSort(task){

    let url = 'app/controllers/TaskController.php?get='+task.id;
    let response = await fetch(url);
    
    if (response.ok) {

        let json = await response.json();
        let taskData = json[0];
        let list;
        let taskes;

       

        list = document.getElementById('taskbox'+taskData.taskBoxId)//.querySelector('.task_block_list')
        taskes = list.getElementsByTagName("li");
        
        for (var i = 0; i < taskes.length; ++i) {

            let url = 'app/controllers/TaskController.php?updateSort='+taskes[i].id;
            let se = await fetch(
                url, 
            {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(i)
            });
            
           if (!se.ok) {
                alert("Ошибка HTTP: " + response.status);
           }
        }


        let parentList = task.parentNode;
        // console.log(task.parentNode);
        if (taskData.taskBoxId != parentList.parentNode.id.slice(7, 8)) {

            taskes = parentList.getElementsByTagName("li");
            
            for (var i = 0; i < taskes.length; ++i) {

                let url = 'app/controllers/TaskController.php?updateSort='+taskes[i].id;
                let se = await fetch(
                    url, 
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify(i)
                });
                
                if (!se.ok) {
                        alert("Ошибка HTTP: " + response.status);
                }
            }
        } 
        

    } else {
        alert("Ошибка HTTP: " + response.status);
    }

}

async function attachTask( task, target, isload ) {

    let targ;
    
    if (targ = target.querySelector('.task_block_list')) {

        //attaching task after validate & before task features for correct sort
        targ.appendChild(task);

        let url = 'app/controllers/TaskController.php?get='+task.id;
        let response = await fetch(url);

        if (response.ok) {

            let json = await response.json();
            let taskData = json[0];

            if (target.id.slice(7, 8) > 0) {

                if (taskData.current) {
                    
                    taskData.current = false;
                    task.innerHTML = getBoxedTaskHtml(taskData.text);
                }
                let taskboxid = target.id.slice(7, 8);
                if (taskData.taskBoxId != taskboxid) {
                    taskData.taskBoxId = taskboxid;
                }
                
            } else {
                taskData.current = true;
                
                if (taskData.taskBoxId != 0) {
                    if (taskData.done) {
                        taskData.done = false;
                        task.classList.remove('taskcomplete')
                    }

                    let url = 'app/controllers/TaskBoxController.php?get='+taskData.taskBoxId;
                    let response = await fetch(url);

                    if (response.ok) {
                        let json = await response.json();
                        task.innerHTML = getCurrentTaskHtml(json[0].title.slice(0, 3), taskData.text);
                    } else {
                        alert("Ошибка HTTP: " + response.status);
                    }

                }else {
                    task.innerHTML = getCurrentTaskHtml(" ", taskData.text);
                }
            }

            
            if (targ && !isload) {
                
                syncTasksSort(task);
                
                let url = 'app/controllers/TaskController.php?update='+taskData.id;
                await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify(taskData)
                });


                
            }
           

        } else {
            alert("Ошибка HTTP: " + response.status);
        }

    }

    

}





function dragTask(event) {
    // Adding dragging class to task after a delay
    // if (event.target.classList.contains("task")) {
        setTimeout(() => event.target.classList.add("dragging"), 0);
    // }
}

async function dragendTask(event) {
    
    let taskList;
    let task = event.target;

    task.classList.remove("dragging");
   
    syncTasksSort(task);

    if (taskList = task.parentNode.parentNode) {
        

        let url = 'app/controllers/TaskController.php?get='+task.id;
        let response = await fetch(url);

        if (response.ok) {
            
            let json = await response.json();
            let taskData = json[0];
            
            if (taskList.id.slice(7, 8) > 0) {

                if (taskData.current) {

                    taskData.current = false;
                    task.innerHTML = getBoxedTaskHtml(taskData.text);
                }
                let taskboxid = taskList.id.slice(7, 8);
                if (taskData.taskBoxId != taskboxid) {
                    taskData.taskBoxId = taskboxid;
                }
                
            } else {
                taskData.current = true;

                if (taskData.taskBoxId != 0) {
                    if (taskData.done) {
                        taskData.done = false;
                        task.classList.remove('taskcomplete')
                    }

                    
                    let url = 'app/controllers/TaskBoxController.php?get='+taskData.taskBoxId;
                    let boxresponse = await fetch(url);

                    if (boxresponse.ok) {
                        let json = await boxresponse.json();
                        task.innerHTML = getCurrentTaskHtml(json[0].title.slice(0, 3), taskData.text);
                    } else {
                        alert("Ошибка HTTP: " + boxresponse.status);
                    }
                
                }else {
                    task.innerHTML = getCurrentTaskHtml(" ", taskData.text);
                }
            }
            
            let url = 'app/controllers/TaskController.php?update='+taskData.id;
            let upresponse = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(taskData)
            });

            if (!upresponse.ok) {
                alert("Ошибка HTTP: " + upresponse.status);
            }
            

        } else {
            alert("Ошибка HTTP: " + response.status);
        }
    }
}

function dragOverTasklist(event) {

    event.preventDefault();
    const draggingtask = document.querySelector(".dragging");
    // Getting all tasks except currently dragging and making array of them
    let siblings = [...event.target.querySelectorAll(".task:not(.dragging)")];

    // Finding the sibling after which the dragging task should be placed
    let nextSibling = siblings.find(sibling => {
        // console.log();
        return event.clientY + event.target.scrollTop <= sibling.offsetTop + sibling.offsetHeight / 4;
    });

    // let taskbox = (event.target.closest(".task-block"))
    if (!draggingtask.classList.contains("task")) return;
  
    if (nextSibling) {

        event.target.insertBefore(draggingtask, nextSibling);
       
    }else if (event.target.classList.contains("task_block_list")) {
        // taskbox.querySelector('.task_block_list')
        
        event.target.appendChild(draggingtask, nextSibling);
    }


}

function dragEnterTasklist(event) {
    event.preventDefault()
}
