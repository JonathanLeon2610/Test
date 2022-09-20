const { createApp } = Vue; 
const app = createApp({ 
  data() {
    return {
      movie: [],
      casting: [],
      genres: [],
      videos: [],
      keywords: [],
      recommendations: [],
      countries: [],
      crew: [],
      movie_id: '',
      type: "movie",
      user: JSON.parse(sessionStorage.getItem('user'))
    }
  },
  async mounted() {
    //ID DE LA PELICULA
    let url = window.location.href;
    url = url.replaceAll('http://localhost/equipo4-avanzada-tm-2022/public/detalle_pelicula.html?id=','');
    arr = url.split('-');
    this.movie_id = arr[0];
    
    //DETALLES
    var config= {
      method: 'get',
      url: 'https://api.themoviedb.org/3/movie/'+this.movie_id+'?api_key=521eb323d239c60577388c1365b18990&language=en-US'
      //url: 'https://api.themoviedb.org/3/movie/629176?api_key=521eb323d239c60577388c1365b18990&language=en-US'
    };
    try {
      const response = await axios(config);
      if(response.data){
        this.movie = JSON.parse(JSON.stringify(response.data));
      }
    } catch (error) {
      console.log(error);
    }

    //GENEROS
    this.genres = JSON.parse(JSON.stringify(this.movie.genres));

    //PAISES
    this.countries = JSON.parse(JSON.stringify(this.movie.production_countries));

    //REPARTO Y CREW
    var config= {
      method: 'get',
      url: 'https://api.themoviedb.org/3/movie/'+this.movie_id+'/credits?api_key=521eb323d239c60577388c1365b18990&language=en-US'
      //url: 'https://api.themoviedb.org/3/movie/629176/credits?api_key=521eb323d239c60577388c1365b18990&language=en-US'
    };
    try {
      const response = await axios(config);
      if(response.data.cast){
        this.casting = JSON.parse(JSON.stringify(response.data.cast));
        this.crew = JSON.parse(JSON.stringify(response.data.crew));
      }
    } catch (error) {
      console.log(error);
    }

    //VIDEOS
    var config= {
      method: 'get',
      url: 'https://api.themoviedb.org/3/movie/'+this.movie_id+'/videos?api_key=521eb323d239c60577388c1365b18990&language=en-US'
      //url: 'https://api.themoviedb.org/3/movie/629176/videos?api_key=521eb323d239c60577388c1365b18990&language=en-US'
    };
    try {
      const response = await axios(config);
      if(response.data){
        this.videos = JSON.parse(JSON.stringify(response.data.results))
      }
    } catch (error) {
      console.log(error);
    }

    //KEYWORDS
    var config= {
      method: 'get',
      url: 'https://api.themoviedb.org/3/movie/'+this.movie_id+'/keywords?api_key=521eb323d239c60577388c1365b18990&language=en-US'
      //url: 'https://api.themoviedb.org/3/movie/629176/keywords?api_key=521eb323d239c60577388c1365b18990&language=en-US'
    };
      try {
        const response = await axios(config);
        if(response.data){
          this.keywords = JSON.parse(JSON.stringify(response.data.keywords))
        }
      } catch (error) {
        console.log(error);
      }

      //RECOMENDACIONES
      var config= {
        method: 'get',
        url: 'https://api.themoviedb.org/3/movie/'+this.movie_id+'/recommendations?api_key=521eb323d239c60577388c1365b18990&language=en-US&page=1'
        //url: 'https://api.themoviedb.org/3/movie/629176/recommendations?api_key=521eb323d239c60577388c1365b18990&language=en-US&page=1'
      };
      try {
        const response = await axios(config);
        if(response.data){
          this.recommendations = JSON.parse(JSON.stringify(response.data.results))
        }
      } catch (error) {
        console.log(error);
      }
  },
  methods: {
    logout() {
      sessionStorage.removeItem('username');
      this.user = null;
    },
    rating(num) {
      return Math.round(num * 10) + "%";
    },
    time(num){ 
      var hours = Math.floor(num / 60);  
      var minutes = num % 60;
      return hours + "h" + minutes + "m";         
    },
    getDirector(crew) {
      var director = "Sin director";
      crew.map(staff => {
        if (staff.job == "Director") {
          director = staff.name;
        }
      })
      return director;
    },
    getWriter(crew) {
      var writer = "Sin escritor";
      crew.map(staff => {
        if (staff.job == "Writer") {
          writer = staff.name;
          return writer
        }
      })
      return writer;
    },
    money(num) {
      return num > 0 ? '$'+(num).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') : '-';
    },
    getTrailer(videos) {
      var url = 'Qw4w9WgXcQ';
      videos.map(video => {
        if (video.type == "Trailer") {
          if (video.official) {
            url = video.key;
          }
        }
      })
      return url;
    },
    getVideoName(videos) {
      videos.map(video => {
        if (video.type == "Trailer") {
          if (video.official)
            return video.name;
        }
      })
      return true;
    }
  }
}).mount('#contenedor');