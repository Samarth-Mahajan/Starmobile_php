<template>
  <div class="py-12 bg-gray-50">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <h1 class="text-2xl font-bold text-gray-800 mb-6 px-4 sm:px-0">User Dashboard</h1>
          
          <!-- Stats Cards -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 px-4 sm:px-0">
              <!-- Total Users Card -->
              <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
                  <div class="flex items-center justify-between">
                      <h2 class="text-sm font-medium text-gray-500">Total Users</h2>
                      <div class="p-2 bg-blue-100 rounded-full">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                              <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                          </svg>
                      </div>
                  </div>
                  <p class="mt-2 text-3xl font-bold text-gray-800">{{ stats.totalUsers }}</p>
                  <div class="mt-2 text-sm text-gray-600">All registered users</div>
              </div>
              
              <!-- New Users Today Card -->
              <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
                  <div class="flex items-center justify-between">
                      <h2 class="text-sm font-medium text-gray-500">New Today</h2>
                      <div class="p-2 bg-green-100 rounded-full">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                          </svg>
                      </div>
                  </div>
                  <p class="mt-2 text-3xl font-bold text-gray-800">{{ stats.newUsersToday }}</p>
                  <div class="mt-2 text-sm text-gray-600">New registrations today</div>
              </div>
              
              <!-- Last Week Users Card -->
              <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
                  <div class="flex items-center justify-between">
                      <h2 class="text-sm font-medium text-gray-500">Last 7 Days</h2>
                      <div class="p-2 bg-purple-100 rounded-full">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                          </svg>
                      </div>
                  </div>
                  <p class="mt-2 text-3xl font-bold text-gray-800">{{ stats.lastWeekUsers }}</p>
                  <div class="mt-2 text-sm text-gray-600">New users in the last week</div>
              </div>
              
              <!-- Growth Rate Card -->
              <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
                  <div class="flex items-center justify-between">
                      <h2 class="text-sm font-medium text-gray-500">Monthly Growth</h2>
                      <div class="p-2 bg-yellow-100 rounded-full">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                              <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                              <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                          </svg>
                      </div>
                  </div>
                  <p class="mt-2 text-3xl font-bold" :class="stats.growthRate >= 0 ? 'text-green-600' : 'text-red-600'">
                      {{ stats.growthRate >= 0 ? '+' : '' }}{{ stats.growthRate }}%
                  </p>
                  <div class="mt-2 text-sm text-gray-600">Month over month</div>
              </div>
          </div>
          
          <!-- Registration Chart -->
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
              <div class="p-6 bg-white border-b border-gray-200">
                  <h2 class="text-lg font-semibold text-gray-700 mb-4">User Registration Trend (Last 7 Days)</h2>
                  <div class="h-64">
                      <canvas ref="chartCanvas"></canvas>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
  props: {
      stats: Object,
  },
  data() {
      return {
          chart: null
      }
  },
  mounted() {
      this.initChart();
  },
  methods: {
      initChart() {
          // Check if Chart.js is available
          if (typeof Chart === 'undefined') {
              console.error('Chart.js is not loaded. Please include Chart.js in your project.');
              return;
          }

          const ctx = this.$refs.chartCanvas.getContext('2d');
          
          // Format the dates for display
          const dates = this.stats.registrationTrend.map(item => {
              const date = new Date(item.date);
              return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
          });
          
          const counts = this.stats.registrationTrend.map(item => item.count);
          
          this.chart = new Chart(ctx, {
              type: 'line',
              data: {
                  labels: dates,
                  datasets: [{
                      label: 'New Users',
                      data: counts,
                      backgroundColor: 'rgba(59, 130, 246, 0.2)',
                      borderColor: 'rgba(59, 130, 246, 1)',
                      borderWidth: 2,
                      tension: 0.4,
                      pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  scales: {
                      y: {
                          beginAtZero: true,
                          ticks: {
                              precision: 0
                          }
                      }
                  }
              }
          });
      }
  },
  beforeUnmount() {
      if (this.chart) {
          this.chart.destroy();
      }
  }
}
</script>