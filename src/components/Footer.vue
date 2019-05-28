<template>
  <div>
    <footer class="page-footer blue">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Phantom Note</h5>
            <p
              class="grey-text text-lighten-4"
            >La forma facil de tener tus notas conectadas en cualquier lugar</p>
          </div>
          <div class="col l4 offset-l2 s12">
            <ul>
              <li>
                <router-link to="/registro">
                  <a class="grey-text text-lighten-3">Registrate</a>
                </router-link>
              </li>
              <li>
                <router-link to="/inicio-session">
                  <a class="grey-text text-lighten-3">Inica sesion</a>
                </router-link>
              </li>
              <li>
                <router-link to="/contact">
                  <a class="grey-text text-lighten-3">Contacto</a>
                </router-link>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">© 2019 Copyright Phantom Note</div>
      </div>
    </footer>
  </div>
</template>
<style scoped>
.page-footer{
  position:absolute;
  width: 100%;
  left: 0;
  bottom: 0;
  z-index: -10000;
}
</style>
<script>
export default {
    name: 'Footer',
    data(){
        return{

        }
    }
}
</script>