const { createApp } = Vue;
const app = createApp({
    data() {
        return {
            serie: [],
            certification: [],
            genres: [],
            runtime: [],
            providers: [],
            createdBy: [],
            casting: [],
            networks: [],
            spokenLanguages: [],
            seasons: [],
            keywords: [],
            videos: [],
            recommendations: [],
            serie_id: 0,
            type: 'tv',
        }
    },
    methods: {
        rating(num) {
            return Math.round(num * 10);
        },
        time(num) {
            if (num == null || num == "") {
                return "";
            } else {
                var hours = Math.floor(num / 60);
                var minutes = num % 60;
                if (hours == 0) {
                    return minutes + "m";
                } else {
                    return hours + "h " + minutes + "m";
                }
            }
        },
        getSlug(title){
            return title.replaceAll(' ','-');
        },
    },
    async mounted() {
         //CAMBIAR IDIOMA: en-US | es

        //OBTENER EL ID DE LA SERIE
        let url = window.location.href;
        url = url.replaceAll('http://localhost/equipo4-avanzada-tm-2022/public/detalle_serie.html?id=','');
        arr = url.split('-');
        this.serie_id = arr[0];

        //OBTENER DETALLES SOBRE LA SERIE
        var config = {
            method: 'get',
            //url: 'https://api.themoviedb.org/3/tv/60574?api_key=fdc510bfe0d84dae126b382d74c09fed&language=en-US'
            url: 'https://api.themoviedb.org/3/tv/'+this.serie_id+'?api_key=fdc510bfe0d84dae126b382d74c09fed&language=en-US'
        };
        try {
            const response = await axios(config);
            if (response.data) {
                this.serie = JSON.parse(JSON.stringify(response.data));
            }
        } catch (error) {
            console.log(error);
        }

        //OBTENER LOS GÉNEROS
        this.genres = JSON.parse(JSON.stringify(this.serie.genres));

        //OBTENER EL RUNTIME
        this.runtime = JSON.parse(JSON.stringify(this.serie.episode_run_time));

        //OBTENER LOS CREADORES
        this.createdBy = JSON.parse(JSON.stringify(this.serie.created_by));

        //OBTENER EL IDIOMA
        this.spokenLanguages = JSON.parse(JSON.stringify(this.serie.spoken_languages));

        //OBTENER LOS CANALES
        this.networks = JSON.parse(JSON.stringify(this.serie.networks));

        //OBTENER SEASONS
        this.seasons = JSON.parse(JSON.stringify(this.serie.seasons));

        //OBTENER AL REPARTO (CREDITS)
        var config = {
            method: 'get',
            //url: 'https://api.themoviedb.org/3/tv/60574/aggregate_credits?api_key=fdc510bfe0d84dae126b382d74c09fed&language=en-US',
            url: 'https://api.themoviedb.org/3/tv/'+this.serie_id+'/aggregate_credits?api_key=fdc510bfe0d84dae126b382d74c09fed&language=en-US',
        };
        try {
            const response = await axios(config);
            if (response.data.cast) {
                this.casting = JSON.parse(JSON.stringify(response.data.cast));
            }
        } catch (error) {
            console.log(error);
        }

        //OBTENER KEYWORDS
        var config = {
            method: 'get',
            //url: 'https://api.themoviedb.org/3/tv/60574/keywords?api_key=fdc510bfe0d84dae126b382d74c09fed',
            url: 'https://api.themoviedb.org/3/tv/'+this.serie_id+'/keywords?api_key=fdc510bfe0d84dae126b382d74c09fed',
        };
        try {
            const response = await axios(config);
            if (response.data.results) {
                this.keywords = JSON.parse(JSON.stringify(response.data.results));
            }
        } catch (error) {
            console.log(error);
        }

        //OBTENER VIDEOS
        var config = {
            method: 'get',
            //url: 'https://api.themoviedb.org/3/tv/60574/videos?api_key=fdc510bfe0d84dae126b382d74c09fed&language=en-US',
            url: 'https://api.themoviedb.org/3/tv/'+this.serie_id+'/videos?api_key=fdc510bfe0d84dae126b382d74c09fed&language=en-US',
        };
        try {
            const response = await axios(config);
            if (response.data.results) {
                this.videos = JSON.parse(JSON.stringify(response.data.results));
            }
        } catch (error) {
            console.log(error);
        }

        //OBTENER RECOMENDACIONES
        var config = {
            method: 'get',
            //url: 'https://api.themoviedb.org/3/tv/60574/recommendations?api_key=fdc510bfe0d84dae126b382d74c09fed&language=en-US&page=1',
            url: 'https://api.themoviedb.org/3/tv/'+this.serie_id+'/recommendations?api_key=fdc510bfe0d84dae126b382d74c09fed&language=en-US&page=1',
        };
        try {
            const response = await axios(config);
            if (response.data.results) {
                this.recommendations = JSON.parse(JSON.stringify(response.data.results));
            }
        } catch (error) {
            console.log(error);
        }

        //OBTENER CLASIFICACIÓN (Content_Rating)
        var config = {
            method: 'get',
            //url: 'https://api.themoviedb.org/3/tv/60574/content_ratings?api_key=fdc510bfe0d84dae126b382d74c09fed&language=en-US',
            url: 'https://api.themoviedb.org/3/tv/'+this.serie_id+'/content_ratings?api_key=fdc510bfe0d84dae126b382d74c09fed&language=en-US',
        };
        try {
            const response = await axios(config);
            if (response.data.results) {
                this.certification = JSON.parse(JSON.stringify(response.data.results));
            }
        } catch (error) {
            console.log(error);
        }

        //OBTENER PROVIDERS
        var config = {
            method: 'get',
            //url: 'https://api.themoviedb.org/3/tv/60574/watch/providers?api_key=fdc510bfe0d84dae126b382d74c09fed',
            url: 'https://api.themoviedb.org/3/tv/'+this.serie_id+'/watch/providers?api_key=fdc510bfe0d84dae126b382d74c09fed',
        };
        try {
            const response = await axios(config);
            if (response.data.results) {
                this.providers = JSON.parse(JSON.stringify(response.data.results.US.flatrate));
            }
        } catch (error) {
            console.log(error);
        }
    },
}).mount('#contenedor');