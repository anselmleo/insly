<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <title>Task Two</title>
</head>
<body>
  <div class="container">
    <div class="center-content">
      <img id="header-logo" src="../images/insly-logo.svg" /> 
      <div class="center-section-first-content">
        <h1 id="TASKTWO">TASK TWO</h1>
        <button class="selected" disabled>Insly</button>
      </div>
      <div class="center-section-second-content">
        <p>Write a simple car insurance calculator which will output price of the policy
        <br>using vanilla PHP and JavaScript</p>
      </div>
      <hr class="center-content-line">
      <div id="error-container" style="display: none">
        <div id="error-message" class="errors"></div>
        <button id="error-button" class="form-input-button" type="button">Back</button>
      </div>
      <div id="form-container" style="display: block">
        <form class="input-form">
          <div class="form-header">
            <header>Car Insurance Calculator</header>
          </div>  
          <div class="input-box">
            <label class="input-label" for="estimatedValue">Estimated value of the car (100 - 100 000 EUR)</label><br>
            <input id="estimatedValue" class="input-element" type="number" min="100" max="100000" name="estimatedValue" value="100" required>
          </div>
          <div class="input-box">
            <label class="input-label" for="tax">Tax percentage (0 - 100%)</label><br>
            <input id="tax" class="input-element" type="number" min="0" max="100" name="tax" value="0" required>
          </div>
          <div class="input-box">
            <label class="input-label" for="instalments">Number of instalments</label><br>
            <input id="instalments" class="input-element" class="form-control" type="number" min="1" max="12" name="instalments" value="1" required>
          </div>
          <input id="csrf_token" type="hidden" name="csrf_token" value="<?php session_start(); require_once '../Helper.php'; $csrfHelper = new Helper(); echo $csrfHelper->csrf_token(); ?>">
          <input id="submit" class="form-input-button" type="submit" value="Calculate">
        </form>
      </div>
      
      <div id="result-table-container" style="display: none">
          <table id="result-table">
            <thead>
            <tr id="result-table-headers">
              <th scope="col">#</th>
              <th scope="col">Policy</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <th scope="row">Value</th>
            </tr>
            <tr>
              <td>Base premium (11%)</td>
            </tr>
            <tr>
              <td>Commission (17%)</td>
            </tr>
            <tr>
              <td>Tax (<span id="tax-data"></span> )</td>
            </tr>
            <tr>
              <th scope="row">Total cost</th>
            </tr>
            </tbody>
          </table>
          
        </div>
        <button id="back-button" class="form-input-button" type="button" style="display: none">Back</button>
    </div>
  </div>
  <script src="../scripts/request.js"></script>
</body>
</html>