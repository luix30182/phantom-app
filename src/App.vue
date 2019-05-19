<template>
  <div id="app">
    <Menu/>
    <router-view/>
    <Footer/>
  </div>
</template>
<style>
p {
  font-size: 20px;
}

.image-banner {
  margin-bottom: 40px;
}

.square {
  max-width: 150px;
  max-height: 150px;
}

.section {
  margin: 40px auto;
}
.section-2 {
  padding: 40px;
}
.section-3{
  margin-top: 120px;
}
.section-4{
  margin: 60px auto;
}
.section-5{
  margin-top: 40px;
}
.row-margin-none{
  margin-bottom: 0;
}
.main-feature {
  font-size: 3em;
}

.section-img-container {
  position: relative;
}
.social-icon{
  font-size: 5em;
}
.section-img {
  position: absolute;
  left: 30px;
  top: -100px;
  bottom: 0px;
}
.feature-grid{
  max-width: 100px;
  max-height: 100px;
}
textarea.materialize-textarea{height: 10rem;
  overflow-y: scroll;
}
.icon{
  height: 100px;
  width: 100px;
}
@media only screen and (max-width: 995px) {
  .section-img-container {
    position: relative;
  }

  .section-img {
    position: relative;
    left: 0px;
    top: 0px;
    bottom: 0px;
  }
}
</style>

<script>
import Menu from '@/components/Menu'
import Footer from '@/components/Footer'
export default {
  components:{
    Menu,
    Footer
  }
}
</script>
