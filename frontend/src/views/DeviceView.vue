<template>
  <div class="device-view">
    <div v-if="loading" class="loading">
      <p>Loading device information...</p>
    </div>
    <div v-else-if="error" class="error">
      <p>{{ error }}</p>
      <button @click="fetchDevice" class="btn btn-primary">Try Again</button>
    </div>
    <div v-else-if="device" class="device-container">
      <h1 class="device-title">{{ device.name }}</h1>
      
      <div class="tabs">
        <div class="tab-item">
          <a @click="activeTab = 'info'" :class="['tab-link', { active: activeTab === 'info' }]">
            <i class="fas fa-info-circle"></i> Device Information
          </a>
        </div>
        <div class="tab-item">
          <a @click="activeTab = 'manuals'" :class="['tab-link', { active: activeTab === 'manuals' }]">
            <i class="fas fa-book"></i> Manuals
          </a>
        </div>
        <div class="tab-item">
          <a @click="activeTab = 'ticket'" :class="['tab-link', { active: activeTab === 'ticket' }]">
            <i class="fas fa-ticket-alt"></i> Report an Issue
          </a>
        </div>
      </div>
      
      <div class="tab-content">
        <!-- Device Information Tab -->
        <div :class="['tab-pane', { active: activeTab === 'info' }]">
          <div class="card">
            <div class="card-header">
              <h2>Device Details</h2>
            </div>
            <div class="card-body">
              <div class="device-info">
                <div class="info-item">
                  <span class="info-label">Product:</span>
                  <span>{{ device.product.name }}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">Serial Number:</span>
                  <span>{{ device.serial_number }}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">QR Code:</span>
                  <span>{{ device.qr_code }}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">Order Number:</span>
                  <span>{{ device.order_number || 'N/A' }}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">Delivery Date:</span>
                  <span>{{ formatDate(device.delivery_date) }}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">Installation Date:</span>
                  <span>{{ formatDate(device.installation_date) }}</span>
                </div>
                <div class="info-item">
                  <span class="info-label">Warranty:</span>
                  <span>{{ device.warranty_months }} months</span>
                </div>
                <div class="info-item">
                  <span class="info-label">Warranty Status:</span>
                  <span :class="{ 'text-success': isUnderWarranty, 'text-danger': !isUnderWarranty }">
                    {{ isUnderWarranty ? 'Active' : 'Expired' }}
                  </span>
                </div>
                <div class="info-item" v-if="isUnderWarranty">
                  <span class="info-label">Warranty Expires:</span>
                  <span>{{ formatDate(warrantyExpirationDate) }}</span>
                </div>
              </div>
            </div>
          </div>
          
          <div class="card" v-if="device.product.specifications">
            <div class="card-header">
              <h2>Specifications</h2>
            </div>
            <div class="card-body">
              <div class="device-info">
                <div class="info-item" v-for="(value, key) in device.product.specifications" :key="key">
                  <span class="info-label">{{ formatSpecKey(key) }}:</span>
                  <span>{{ value }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Manuals Tab -->
        <div :class="['tab-pane', { active: activeTab === 'manuals' }]">
          <div class="card">
            <div class="card-header">
              <h2>Available Manuals</h2>
            </div>
            <div class="card-body">
              <div v-if="device.manuals && device.manuals.length > 0">
                <ul class="manual-list">
                  <li v-for="manual in device.manuals" :key="manual.id" class="manual-item">
                    <i class="fas fa-file-pdf manual-icon"></i>
                    <a :href="manual.file_path" target="_blank" class="manual-link">
                      {{ manual.title }} ({{ manual.language.toUpperCase() }})
                    </a>
                  </li>
                </ul>
              </div>
              <div v-else>
                <p>No manuals available for this device.</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Report an Issue Tab -->
        <div :class="['tab-pane', { active: activeTab === 'ticket' }]">
          <div class="card">
            <div class="card-header">
              <h2>Report an Issue</h2>
            </div>
            <div class="card-body">
              <form @submit.prevent="submitTicket" class="ticket-form">
                <div class="form-group">
                  <label for="name">Your Name *</label>
                  <input 
                    type="text" 
                    id="name" 
                    v-model="ticket.reporter_name" 
                    class="form-control" 
                    required
                  >
                </div>
                
                <div class="form-group">
                  <label for="email">Your Email *</label>
                  <input 
                    type="email" 
                    id="email" 
                    v-model="ticket.reporter_email" 
                    class="form-control" 
                    required
                  >
                </div>
                
                <div class="form-group">
                  <label for="phone">Your Phone Number *</label>
                  <input 
                    type="tel" 
                    id="phone" 
                    v-model="ticket.reporter_phone" 
                    class="form-control" 
                    required
                  >
                </div>
                
                <div class="form-group">
                  <label for="title">Issue Title *</label>
                  <input 
                    type="text" 
                    id="title" 
                    v-model="ticket.title" 
                    class="form-control" 
                    required
                  >
                </div>
                
                <div class="form-group">
                  <label for="description">Issue Description *</label>
                  <textarea 
                    id="description" 
                    v-model="ticket.description" 
                    class="form-control" 
                    rows="5" 
                    required
                  ></textarea>
                </div>
                
                <div class="form-group">
                  <label for="availability">When are you available for a technician to contact you?</label>
                  <input 
                    type="text" 
                    id="availability" 
                    v-model="ticket.availability_time" 
                    class="form-control" 
                    placeholder="e.g., Weekdays 9am-5pm"
                  >
                </div>
                
                <div class="form-group">
                  <label>Attach a file (optional)</label>
                  <div class="file-upload">
                    <label for="file" class="file-upload-label">
                      <i class="fas fa-upload"></i> Choose File
                    </label>
                    <input 
                      type="file" 
                      id="file" 
                      @change="handleFileUpload" 
                      class="form-control-file"
                    >
                    <span v-if="ticket.file" class="file-name">{{ ticket.file.name }}</span>
                  </div>
                </div>
                
                <div class="form-actions">
                  <button type="button" @click="resetForm" class="btn btn-secondary">Reset</button>
                  <button type="submit" class="btn btn-primary" :disabled="submitting">
                    {{ submitting ? 'Submitting...' : 'Submit' }}
                  </button>
                </div>
                
                <div v-if="ticketSuccess" class="alert alert-success mt-3">
                  Your issue has been reported successfully. We will contact you soon.
                </div>
                
                <div v-if="ticketError" class="alert alert-danger mt-3">
                  {{ ticketError }}
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="no-device">
      <p>Please scan a valid QR code to view device information.</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DeviceView',
  data() {
    return {
      loading: false,
      error: null,
      device: null,
      activeTab: 'info',
      ticket: {
        reporter_name: '',
        reporter_email: '',
        reporter_phone: '',
        title: '',
        description: '',
        availability_time: '',
        file: null
      },
      submitting: false,
      ticketSuccess: false,
      ticketError: null
    };
  },
  computed: {
    qrCode() {
      // Check both route params and query params for the code
      const code = this.$route.params.code || this.$route.query.code;
      console.log('Detected QR code:', code);
      console.log('Route params:', this.$route.params);
      console.log('Route query:', this.$route.query);
      return code;
    },
    isUnderWarranty() {
      if (!this.device || !this.device.delivery_date || !this.device.warranty_months) {
        return false;
      }
      
      const deliveryDate = new Date(this.device.delivery_date);
      const warrantyEndDate = new Date(deliveryDate);
      warrantyEndDate.setMonth(warrantyEndDate.getMonth() + this.device.warranty_months);
      
      return new Date() < warrantyEndDate;
    },
    warrantyExpirationDate() {
      if (!this.device || !this.device.delivery_date || !this.device.warranty_months) {
        return null;
      }
      
      const deliveryDate = new Date(this.device.delivery_date);
      const warrantyEndDate = new Date(deliveryDate);
      warrantyEndDate.setMonth(warrantyEndDate.getMonth() + this.device.warranty_months);
      
      return warrantyEndDate;
    }
  },
  watch: {
    qrCode: {
      immediate: true,
      handler(newCode) {
        if (newCode) {
          this.fetchDevice();
        }
      }
    }
  },
  methods: {
    async fetchDevice() {
      if (!this.qrCode) return;
      
      this.loading = true;
      this.error = null;
      
      try {
        const url = `http://localhost:8000/api/devices/${this.qrCode}`;
        console.log('Fetching device from URL:', url);
        // Make an API call to the backend to fetch device information
        const response = await fetch(url);
        
        if (!response.ok) {
          throw new Error(`Failed to fetch device: ${response.statusText}`);
        }
        
        this.device = await response.json();
      } catch (err) {
        this.error = 'Failed to load device information. Please try again.';
        console.error(err);
      } finally {
        this.loading = false;
      }
    },
    formatDate(dateString) {
      if (!dateString) return 'N/A';
      
      const date = new Date(dateString);
      return date.toLocaleDateString();
    },
    formatSpecKey(key) {
      return key.charAt(0).toUpperCase() + key.slice(1).replace(/_/g, ' ');
    },
    handleFileUpload(event) {
      this.ticket.file = event.target.files[0] || null;
    },
    resetForm() {
      this.ticket = {
        reporter_name: '',
        reporter_email: '',
        reporter_phone: '',
        title: '',
        description: '',
        availability_time: '',
        file: null
      };
      this.ticketSuccess = false;
      this.ticketError = null;
      
      // Reset file input
      const fileInput = document.getElementById('file');
      if (fileInput) {
        fileInput.value = '';
      }
    },
    async submitTicket() {
      this.submitting = true;
      this.ticketSuccess = false;
      this.ticketError = null;
      
      try {
        // Create ticket data
        const ticketData = {
          device_id: this.device.id,
          reporter_name: this.ticket.reporter_name,
          reporter_email: this.ticket.reporter_email,
          reporter_phone: this.ticket.reporter_phone,
          title: this.ticket.title,
          description: this.ticket.description,
          availability_time: this.ticket.availability_time
        };
        
        // Make API call to create ticket
        const response = await fetch('http://localhost:8000/api/tickets', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(ticketData)
        });
        
        if (!response.ok) {
          throw new Error(`Failed to create ticket: ${response.statusText}`);
        }
        
        const result = await response.json();
        
        if (result.success) {
          this.ticketSuccess = true;
          this.resetForm();
        } else {
          throw new Error(result.message || 'Failed to create ticket');
        }
      } catch (err) {
        this.ticketError = err.message || 'Failed to submit your issue. Please try again.';
        console.error(err);
      } finally {
        this.submitting = false;
      }
    }
  }
};
</script>

<style scoped>
.device-title {
  margin-bottom: 1.5rem;
  text-align: center;
}

.loading, .error, .no-device {
  text-align: center;
  padding: 2rem;
}

.alert {
  padding: 0.75rem 1.25rem;
  margin-bottom: 1rem;
  border: 1px solid transparent;
  border-radius: 0.25rem;
}

.alert-success {
  color: #155724;
  background-color: #d4edda;
  border-color: #c3e6cb;
}

.alert-danger {
  color: #721c24;
  background-color: #f8d7da;
  border-color: #f5c6cb;
}

.mt-3 {
  margin-top: 1rem;
}

.text-success {
  color: var(--success-color);
}

.text-danger {
  color: var(--danger-color);
}
</style>
