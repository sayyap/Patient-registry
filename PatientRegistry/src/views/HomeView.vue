<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';

// Form data for the combined patient and address information
const formData = ref({
  name: '',
  date_of_birth: '',
  national_id: '',
  address: {
    island_id: '',
    street: '',
    city: '',
    house_name: ''
  }
});

// Define the API base URL (you can replace this with your actual backend URL)
const apiUrl = 'https://localhost/api'; // Change this to your backend URL

// Axios client instance
const apiClient = axios.create({
  baseURL: apiUrl,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Submit handler for the form (Patient + Address)
const submitForm = async () => {
  try {
    // Send combined form data (patient + address) to the backend
    const response = await apiClient.post('/api/patients', formData.value);
    console.log('Form Submitted:', response.data);

    // You can display a success message or redirect the user
    alert('Patient and address information saved successfully');

    // Optionally, you could clear the form fields after submission
    formData.value = {
      name: '',
      date_of_birth: '',
      national_id: '',
      address: {
        island_id: '',
        street: '',
        city: '',
        house_name: ''
      }
    };
  } catch (error) {
    // Log error and show a failure message
    console.error('Error submitting form:', error);
    alert('There was an error submitting the data');
  }
};
</script>

<template>
  <div class="form-container">
    <!-- Combined Form for Patient and Address Information -->
    <div class="form-section">
      <h2>Patient Information</h2>
      <form @submit.prevent="submitForm">
        <!-- Personal Information -->
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" v-model="formData.name" placeholder="Enter your name" required />
        </div>

        <div class="form-group">
          <label for="date_of_birth">Date of Birth</label>
          <input type="date" id="date_of_birth" v-model="formData.date_of_birth" required />
        </div>

        <div class="form-group">
          <label for="national_id">National ID</label>
          <input type="text" id="national_id" v-model="formData.national_id" placeholder="Enter your National ID" required />
        </div>

        <!-- Address Information -->
        <h3>Address Information</h3>
        <div class="form-group">
          <label for="island_id">Island ID</label>
          <input type="text" id="island_id" v-model="formData.address.island_id" placeholder="Enter Island ID" required />
        </div>

        <div class="form-group">
          <label for="street">Street</label>
          <input type="text" id="street" v-model="formData.address.street" placeholder="Enter Street Name" required />
        </div>

        <div class="form-group">
          <label for="city">City</label>
          <input type="text" id="city" v-model="formData.address.city" placeholder="Enter City" required />
        </div>

        <div class="form-group">
          <label for="house_name">House Name</label>
          <input type="text" id="house_name" v-model="formData.address.house_name" placeholder="Enter House Name" required />
        </div>

        <button type="submit" class="submit-btn">Submit</button>
      </form>
    </div>
  </div>
</template>

<style scoped>
.form-container {
  display: flex;
  flex-direction: column;
  gap: 40px;
  padding: 20px;
}

.form-section {
  width: 100%;
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  font-size: 24px;
  color: #333;
  margin-bottom: 20px;
}

h3 {
  text-align: center;
  font-size: 20px;
  color: #333;
  margin-top: 20px;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  font-size: 14px;
  color: #555;
  margin-bottom: 5px;
}

input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 16px;
  color: #333;
}

input:focus {
  outline: none;
  border-color: #5cb85c;
}

button.submit-btn {
  width: 100%;
  padding: 12px;
  background-color: #5cb85c;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
}

button.submit-btn:hover {
  background-color: #4cae4c;
}
</style>
