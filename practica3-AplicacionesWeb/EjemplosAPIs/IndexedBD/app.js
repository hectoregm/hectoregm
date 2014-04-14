var html5 = {};
window.indexedDB = window.indexedDB || window.webkitIndexedDB ||
  window.mozIndexedDB;

if ('webkitIndexedDB' in window) {
  window.IDBTransaction = window.webkitIDBTransaction;
  window.IDBKeyRange = window.webkitIDBKeyRange;
}

// We are using the Asynchronous API
html5.indexedDB = {};
html5.indexedDB.db = null;

html5.indexedDB.onerror = function(e) {
  console.log(e);
};


// We open the database
html5.indexedDB.open = function() {
  var version = 1;
  var request = indexedDB.open("todos", version);

  // We can only create Object stores in a versionchange transaction.
  request.onupgradeneeded = function(e) {
    var db = e.target.result;

    e.target.transaction.onerror = html5.indexedDB.onerror;

    if(db.objectStoreNames.contains("todo")) {
      db.deleteObjectStore("todo");
    }

    var store = db.createObjectStore("todo",
                                     {keyPath: "timeStamp"});
  };

  // Callback after succesfully opening the DB
  request.onsuccess = function(e) {
    html5.indexedDB.db = e.target.result;
    html5.indexedDB.getAllTodoItems();
  };

  request.onerror = html5.indexedDB.onerror;
};


// Method to create a new todo item
html5.indexedDB.addTodo = function(todoText) {
  var db = html5.indexedDB.db;
  var trans = db.transaction(["todo"], "readwrite");
  var store = trans.objectStore("todo");

  var data = {
    "text": todoText,
    "timeStamp": new Date().getTime()
  };

  var request = store.put(data);

  request.onsuccess = function(e) {
    html5.indexedDB.getAllTodoItems();
  };

  request.onerror = function(e) {
    console.log("Error Adding: ", e);
  };
};

// Method to delete a todo item
html5.indexedDB.deleteTodo = function(id) {
  var db = html5.indexedDB.db;
  var trans = db.transaction(["todo"], "readwrite");
  var store = trans.objectStore("todo");

  var request = store.delete(id);

  request.onsuccess = function(e) {
    html5.indexedDB.getAllTodoItems();
  };

  request.onerror = function(e) {
    console.log("Error Adding: ", e);
  };
};


// Method to query all the items in the DB
html5.indexedDB.getAllTodoItems = function() {
  var todos = document.getElementById("todoItems");
  todos.innerHTML = "";

  var db = html5.indexedDB.db;
  var trans = db.transaction(["todo"], "readwrite");
  var store = trans.objectStore("todo");

  // Get everything in the store, since key is a timestamp
  // we grab anything using 0 has our lower bound;
  var keyRange = IDBKeyRange.lowerBound(0);
  var cursorRequest = store.openCursor(keyRange);

  cursorRequest.onsuccess = function(e) {
    var result = e.target.result;
    if(!!result == false)
      return;

    renderTodo(result.value);
    result.continue();
  };

  cursorRequest.onerror = html5.indexedDB.onerror;
};


// Method to construct the HTML for each todo item
function renderTodo(row) {
  var todos = document.getElementById("todoItems");
  var li = document.createElement("li");
  var a = document.createElement("a");
  var t = document.createTextNode(row.text);

  a.addEventListener("click", function() {
    html5.indexedDB.deleteTodo(row.timeStamp);
  }, false);

  a.href = "#";
  a.textContent = " [Delete]";
  li.appendChild(t);
  li.appendChild(a);
  todos.appendChild(li);
}

// Callback function for input form
function addTodo() {
  var todo = document.getElementById("todo");
  html5.indexedDB.addTodo(todo.value);
  todo.value = "";
}

function init() {
  html5.indexedDB.open();
}

window.addEventListener("DOMContentLoaded", init, false);
