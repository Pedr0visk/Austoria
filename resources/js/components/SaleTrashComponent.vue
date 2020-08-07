<template>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <!-- card -->
        <div class="card mb-3 text-white bg-dark">
            <!-- card header -->
            <div class="card-header">Lixeira</div>
            <!-- card body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0 table-striped table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Transação</th>
                                <th>Subtotal</th>
                                <th>Total</th>
                                <th><i class="fa fa-calendar"></i> data</th>
                                <th>Recuperar</th>
                                <th>Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(sale, key) in sales" :index="key" :key="sale.id" :item="item">
                                <th>{{ sale.id}}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      sales: []
    };
  },
  methods: {
    restore() {
      const that = this;

      //   axios.post("/api/customers", this.form).then(res => {
      //     that.$bus.$emit("customerCreated", {
      //       customer: res.data
      //     });

      //     that.clearForm();
      //   });
    }
  },
  mounted() {
    const that = this;

    axios.get("/api/sales/trash").then(res => {
      console.log(res.data.data);
      that.sales = res.data.data;
    });
  }
};
</script>
