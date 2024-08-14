


async function createTaskBox(event) {
    var input = document.getElementById("newTaskBoxInput");

    let url = 'app/controllers/TaskBoxController.php?create';
    
    let data = {
        title: input.value,
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
        
        let url = 'app/controllers/TaskBoxController.php?getLast';
        let res = await fetch(url);
        if (res.ok){
            let jsn = await res.json();
            let lastTaskBox = jsn[0]

            event.target.closest(".createTaskbox").remove()
            addTaskBox(lastTaskBox)
            syncTaskBoxesSort()
        }
    }

}

async function removeTaskBox(event) {
    let parentTaskbox = event.target.parentNode.parentNode.parentNode.parentNode
   
        //list = document.getElementById('taskbox'+taskData.taskBoxId)//.querySelector('.task_block_list')
        taskes = parentTaskbox.getElementsByTagName("li");
        
        for (var i = 0; i < taskes.length; ++i) {
            let url = 'app/controllers/TaskController.php?delete='+taskes[i].id;
            await fetch(url);
          
        }

        let url = 'app/controllers/TaskBoxController.php?delete='+parentTaskbox.id.slice(7, 8);
        await fetch(url);

        parentTaskbox.remove();

}

function closeCreateTaskBox(event) {
    
    event.target.closest(".createTaskbox").remove();
}

function forseCreateTask(event){
    
    if (event.key === "Enter") {
        var input = event.target
        var parent = input.parentNode;
        event.preventDefault();


        if (parent.id == 0 ){
            createNewTask(input.value, true, parent.id);
            input.value = "";
        }else{
            createNewTask(input.value, false, parent.id);
            parent.remove();
        }
        
    }
}

function createTaskWindow(event) {
    let parentTaskbox = event.target.parentNode.parentNode.parentNode.parentNode
    let taskBoxId = parentTaskbox.id.slice(7, 8)
    
    

    let taskInput = document.createElement('div');
    taskInput.setAttribute('class', "task_form main-border");
    taskInput.setAttribute('id', taskBoxId);

    taskInput.innerHTML = `
            <input class="task_input" type="text" id="forceTask" placeholder="New task" onkeypress="forseCreateTask(event)">
    `;
   
    parentTaskbox.querySelector(".task-block-name").insertBefore(taskInput, parentTaskbox.querySelector(".dropdown"));
    
}