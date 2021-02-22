require('./bootstrap');

var app = new Vue ({
    el: '#app',
    data: {
      types: [],
      restaurants: [],
      dishes: [],
      selected_type: '',
      checked_types: [],
      filtered_restaurants: [],
    },
    methods: {
    getAllRestaurants() {
        this.selected_type = '';
        this.restaurants = [];
        this.checked_types = [];
        // -------------------- AXIOS call for ALL Restaurants --------------------
        axios
        .get('/api/restaurants')
        .then(response => {
          this.restaurants = response.data.results;
        });
    },
    getAllTypes() {
        // -------------------- AXIOS call for all Types --------------------
        axios
        .get('/api/types')
        .then(response => {
          this.types = response.data.results;
        });
    },
    getAllDishes() {
        // -------------------- AXIOS call for all Dishes --------------------
        axios
        .get('/api/dishes')
        .then(response => {
          this.dishes = response.data.results;
        });
    },
      getFilteredRestaurants() {
        this.restaurants = [];
        // -------------------- AXIOS call for FILTERED Restaurants by Type --------------------
        axios
        .get('/api/restaurants/' + this.selected_type)
        .then(response => {
          this.restaurants = response.data.results;
        });
      },
      getFilteredRestaurantsByTypes() {
        var request = {
          checked: this.checked_types
        }
        // Se l'array di checkbox è vuoto visualizzo in automatico tutti i ristoranti
        if(this.checked_types.length == 0) {
          this.getAllRestaurants()
        } else {
          // -------------------- AXIOS call for FILTERED Restaurants by Types --------------------
          this.restaurants = [];
          axios
          .post('/api/restaurants/', request)
          .then(response => {
            // prendo i risultati della chiamata ajax e li salvo in un array di appoggio
            this.restaurants = response.data.results;
            console.log(this.restaurants);
          });
        }
      }
    },
    mounted() {
      this.getAllRestaurants();
      this.getAllTypes();
      this.getAllDishes();
    }
});



// var app = new Vue ({
//     el: '#app',
//     data: {
//       types: [],
//       restaurants: [],
//       dishes: [],
//       selected_type: '',
//       // checked_types: [],
//       // filtered_restaurants: [],
//       // id_restaurant: [],
//       // search_reset: '',
//       // pizza_checked: '',
//       // array_pizza_checked: [],
//       // italian_checked: '',
//       // array_italian_checked: [],
//       // sushi_checked: '',
//       // array_sushi_checked: [],
//       // vegan_checked: '',
//       // array_vegan_checked: [],
//       // organic_checked: '',
//       // array_organic_checked: [],
//       // street_checked: '',
//       // array_street_checked: [],
//       // asian_checked: '',
//       // array_asian_checked: [],
//       // mexican_checked: '',
//       // array_mexican_checked: [],
//       // hawaian_checked: '',
//       // array_hawaian_checked: [],
//       // array_carrello: []
//     },
//     methods: {
//     getAllRestaurants() {
//         // this.selected_type = '';
//         // this.restaurants = [];
//         // this.checked_types = [];
//         // -------------------- AXIOS call for ALL Restaurants --------------------
//         axios
//         .get('/api/restaurants')
//         .then(response => {
//           this.restaurants = response.data.results;
//         });
//     },
//     // getPizza() {
//     //     // -------------------- AXIOS call for FILTERED Restaurants by Type --------------------
//     //     axios
//     //     .get('/api/restaurants/' + '1')
//     //     .then(response => {
//     //       this.array_pizza_checked = response.data.results;
//     //       console.log(this.array_pizza_checked);
//     //     });
//     // },
//     // getItalianFood() {
//     //     // -------------------- AXIOS call for FILTERED Restaurants by Type --------------------
//     //     axios
//     //     .get('/api/restaurants/' + '2')
//     //     .then(response => {
//     //       this.array_italian_checked = response.data.results;
//     //       console.log(this.array_italian_checked);
//     //     });
//     // },
//     // getSushi() {
//     //     // -------------------- AXIOS call for FILTERED Restaurants by Type --------------------
//     //     axios
//     //     .get('/api/restaurants/' + '3')
//     //     .then(response => {
//     //       this.array_sushi_checked = response.data.results;
//     //       console.log(this.array_sushi_checked);
//     //     });
//     // },
//     // getVeganFoods() {
//     //     // -------------------- AXIOS call for FILTERED Restaurants by Type --------------------
//     //     axios
//     //     .get('/api/restaurants/' + '4')
//     //     .then(response => {
//     //       this.array_vegan_checked = response.data.results;
//     //       console.log(this.array_vegan_checked);
//     //     });
//     // },
//     // getOrganicFoods() {
//     //     // -------------------- AXIOS call for FILTERED Restaurants by Type --------------------
//     //     axios
//     //     .get('/api/restaurants/' + '5')
//     //     .then(response => {
//     //       this.array_organic_checked = response.data.results;
//     //       console.log(this.array_organic_checked);
//     //     });
//     // },
//     // getStreetFoods() {
//     //     // -------------------- AXIOS call for FILTERED Restaurants by Type --------------------
//     //     axios
//     //     .get('/api/restaurants/' + '6')
//     //     .then(response => {
//     //       this.array_street_checked = response.data.results;
//     //       console.log(this.array_street_checked);
//     //     });
//     // },
//     // getAsianFoods() {
//     //     // -------------------- AXIOS call for FILTERED Restaurants by Type --------------------
//     //     axios
//     //     .get('/api/restaurants/' + '7')
//     //     .then(response => {
//     //       this.array_asian_checked = response.data.results;
//     //       console.log(this.array_asian_checked);
//     //     });
//     // },
//     // getMexican() {
//     //     // -------------------- AXIOS call for FILTERED Restaurants by Type --------------------
//     //     axios
//     //     .get('/api/restaurants/' + '8')
//     //     .then(response => {
//     //       this.array_mexican_checked = response.data.results;
//     //       console.log(this.array_mexican_checked);
//     //     });
//     // },
//     // getHawaianFoods() {
//     //     // -------------------- AXIOS call for FILTERED Restaurants by Type --------------------
//     //     axios
//     //     .get('/api/restaurants/' + '9')
//     //     .then(response => {
//     //       this.array_hawaian_checked = response.data.results;
//     //       console.log(this.array_hawaian_checked);
//     //     });
//     // },
//     // getAllTypes() {
//     //     // -------------------- AXIOS call for all Types --------------------
//     //     axios
//     //     .get('/api/types')
//     //     .then(response => {
//     //       this.types = response.data.results;
//     //       console.log(this.types);
//     //     });
//     // },
//     // getAllDishes() {
//     //     // -------------------- AXIOS call for all Dishes --------------------
//     //     axios
//     //     .get('/api/dishes')
//     //     .then(response => {
//     //       this.dishes = response.data.results;
//     //     });
//     // },
//     // search_reset(){
//     //     this.pizza_checked = 0;
//     //     this.italian_checked = 0;
//     //     this.sushi_checked = 0;
//     //     this.vegan_checked = 0;
//     //     this.organic_checked = 0;
//     //     this.street_checked = 0;
//     //     this.asian_checked = 0;
//     //     this.mexican_checked = 0;
//     //     this.hawaian_checked = 0;
//     // }
//       getFilteredRestaurants() {
//         this.restaurants = [];
//         // -------------------- AXIOS call for FILTERED Restaurants by Type --------------------
//         axios
//         .get('/api/restaurants/' + this.selected_type)
//         .then(response => {
//           this.restaurants = response.data.results;
//         });
//       },
//
//
//     },
//     mounted() {
//       this.getAllRestaurants();
//       this.getAllTypes();
//       // this.getPizza();
//       // this.getSushi();
//       // this.getItalianFood();
//       // this.getVeganFoods();
//       // this.getOrganicFoods();
//       // this.getStreetFoods();
//       // this.getAsianFoods();
//       // this.getMexican();
//       // this.getHawaianFoods();
//       this.getAllDishes();
//     }
// });
