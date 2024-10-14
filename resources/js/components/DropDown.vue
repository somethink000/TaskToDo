<script>

	import { defineComponent } from 'vue';
    import ImageButton from './ImageButton.vue';



	export default defineComponent({
        props: ['image', 'size'],
		components: { ImageButton },
		
	});
</script>


<template>

    <div class="dropdown">
        <ImageButton class="dropbtn" :image="image" :size="size" />
        <div class="dropdown-content">
            <slot />
        </div>
    </div>

</template>

<style>
  
    .dropbtn {
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
        z-index: 1;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        min-width: 100px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 2;

        a {
            padding: 6px 8px;
            flex-direction: row;
            align-items: center;
            text-decoration: none;
            display: flex;

            img{
                margin-right: 10%;
            }
        }
    }

   

    .dropdown-content a:hover {
        background-color: rgb(100, 100, 100);
    }

    .dropdown-content a:active {
        background-color: rgb(150, 150, 150);
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
   
</style>