<template>
    <div>
        <Menu/>
        <div class="container center-align section">
        <img class="square" src="https://pngimage.net/wp-content/uploads/2018/06/user-icon-in-png-5.png" alt="image-begin" />
        <div v-if="alert" class="alert">
            <h5>Algo anda mal con tus datos, verificalos</h5>
        </div>
        <h2 class="blue-text">Bienvenido!!</h2>
        <h5>Inicia sesión</h5>
        <div class="container">
            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col s12 m6 offset-m3">
                            <input v-model="email" id="email" type="email" class="validate">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field col s12 m6 offset-m3">
                            <input v-model="password" id="password" type="password" class="validate">
                            <label for="password">Password</label>
                        </div>
                        <a @click="login" class="waves-effect waves-light btn col s12 m4 offset-m4">Iniciar</a>
                    </div>
                </form>
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
</style>

<script>
import router from '../router'
import Menu from '@/components/Menu'
import Footer from '@/components/Footer'

import { setInterval } from 'timers';
export default {
    components:{
        Menu,
        Footer
    },
    data(){
        return{
            email: '',
            password: '',
            alert: false
        }
    },
    methods:{
        login: function(){
            //Se verifica que los campos no esten vacios
            if(this.email.length > 0 && this.password.length > 0){
            //Con la funcion fetch y el API se obtiene una lista de usuarios, esta lista no contiene las contraseñas
             fetch('/api-phantom/users/read-Usuario.php')
            .then(response => response.json())
            .then(data => {
                //en holder se guarda la lista de los uduarios
                const holder = Array.from(data['records'])
                let userHolder;
                let flag = false;
                //en el array se busca al usuario con el email que se requiere
                holder.forEach(element => {
                    //si se encuestra el email en la lista, atravez del API se obtienen los datos completos del uduario, esta vez con la contraseña incluida
                    if(element['email'] === this.email){
                        flag = true;
                        fetch(`/api-phantom/users/readOne-Usuario.php?idUsuario=${element['idUsuario']}`)
                        .then(blob => blob.json())
                        .then(data => userHolder = data)
                        .then(() =>{
                            //Si la contraseña coincide se da acceso a la lista de notas que le pertencen al usuario
                            if(this.password === userHolder['password']){
                                router.push({ name: 'lista-nota', params: { user: element['idUsuario'] } })
                            }else{
                                //de lo contrario se muestra un mensaje, indicando que no se puede iniciar sesion 
                                this.alert = !this.alert
                                setTimeout(() => {
                                    this.alert = !this.alert
                                }, 1000);
                            }
                        })
                    }
                });
                if(!flag){
                    //En caso de que los campos esten vacios se muestra un mensaje de error
                    this.alert = !this.alert
                    setTimeout(() => {
                        this.alert = !this.alert
                    }, 1000);
                }
            })
            }
        }
    }
}
</script>
