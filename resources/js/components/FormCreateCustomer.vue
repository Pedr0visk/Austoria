<template>
    <form>
        <div class="form-group">
            <label for="name">Nome *</label>
            <input v-model="form.name" type="text" class="form-control" id="name" placeholder="Igor Paiva...">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="instagram">Instagram (opcional)</label>
            <input v-model="form.instagram" type="text" class="form-control" id="instagram" placeholder="pedrobellotooficial">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="phone">Telefone</label>
            <input v-model="form.phone" type="text" class="form-control" id="phone" placeholder="(24) 99999-9999">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
            <label for="dob">Data de Nascimento</label>
            <input v-model="form.dob" type="date" class="form-control" id="dob" placeholder="Data de nascimento">
            <div class="invalid-feedback"></div>
        </div>
    </form>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: null,
        phone: null,
        instagram: null,
        dob: null
      }
    };
  },
  methods: {
    store() {
      const that = this;

      axios.post("/api/customers", this.form).then(res => {
        that.$bus.$emit("customerCreated", {
          customer: res.data
        });

        that.clearForm();
      });
    },
    clearForm() {
      this.form = {
        name: null,
        phone: null,
        instagram: null,
        dob: null
      };
    }
  },
  mounted() {
    this.$bus.$on("saveFormCreateCustomer", event => {
      this.store();
    });

    this.$bus.$on("clearFormCreateCustomer", event => {
      this.clearForm();
    });
  }
};
</script>
