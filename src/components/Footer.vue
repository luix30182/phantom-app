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
                  <a class="grey-text text-lighten-3">Inica secion</a>
                </router-link>
              </li>
              <li>
                <router-link to="/contact">
                  <a class="grey-text text-lighten-3">Contacto</a>
                </router-link>
              </li>
              <li>
                <router-link to="/nota">
                  <a class="grey-text text-lighten-3">Notas</a>
                </router-link>
              </li>
              <li>
                <router-link to="/lista">
                  <a class="grey-text text-lighten-3">Lista de Notas</a>
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

<script>
export default {
    name: 'Footer',
    data(){
        return{

        }
    }
}
</script>

