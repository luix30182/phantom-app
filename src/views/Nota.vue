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
      idUsuario: null,
      idNota: null,
      //Esta variable permite diferenciar entre crear una nota nueva y editar una 
      editMode: false
    }
  },
  methods:{
    createNote: function(){
      //Se crea un objeto con los datos de la nota
      const nota = {};
      nota['titulo'] = this.title;
      nota['contenido'] = this.contenido;
      if(!this.editMode){
      //Si no se esta editando una nota, se crea un JOSON con el Id del usuario
        nota['idUsuario'] = this.idUsuario;
        const data = JSON.stringify(nota);
        //Utilizando la funcion fetch, se crea la nota utlizando el API
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
            //Si se recibe el mensaje Nota was created, se regresa a la vista de notas
            router.push({ name: 'lista-nota', params: { user: this.idUsuario } })
          }
        })
      }else{
        //Si se esta editando una nota se crea un JSON con el Id de la nota en lugar del de usuario
        nota['idNota'] = this.idNota;
        const data = JSON.stringify(nota)
        //De igual manera haciendo uso de la funcion fetch y el API se actaliza la nota
        fetch('/api-phantom/nota/update-nota.php', {
           method: "POST", // or 'PUT'
           body: data, // data can be `string` or {object}!
           headers: {
             "Content-Type": "application/json"
           }
         })
         .then(res => res.json())
        .then(data => {
          console.log(data)
          if(data['message'] === 'Nota was updated'){  
            //Si la nota se pudo actualizar, se regresa a la vista de lista de notas
            router.push({ name: 'lista-nota', params: { user: this.idUsuario } })
          }
        })
      }
    }
  },
  created(){
    this.idUsuario = this.$route.params.idUsuario;
    const today = new Date();
    const dd = String(today.getDate()).padStart(2, '0');
    const mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    const yyyy = today.getFullYear();
    this.date = mm + '/' + dd + '/' + yyyy;
    try{
      const nota = this.$route.params.nota;
      this.title = nota['titulo'];
      this.contenido = nota['contenido'];
      this.idUsuario = parseInt(nota['idUsuario'])
      this.idNota = parseInt(nota['idNota'])
      this.editMode = true;
    }catch(e){
      // console.log()
    }
  }
}
</script>

