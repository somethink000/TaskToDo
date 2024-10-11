
import { defineStore } from 'pinia'
import moment from "moment";
import { Position, useVueFlow, VueFlow } from '@vue-flow/core'


export const useNodesStore = defineStore('nodes', {
  state: () => ({
    nodes: [ ],
	edges: [ ],
    // {
    //   id: '1',
    //   source: '1',
    //   target: '2',
    //   animated: true,
    // }
  }),
  actions: {
   
    //refresh all nodes
    async load_data() {
       
        axios.get('/api/nodes')
        .then(res => {
            
            this.nodes = res.data
            console.log(res.data)
        })
    },


    async delete_nodebox(id) {
        axios.delete('/api/nodeBoxes/' + id)
        .then(res => {
            if (res.data) {
                this.boxes.delete(id);
            } else {
                
            }
        })
    },


    async create_node(form) { 

        
       
        // this.nodes.unshift(form);
        
        // console.log(this.nodes);

        return axios.post('/api/nodes', form, {
            headers: {
                "Content-doubleValuetype": "application/json"
            }
        })
        .then(res => {

            var data = res.data;
            if (data) {
                
                console.log(data);
                // addNodes([form])

                // var nodes = this.boxes.get(form.nodebox_id).nodes
                // nodes.unshift(data);
                // this.update_nodes_sort(form.nodebox_id);

                return data;
            } else {
                
            }
        })  
    },


    async update_nodes_sort(boxId){
                
        var nodes = this.boxes.get(boxId).nodes

        for (var i = 0; i < nodes.length; ++i) {
            nodes[i].sort_id = i;
        }

        axios.post('/api/nodes/update_sort', nodes, {
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

    async unpin_node(node, index) {

        var nodes = this.dates.get(node.planed_at).nodes

        node.planed_at = null;
        this.boxes.get(node.nodebox_id).nodes.unshift(node);
        nodes.splice(index, 1);
        this.update_node(node);
    },

    async update_node(nodeData) {
               
        axios.patch('/api/nodes/' + nodeData.id, nodeData, {
            headers: {
                "Content-type": "application/json"
            }
        })
        .then(res => {
            if (res.data) {
        
            } else {  }
        })
    },

    async delete_node(node, sortId) {

        var nodes = this.boxes.get(node.nodebox_id).nodes

        axios.delete('/api/nodes/' + node.id)
        .then(res => {
            if (res.data) {
                nodes.splice(sortId, 1);
            } else {
                
            }
        })
    },

    async complite_node(node, index) {

        var nodes = this.boxes.get(node.nodebox_id).nodes

        node.done = !node.done;

        if (index < nodes.length){

            if (node.done) {

                for (var i = index+1; i < nodes.length; ++i) {
                    
                    //Add on the first done row if this done
                    if(nodes[i].done == true){
                        var oldPlace = index;
                        var newPlace = i;

                        var t = nodes.splice(oldPlace,1);
                        //после того как удалите элемент из массива, у него изменится длина
                        nodes.splice(newPlace-1,0,t[0]);
                        
                        break;
                    }
                    //no doned nodes fix
                    else if ( i == nodes.length-1) {
                        var oldPlace = index;
                        var newPlace = i;

                        var t = nodes.splice(oldPlace,1);
                        nodes.push(t[0]);
                    }
                }
            }else{

                //Add on the first row of node box
                var t = nodes.splice(index,1);
                nodes.unshift(node);
            }
        }

        this.update_node(node).then(() => {

            this.update_nodes_sort(node.nodebox_id);

        });
        
    },


    },
    getters: {
        getNodes: (state) => state.nodes,
        getEdges: (state) => state.edges,

        // getBox: (state)=> {
        //     return (boxId) => state.boxes.get(boxId);
        // },
        
    },
})
