<script setup>
import Layout from '../Layout.vue'
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
    <Layout title="Home">
        <template #main>
            
        </template>        
    </Layout>
</template>