<template>
  <div class="qr-generator">
    <h2>QR Code Generator</h2>
    
    <div class="input-container">
      <label for="qr-text">Enter text or URL for QR code:</label>
      <input 
        id="qr-text" 
        v-model="qrText" 
        type="text" 
        placeholder="Enter text or URL"
      />
    </div>
    
    <div class="qr-container" v-if="qrText">
      <qrcode-vue :value="qrText" :size="size" level="H" />
      
      <div class="qr-options">
        <label for="qr-size">Size:</label>
        <input 
          id="qr-size" 
          v-model.number="size" 
          type="range" 
          min="100" 
          max="300" 
          step="10"
        />
        <span>{{ size }}px</span>
      </div>
      
      <button @click="downloadQR" class="download-btn">Download QR Code</button>
    </div>
    
    <div class="instructions" v-else>
      <p>Enter some text or a URL above to generate a QR code.</p>
    </div>
  </div>
</template>

<script>
import QrcodeVue from 'qrcode.vue';

export default {
  name: 'QRGenerator',
  components: {
    QrcodeVue
  },
  data() {
    return {
      qrText: '',
      size: 200
    };
  },
  methods: {
    downloadQR() {
      // Find the canvas element
      const canvas = this.$el.querySelector('canvas');
      if (!canvas) return;
      
      // Create a temporary link element
      const link = document.createElement('a');
      link.download = 'qrcode.png';
      link.href = canvas.toDataURL('image/png');
      
      // Trigger the download
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }
  }
};
</script>

<style scoped>
.qr-generator {
  max-width: 500px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  color: #333;
  margin-bottom: 20px;
}

.input-container {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
  color: #555;
}

input[type="text"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 16px;
}

.qr-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 20px;
}

.qr-options {
  margin: 15px 0;
  display: flex;
  align-items: center;
  gap: 10px;
}

.download-btn {
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 10px 15px;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s;
}

.download-btn:hover {
  background-color: #45a049;
}

.instructions {
  text-align: center;
  color: #777;
  margin-top: 20px;
}
</style>
