<template>
    <div class="row">
        <div class="col-md-8 col-sm-12">

            <div class="card mb-3">

                <div class="card-header">Items de Venda</div>

                <div class="card-body p-0">
                   <product-search class="p-2"></product-search>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Produto</th>
                                    <th width="14%">Preço</th>
                                    <th width="7%">Quantidade</th>
                                    <th width="16%">% Desconto</th>
                                    <th width="10%">Subtotal</th>
                                    <th width="5%" align="center">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <sales-item v-for="(item, key) in items" :index="key" :key="item.product_id" :item="item"></sales-item>
                                <tr v-show="!items.length" class="table-info">
                                    <td colspan="7" align="center">Items de venda vazio.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer small text-muted">
                    Total Item : {{ items.length }}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">

                <div class="card-header">Venda</div>

                <div class="card-body pb-0">
                    <div class="form-group">
                        <label for="customer">Cliente *</label>
                        <input-customer></input-customer>
                    </div>
                    <div class="form-group row" v-show="(form.amountDue < 0 || items.length != 0)">
                        <div class="col-6">
                            <label for="">Subtotal</label>
                            <h4 class="text-success form-control-plaintext">{{ totalAmount }}</h4>
                        </div>
                        <div class="col-6">
                            <label>Total à pagar</label>
                            <h4 class="text-warning form-control-plaintext">{{ amountDue }}</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group" v-show="items.length > 0">
                        <label for="name">Payment Methods *</label>
                        <div class="input-group mb-3">

                            <!-- select payment -->
                            <select
                            @change="addPayment"
                            v-validate="'required'"
                            data-vv-name="paymentMethod"
                            v-model="payment.paymentMethod"
                            :class="{'form-control' : true, 'is-invalid' : errors.has('paymentMethod')}">
                                <option
                                v-for="paymentMethod in paymentMethods"
                                :key="paymentMethod.id"
                                :value="paymentMethod">{{ paymentMethod.name }}</option>
                            </select>

                            <div class="invalid-feedback">{{ errors.first('paymentMethod') }}</div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" @click.prevent="validateForm" :disabled="(items.length == 0)">Finalizar venda</button>
                    <a href="/" class="btn btn-link btn-block">cancelar</a>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import InputCustomer from "./InputCustomer.vue";
import ProductSearch from "./ProductSearch.vue";
import SalesItem from "./SalesItem.vue";

export default {
  components: {
    ProductSearch,
    SalesItem,
    InputCustomer
  },
  data() {
    return {
      payment: {},
      paymentMethods: [],
      salePayment: {},
      form: {
        customer_id: null
      },
      items: [],
      customers: []
    };
  },
  computed: {
    totalAmount: function() {
      return _.sumBy(this.items, "subtotal_unit_price");
    },
    amountDue: function() {
      return this.totalAmount;
    }
  },
  methods: {
    addItem(item) {
      let ids = _.map(this.items, "id");

      if (!_.includes(ids, item.id)) {
        this.$set(item, "quantity", 1);
        this.$set(item, "discount", 0);
        this.$set(
          item,
          "subtotal_unit_price",

          Number(item.price * item.quantity).toFixed(2)
        );

        this.items.push(item);
      } else {
        let index = _.findIndex(this.items, function(i) {
          return i.id == item.id;
        });

        let currentProduct = this.items[index];

        currentProduct.quantity = currentProduct.quantity + 1;
      }
    },

    addPayment() {
      let payment = this.payment;
      this.salePayment = { paymentMethod: payment.paymentMethod };
    },

    removeItem(item) {
      let index = _.findIndex(this.items, function(i) {
        return i.id == item.id;
      });

      let currentProduct = this.items[index];

      if (currentProduct.quantity - 1 == 0) {
        this.deleteItem(currentProduct);
      } else {
        currentProduct.quantity = currentProduct.quantity - 1;
      }
    },

    deleteItem(item) {
      let index = _.findIndex(this.items, function(i) {
        return i.id == item.id;
      });

      this.items.splice(index, 1);
    },

    clearForm() {
      this.form = {
        customer_id: null
      };
      this.items = [];
      this.salesPayments = [];

      this.$bus.$emit("inputCustomerCleared");
    },
    validateForm() {
      const that = this;

      this.$validator.validateAll().then(result => {
        if (result) {
          that.store();
        }
      });
    },
    // main action
    store() {
      const that = this;

      let formRequest = this.form;

      formRequest.items = _.map(this.items, item => {
        return {
          product_id: item.id,
          price: item.price,
          discount: item.discount,
          quantity: item.quantity
        };
      });

      formRequest.payment = {
        payment_method_id: this.payment.paymentMethod.id
      };

      axios.post("/api/sales", formRequest).then(res => {
        that
          .$swal({
            title: "Venda confirmada!",
            text: res.data.message,
            type: "success",
            showConfirmButton: false,
            timer: 1500
          })
          .then(swalRes => {});

        that.clearForm();
      });
    }
  },
  mounted() {
    const that = this;

    this.$bus.$on("productSelected", event => {
      let item = event.product;

      if (item) {
        this.addItem(item);
      }
    });

    this.$bus.$on("customerSelected", event => {
      let customer = event.customer;

      if (customer) {
        this.form.customer_id = customer.id;
      }
    });

    axios.get("/api/customers/search").then(res => {
      that.customers = res.data;
    });

    axios.get("/api/payment-methods/all").then(res => {
      that.paymentMethods = res.data;
      // select first payment
      this.payment.paymentMethod = that.paymentMethods[0];
    });
  }
};
</script>
