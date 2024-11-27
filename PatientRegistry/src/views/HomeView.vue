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
const apiUrl = 'http://localhost:8000/api'; // Change this to your backend URL

// Axios client instance
// const apiClient = axios.create({
//   baseURL: apiUrl,
//   headers: {
//     'Content-Type': 'application/json',
//   },
// });

// Store validation errors
const validationErrors = ref<any>({});

// Submit handler for the form (Patient + Address)
const submitForm = async () => {
  try {
    // Send combined form data (patient + address) to the backend
    const res = await axios.post(`${apiUrl}/patients`, formData.value)
    console.log(res)

    // const response = await apiClient.post('/patients', formData.value);
    // console.log('Form Submitted:', response.data);

    // Display a success message
    alert('Patient and address information saved successfully');
    
    // Optionally clear the form fields after submission
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

    // Clear validation errors
    validationErrors.value = {};
  } catch (error: any) {
    // Check if the error is an Axios error
    if (error.isAxiosError) {
      console.error('Axios Error:', error.response);

      // Check for validation errors (HTTP status 422)
      if (error.response && error.response.status === 422) {
        // Validation error occurred (for form submission)
        console.error('Validation error:', error.response.data.errors);
        validationErrors.value = error.response.data.errors; // Store errors for display
        alert('There were validation errors. Please check the form fields.');
      } else if (error.response) {
        // Handle other HTTP errors
        console.error(`HTTP Error: ${error.response.status} - ${error.response.statusText}`);
        alert(`Error: ${error.response.status} - ${error.response.statusText}`);
      } else {
        // Handle case where no response is received
        console.error('No response from server.');
        alert('No response from server. Please check your network connection or try again later.');
      }
    } else {
      // Non-Axios error (e.g., network failure, etc.)
      console.error('Error:', error);
      alert('An unexpected error occurred. Please try again later.');
    }
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
        <div class="form-group" :class="{'has-error': validationErrors.name}">
          <label for="name">Name</label>
          <input
            type="text"
            id="name"
            v-model="formData.name"
            placeholder="Enter your name"
            required
          />
          <div v-if="validationErrors.name" class="error-message">
            <span>{{ validationErrors.name[0] }}</span>
          </div>
        </div>

        <div class="form-group" :class="{'has-error': validationErrors.date_of_birth}">
          <label for="date_of_birth">Date of Birth</label>
          <input
            type="date"
            id="date_of_birth"
            v-model="formData.date_of_birth"
            required
          />
          <div v-if="validationErrors.date_of_birth" class="error-message">
            <span>{{ validationErrors.date_of_birth[0] }}</span>
          </div>
        </div>

        <div class="form-group" :class="{'has-error': validationErrors.national_id}">
          <label for="national_id">National ID</label>
          <input
            type="text"
            id="national_id"
            v-model="formData.national_id"
            placeholder="Enter your National ID"
            required
          />
          <div v-if="validationErrors.national_id" class="error-message">
            <span>{{ validationErrors.national_id[0] }}</span>
          </div>
        </div>

        <!-- Address Information -->
        <h3>Address Information</h3>
        <div class="form-group" :class="{'has-error': validationErrors['address.island_id']}">
          <label for="island_id">Island ID</label>
          <input
            type="text"
            id="island_id"
            v-model="formData.address.island_id"
            placeholder="Enter Island ID"
            required
          />
          <div v-if="validationErrors['address.island_id']" class="error-message">
            <span>{{ validationErrors['address.island_id'][0] }}</span>
          </div>
        </div>

        <div class="form-group" :class="{'has-error': validationErrors['address.street']}">
          <label for="street">Street</label>
          <input
            type="text"
            id="street"
            v-model="formData.address.street"
            placeholder="Enter Street Name"
            required
          />
          <div v-if="validationErrors['address.street']" class="error-message">
            <span>{{ validationErrors['address.street'][0] }}</span>
          </div>
        </div>

        <div class="form-group" :class="{'has-error': validationErrors['address.city']}">
          <label for="city">City</label>
          <input
            type="text"
            id="city"
            v-model="formData.address.city"
            placeholder="Enter City"
            required
          />
          <div v-if="validationErrors['address.city']" class="error-message">
            <span>{{ validationErrors['address.city'][0] }}</span>
          </div>
        </div>

        <div class="form-group" :class="{'has-error': validationErrors['address.house_name']}">
          <label for="house_name">House Name</label>
          <input
            type="text"
            id="house_name"
            v-model="formData.address.house_name"
            placeholder="Enter House Name"
            required
          />
          <div v-if="validationErrors['address.house_name']" class="error-message">
            <span>{{ validationErrors['address.house_name'][0] }}</span>
          </div>
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

.has-error input {
  border-color: red;
}

.error-message {
  color: red;
  font-size: 12px;
}
</style>
