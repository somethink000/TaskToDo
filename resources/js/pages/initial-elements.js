import { MarkerType } from '@vue-flow/core'

export const initialNodes = [
  {
    id: '1',
    type: 'input',
    data: { label: 'Node 1' },
    position: { x: 250, y: 0 },
    class: 'light',
  },
  {
    id: '2',
    type: 'output',
    data: { label: 'Node 2' },
    position: { x: 100, y: 100 },
    class: 'light',
  },
  {
    id: '3',
    data: { label: 'Node 3' },
    position: { x: 400, y: 100 },
    class: 'light',
  },
  {
    id: '4',
    data: { label: 'Node 4' },
    position: { x: 150, y: 200 },
    class: 'light',
  },
  {
    id: '5',
    type: 'output',
    data: { label: 'Node 5' },
    position: { x: 300, y: 300 },
    class: 'light',
  },
]

export const initialEdges = [
  {
    id: '1',
    source: '1',
    target: '2',
    
  },
  {
    id: '2',
    source: '1',
    target: '3',
    
  },
  {
    id: '3',
    source: '4',
    target: '5',
  },
  {
    id: '4',
    source: '3',
    target: '4',
  },
]
