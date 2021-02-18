require('./bootstrap');
var app = new Vue ({
    el: '#app',
    data: {
      types: [],
      restaurants: [],
      dishes: [],
      selected_type: ''
    },
    methods: {
      showAllRestaurants() {
        this.selected_type = '';
      },
      getSelectedRestaurants() {
        // -------------------- AJAX call for Selected Restaurants by Type --------------------
        axios
        .get('/api/restaurants/', {
          params: {
            query: this.selected_type
          }
        })
        .then(response => {
          this.restaurants = response.data.results;
        });
      }
    },
    mounted() {
      const self = this;
      // -------------------- AJAX call for Types --------------------
      axios
      .get('/api/types')
      .then(response => {
        self.types = response.data.results;
      });
      // -------------------- AJAX call for Restaurants --------------------
      axios
      .get('/api/restaurants')
      .then(response => {
        self.restaurants = response.data.results;
      });

      // -------------------- AJAX call for Dishes --------------------
      axios
      .get('/api/dishes')
      .then(response => {
        self.dishes = response.data.results;
      });
    }
});
