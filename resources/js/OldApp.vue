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
                     <div>{{formatDate(post.created_at)}}</div>
                     <a href="">Read more</a>
                 </article>
                 <section class="navigation">
                    <button
                        v-show="pagination.current > 1"
                        @click="getPosts(pagination.current - 1)"
                     >
                         prev
                    </button>
                    <button 
                        v-for="i in pagination.last" 
                        :key="`page-${i}`"
                         @click="getPosts(i)"
                         :class="{'active-page': i == pagination.current}"

                    >
                        {{i}}
                    </button>
                    <button
                        v-show="pagination.current < pagination.last"
                        @click="getPosts(pagination.current + 1)"
                     >
                         next
                    </button>
                 </section>
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
            posts:[],
            pagination:{}
        }
    },
    created(){
        //console.log(axios);
        this.getPosts();
    },
    methods:{
        getPosts(page = 1){
            //get posts from API
            axios.get(`http://127.0.0.1:8000/api/posts?page=${page}`)
            .then(res =>{
                console.log(res.data);
                this.posts = res.data.data;
                this.pagination = {
                    current: res.data.current_page,
                    last: res.data.last_page
                };
            })
            .catch(err =>{
                console.log(err);
            })
        },
        formatDate(date){
            const postDate = new Date(date);
            let day = postDate.getDate();
            let month = postDate.getMonth() + 1;
            const year = postDate.getFullYear();
            if (month < 10) {
                month = '0' + month;
            }
            if (day < 10) {
                day = '0' + day;
            }
            return `${day}/${month}/${year}` 
        }
    }
}
</script>

<style lang="scss">
@import '../sass/frontoffice/utilities';
    body{
        font-family: sans-serif;
        .navigation{
            margin-top: 20px;
        }
        .active-page{
            background: dodgerblue;
        }
    }
</style>
