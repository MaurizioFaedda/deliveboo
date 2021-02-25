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
    duplicates: [],
    quantity: 1,
    subTotal: 0,
    new_dish_obj: null,
    current_quantity: 1,
    totalPrice: 0
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
            });
        }
    },
    // ------------------- Cart list--------------------
    addItemCart(id_dish){
        this.quantity = 1;
        // Inserisco l'id del piatto aggiunto dall'utente nell'array da passare al backend con il form
        this.dishes_id.push(id_dish);
        // -------------------- AXIOS call for Dish by ID --------------------
        // Controllo se il carrello è vuoto
        if (this.cart_list.length === 0) {
            axios
            // .put('/api/dish/' + id_dish, { qty: 1 })
            .get('/api/dish/' + id_dish)
            .then(response => {
             // Se è vuoto aggiungo il primo elemento/piatto al carrello
                Object.assign(response.data.results, {qnty: 1})
                this.cart_list.push(response.data.results);
                // this.cart_list[0]({
                //     visible: 1
                // });
                this.new_dish_obj = '';
                this.totalPrice = response.data.results.price;
                this.saveDishes();
                this.saveTotalPrice();
            });
        } else {
            // Se il carrello non è vuoto verifico che il ristorante da cui aggiungo i piatti sia lo stesso del primo piatto
            axios
            .get('/api/dish/' + id_dish)
            .then(response => {
                var temp = true;
                // Controllo che la fk del piatto appena aggiunto (quello ciclato) sia uguale all'id del ristorante del primo piatto
                if ( this.cart_list[0].restaurant_id === response.data.results.restaurant_id) {
                    // Se il ristorante è lo stesso l'utente può procedere ad aggiungere il piatto all'ordine/carrello
                    for (var i = 0; i < this.cart_list.length; i++) {
                        if (this.cart_list[i].id == response.data.results.id) {
                            this.cart_list[i].qnty++
                            temp = false;
                            this.new_dish_obj = '';
                            this.totalPrice += response.data.results.price;
                            this.saveDishes();
                            this.saveTotalPrice();
                        }

                    }

                    if (temp) {
                        Object.assign(response.data.results, {qnty: 1})
                        this.cart_list.push(response.data.results);
                        this.totalPrice += response.data.results.price;
                        this.saveDishes();
                        this.saveTotalPrice();
                    }

                } else {
                    alert('Pippo');
                }

            });
        }
    },
    removeItemCart(index, dish) {
      // A partire dall'elemento che voglio cancellare ne prendo solo 1
      this.totalPrice -= dish.price * dish.qnty;
      this.cart_list.splice(index,1);
      this.saveTotalPrice();
      this.saveDishes();
    },
    removeAllCart(){
        //  Svuoto il cart_list e lo comunico al localStorage
        this.cart_list = [];
        this.totalPrice = 0;
        this.saveDishes();
        this.saveTotalPrice();
    },
    saveDishes() {
      let parsed = JSON.stringify(this.cart_list);
      localStorage.setItem('cart_list', parsed);
    },
    saveTotalPrice() {
      let parsed = JSON.stringify(this.totalPrice);
      localStorage.setItem('totalPrice', parsed);
    },
    changeQuantity(value, index){
        this.cart_list[index].qnty = value;
        this.saveDishes();
        this.saveTotalPrice();
    },
    getSubTotal(singlePrice, quantity){
        return singlePrice*quantity
    },
    getDuplicates(dish){
        Object.assign(dish, {qnty: 1});
    },
    getTotalPrice(){
        this.totalPrice = 0;
        for (var i = 0; i < this.cart_list.length; i++) {
            this.totalPrice += this.cart_list[i].qnty * this.cart_list[i].price;
        }
        this.saveTotalPrice();
        return this.totalPrice
    },
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
        };
        if (localStorage.totalPrice) {
         this.totalPrice = parseFloat(localStorage.totalPrice);
        };

    },

});
