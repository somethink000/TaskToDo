<script setup>
  import { ref } from 'vue'
  import { Position, useVueFlow, VueFlow } from '@vue-flow/core'
  import TaskNode from '@/components/nodes/TaskNode.vue'
  import { Background } from '@vue-flow/background'
  import { useNodesStore } from '@/stores/nodes.js'

  const store = useCounterStore()
  const { onInit, onNodeDragStop, onConnect, addEdges, setViewport, toObject } = useVueFlow()

  // const nodes = ref([
  //   {
  //     id: '1',
  //     type: 'task',
  //     data: { label: 'toolbar top ddd dwdw dwdw dwd wdwd w dwdwd wd wdwdwd', toolbarPosition: Position.Top },
  //     position: { x: 200, y: 0 },
  //   },
  //   {
  //     id: '2',
  //     type: 'task',
  //     data: { label: 'toolbar right', toolbarPosition: Position.Right },
  //     position: { x: -50, y: 100 },
  //   },
  // ])

  const edges = ref([
  // {
  //   id: '1',
  //   source: '1',
  //   target: '2',
  //   animated: true,
  // }
  ])

  

  /**
   * onConnect is called when a new connection is created.
   *
   * You can add additional properties to your new edge (like a type or label) or block the creation altogether by not calling `addEdges`
   */
  onConnect((connection) => {
    addEdges(connection)
  })

</script>

<template>
  <VueFlow 
  :nodes="nodes" 
  :edges="edges"
  fit-view-on-init
  class="basic-flow"
  >
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
