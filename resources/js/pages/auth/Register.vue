


<script>
import { mapActions } from 'pinia'
import { useAuthStore } from '@/stores/auth.js'


export default {
  data: () => {
    return {
      data: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
      errors: null,
    }
  },
  components: {

  },
  methods: {
    ...mapActions(useAuthStore, ['attempt_user']),
    register() {
      this.errors = null
      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/register', this.data)
          .then((response) => {
            this.attempt_user()
              .then(() => {
                this.$router.push({ name: 'Home' })
              })
              .catch((error) => {
                console.error(error);
              })
          })
          .catch((error) => {
            this.errors = error.response.data.errors
          })
      });
    },
  },
}
</script>


<template>

  <centerPanel>

      <Header> 
        <CircleButtonImage @click="this.$router.push('Login')" title="Login" image="/images/check.png"/> 
      </Header>

      <formCont>
        <form @submit.prevent="register">

            <inpBox class="main-border colItem">
              <input v-model="data.name" placeholder="Name" id="name" type="text" name="name" required="required" autofocus="autofocus">
            </inpBox>
            <div v-if="errors && errors.name">
              <p v-for="(error, index) in errors.name" :key="'name-' + index" >{{ error }}</p>
            </div>
        
            <inpBox class="main-border colItem">
              <input v-model="data.email" placeholder="Email" id="email" type="email" name="email" required="required" autofocus="autofocus">
            </inpBox>
            <div v-if="errors && errors.email">
              <p v-for="(error, index) in errors.email" :key="'email-' + index" >{{ error }}</p>
            </div>
          
            <inpBox class="main-border colItem">
              <input v-model="data.password" placeholder="Password" id="password" type="password" name="password" required="required" autocomplete="current-password">
            </inpBox>
            <div v-if="errors && errors.password">
              <p v-for="(error, index) in errors.password" :key="'password-' + index" >{{ error }}</p>
            </div>

            <inpBox class="main-border colItem">
              <input v-model="data.password_confirmation" placeholder="Confirm password" id="password_confirmation" type="password" name="password_confirmation" required="required" autocomplete="current-password">
            </inpBox>
            <div v-if="errors && errors.password_confirmation">
              <p v-for="(error, index) in errors.password_confirmation" :key="'password_confirmation-' + index" >{{ error }}</p>
            </div>
        
  
            <button class="colItem main-border" type="submit">
              Register
            </button>
      
        </form>
      </formCont>
  </centerPanel>
</template>

