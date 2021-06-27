<template>
  <header>
      <a href=""><h1>BoolPress</h1></a>
      <ul>
          <li>
              <router-link :to="{name:'home'}">home</router-link>
          </li>
          <li>
              <router-link :to="{name:'blog'}">blog</router-link>
              
          </li>
          <li>
              <router-link :to="{name:'about'}">about</router-link>
          </li>
      </ul>
  </header>
</template>

<script>
export default {
    name:'Header',
}
</script>

<style lang = "scss" scoped>
    header{
        background: lightblue;
        }
        .active{
            color:red;
        }
    
    
</style>