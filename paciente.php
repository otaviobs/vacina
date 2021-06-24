<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cadastro</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
.active{
  background-color: #d5d5d5;
  text-decoration: none!important;
}
</style>
</head>

<body>
  <header>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">Campanha da vacinação</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href=".">Vacina</a>
        <span class="p-2 text-dark active">Paciente</span>
        <a class="p-2 text-dark" href="vacina-paciente.php">Vacinas nos pacientes</a>
      </nav>
    </div>
  </header>
  <div class="container">
    <div class="row">
      <div class="col-12" id='vueapp'>
        <h1>Cadastrar paciente</h1>
        <div class="form-group col-12">
          <label for="nome">Nome Completo</label>
          <input id="nome" class="form-control" type="text" placeholder="Digite o nome completo" v-model="nome" />
        </div>
        <div class="form-group col-4 float-left">
          <label for="dtnasc">Data de nascimento</label>
          <input id="dtnasc" class="form-control" type="date" v-model="dataNascimento" />
        </div>
        <div class="form-group col-4 float-left">
          <label for="cpf">CPF</label>
          <input id="cpf" class="form-control" type="number" maxlength="11" placeholder="Digite apenas os números" v-model.number="cpf" />
        </div>
        <div class="form-group col-4 float-left">
          <label for="telefone">Telefone</label>
          <input id="telefone" class="form-control" maxlength="11" type="number" placeholder="Digite apenas os números com DDD" v-model="telefone" />
        </div>
        <div class="form-group col-12 float-left">
          <label for="email">E-mail</label>
          <input id="email" class="form-control" type="email" placeholder="Digite o seu e-mail" v-model="email" />
        </div>
        <div class="form-group col-4 float-left">
          <label for="rua">Logradouro</label>
          <input id="rua" class="form-control" type="text" placeholder="Digite o lagradouro" v-model="rua" />
        </div>
        <div class="form-group col-2 float-left">
          <label for="numero">Número</label>
          <input id="numero" class="form-control" type="number" placeholder="Digite o número" v-model="numero" />
        </div>
        <div class="form-group col-2 float-left">
          <label for="bairro">Bairro</label>
          <input id="bairro" class="form-control" type="text" placeholder="Digite o bairro" v-model="bairro" />
        </div>
        <div class="form-group col-2 float-left">
          <label for="cidade">Cidade</label>
          <input id="cidade" class="form-control" type="text" placeholder="Digite a cidade" v-model="cidade" />
        </div>
        <div class="form-group col-2 float-left">
          <label for="uf">Estado</label>
          <input id="uf" class="form-control" type="text" placeholder="Digite o estado" v-model="estado" />
          <!--
          <select v-model="estado">
            <option value="" >Select State</option>
            <option v-for='estado in estados' :value='estado.id'>{{ estado.nome }}</option>
          </select>
          -->
        </div>
        <div class="form-group col-3 conte">
          <button class="btn btn-primary btn-lg" @click="createPaciente()">Salvar</button>
        </div>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Data nascimento</th>
              <th scope="col">CPF</th>
              <th scope="col">Telefone</th>
              <th scope="col">Email</th>
              <th scope="col">Endereço</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for='paciente in pacientes'>
              <th scope="row">{{ paciente.nome }}</th>
              <td>{{ paciente.dataNascimento.date | moment }}</td>
              <td>{{ paciente.cpf }}</td>
              <td>{{ paciente.telefone }}</td>
              <td>{{ paciente.email }}</td>
              <td>{{ paciente.rua }}, {{ paciente.numero }} - {{ paciente.bairro }} - {{ paciente.cidade }} - {{ paciente.estado }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="moment.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
      const API_URL = 'api/paciente';
      const app = new Vue({
        el: '#vueapp',
        data: {
            nome: '',
            dataNascimento: '',
            cpf: '',
            telefone: '',
            email: '',
            rua: '',
            numero: '',
            bairro: '',
            cidade: '',
            estado: '',
            /*estados: [
              {"id":"AC", "nome" : "Acre"},
              {"id":"AL", "nome" : "Alagoas"},
              {"id":"AP", "nome" : "Amapá"},
              {"id":"AM", "nome" : "Amazonas"},
              {"id":"BA", "nome" : "Bahia"},
              {"id":"CE", "nome" : "Ceará"},
              {"id":"DF", "nome" : "Distrito Federal"},
              {"id":"ES", "nome" : "Espírito Santo"},
              {"id":"GO", "nome" : "Goiás"},
              {"id":"MA", "nome" : "Maranhão"}
            ],*/
            pacientes: []
        },
        filters: {
          moment: function (date) {
            return moment(date).format('DD/MM/YYYY');
          }
        },
        mounted: function() {
          this.getPacientes()
        },
        methods: {
          formataStringData: function() {
            this.dataNascimento = this.dataNascimento.split("/").reverse().join("/");
          },
          async getPacientes() {

            await axios.get(API_URL)
              .then(function(response) {
                app.pacientes = response.data;
              })
              .catch(function(error) {
                console.log(error);
              });
          },
          createPaciente: function() {
            this.formataStringData();

            let formData = new FormData();
            formData.append('nome', this.nome)
            formData.append('dataNascimento', this.dataNascimento)
            formData.append('cpf', this.cpf)
            formData.append('telefone', this.telefone)
            formData.append('email', this.email)
            formData.append('rua', this.rua)
            formData.append('numero', this.numero)
            formData.append('bairro', this.bairro)
            formData.append('cidade', this.cidade)
            formData.append('estado', this.estado)

            var paciente = {};
            formData.forEach(function(value, key){
              paciente[key] = value;
            });
//console.log(vacina);
            //let json = JSON.stringify(vacina);

            axios({
                method: 'POST',
                url: API_URL,
                data: paciente,
                config: { headers: {'Content-Type': 'application/json' }}
            })
            .then(function (response) {
                Swal.fire({
                  icon: 'success',
                  title: 'Paciente cadastrado com sucesso!',
                  allowOutsideClick: false
                })
                app.pacientes.push(paciente)
                app.resetForm();
            })
            .catch(function (response) {
              Swal.fire({
                icon: 'error',
                title: 'Ocorreu algum erro ao cadastrar o paciente',
                allowOutsideClick: false
              })
              console.log(response)
            });
          },
          resetForm: function() {
            this.nome = '',
            this.dataNascimento = '',
            this.cpf = '',
            this.telefone = '',
            this.email = '',
            this.rua = '',
            this.numero = '',
            this.bairro = '',
            this.cidade = '',
            this.estado = ''
          },
          deletePaciente: function(id){
            
          }
        }
      })
      
    </script>
</body>

</html>