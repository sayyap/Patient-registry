<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';

const apiUrl = 'http://localhost:8000/api'; // Change this to your backend URL

// Axios client instance
const apiClient = axios.create({
  baseURL: apiUrl,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'

  },
  withCredentials: true
});

// Patients data
const patients = ref<any[]>([]);

// Fetch all patients from the backend
const fetchPatients = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/patients');
    patients.value = response.data.data;
  } catch (error) {
    console.error('Error fetching patients:', error);
  }
};

// Call the fetchPatients function when the component is mounted
onMounted(() => {
  fetchPatients();
});
</script>

<template>
  <div class="form-container">
    <div class="table-section">
      <h2>Patients Records</h2>
      <table class="patients-table">
        <thead>
        <tr>
          <th>Name</th>
          <th>Date of Birth</th>
          <th>National ID</th>
          <th>Island ID</th>
          <th>Street</th>
          <th>City</th>
          <th>House Name</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="patient in patients" :key="patient.id">
          <td>{{ patient.name }}</td>
          <td>{{ patient.date_of_birth }}</td>
          <td>{{ patient.national_id }}</td>
          <td>{{ patient.address.island_id }}</td>
          <td>{{ patient.address.street }}</td>
          <td>{{ patient.address.city }}</td>
          <td>{{ patient.address.house_name }}</td>
        </tr>
        </tbody>
      </table>
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

.table-section {
  width: 100%;
  max-width: 900px;
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

.patients-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

.patients-table th,
.patients-table td {
  padding: 12px;
  text-align: left;
  border: 1px solid #ddd;
}

.patients-table th {
  background-color: #5cb85c;
  color: white;
}

.patients-table tbody tr:hover {
  background-color: #f1f1f1;
}
</style>
