<script setup>
  import { ref } from 'vue'
  import { Panel, Position, useVueFlow, VueFlow } from '@vue-flow/core'
  import TaskNode from '@/components/nodes/TaskNode.vue'
  import { Background } from '@vue-flow/background'
  import { useNodesStore } from '@/stores/nodes.js'

  const store = useNodesStore()
  const { nodes, onInit, onNodeDragStop, addNodes, onConnect, addEdges, setViewport, toObject } = useVueFlow()

  //const nodes = ref([{ id: '1', data: { label: 'Node 1' }, position: { x: 100, y: 100 } }])
  const edges = store.getEdges


  function loadData() {

    axios.get('/api/nodes')
    .then(res => {
      console.log(res.data);
      for (var i = 0; i < res.data.length; ++i) {
          
          let nodeData = res.data[i];
          
          addNodes([nodeData])
      }
    })
  }

  onNodeDragStop(({ event, nodes, node }) => {


    for (var i = 0; i < nodes.length; ++i) {
          
        let node = nodes[i];
      

        return axios.patch('/api/nodes/' + node.id, node, {
            headers: {
                "Content-type": "application/json"
            }
        })
        .then(res => {
           
          console.log(res.data);
            
        })
    }
    
  })

  function addNode() {

    var form = {
        type: 'task',
        data: { label: 'make america great again', description: "Vote for obamna" },
        done: false, 
        position: { x: 0, y: 200 }
    };
   
    // store.create_node(form)

     return axios.post('/api/nodes', form, {
            headers: {
                "Content-doubleValuetype": "application/json"
            }
        })
        .then(res => {


            addNodes([res.data])
  
        })  
    
  }

  loadData();

  onConnect((connection) => {
    addEdges(connection)
  })

</script>

<template>
   
  <!-- :nodes="nodes" :edges="edges"-->
  <VueFlow 
    fit-view-on-init
    class="basic-flow"
  >
    <!-- <button class="colItem main-border" @click="addNode()">add TaskNode</button> -->


    <Panel position="top-right">
      <div class="buttons">
        <button title="save graph" @click="addNode()">Add</button>
      </div>
    </Panel>


    <template #node-task="props">
      <TaskNode v-bind="props"/>
    </template>

   
    <Background pattern-color="#aaa" :gap="16" />

   
  </VueFlow>

  

</template>

<style>

.basic-flow.dark {
    background:#2d3748;
    color:#fffffb
}

.basic-flow {
    /* background:#a7a7a7; */
    background:#2d3748;
    color:#fffffb
}

.vue-flow__node-toolbar {
  display: flex;
  gap: 0.5rem;
  align-items: center;
  background-color: #2d3748;
  padding: 8px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.vue-flow__node-toolbar button {
  background: #4a5568;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  cursor: pointer;
}

.vue-flow__node-toolbar button.selected {
  background: #2563eb;
}

.vue-flow__node-toolbar button:hover {
  background: #2563eb;
}

</style>
