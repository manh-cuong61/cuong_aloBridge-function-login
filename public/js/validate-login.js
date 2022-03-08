let btnLogin = document.querySelector('#login')
let email = document.querySelector('#email')
let email_error = document.querySelector('.email_error')
let password = document.querySelector('#password')
let password_error = document.querySelector('.password_error')


btnLogin.addEventListener('click', function(event){
    let messages_email = []
    let messages_password = []
    if(email.value.trim() == '') {
        messages_email.push('Email is required')
    }
    if(password.value == '') {
        messages_password.push('Password is required')
    }
    

    if(messages_email.length > 0) {
        event.preventDefault()
        email_error.innerHTML = messages_email.join(', ')
    }
    if(messages_password.length > 0) {
        event.preventDefault()
        password_error.innerHTML = messages_password.join(', ')
    }
})