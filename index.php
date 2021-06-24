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
        <span class="p-2 text-dark active" href="#">Vacina</span>
        <a class="p-2 text-dark" href="paciente.php">Paciente</a>
        <a class="p-2 text-dark" href="vacina-paciente.php">Vacinas nos pacientes</a>
      </nav>
    </div>
  </header>
  <div class="container">
    <div class="row">
      <div class="col-12" id='vueapp'>
        <h1>Cadastrar vacina</h1>
        <div class="form-group col-6 float-left">
          <label for="lote">Lote</label>
          <input id="lote" class="form-control" type="number" placeholder="Número do lote (Ex. 123, 554...)" v-model.number="lote" />
        </div>
        <div class="form-group col-6 float-left">
          <label for="doses">Doses</label>
          <input id="doses" class="form-control" type="number" placeholder="Quantidade de doses consegue ser aplicado (Ex. 9, 12...)" v-model.number="nDoses" />
        </div>
        <div class="form-group col-6 float-left">
          <label for="intervalo">Intervalo</label>
          <input id="intervalo" class="form-control" type="number" placeholder="Quantidade de dias (Ex. 28, 90...)" v-model.number="intervalo" />
        </div>
        <div class="form-group col-6 float-left">
          <label for="dtValidade">Data de validade</label>
          <input id="dtValidade" class="form-control" type="date" v-model="dataValidade" />
        </div>
        <div class="form-group col-12 float-left">
          <label for="fabricante">Fabricante</label>
          <input id="fabricante" class="form-control" type="text" v-model="fabricante" />
        </div>
        <div class="form-group col-3 conte">
          <button class="btn btn-primary btn-lg" @click="createVacina()">Salvar</button>
        </div>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Lote</th>
              <th scope="col">Doses</th>
              <th scope="col">Intervalo</th>
              <th scope="col">Data de Validade</th>
              <th scope="col">Fabricante</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for='vacina in vacinas'>
              <th scope="row">{{ vacina.lote }}</th>
              <td>{{ vacina.nDoses }}</td>
              <td>{{ vacina.intervalo }}</td>
              <td>{{ vacina.dataValidade.date | moment  }}</td>
              <td>{{ vacina.fabricante }}</td>
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
      const API_URL = 'api/vacina';
      const app = new Vue({
        el: '#vueapp',
        data: {
            lote: '',
            nDoses: '',
            intervalo: '',
            fabricante: '',
            dataValidade: '',
            vacinas: []
        },
        filters: {
          moment: function (date) {
            return moment(date).format('DD/MM/YYYY');
          }
        },
        mounted: function() {
          this.getVacinas()
        },
        methods: {
          formataStringData: function() {
            this.dataValiadade = this.dataValidade.split("/").reverse().join("/");
          },
          async getVacinas() {

            await axios.get(API_URL)
              .then(function(response) {
                app.vacinas = response.data;
              })
              .catch(function(error) {
                console.log(error);
              });
          },
          createVacina: function() {
            console.log("Creating a vacina!")
            this.formataStringData();

            let formData = new FormData();
            console.log("lote da vacina:", this.lote)
            formData.append('lote', this.lote)
            formData.append('nDoses', this.nDoses)
            formData.append('intervalo', this.intervalo)
            formData.append('fabricante', this.fabricante)
            formData.append('dataValidade', this.dataValidade)

            var vacina = {};
            formData.forEach(function(value, key){
              vacina[key] = value;
            });
//console.log(vacina);
            //let json = JSON.stringify(vacina);

            axios({
                method: 'POST',
                url: API_URL,
                data: vacina,
                config: { headers: {'Content-Type': 'application/json' }}
            })
            .then(function (response) {
                Swal.fire({
                  icon: 'success',
                  title: 'Vacina cadastrada com sucesso!',
                  allowOutsideClick: false
                })
                app.vacinas.push(vacina)
                app.resetForm();
            })
            .catch(function (response) {
              Swal.fire({
                icon: 'error',
                title: 'Ocorreu algum erro ao cadastrar a vacina',
                allowOutsideClick: false
              })
              console.log(response)
            });
            
          },
          resetForm: function() {
            this.lote = '',
            this.nDoses = '',
            this.intervalo = '',
            this.fabricante = '',
            this.dataValidade = ''
          },
          deleteVacina: function(id){
            
          }
        }
      })
      
    </script>
</body>

</html>