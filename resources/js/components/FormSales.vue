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
                                    <th width="10%">Disconto</th>
                                    <th width="16%">Subtotal</th>
                                    <th width="5%" align="center">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <sales-item v-for="(item, key) in items" :index="key" :key="item.product_id" :item="item"></sales-item>
                                <tr v-show="!items.length" class="table-info">
                                    <td colspan="7" align="center">Sales items empty.</td>
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
                        <label for="customer">Cliente</label>
                        
                        <div class="input-group mb-3">
                            
                            <input id="search-box" type="text" class="form-control" placeholder="Buscar Cliente..." />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#customerModal"><i class="fa fa-plus"></i> Criar</button>
                            </div>
                            
                            <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="customerModalLabel">Create New Customer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group row" v-show="(form.amountDue < 0 || items.length != 0)">
                        <div class="col-12">
                            <label for="">Subtotal</label>
                            <h4 class="text-success form-control-plaintext">{{ totalAmount }} R$</h4>
                        </div>
                        <div class="col-12">
                            <label>Total à pagar</label>
                            <h4 class="text-warning form-control-plaintext">{{ amountDue }} R$</h4>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <button type="submit" class="btn btn-success btn-block">Finalizar Venda</button>
                    <a href="/" class="btn btn-link btn-block">Cancelar</a>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import ProductSearch from './ProductSearch.vue';
import SalesItem from './SalesItem.vue';

export default {
    components: {
        ProductSearch,
        SalesItem
    },
    data () {
        return {
            payment: {
            },
            form: {
                customer_id: null
            },
            items: [],
            customers: [],
        }
    },
     computed: {
        totalPayment () {
            return _.sumBy(this.salesPayments, 'amount')
        },
        totalAmount: function(){
            return _.sumBy(this.items, 'subtotal_unit_price')
        },
        amountDue: function() {
            return this.totalAmount - this.totalPayment
        }
    },
    methods: {
        addItem (item) {
            let ids = _.map(this.items, 'id')

            if (!_.includes(ids, item.id)) {
                this.$set(item, 'quantity', 1)
                this.$set(item, 'discount', 0)
                this.$set(item, 'subtotal_unit_price', (item.price * item.quantity))

                this.items.push(item)
            } else {
                let index = _.findIndex(this.items, function(i) {
                    return i.id == item.id
                })

                let currentProduct = this.items[index]

                currentProduct.quantity = currentProduct.quantity + 1
            }
        },
        removeItem (item) {
            let index = _.findIndex(this.items, function(i) {
                return i.id == item.id
            })

            let currentProduct = this.items[index]

            if (currentProduct.quantity - 1 == 0) {
                this.deleteItem(currentProduct)
            } else {
                currentProduct.quantity = currentProduct.quantity - 1
            }
        },
        deleteItem (item) {
            let index = _.findIndex(this.items, function(i) {
                return i.id == item.id
            })

            this.items.splice(index, 1)
        },
        clearForm () {
            this.form = {
                customer_id: null
            }
            this.items = []
            this.salesPayments = []

            this.$bus.$emit('inputCustomerCleared')
        },
        validateForm () {
            const that = this

            this.$validator.validateAll().then((result) => {
                if (result) {
                    that.store()
                }
            });
        },

        // main action
        store () {
            const that = this

            let formRequest = this.form
            formRequest.items = _.map(this.items, (item) => {
                return {
                    product_id: item.id,
                    price: item.unit_price,
                    discount: item.discount,
                    quantity: item.quantity
                }
            })
            formRequest.payments = _.map(this.salesPayments, (payment) => {
                return {
                    amount: payment.amount
                }
            })

            axios.post('/api/sales', formRequest).then(res => {
                that.$swal({
                    title: 'Success!',
                    text: res.data.message,
                    type: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                }).then(swalRes => {
                });

                that.clearForm()
            })
        }
    },
    mounted () {
         const that = this

        this.$bus.$on('productSelected', event => {
            let item = event.product
            
            if (item) {
                this.addItem(item)
            }
        })

        this.$bus.$on('customerSelected', event => {
            let customer = event.customer
            
            if (customer) {
                this.form.customer_id = customer.id
            }
        })

        axios.get('/api/customers/search').then(res => {
            that.customers = res.data
        })
    }
}
</script>
