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
      show_all() {
        this.selected_type = '';
      }
    },
    mounted() {
      const self = this;
      // -------------------- AJAX call for Types --------------------
      axios
      .get('/api/types')
      .then(response => {
        self.types = response.data.results;
        console.log(self.types);
      });
      // -------------------- AJAX call for Restaurants --------------------
      axios
      .get('/api/restaurants')
      .then(response => {
        self.restaurants = response.data.results;
        console.log(self.restaurants);
      });
      // -------------------- AJAX call for Dishes --------------------
      axios
      .get('/api/dishes')
      .then(response => {
        self.dishes = response.data.results;
        console.log(self.dishes);
      });
    }
});
