
<script>

import centerPanel from '@/components/centerPanel.vue';
import Header from '@/components/Header.vue';
import CircleButtonImage from '@/components/CircleButtonImage.vue';

export default {
  data() {
    return {
      errors: null,
    }
  },
  components: {
    centerPanel, Header, CircleButtonImage
  },
  methods: {
    resendVerification() {
      this.errors = null
      axios.post('/email/verification-notification')
        .then((response) => {
          console.log(response)
        })
        .catch((error) => {
          this.errors = error.response.data
        })
    }
  }
}
</script>


<template>


  <centerPanel>
    <Header> 
      <CircleButtonImage @click="this.$router.push('Register')" title="Register" image="/images/plus.png"/> 
    </Header>


   
    <txt class="colItem">Click on link in the sented message to verify email address</txt>

     

    <form @submit.prevent="resendVerification">
      <div v-if="errors" class="text-red-500 py-2 font-semibold">
        <span>{{ errors.message }}</span>
      </div>


        <button class="colItem main-border" type="submit">Resend Verification Email</button>
     

    </form>
 
  </centerPanel>
</template>

