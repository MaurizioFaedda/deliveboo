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
      cart_list:[],
      dishes_id:[]
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
    },
    addItemCart(value){
        // Pusho l'id del piatto in un array
        this.dishes_id.push(value);
        // -------------------- AXIOS call for Dish by ID --------------------
        axios
        .get('/api/dish/' + value)
        .then(response => {
            this.cart_list.push(response.data.results);
            console.log(this.cart_list);
        });
    },
    },
    mounted() {
      this.getAllRestaurants();
      this.getAllTypes();
      this.getAllDishes();
    }
});
