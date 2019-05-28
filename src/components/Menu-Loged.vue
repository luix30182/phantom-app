<template>
  <div>
    <nav class="blue darken-2">
      <div class="nav-wrapper">
        <div class="container">
          <router-link to="/">
            <a class="brand-logo">Phantom Note</a>
          </router-link>
          <router-link to="/">
            <a data-target="mobile-demo" class="sidenav-trigger">
              <i class="material-icons">menu</i>
            </a>
          </router-link>
          <ul class="right hide-on-med-and-down">
            <li>
              <router-link to="/">
                <a class="blue darken-4">Cerrar sesion</a>
              </router-link>
            </li>
            <li>
              <router-link to="/contact">
                <a>contacto</a>
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
      <li>
        <router-link to="/">
          <a class="blue darken-4">Cerrar Sesion</a>
        </router-link>
      </li>
      <li>
        <router-link to="/contact">
          <a>contacto</a>
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "MenuL",
  data() {
    return {};
  }
};
</script>
