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
      current_restaurants: [],
      id_restaurant: []
    },
    methods: {
      getAllRestaurants() {
        this.selected_type = '';
        this.restaurants = [];
        // -------------------- AXIOS call for ALL Restaurants --------------------
        axios
        .get('/api/restaurants')
        .then(response => {
          this.restaurants = response.data.results;
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
        // console.log(this.checked_types);
        for (var i = 0; i < this.checked_types.length; i++) {
          axios
          .get('/api/restaurants/' + this.checked_types[i])
          .then(response => {
            // prendo i risultati della chiamata ajax e li salvo in un array di appoggio
            this.current_restaurants = response.data.results;
            // console.log(this.current_restaurants);
            // Ciclo il risultato della chiamata
            this.current_restaurants.forEach((currentrestaurants) => {
                // per ogni sinsolo oggetto controllo che id del ristorante non sia già presente nell'array id_restaurant
                if(!this.id_restaurant.includes(currentrestaurants.id)){

                    // se non è presente lo pusho nell'array id_restaurant
                    this.id_restaurant.push(currentrestaurants.id);
                    // console.log(this.id_restaurant);

                    // Dopo aver selezionato gli elementi che hanno passato il check dell'id del ristorante li pusho nell'array dei ristoranti filtrati
                    this.filtered_restaurants.push(currentrestaurants);
                    // console.log(this.filtered_restaurants);

                    // Attribuisco il risultato dei ristoranti filtrati all'array restaurants
                    this.restaurants = this.filtered_restaurants;
                    // console.log(this.restaurant);
                }
            });
          });

        }




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
      }
    },
    mounted() {
      this.getAllRestaurants();
      this.getAllTypes();
      this.getAllDishes();
    }
});
