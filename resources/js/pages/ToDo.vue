<script setup>
  import { markRaw } from 'vue'
  import { Panel, Position, useVueFlow, VueFlow } from '@vue-flow/core'
  import { Background } from '@vue-flow/background'
  import { useNodesStore } from '@/stores/nodes.js'

  import TaskNode from '@/components/nodes/TaskNode.vue'
  import CastomEdge from '@/components/nodes/CastomEdge.vue'
  import ImageButton from '@/components/ImageButton.vue'


  const store = useNodesStore()
  const { edges, nodes, onInit, onNodeDragStop, addNodes, onConnect, addEdges, removeNodes, setViewport, toObject } = useVueFlow()

  const nodeTypes = {
    task: markRaw(TaskNode),
  }

  function loadData() {

    axios.get('/api/nodes')
    .then(res => {

      let nodesData = res.data['nodes'];
      let edgesData = res.data['edges'];
      
      addNodes(nodesData)
      
      addEdges(edgesData)
      
      
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
           
         
        })
    }
    
  })

  function addNode() {

    var form = {
        type: 'task',
        data: { label: " ", description: " " },
        done: false,
        parentNode: '', 
        position: { x: 0, y: 200 }
    };
    

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

    let edge = {
        type: 'button', //smoothstep
        label: '',
        source: connection.source,
        target: connection.target,
    };

    return axios.post('/api/edges', edge, {
        headers: {
            "Content-doubleValuetype": "application/json"
        }
    })
    .then(res => {

        addEdges([res.data])
        //addNodes([res.data])

    })  

  })

</script>

<template>
   
  <!-- :nodes="nodes" :edges="edges"-->
  <VueFlow 
    fit-view-on-init
    class="basic-flow"
    :nodeTypes="nodeTypes"
  >
  

    <Panel position="top-right">
      <div class="buttons">
        <ImageButton @click="addNode()" image="/images/plus.png" size="32" />
      </div>
    </Panel>


    <template #edge-button="buttonEdgeProps">
      <CastomEdge
        :id="buttonEdgeProps.id"
        :source-x="buttonEdgeProps.sourceX"
        :source-y="buttonEdgeProps.sourceY"
        :target-x="buttonEdgeProps.targetX"
        :target-y="buttonEdgeProps.targetY"
        :source-position="buttonEdgeProps.sourcePosition"
        :target-position="buttonEdgeProps.targetPosition"
        :marker-end="buttonEdgeProps.markerEnd"
        :style="buttonEdgeProps.style"
      />
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
