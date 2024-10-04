
<script>

import { useAuthStore } from '@/stores/auth.js'
import { mapActions } from 'pinia'
// import centerPanel from '@/components/centerPanel.vue';
// import Header from '@/components/Header.vue';
// import CircleButtonImage from '@/components/CircleButtonImage.vue';


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
    //centerPanel, Header, CircleButtonImage
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

  <!-- <centerPanel>
        <Header> 
          <CircleButtonImage @click="this.$router.push('Register')" title="Register" image="/images/plus.png"/> 
        </Header>
        
        <formCont>
          <form @submit.prevent="login">
            
            <inpBox class="main-border colItem">
              <input v-model="data.email" id="email" type="email" placeholder="Email" name="email" required="required" autofocus="autofocus">
            </inpBox>
           
            <inpBox class="main-border colItem">
              <input v-model="data.password" id="password" type="password" placeholder="Password" name="password" required="required" autocomplete="current-password">
            </inpBox>

            <div v-if="errors">
              <span>{{ errors.message }}</span>
            </div>

           
           
            <button class="colItem main-border" type="submit">Log in</button>

            <div class="colItem">
              <CircleButtonImage @click="this.$router.push({ name: 'ForgotPassword' })" title="Forgot password" /> 
            </div>

            <checkContent class="colItem">
                <txt>Remember me</txt>
                <input v-model="data.remember" id="remember" type="checkbox" name="remember" >
            </checkContent>


          </form>
        </formCont>
          
         
        
    
    
  </centerPanel>
   -->
</template>

<style>


  

  formCont{
    
    checkContent{
      display: flex;

      input{
        width: 20px;
      }
    
    }

  }

</style>