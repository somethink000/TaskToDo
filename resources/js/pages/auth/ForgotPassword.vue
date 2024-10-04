
<script>

// import centerPanel from '@/components/centerPanel.vue';
// import Header from '@/components/Header.vue';
// import CircleButtonImage from '@/components/CircleButtonImage.vue';


export default {
  data: () => {
    return {
      email: null,
      errors: null,
    }
  },
  components: {
    //centerPanel, Header, CircleButtonImage
  },
  methods: {
    resetPassword() {
      this.errors = null
      axios.post('/forgot-password', { email: this.email })
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

  <!-- <centerPanel>
    <Header> 
      <CircleButtonImage @click="this.$router.push('Login')" title="Login" image="/images/check.png"/> 
    </Header>
    
    <formCont>
      <form @submit.prevent="resetPassword">

        <inpBox class="main-border colItem">
          <input v-model="email" id="email" type="email" placeholder="Email" name="email" required="required" autofocus="autofocus">
        </inpBox>
        
        <div v-if="errors">
          <span>{{ errors.message }}</span>
        </div>
        
        <button class="colItem main-border" type="submit">
          Send Password-Reset E-Mail
        </button>

      </form>
    </formCont>
  </centerPanel> -->
</template>


