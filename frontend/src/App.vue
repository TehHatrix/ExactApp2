<template>
<div>
  <router-link v-if="this.$route.name != 'Item' " to="/item-entry">Go to Item Entry</router-link>
  <router-view></router-view>
</div>
</template>

<script>
export default {
  name: 'App',
  components: {
  },
  mounted () {
    console.log(this.$route.name);
  },
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
