const { createApp } = Vue; 
const app = createApp({ 
  data() {
    return {
        genre_name:"",
        genre_id:0,
        results:[],
        type:""
    }
  },
  mounted(){
    var config = {
      method: 'get',
      url: 'https://api.themoviedb.org/3/discover/tv?api_key=5a98b28f02c93c76cacc6a7eecdbe6fa&language=en-US&sort_by=popularity.desc&with_genres='+18,
      headers: { }
    };

    axios(config)
    .then(function (response) {
      //console.log(JSON.stringify(response.data));
      app.results = response.data.results;
    })
    .catch(function (error) {
      console.log(error);
    });
  }
}).mount('#contenedor');