<template>
  <div class="home">
    <Menu/>
    <Principal/>
  </div>
</template>

<script>
// @ is an alias to /src
import Principal from '@/components/Principal'
import Menu from '@/components/Menu'

export default {
  name: 'Home',
  components: {
    Menu,
    Principal
  }
}
</script>
