<template>
  <div>
    <Menu/>
    <div class="row row-margin-none">
      <div class="col s12 m12 l6 blue white-text">
        <div class="container section-4">
          <h3>Registrate y crea miles de notas</h3>
          <p>
            Almacenamiento en la nube, accede a todas tus notas de forma rápida y gratuita,
            <span>
              Registrate
              ahora
            </span>
          </p>
          <div class>
            <img
              class="image-banner responsive-img"
              src="https://evernote.com/c/assets/homepage/homepage-hero-desktop.png?28e4619a46d0cf89"
              alt="banner-1"
            >
          </div>
        </div>
      </div>
      <div class="col s12 m12 l6">
        <div v-if="message" class="alert">
            <h5>Completa todos los campos</h5>
        </div>
        <div v-if="message2" class="alert alert2">
            <h5>Usuario Creado</h5>
        </div>
        <h3 class="center-align">Inresa los datos para tu registro</h3>
        <div class="container">
          <div class="row">
            <form class="col s12 valign-wrapper">
              <div class="row">
                <div class="input-field col s12 m6">
                  <input v-model="firstName" id="first_name" type="text" class="validate">
                  <label for="first_name">First Name</label>
                </div>
                <div class="input-field col s12 m6">
                  <input v-model="lastName" id="last_name" type="text" class="validate">
                  <label for="last_name">Last Name</label>
                </div>
                <div class="input-field col s12">
                  <input v-model="password" id="password" type="password" class="validate">
                  <label for="password">Password</label>
                </div>
                <div class="input-field col s12">
                  <input v-model="email" id="email" type="email" class="validate">
                  <label for="email">Email</label>
                </div>
                <a @click="registrar" class="waves-effect waves-light btn col s12 m4 offset-m4">Iniciar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <Footer/>
  </div>
</template>
<style scoped>
.alert{
    width: 40%;
    border-color: rgba(0,0,0,0.12) !important;
    border-radius: 0;
    border-width: 4px 0 0 0;
    border-style: solid;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    margin: 0 auto;
    padding: 5px;
    transition: 0.3s cubic-bezier(0.25, 0.8, 0.5, 1);
    background-color: #ff5252;
}
.alert2{
  background-color: green;
}
</style>
<script>
import Menu from '@/components/Menu'
import Footer from '@/components/Footer'

export default {
  components:{
    Menu,
    Footer
  },
  data(){
    return{
      firstName: '',
      lastName: '',
      password: '',
      email: '',
      message: false,
      message2: false
    }
  },
  methods:{
    registrar: function(){
      //Se verifica que ningun campo este vacio
      if(this.firstName.length > 0 && this.lastName.length>0 && this.password.length>0 && this.email.length>0){
        const name = this.firstName + ' ' + this.lastName;
        //se crea un objeto JSON para poder con los datos
        const user = {};
        user['name'] = name;
        user['password'] = this.password;
        user['email'] = this.email;
        const data = JSON.stringify(user)
        //Utilizando la funcion fetch se manda el JSON para poder registrar al usuario
        fetch('/api-phantom/users/create-Usuario.php', {
          method: "POST", // or 'PUT'
          body: data, // data can be `string` or {object}!
          headers: {
            "Content-Type": "application/json"
          }
        })
        .then(res => res.json())
        .then(data => {
          if(data['message'] === 'User was created'){
            /*Si el mensaje recibido por el API es User was created, quiere
              decir que se pudo crear el usuario, los campos se limpian
              y aparece un mensaje haciendo saber lo que acaba de pasar
            */
            this.firstName = '';
            this.lastName = '';
            this.password = '';
            this.email = '';
            this.message2 = !this.message2
            setTimeout(() => {
                this.message2 = !this.message2
            }, 1000);
          }
        })
      }else{
        //En caso de que el usuario no se pueda crear, se notifica con un mensaje
        this.message = !this.message
        setTimeout(() => {
            this.message = !this.message
        }, 1000);
      }
    }
  }
}
</script>

