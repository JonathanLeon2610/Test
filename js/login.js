const { createApp } = Vue; 
const app = createApp({ 
  data() {
    return {
      users: null,
      email: '',
      password: '',
    }
  },
  methods: 
  {
      login(e)
      {
          e.preventDefault();
          var data = new FormData();
          data.append('username', this.email);
          data.append('password', this.password);
          data.append('request_token', '');

          var config = 
          {
              method: 'post',
              url: 'https://api.themoviedb.org/3/authentication/token/validate_with_login?api_key=8bf31e57a4c4eff6668908a8dc882b5f',
              headers: 
              { 
              },
              data : data
          };
          var username = this.email
          axios(config)
          .then(function (response) 
          {
              if(response.data.success)
              {
                sessionStorage.setItem("user", JSON.stringify(username));
              }
              console.log(JSON.stringify(response.data));
              location.href = 'detalle_pelicula.html';
              alert("Se ha conectado correctamente");
          })
          .catch(function (error) 
          {
              alert("Sesión no válida, no pudimos validar tu inicio de sesión");
              console.log(error);
          });
      },
  }
}).mount('#contenedor');