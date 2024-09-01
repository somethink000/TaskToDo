
<script>

import { useAuthStore } from '@/stores/auth.js'
import { mapActions } from 'pinia'
import centerPanel from '@/components/centerPanel.vue';

export default {
  data: () => {
    return {
      errors: null,
      data: {
        email: null,
        password: null,
        remember: true,
      },
    }
  },
  components: {
    centerPanel,
  },
  methods: {
    ...mapActions(useAuthStore, ['attempt_user', 'set_user']),
    login() {
      this.errors = null

      axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/login', this.data)
          .then((response) => {
            if (response?.status === 200 && response.data?.two_factor) {
              this.$router.replace({ name: 'TwoFactorChallenge' })
              return
            }

            this.attempt_user()
              .then((response) => {
                if (response?.status === 200) {
                  this.$router.replace({ name: 'Home' })
                }
              })
              .catch((error) => {
                this.errors = error
              })
          })
          .catch((error) => {
            this.errors = error
          })
      });
    },
  },
}
</script>


<template>

  <centerPanel>

          <form @submit.prevent="login">
            

              <input class="colItem main-border" v-model="data.email" id="email" type="email" placeholder="Email" name="email" required="required" autofocus="autofocus">
            
           
              <input class="colItem main-border" v-model="data.password" id="password" type="password" placeholder="Password" name="password" required="required" autocomplete="current-password">
           
            <div v-if="errors">
              <span>{{ errors.message }}</span>
            </div>

           
           
          

              
              <button class="colItem main-border" type="submit">Log in</button>

            <div class="colItem">
              <router-link :to="{ name: 'ForgotPassword' }">
                Forgot your password?
              </router-link>


              
              <input v-model="data.remember" id="remember" type="checkbox" name="remember">

            </div>

          </form>

          
          <router-link class="colItem" :to="{ name: 'Register' }">
            <txt>Register</txt>
          </router-link>
        
    
    
  </centerPanel>
  
</template>

