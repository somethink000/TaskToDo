



async function syncTaskBoxesSort(){
    
    let blocks_container = document.getElementById('tasks_place')
    let boxes = blocks_container.querySelectorAll(".task-block");
    
    for (var i = 0; i < boxes.length; ++i) {

        let url = 'app/controllers/TaskBoxController.php?updateSort='+boxes[i].id.slice(7, 8);
        let se = await fetch(
            url, 
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(i)
        });
        
    }
}



function dragTaskBox(event) {
    // Adding dragging class to task after a delay
    setTimeout(() => event.target.classList.add("dragging"), 0);

}

function dragendTaskBox(event) {
    event.target.classList.remove("dragging");

    syncTaskBoxesSort()
}

function dragOverTaskBoxContainer(event) {
    event.preventDefault();
    const draggingtask = document.querySelector(".dragging");
    // Getting all tasks except currently dragging and making array of them
    let siblings = [...event.target.querySelectorAll(".task-block:not(.dragging)")];
    
    // Finding the sibling after which the dragging task should be placed
    let nextSibling = siblings.find(sibling => {
        // console.log();
        return event.clientY + event.target.scrollTop <= sibling.offsetTop + sibling.offsetHeight / 4;
    });

    if (!draggingtask.classList.contains("task-block")) return;

    if (nextSibling) event.target.insertBefore(draggingtask, nextSibling);


}

function dragEnterTaskBoxContainer(event) {
    event.preventDefault()
}
