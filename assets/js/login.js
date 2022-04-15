const loginBtn = document.querySelector('form button');

loginBtn.addEventListener('click', async (e) => {
    e.preventDefault();
    const payload = {
        email: 'test',
        password: 'pass'
    }
    const data = new FormData()
    data.append('email', payload.email);
    data.append('password', payload.password);
    // loginBtn.setAttribute('disabled', true);
    await fetch('http://localhost/sign/routes/auth/login.php', {
        method: 'POST',
        headers: {
            'Accept': '*/*',
        },
        body: data
    }).then(res => res.json())
    .then(data => console.log(data))
})