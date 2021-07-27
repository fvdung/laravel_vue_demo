<template>
  <div class="container">
    <div class="header">
      <h2>CALCULATOR</h2>
    </div>
    <div class="wrapper">
      <div class="input-box">
        <label class="title">Enter the numbers</label>
        <input v-model="firstNumber" type="number" name="first_number" class="form-control" placeholder="number 2">
        <small v-if="errors.first_number" class="text-error">{{ errors.first_number[0] }}</small>
        <input v-model="secondNumber" type="number" name="second_number" class="form-control" placeholder="number 2">
        <small v-if="errors.first_number" class="text-error">{{ errors.first_number[0] }}</small>
        <button class="btn btn-danger" @click="getSum()">Sum</button>
      </div>
      <hr class="divider">
      <div class="result-box">
        <label class="title">Results</label>
        <input v-model="result" type="number" class="form-control form-result">
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        firstNumber: null,
        secondNumber: null,
        result: null,
        errors: []
      }
    },
    methods: {
      getSum() {
        this.errors = []
        axios.post('/api/calculator/sum', {
          first_number: parseFloat(this.firstNumber),
          second_number: parseFloat(this.secondNumber)
        }).then(result => {
          this.result = result.data.sum
        }).catch(error => {
          console.log(error.response)
          if (error && error.response.status == 422) {
            this.errors = error.response.data.errors
          }
        })
      }
    }
  }
</script>

<style scoped>
  .container, .wrapper, .input-box, .result-box {
    display: flex;
    flex-direction: column;
  }
  .container {
    justify-content: center;
    width: 100%;
    max-width: 100%;
  }
  .header {
    background-color: #C10708;
    text-align: center;
    font-weight: 600;
    padding: 15px 0px;
    font-size: 22px;
    color: #fff;
    width: 100%;
  }
  .wrapper {
    border: 2px solid #ccc;
    border-radius: 2px;
    padding: 50px;
    align-self: center;
    margin: 30px 10px;
  }
  .title {
    text-align: center;
    color: #999;
  }
  .form-control {
    border-radius: 3px;
    border: 2px solid #999;
    margin-top: 15px;
  }
  .btn-danger {
    background-color: #C10708;
    display: block;
    padding: 10px 0;
    font-weight: 500;
    color: #fff;
    margin: 15px 0 30px 0;
    border-radius: 3px;
  }
  .mt-10 {
    margin-top: 10px;
  }
  .divider {
    background-color: #C10708;
    height: 2px;
    border: none;
  }
  .text-error {
    color: #C10708;
  }
  .result-box {
    padding-top: 40px;
  }
  .form-result {
    border-color: #C10708;
  }
  @media only screen and (min-width: 1024px) {
    .wrapper {
      max-width: 550px;
    }
  }
  @media only screen and (min-width: 768px) {
    .wrapper {
      width: 80%;
    }
  }
  @media only screen and (min-width: 667px) {
    .wrapper {
      width: 85%;
    }
  }
  @media only screen and (min-width: 420px) {
    .wrapper {
      width: 90%;
    }
  }
</style>