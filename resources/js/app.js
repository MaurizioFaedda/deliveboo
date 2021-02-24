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
    cart_list: [],
    dishes_id: [],
    new_dish_obj: null,
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
    addItemCart(id_dish){
      // Inserisco l'id del piatto aggiunto dall'utente nell'array da passare al backend con il form
      this.dishes_id.push(id_dish);
      // -------------------- AXIOS call for Dish by ID --------------------
      axios
      .get('/api/dish/' + id_dish)
      .then(response => {
          this.cart_list.push(response.data.results);
          console.log(this.cart_list);
          this.new_dish_obj = '';
          this.saveDishes();
      });
    },
    removeItemCart(dish) {
      // A partire dall'elemento che voglio cancellare ne prendo solo 1
      this.cart_list.splice(dish,1);
      this.saveDishes();
    },
    saveDishes() {
      let parsed = JSON.stringify(this.cart_list);
      localStorage.setItem('cart_list', parsed);
    },
    removeAllItemsCart() {
      this.cart_list = [];
      this.saveDishes();
    }
  },
  mounted() {
    this.getAllRestaurants();
    this.getAllTypes();
    // Grabbing the value and parse the JSON value.
    if(localStorage.getItem('cart_list')) {
      try {
        this.cart_list = JSON.parse(localStorage.getItem('cart_list'));
      } catch(e) {
        // If anything goes wrong here we assume the data is corrupt and delete it.
        localStorage.removeItem('cart_list');
      }
    }
  },
});
