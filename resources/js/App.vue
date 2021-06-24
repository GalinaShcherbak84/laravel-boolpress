<template>
    <div>
        <header>
        <!-- <Header/> -->
        </header>
        <main>
            <div class="container">
                 <h1>Blog</h1>
                 <article v-for="post in posts " :key ="post.id">
                     <h2>{{post.title}}</h2>
                     <div>{{post.created_at}}</div>
                     <p>{{post.content}}</p>
                     <a href="">Read more</a>
                 </article>
            </div>
        </main>
    </div>
</template>

<script>
import axios from 'axios';
/* import Header from "./components/Header.vue"; */
export default {
    name:'App',
    data(){
        return{
            posts:[]
        }
    },
    created(){
        //console.log(axios);
        this.getPosts();
    },
    methods:{
        getPosts(){
            //get posts from API
            axios.get('http://127.0.0.1:8000/api/posts')
            .then(res =>{
                console.log(res.data);
                this.posts = res.data;
            })
            .catch(err =>{
                console.log(err);
            })
        }
    }
}
</script>

<style lang="scss">
@import '../sass/frontoffice/utilities';
    body{
        font-family: sans-serif;
    }
</style>
