<template>
  <div class="not-found">
    <h1>404</h1>
    <p>The page you are looking for does not exist.</p>
    <router-link to="/qr" class="btn btn-primary">Go to Home</router-link>
  </div>
</template>

<script>
export default {
  name: 'NotFound'
};
</script>
