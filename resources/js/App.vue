<template>
    <div>
        <header>
         <Header/> 
        </header>
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import axios from 'axios';
import Header from "./components/Header.vue";
export default {
    name:'App',
    components: {
        Header
    }
}
</script>

<style lang="scss">
@import '../sass/frontoffice/utilities';
    body{
        font-family: sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
</style>
