<template>
  <div class="container section-5">
    <MenuLoged/>
    <div class="row">
      <div class="input-field col s12">
        <input v-model="title" id="last_name" type="text" class="validate" placeholder="Nombre de la nota">
      </div>
      <h6 class="col s12 grey-text">Ultima modificacion: {{date}}</h6>
      <div class="input-field col s12">
        <textarea v-model="contenido" id="note-content" class="materialize-textarea"></textarea>
        <label for="note-content">Contenido</label>
      </div>
      <a @click="createNote" class="waves-effect waves-light btn">
        <i class="material-icons right">save</i>Guardar
      </a>
    </div>
    <Footer/>
  </div>
</template>
<script>
import router from '../router'
import MenuLoged from '@/components/Menu-Loged'
import Footer from '@/components/Footer'

export default {
  components:{
    MenuLoged,
    Footer
  },
  data(){
    return{
      date: null,
      title: '',
      contenido: '',
      idUsuario: null
    }
  },
  methods:{
    createNote: function(){
      const nota = {};
      nota['titulo'] = this.title;
      nota['contenido'] = this.contenido;
      nota['idUsuario'] = this.idUsuario;
      const data = JSON.stringify(nota)
      fetch('/api-phantom/nota/create-nota.php', {
        method: "POST", // or 'PUT'
        body: data, // data can be `string` or {object}!
        headers: {
          "Content-Type": "application/json"
        }
      })
      .then(res => res.json())
      .then(data => {
        if(data['message'] === 'Nota was created'){
          router.push({ name: 'lista-nota', params: { user: this.idUsuario } })
        }
      })
    }
  },
  created(){
    this.idUsuario = this.$route.params.idUsuario;
    const today = new Date();
    const dd = String(today.getDate()).padStart(2, '0');
    const mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    const yyyy = today.getFullYear();
    this.date = mm + '/' + dd + '/' + yyyy;
  }
}
</script>

