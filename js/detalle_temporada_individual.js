const { createApp } =  Vue;
const app=createApp({
  data(){
    return{
      episodes:"",
      serie_id:"60625",
      temporada_id:"1"
    }
  },
  methods: {
  },
  mounted() {
  //Montar la informacion que se mostrará
  // Obtner id de la serie
    // let url = window.location.href;
    // url = url.replaceAll('http://localhost/equipo4-avanzada-tm-2022/public/detalle_temporada_individual.html?id=','');
    // arr = url.split('-');
    // this.serie_id = arr[0];
    var pointer=this;
    var config = {
      method: 'get',
      url: 'https://api.themoviedb.org/3/tv/'+pointer.serie_id+'/season/'+pointer.temporada_id+'?api_key=c6a2a78594eff557eccab351f2eb6832&language=en-US',
      headers: { }
    };
    axios(config)
    .then(function (response) {
      pointer.episodes=response.data.episodes
    })
    .catch(function (error) {
      console.log(error);
    });
  }
}).mount("#contenedor")