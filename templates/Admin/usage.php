<?php $this->extend('/layout/phoenix/standard'); ?>
<section class="section">
      <div class="row">

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">New Users & Learners</h5>
<?php
$chartLabels = json_encode(array_keys($usersCreated));
$userData = json_encode(array_values($usersCreated));
$learnerData = json_encode(array_values($learnersCreated));
?>
<script>
var chartLabels = <?php echo $chartLabels; ?>;
var userData = <?php echo $userData; ?>;
var learnerData = <?php echo $learnerData; ?>;
</script>
              <!-- Line Chart -->
<canvas id="users" style="max-height: 400px;"></canvas>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.querySelector('#users'), {
      type: 'line',
      data: {
        labels: chartLabels, // Use data from PHP script
        datasets: [{
          label: 'New Users',
          data: userData, // Use data from PHP script
          fill: true,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0
        },
	{
          label: 'New Learners',
          data: learnerData, // Use data from PHP script
          fill: true,
          borderColor: 'rgb(255, 99, 132)',
          tension: 0
        }]
      },
      options: {
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          stepSize: 1, // This line will force the scale to use integers
          precision: 0 // This line will force the scale to not use decimal places
        }
      }
    }
  }
    });
  });
</script>
<!-- End Line Chart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Usage Breakdown</h5>

              <!-- Bar Chart -->
<canvas id="modusage" style="max-height: 400px;"></canvas>
<script>
  document.addEventListener("DOMContentLoaded", () => {

    // Get the data from PHP
    var totalCounts = <?php echo json_encode($totalCounts); ?>;

    // Get the labels and data from totalCounts
    var modelCountLabels = Object.keys(totalCounts);
    var modelCountData = Object.values(totalCounts);

    new Chart(document.querySelector('#modusage'), {
      type: 'bar',
      data: {
        labels: modelCountLabels, // use labels from PHP data
        datasets: [{
          label: 'Model',
          data: modelCountData, // use data from PHP data
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
      y: {
        beginAtZero: true,
        ticks: {
          stepSize: 1, // This line will force the scale to use integers
          precision: 0 // This line will force the scale to not use decimal places
        }
      }
    }
      }
    });
  });
</script>
<!-- End Bar Chart -->


            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Historical Revenue</h5>
<?php
$revChartLabels = json_encode(array_keys($revenueByDay));
$revUserData = json_encode(array_values($revenueByDay));
?>
<script>
var revChartLabels = <?php echo $revChartLabels; ?>;
var revUserData = <?php echo $revUserData; ?>;
</script>
              <!-- Line Chart -->
<canvas id="revenue" style="max-height: 400px;"></canvas>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.querySelector('#revenue'), {
      type: 'line',
      data: {
        labels: revChartLabels, // Use data from PHP script
        datasets: [{
          label: 'Revenue',
          data: revUserData, // Use data from PHP script
          fill: true,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0
        }]
      },
      options: {
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          stepSize: 1, // This line will force the scale to use integers
          precision: 0 // This line will force the scale to not use decimal places
        }
      }
    }
  }
    });
  });
</script>
<!-- End Line Chart -->

            </div>
          </div>
        </div>

      </div>
    </section>