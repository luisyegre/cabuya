<script setup>
import Layout from '../Layout.vue'
import PostView from './Components/PostView.vue'
import HeartIcon from '../../Icons/Heart.vue'
import HeartCrackIcon from '../../Icons/HeartCrack.vue'
import {ref} from 'vue'
import { Head, Link } from '@inertiajs/vue3'


defineProps({ 
    user: Object,
})
const posts = ref([
    {
        body:"Lorem, ipsum, dolor dolores ajaja.",
        reactions_count:10,
        user:{
            name: "Pepe"
        },
        created_at:new Date().toDateString()
    },
    {
        body:"Lorem, ipsum, dolor dolores ajaja.",
        reactions_count:5,
        user:{
            name: "Pepe"
        },
        created_at:new Date().toDateString()
    },
    {
        body:"Lorem, ipsum, dolores ajaja.dolores ajaja.",
        reactions_count:0,
        user:{
            name: "Lolo"
        },
        created_at:new Date().toDateString()
    }
])
</script>

<template>
    <Layout title="Home" :posts="posts">
        <template #main>
            <div class="create">
                <span class="post-username">{{posts[0].user.name}}</span>
                <form class="form-publish" >
                    <textarea class="create-input" placeholder="¿En que piensas?" name="body"></textarea>
                    <button type="submit">Publicar</button>
                </form>
            </div>
            <div v-for="post,i in posts" class="post-container">
                <div class="post">
                    <div class="header">
                        <span class="post-username">{{post.user.name}}</span> <span class="post-date">22 de julio del 2023</span>
                    </div>
                    <div class="body">
                        {{post.body}} asdlkj
                    </div>
                    <div class="footer">
                        <div class="reactions">
                            <button class="react-button">
                                <heart-icon color="red"/>
                                <heart-crack-icon color="red"/>
                            </button>
                             <span class="reactions-count">{{post.reactions_count}}</span>
                        </div>
                    </div> 
                </div>                  
            </div>   
        </template>        
    </Layout>
</template>
<style>
.create{
    border-bottom: 1.5px solid var(--primary);
    padding: .5em;
}
.form-publish{
    margin-top:1em;
    display: flex;
    flex-direction: column;
}
.form-publish .create-input{
    background-color: transparent;
    font-size: .8em;
    color: var(--text-color);
    border: none;
    outline: none;
    width: 100%;
    border-bottom: 1.5px solid var(--primary);
}
.form-publish button{
    color: black;
    border-radius: 1em;
    border: 0;
    outline: 0;
    font-size: .8em;
    padding: .4em;
    width: 40%;
    max-width: 10em;
    margin-top: .5em;
    background-color: var(--primary);
    margin-left: auto;
}

.post{
    margin:.5em;
}
.header {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
}
.post-date {
    opacity: 30%;
    font-size: .6em;
}
.post-username {
    font-weight: bold;
    font-size: .8em;
    color: var(--primary);
    padding: .2em .5em;
    border-radius:.8em;
    border:1.5px solid var(--primary);
}
.post .body{
    margin: 1em;
}
.post-container{
    border-bottom: 1.5px solid var(--primary);
}
.reactions{
/*    margin-top:.5em;*/
    display: flex;
    align-items: center;
    gap: .5em;
    margin-left:1em;
}
.react-button{
    border: none;
    background-color: transparent;
    font-size: 1em;
    cursor: pointer;
}

</style>