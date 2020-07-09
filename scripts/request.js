function getId(id) {
  return document.getElementById(id);
}

getId('submit').addEventListener("click", function(event){
  event.preventDefault()
});

function getClass(className) {
  return document.getElementsByClassName(className);
}

let estimatedValue = getId('estimatedValue');
let tax = getId('tax');
let instalments = getId('instalments');
let submit = getId('submit');
let csrf_token = getId('csrf_token');

var xhttp = new XMLHttpRequest();

submit.onclick = function() {
  xhttp.open('POST', '../tasktwo.php');
  xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhttp.send('estimatedValue=' + estimatedValue.value + '&tax=' + tax.value + '&instalments=' + instalments.value + '&csrf_token=' + csrf_token.value + '&submit=' + submit.value);
  return false;
};

xhttp.onload = function () {
  if (xhttp.status >= 200 && xhttp.status < 300) {
    console.log(xhttp.status);
    showResultTable(JSON.parse(xhttp.response));
    let formContainerElement = getId('form-container');
    formContainerElement.style.display = 'none';
    let tableContainerElement = getId('result-table-container');
    tableContainerElement.style.display = 'block';
    let buttonElement = getId('back-button');
    buttonElement.style.display = 'block';
  } else {
    console.log('The request failed!');
    console.log(JSON.parse(xhttp.response));
    showError(JSON.parse(xhttp.response));
    let formContainerElement = getId('form-container');
    formContainerElement.style.display = 'none';
  }
};

let tableClone = getId('result-table').cloneNode(true);
clearTable();

function clearTable() {
  let table = getId('result-table');
  table.parentNode.removeChild(table);
}

function addHeader(i) {
  let header = getId('result-table-headers');
  let newNode = document.createElement('th');
  let newContent = document.createTextNode(i + ' instalment');
  newNode.appendChild(newContent);
  header.appendChild(newNode);
}

function addData(index, list, content) {
  let newNode = document.createElement('td');
  let newContent = document.createTextNode(content);
  newNode.appendChild(newContent);
  list[index].appendChild(newNode);
}

function showResultTable(response) {
  let newTableClone = tableClone.cloneNode(true);
  getId('result-table-container').appendChild(newTableClone);

  let taxHolder = getId('tax-data');
  let newContent = document.createTextNode(tax.value + '%');
  taxHolder.appendChild(newContent);
    
  let tbodyList = document.querySelectorAll('#result-table-container table tbody tr');
  addData(0, tbodyList, response.value);
  addData(1, tbodyList, response.base_price);
  addData(2, tbodyList, response.commission);
  addData(3, tbodyList, response.tax);
  addData(4, tbodyList, response.total);

  if (response.payments.length > 0) {
      for (var i = 0; i < response.payments.length; i++) {
          addHeader(i+1);

          addData(0, tbodyList, '');
          addData(1, tbodyList, response.payments[i].base_price);
          addData(2, tbodyList, response.payments[i].commission);
          addData(3, tbodyList, response.payments[i].tax);
          addData(4, tbodyList, response.payments[i].total);
      }
  }
}


function showError(response) {
  let errorContainer = getId('error-container');
  console.log(errorContainer);
  errorContainer.style.display = 'block';
  let errorMessage = getId('error-message');
  errorMessage.textContent = response.message;
}

getId('error-button').onclick = function () {
  
  clearErrorMessage();

  let errorContainer = getId('error-container');
  errorContainer.style.display = 'none';
  let formContainerElement = getId('form-container');
  formContainerElement.style.display = 'block';
  return false;
};

function clearErrorMessage() {
  getId('error-message').textContent = "";
}


getId('back-button').onclick = function () {
  
  clearTable();

  let formContainerElement = getId('form-container');
  formContainerElement.style.display = 'block';
  let tableContainerElement = getId('result-table-container');
  tableContainerElement.style.display = 'none';
  let buttonElement = getId('back-button');
  buttonElement.style.display = 'none';

  return false;
};
