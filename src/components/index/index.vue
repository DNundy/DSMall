<template>
  <div>
      <user-header></user-header>
      <user-footer></user-footer>
  </div>
</template>
 
<script>

import UserHeader from "./layout/header";
import UserFooter from "./layout/footer";

export default {
  data () {
    return {
    }
  },
  components: {
      UserHeader,
      UserFooter
  }
}
</script>
 
 
<style scoped>
 
</style>