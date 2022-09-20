const { createApp } =  Vue;
const app=createApp({
  data(){
    return{
      serie:"",
      serie_id:""
    }
  },methods: {

},
mounted() {
  //Montar la informacion que se mostrará
  //Obtener id de la serie
    // let url = window.location.href;
    //     url = url.replaceAll('http://localhost/equipo4-avanzada-tm-2022/public/detalle_temporada.html?id=','');
    //     arr = url.split('-');
    //     this.serie_id = arr[0];
      var pointer=this;
      var config = {
        method: 'get',
        url: 'https://api.themoviedb.org/3/tv/60625?api_key=c6a2a78594eff557eccab351f2eb6832&language=en-US',
        headers: { }
      };
      axios(config)
      .then(function (response) {
        pointer.serie=response.data
      })
      .catch(function (error) {
        console.log(error);
      });
}
}).mount("#contenedor")