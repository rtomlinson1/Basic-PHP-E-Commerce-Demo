<?php
include('./includes/header.php');
include('./includes/menu.php');

 ?>
    <div class="container">
      <h2 class="is-size-2 has-text-centered">Locations</h2>
      <br>
      <div class="columns is-centered">
        <div class="column is-two-thirds overflow-x-auto">
          <h4 class="is-size-4">Main Location</h4>
          <table class="table is-bordered is-striped is-fullwidth">
            <thead>
              <th></th>
              <th><strong>Monday</strong></th>
              <th><strong>Tuesday</strong></th>
              <th><strong>Wednesday</strong></th>
              <th><strong>Thursday</strong></th>
              <th><strong>Friday</strong></th>
              <th><strong>Satuday</strong></th>
              <th><strong>Sunday</strong></th>
            </thead>
            <tbody>
              <tr>
                <td>Open:</td>
                <td>6am</td>
                <td>6am</td>
                <td>6am</td>
                <td>6am</td>
                <td>6am</td>
                <td>8am</td>
                <td>7am</td>
              </tr>
              <tr>
                <td>Close:</td>
                <td>10pm</td>
                <td>10pm</td>
                <td>10pm</td>
                <td>10pm</td>
                <td>12am</td>
                <td>10pm</td>
                <td>7pm</td>

              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="columns is-centered">
        <div class="column is-two-thirds overflow-x-auto">
          <h4 class="is-size-4">Mobile Coffee Truck</h4>
          <h5 class="is-size-5"><strong>ONLY OPEN ON MONDAYS!</strong> </h5>
          <table class="table is-bordered is-striped">
            <thead>
              <th></th>
              <th><strong>Monday</strong></th>
              <th><strong>Tuesday</strong></th>
              <th><strong>Wednesday</strong></th>
              <th><strong>Thursday</strong></th>
              <th><strong>Friday</strong></th>
              <th><strong>Satuday</strong></th>
              <th><strong>Sunday</strong></th>
            </thead>
            <tbody>
              <tr>
                <td>Open:</td>
                <td>5am</td>
                <td>CLOSED</td>
                <td>CLOSED</td>
                <td>CLOSED</td>
                <td>CLOSED</td>
                <td>CLOSED</td>
                <td>CLOSED</td>
              </tr>
              <tr>
                <td>Close:</td>
                <td>10pm</td>
                <td>CLOSED</td>
                <td>CLOSED</td>
                <td>CLOSED</td>
                <td>CLOSED</td>
                <td>CLOSED</td>
                <td>CLOSED</td>

              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="columns is-centered">
        <div class="column is-two-thirds overflow-x-auto">
          <h4 class="is-size-4">Inside Walmart</h4>
          <table class="table is-bordered is-striped">
            <thead>
              <th></th>
              <th><strong>Monday</strong></th>
              <th><strong>Tuesday</strong></th>
              <th><strong>Wednesday</strong></th>
              <th><strong>Thursday</strong></th>
              <th><strong>Friday</strong></th>
              <th><strong>Satuday</strong></th>
              <th><strong>Sunday</strong></th>
            </thead>
            <tbody>
              <tr>
                <td>Open:</td>
                <td>8am</td>
                <td>8am</td>
                <td>8am</td>
                <td>8am</td>
                <td>8am</td>
                <td>8am</td>
                <td>CLOSED</td>
              </tr>
              <tr>
                <td>Close:</td>
                <td>10pm</td>
                <td>10pm</td>
                <td>10pm</td>
                <td>10pm</td>
                <td>10am</td>
                <td>10pm</td>
                <td>CLOSED</td>

              </tr>
            </tbody>
          </table>
        </div>

    </div>
    <br>
  </div>
<?php
$current_file = 'location.php';
include('./includes/footer.php');
 ?>
