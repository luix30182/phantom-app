<template>
  <div class="container section-5">
    <MenuL/>
    <h3 class="blue-text text-darken-3">Notas de {{user['name']}}</h3>
    <div class="row">
      <div class="col s12 m12">
        <a @click="createNote" class="waves-effect waves-light btn">Agregar Nota</a>
        <ul class="collapsible">
          <li v-for="nota in userNotes" :key="nota['idNota']">
            <div class="collapsible-header">
              <i class="material-icons">filter_drama</i>
              {{nota['titulo']}}
            </div>
            <div class="collapsible-body">
              <div :data-note="nota['idNota']" class="left-icon">
                <a @click="deleteNote" class="btn-floating btn-large waves-effect waves-light blue"><i class="material-icons">delete</i></a>
                <a @click="editNote" class="btn-floating btn-large waves-effect waves-light blue"><i class="material-icons">edit</i></a>
              </div>
              <span>{{nota['contenido']}}</span>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <Footer/>
  </div>
</template>
<style scoped>
.left-icon{
  width: 100%;
  padding: 20px;
  display: flex;
  margin: 0 auto;
}
.left-icon a{
  margin-left: 20px;
}
</style>

<script>
import router from "../router";
import { createHash } from 'crypto';
import Footer from '@/components/Footer'
import MenuL from '@/components/Menu-Loged'

export default {
  components:{
    Footer,
    MenuL
  },
  data() {
    return {
      user: null,
      userNotes: []
    };
  },
  methods:{
    createNote: function(){
      router.push({ name: 'nota', params: { idUsuario: this.user.idUsuario } })
    },
    deleteNote: function(e){
        //Guarda el elemento base que contiene el Id de la nota 
        const elementId = e.target.parentElement.parentElement;
        //el Id de la nota esta guardadado en el dataset notde el elemento, se guarda
        const idNota = elementId.dataset.note;
        //Se guarda el li que contiene toda la infomcacion de la nota que se muestra en lista
        const notaRow = elementId.parentElement.parentElement
        //para poder eliminar la nota del contenedor (ul) se guarda el elemento 
        const rootElement = notaRow.parentElement
        // Se crea un JSON con el id de la nota
        const nota = {};
        nota['idNota'] = idNota;
        const data = JSON.stringify(nota);
        // haciendo uso de la funcion fetch, se conecta al API y se elimina la nota
        fetch(`/api-phantom/nota/delete-nota.php`,{
          method: "POST", // or 'PUT'
          body: data, // data can be `string` or {object}!
          headers: {
            "Content-Type": "application/json"
          }
        })
        .then(blob => blob.json()) //La informacion recibida se pasa a JSON
        .then(data => {
          if(data['message'] === 'Nota was deleted'){
            //Si la nota se pudo eliminar, se elimina el elemento del DOM
            rootElement.removeChild(notaRow)
          }
        })
    }
  },
  created() {
    try{
      this.user = parseInt(this.$route.params.user);
    }catch(e){
      console.log('Problema con el Id del usuario')
    }
    try{
      fetch(`/api-phantom/users/readOne-Usuario.php?idUsuario=${this.user}`)
      .then(res => res.json())
      .then(data => {
        this.user = data;
    })
    }catch(e){
      console.log('Problema al tratar de leer la información')
    }

    fetch("/api-phantom/nota/all-notas.php")
      .then(blob => blob.json())
      .then(data => {
        this.userNotes.push(...Array.from(data["records"]));
      });
    this.userNotes = this.userNotes.filter(
      nota => nota["idUsuario"] === this.user["idUsuario"]
    );
  },
  mounted(){
    M.AutoInit();
  }
};
</script>
