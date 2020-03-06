var csrfToken = $('meta[name="csrf-token"]').attr('content')

Vue.component('editable', {
  props: ['productId', 'initValue'],
  template: `
  <p>
    <span v-show="!editing">
      {{value}}
      <a class="editing" @click="editing=true">
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
      </a>
    </span>
    <span v-show="editing" >
      <div class="input-group">
        <input
            v-model="tempValue"
            @keydown.enter="update"
            type="number" 
            class="form-control"
            autofocus
             >
        <span class="input-group-btn">
          <button class="btn btn-default" type="button" @click="update">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
          </button>
          <button class="btn btn-default" type="button" @click="cancel">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
          </button>
        </span>
      </div>
    </span>
  </p>
  `,
  mounted: function () {
    this.value = this.tempValue = this.initValue
  },
  data () {
    return {
      editing: false,
      value: 0,
      tempValue: 0,
    }
  },
  methods: {

    update: function () {
      this.value = this.tempValue
      this.$root.$emit('changed', { 'id': this.productId, 'value': this.value })
      this.editing = false
    },

    cancel: function () {
      this.tempValue = this.value
      this.editing = false
    },

  }
})

window.onload = function () {
  new Vue({
    el: '#app',
    created: function () {
      this.$root.$on('changed', this.updatePrice)
    },
    methods: {
      updatePrice: function (data) {
        var updateData = {
          '_token': csrfToken,
          '_method': 'PATCH',
          'price': data.value
        }
        axios.post('/api/products/' + data.id, updateData)
          .catch((error) => console.log(error.response.data))
      },
    }
  })
}
