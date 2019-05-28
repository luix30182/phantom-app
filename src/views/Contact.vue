<template>
    <div>
        <Menu/>
        <div class="container">
        <h4 class="blue-text center">Ponte en contacto con nosotros!</h4>
        <div class="row center-align section-5">
            <div class="col s12 m8 offset-m2">
                <div class="input-field col s12 m6">
                    <input id="first_name" type="text" class="validate">
                    <label for="first_name">Nombre</label>
                </div>
                <div class="input-field col s12 m6">
                    <input id="last_name" type="text" class="validate">
                    <label for="last_name">Apellido</label>
                </div>
                <div class="input-field col s12">
                    <input id="email" type="email" class="validate">
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s12">
                    <input id="subject" type="text" class="validate">
                    <label for="subject">Asunto</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="message" class="materialize-textarea"></textarea>
                    <label for="message">Mensaje</label>
                </div>
                <a class="waves-effect waves-light btn">Enviar</a>
            </div>
        </div>
        <div class="section-5">
            <h4 class="blue-text center">Tambien nos puedes encontrar en las redes sociales</h4>
            <div class="row center section-5">
                <div class="col s4">
                    <i class="fab blue-text text-darken-4 fa-facebook-square social-icon"></i>
                </div>
                <div class="col s4">
                    <i class="fab blue-text text-darken-4 fa-twitter-square social-icon"></i>
                </div>
                <div class="col s4">
                    <i class="fab blue-text text-darken-4 fa-youtube-square social-icon"></i>
                </div>
            </div>
        </div>
    </div>
    <Footer/>
    </div>
</template>
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
