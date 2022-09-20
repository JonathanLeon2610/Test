const { createApp } = Vue; 
const app = createApp({ 
    data() {
      return {
        user: JSON.parse(sessionStorage.getItem("user")),
        movies: [],
        series: []
      }
  },
  async mounted(){
    //Obtener peliculas populares
    var config = {  
      method: 'get',
      //Despues utilizar otro API Key V3? (Actualmente uso el mio)
      url: 'https://api.themoviedb.org/3/movie/popular?api_key=bed2b0accc555d42ba986bfa83ee1388&language=es-MX',
    };
    try {
      const response = await axios(config);
      if(response.data.results){
          this.movies = JSON.parse(JSON.stringify(response.data.results));
      }
    } catch (error) {
      swal("No se pudieron obtener las peliculas.", "", "error");
    }
    //Obtener series populares
    var config = {  
      method: 'get',
      url: 'https://api.themoviedb.org/3/tv/popular?api_key=bed2b0accc555d42ba986bfa83ee1388&language=es-MX',
    };
    try {
      const response = await axios(config);
      if(response.data.results){
          this.series = JSON.parse(JSON.stringify(response.data.results));
      }
    } catch (error) {
      swal("No se pudieron obtener las series.", "", "error");
    }
    if(!this.user){
      //Llevarlo al login
      //location.href= "";
    }
  }
}).mount('#contenedor');