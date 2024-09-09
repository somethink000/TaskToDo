
import { defineStore } from 'pinia'
import moment from "moment";

export const useTodoStore = defineStore('todo', {
  state: () => ({
    boxes: new Map([]),
	dates: new Map([]),
  }),
  actions: {
   
    async load_data() {

        console.log("ddw");
        // setup dates 
        for (var i = 0; i < 7; ++i) {
					
            var date = new Date((new Date()).valueOf() + (1000*i)*3600*24);
            console.log(moment().add(i, 'days'))
            console.log(moment().format('dddd'))
            
            date = date.toLocaleDateString();
            
            this.dates.set( date, {tasks: []});
        }

        //parse data
        axios.get('/api/taskBoxes')
        .then(res => {
            
            var boxesData = res.data
            
            for (var i = 0; i < boxesData.length; ++i) {
                
                this.boxes.set( boxesData[i].id, boxesData[i]);
            
                var box = this.boxes.get(boxesData[i].id);
                var today = new Date();

                
                for (var v = box.tasks.length-1; v >= 0; --v) {
                    var task = box.tasks[v];
                    
                    
                    if (task.planed_at != null) {

                        //Set Date from php timestamp
                        task.planed_at = new Date(task.planed_at * 1000).toLocaleDateString();
                        //.format('dddd'))//.format("YYYY-MM-DD"));
                    
                        var lesToday = new Date(task.planed_at) < new Date(today.toLocaleDateString());

                        if (lesToday) {
                            if(task.done){
                                continue;
                            }
                            task.dedline = true;
                            this.dates.get(today.toLocaleDateString()).tasks.push(task);
                            box.tasks.splice(v, 1);
                        }else{
                            this.dates.get(task.planed_at).tasks.push(task);
                            box.tasks.splice(v, 1);
                        }
                    
                    }
                }

                box.tasks.sort(function (a, b) {
                    return a.sort_id - b.sort_id;
                });
            }

        })

    },




  },
  getters: {
    currentBoxes: (state) => state.boxes,
    currentDates: (state) => state.dates,
  },
})
