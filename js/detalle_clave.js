const { createApp } = Vue; 
const app = createApp({ 
  data() {
    return {
        keyword_id:0,
        keyword_name:"",
        type:"",
        results:[]
    }
  },
  methods:{
    changeType(){
      if(this.type == 'movie'){
        this.type = 'tv';
      }
      else if(this.type == 'tv'){
        this.type = 'movie';
      }
      this.getResults();
    },
    getResults(){
      var config = {
        method: 'get',
        url: 'https://api.themoviedb.org/3/keyword/'+this.keyword_id+'?api_key=8222147f508c762ed048e8c7e5aa6f09',
        headers: { 
          'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4MjIyMTQ3ZjUwOGM3NjJlZDA0OGU4YzdlNWFhNmYwOSIsInN1YiI6IjYzMWQxYWJlOWMyNGZjMDA3ZDc3MTcxYSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.UflnCScTidL_L1rp_C05duZR9AytlvCUy2MFAxf-u_A'
        }
        };
        axios(config)
        .then(function (response) {
          app.keyword_name = response.data.name;
          //console.log(JSON.stringify(response.data));
        })
        .catch(function (error) {
          console.log(error);
        });
  
        var config = {
          method: 'get',
          url: 'https://api.themoviedb.org/3/discover/'+this.type+'?api_key=8222147f508c762ed048e8c7e5aa6f09&language=en-US&sort_by=popularity.desc&with_keywords='+this.keyword_id,
          headers: { 
            'Authorization': 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI4MjIyMTQ3ZjUwOGM3NjJlZDA0OGU4YzdlNWFhNmYwOSIsInN1YiI6IjYzMWQxYWJlOWMyNGZjMDA3ZDc3MTcxYSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.UflnCScTidL_L1rp_C05duZR9AytlvCUy2MFAxf-u_A'
          }
        };
        axios(config)
        .then(function (response) {
          app.results = response.data.results;  
        })
        .catch(function (error) {
          alert("No se pudieron cargar los resultados de la palabra clave.");
          console.log(error);
        });
    }
  },
  mounted(){
    let url = window.location.href;
    //console.log(url)
    url = url.replaceAll('http://localhost/equipo4-avanzada-tm-2022/public/detalle_clave.html?type=','')
    //console.log(url)
    url = url.replaceAll('&id=','-')
    //console.log(url)
    arr = url.split('-')
    //console.log(arr[0])
    //console.log(arr[1])

    this.type = arr[0]
    this.keyword_id = arr[1]

    this.getResults();
  }
}).mount('#contenedor');