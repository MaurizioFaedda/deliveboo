require('./bootstrap');
var app = new Vue ({
    el: '#app',
    data: {
      types: [],
      restaurants: []
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
    }
});
