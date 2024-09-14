
import { defineStore } from 'pinia'
import moment from "moment";

export const useTodoStore = defineStore('todo', {
  state: () => ({
    boxes: new Map([]),
	dates: new Map([]),
  }),
  actions: {
   
    //refresh all taskboxes and dates
    async load_data() {

        // setup dates 
        for (var i = 0; i < 7; ++i) {
					
            var date = moment().add(i, 'days').format('YYYY-MM-DD');//.format('dddd-YYYY-MM-DD') 
            
            this.dates.set( date, {tasks: []});
        }

        //parse data
        axios.get('/api/taskBoxes')
        .then(res => {
            
            var boxesData = res.data
            
            for (var i = 0; i < boxesData.length; ++i) {
                
                this.boxes.set( boxesData[i].id, boxesData[i]);
            
                var box = this.boxes.get(boxesData[i].id);
                
                for (var v = box.tasks.length-1; v >= 0; --v) {
                    var task = box.tasks[v];
                    
                    if (task.planed_at != null) {
                        
                        if (moment(task.planed_at) == null) {
                            task.planed_at = moment.unix(task.planed_at).format('YYYY-MM-DD');
                        }

                        
                        // console.log(moment(task.planed_at));
                        console.log(moment(task.planed_at));
                        console.log(moment(task.planed_at, 'YYYY-MM-DD'));
                        console.log(moment(task.planed_at, 'YYYY-MM-DD').isBefore(moment(), 'day'));

                        // var lesToday = moment(task.planed_at, 'YYYY-MM-DD').isBefore(moment(), 'day');
                        var lesToday = moment(task.planed_at).isBefore(moment(), 'day');

                        if (lesToday) {
                            if(task.done){
                                
                                continue;
                            }

                            task.dedline = true;
                            this.dates.get(moment().format('YYYY-MM-DD')).tasks.push(task);
                            box.tasks.splice(v, 1);
                        }else{
                            this.dates.get(task.planed_at).tasks.push(task);
                            box.tasks.splice(v, 1);
                            

                            // TODO think about this >>
                            
                            // task.planed_at = null;
                            // task.done = false;
                            // this.compliteTask(task, i);
                        }
                        
                    }
                }

                box.tasks.sort(function (a, b) {
                    return a.sort_id - b.sort_id;
                });
            }

        })
    },


    async delete_taskbox(id) {
        axios.delete('/api/taskBoxes/' + id)
        .then(res => {
            if (res.data) {
                this.boxes.delete(id);
            } else {
                
            }
        })
    },


    async create_task(form) { 
        
        return axios.post('/api/tasks', form, {
            headers: {
                "Content-type": "application/json"
            }
        })
        .then(res => {

            var data = res.data;
            if (data) {
                
                var tasks = this.boxes.get(form.taskbox_id).tasks
                tasks.unshift(data);
                this.update_tasks_sort(form.taskbox_id);

                return data;
            } else {
                
            }
        })  
    },


    async update_tasks_sort(boxId){
                
        var tasks = this.boxes.get(boxId).tasks

        for (var i = 0; i < tasks.length; ++i) {
            tasks[i].sort_id = i;
        }

        axios.post('/api/tasks/update_sort', tasks, {
            headers: {
                "Content-type": "application/json"
            }
        })
        .then(res => {
            if (res.data) {
                
            } else {
                
            }
        })
    },

    async unpin_task(task, index) {

        var tasks = this.dates.get(task.planed_at).tasks

        task.planed_at = null;
        this.boxes.get(task.taskbox_id).tasks.unshift(task);
        tasks.splice(index, 1);
        this.update_task(task);
    },

    async update_task(taskData) {
               
        axios.patch('/api/tasks/' + taskData.id, taskData, {
            headers: {
                "Content-type": "application/json"
            }
        })
        .then(res => {
            if (res.data) {
        
            } else {  }
        })
    },

    async delete_task(task, sortId) {

        var tasks = this.boxes.get(task.taskbox_id).tasks

        axios.delete('/api/tasks/' + task.id)
        .then(res => {
            if (res.data) {
                tasks.splice(sortId, 1);
            } else {
                
            }
        })
    },

    async complite_task(task, index) {

        var tasks = this.boxes.get(task.taskbox_id).tasks

        task.done = !task.done;

        if (index < tasks.length){

            if (task.done) {

                for (var i = index+1; i < tasks.length; ++i) {
                    
                    //Add on the first done row if this done
                    if(tasks[i].done == true){
                        var oldPlace = index;
                        var newPlace = i;

                        var t = tasks.splice(oldPlace,1);
                        //после того как удалите элемент из массива, у него изменится длина
                        tasks.splice(newPlace-1,0,t[0]);
                        
                        break;
                    }
                    //no doned tasks fix
                    else if ( i == tasks.length-1) {
                        var oldPlace = index;
                        var newPlace = i;

                        var t = tasks.splice(oldPlace,1);
                        tasks.push(t[0]);
                    }
                }
            }else{

                //Add on the first row of task box
                var t = tasks.splice(index,1);
                tasks.unshift(task);
            }
        }

        this.update_task(task).then(() => {

            this.update_tasks_sort(task.taskbox_id);

        });
        
    },


  },
  getters: {
    currentBoxes: (state) => state.boxes,
    currentDates: (state) => state.dates,
    getBox: (state)=> {
        return (boxId) => state.boxes.get(boxId);
    },
    getDateBox: (state)=> {
        return (date) => state.dates.get(date);
    }
    
  },
})
