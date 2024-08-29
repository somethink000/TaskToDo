
<script lang="ts">
	import { defineComponent } from 'vue';
    import axios from 'axios';

    import BaseLine from './BaseLine.vue';
    import ImageButton from './ImageButton.vue';

	export default defineComponent({

		components: {BaseLine, ImageButton},

        data: () => ({
            form: {
                title: "",
                userId: 0,
                sortid: 0
            },
        }),
        methods: {
			
            

			store() {
				console.log(this.form);
				axios.post('/api/taskBoxes', this.form, {
					headers: {
						"Content-type": "application/json"
					}
				})
				.then(res => {
					if (res.data) {
						console.log(res.data);
					} else {
						console.log(res.data);
					}
				})
			}
		}
	});
</script>


<template>

    <createTaskbox>
        <createBox class="main-border bl-box">

            <taskboxCreateFormHead>
                <ttl>Create new taskbox</ttl>
                <ImageButton @click="$emit('someEvent')" image="/images/cross.png" size="32"/>
            </taskboxCreateFormHead>

            <BaseLine />

            <taskCreateFormBox>

                <taskForm>
                    <input class="main-border" v-model="form.title" type="text" id="newTaskBoxInput"  placeholder="Task box name">
                </taskForm>

                <button class="main-border bl-box" @click.prevent="store()">
                    <txt>Create</txt>
                </button>

            </taskCreateFormBox>

        </createBox>
    </createTaskbox>
</template>

<style>
   
    createTaskbox{
        display: flex;
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(20, 20, 20, 0.3);
        background-size: 100%; 
        background-repeat: repeat-y;
        backdrop-filter: blur(5px);
        justify-content: center;
        align-items: center;
        

        createBox{
            display: flex;
            border-radius: 10px;
            width: 400px;
            height: 400px;
            padding: 20px;
            flex-direction: column;
        

            taskboxCreateFormHead{
                display: flex;
                margin-top: 10px;
                /* flex-direction: row; */
                justify-content: space-between;
                align-items: center;
            }
            taskCreateFormBox{
                display: flex;
                height: 100%;
                padding: 10px;
                flex-direction: column;
                align-items: center;

                taskForm{
                    display: flex;
                    width: 100%;
                    margin-top: 30px;
                }

                button{
                    margin-top: 30px;
                }
            }
    }
   
}

</style>
