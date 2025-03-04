<template>
  <div class="qr-generator-view">
    <h1>QR Code Generator</h1>
    <p class="description">
      Generate QR codes for your devices, products, or any other information you need to share.
    </p>
    <QRGenerator />
  </div>
</template>

<script>
import QRGenerator from '../components/QRGenerator.vue';

export default {
  name: 'QRGeneratorView',
  components: {
    QRGenerator
  }
};
</script>

<style scoped>
.qr-generator-view {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  text-align: center;
  color: var(--primary-color);
  margin-bottom: 10px;
}

.description {
  text-align: center;
  color: var(--secondary-color);
  margin-bottom: 30px;
}
</style>
