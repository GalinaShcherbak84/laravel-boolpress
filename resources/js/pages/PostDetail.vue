<template>
  <div class="container">
      
      <div v-if="post">
          <h1>{{post.title}}</h1>
          <div class="post-info">
              <span>{{post.category.name}}</span>
              <span v-for="tag in post.tags" :key="`tag-${tag.id}`" class="tag">{{tag.name}}</span>
          </div>
          <p>{{post.content}}</p>

      </div> 
      <div v-else>
          Loading...
      </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    name:'PostDetail',
    data(){
        return{
            post: null
        }
    },
    created() {
        this.getPostDetails();
    },
    methods: {
        getPostDetails() {
            axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
            .then( res => {
               console.log(res.data);
               this.post = res.data;
            })
            .catch(err => {
                console.log(err);
            });
        }
    }
}
</script>

<style lang="scss"scoped>
    .tag{
        padding:0.25rem;
        display: inline-block;
        margin:0.25rem;
        font-size:0.75em;
        background: lightblue;
        border-radius: 15px;
    }
</style>