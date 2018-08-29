
//links Create Account Button to createAccount.html
const createAccountButton = document.getElementById('createAccount');

createAccountButton.addEventListener('click', function (event) {
  location.href='createaccount.html';
});

//links Login button to LoginPage.html
const loginButton = document.getElementById('login');

loginButton.addEventListener('click', function (event) {
  location.href='LoginPage.html';
});
