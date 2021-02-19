require('./bootstrap');
var app = new Vue ({
    el: '#app',
    data: {
      types: [],
      restaurants: [],
      dishes: [],
      selected_type: '',
      checked_types: [],
      filtered_restaurants: []
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
        console.log(this.checked_types);
        for (var i = 0; i < this.checked_types.length; i++) {
          axios
          .get('/api/restaurants/' + this.checked_types[i])
          .then(response => {
            this.restaurants = response.data.results;
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
