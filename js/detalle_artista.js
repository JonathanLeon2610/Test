
const { createApp } = Vue; 
createApp({ 
  data() {
    return {
      actor: '',
    }
  },
  methods: {
    
  },
  mounted() {
    const self=this;
    let url = window.location.href;
    //                           vvvvvvvvv REMPLAZAR POR HOST URL
    url = url.replaceAll('http://localhost/equipo4-avanzada-tm-2022/public/detalle_artista.html?id=','')
    arr = url.split('-')
    //console.log(arr[0])
    var config = {
      method: 'get',
      url: 'https://api.themoviedb.org/3/person/'+arr[0],
      headers: { 
        'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyNDIzYzAwZWMxNGE3NmQ0YzIyNmY3MzUyOTk5NWE3MiIsInN1YiI6IjYzMjhmNjJjYTNiNWU2MDA3YTFmNTQ2NSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.ejpAgLrp5I_3AR5WXe1HFS_SQpJJRb0cVYPGT3ZpfrY'
      } 
    };
    
    axios(config)
    .then(function (response) {
      self.actor=response.data;
      // console.log(JSON.stringify(response.data));
    })
    .catch(function (error) {
      console.log(error);
    });
    
  },
}).mount('#contenedor');