import './bootstrap';
import axios from 'axios';

const register = document.getElementById('register')
const login = document.getElementById('login')
const logout = document.getElementById('logout')

if (localStorage.getItem('token')) {
    register.style.display = 'none'
    login.style.display = 'none'
    logout.style.display = 'block'
} else {
    register.style.display = 'block'
    login.style.display = 'block'
    logout.style.display = 'none'
}

register.addEventListener('click', async function () {
    let name = document.getElementById('username').value
    let email = document.getElementById('email').value
    let password = document.getElementById('password').value

    if (name === '' || email === '' || password === '') {
        alert('Please fill all fields')
        return
    }

    await axios.post(`api/auth/register`, {
        name: name,
        email: email,
        password: password
    })

    login.style.display = 'block'
    register.style.display = 'block'
    logout.style.display = 'none'

    alert('User registered successfully')
})

login.addEventListener('click', async function () {
    let email = document.getElementById('email').value
    let password = document.getElementById('password').value

    if (email === '' || password === '') {
        alert('Please provide both email and password fields')
        return
    }

    try {
        let resp = await axios.post(`api/auth/login`, {
            email: email,
            password: password
        })

        let token = resp.data.access_token
        localStorage.setItem('token', token)

        login.style.display = 'none'
        register.style.display = 'none'
        logout.style.display = 'block'

        alert('User logged in successfully')
    } catch (error) {
        alert('Invalid credentials')
        return
    }
})

logout.addEventListener('click', async function () {
    await fetch('api/auth/logout', {
        method: 'POST',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
    })

    localStorage.removeItem('token')

    login.style.display = 'block'
    register.style.display = 'block'
    logout.style.display = 'none'
})

const search = document.getElementById('search')
const codeSearch = document.getElementById('code-search')

search.addEventListener('click', async function () {
    const input = document.getElementById('searchInput').value
    console.log(input)

    let response = await axios.get(`api/books?keyword=${input}`, {
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
    
    codeSearch.textContent = JSON.stringify(response.data, null, "\t") 
})

const create = document.getElementById('create')
const codeCreate = document.getElementById('code-create')

create.addEventListener('click', async function () {
    let name = document.getElementById('name').value
    let isbn = document.getElementById('isbn').value
    let price = document.getElementById('price').value

    let axiosInstance = axios.create({
        baseURL: 'api/books',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })

    if (name === '' || isbn === '' || price === '') {
        alert('Please fill all fields')
        return
    }

    let response = await axiosInstance.post('', {
        name: name,
        isbn: isbn,
        price: price
    })
    
    codeCreate.textContent = JSON.stringify(response.data, null, "\t")
})

const update = document.getElementById('update')
const codeUpdate = document.getElementById('code-update')

update.addEventListener('click', async function () {
    let id = document.getElementById('update-id').value
    let name = document.getElementById('update-name').value
    let isbn = document.getElementById('update-isbn').value
    let price = document.getElementById('update-price').value

    if (id === '') {
        alert('Please insert an ID')
        return
    }

    let axiosInstance = axios.create({
        baseURL: 'api/books',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })

    try {
        let response = await axiosInstance.patch(`/${id}`, {
            name: name,
            isbn: isbn,
            price: price
        })

        codeUpdate.textContent = JSON.stringify(response.data, null, "\t")
    } catch (error) {
        codeUpdate.textContent = JSON.stringify(error.response.data, null, "\t")
    }
})

const deleteBtn = document.getElementById('delete')
const codeDelete = document.getElementById('code-delete')

deleteBtn.addEventListener('click', async function () {
    let id = document.getElementById('delete-id').value

    if (id === '') {
        alert('Please insert an ID')
        return
    }

    try {
        let response = await axios.delete(`api/books/${id}`, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        codeDelete.textContent = JSON.stringify(response.data, null, "\t")
    } catch (error) {
        codeDelete.textContent = JSON.stringify(error.response.data, null, "\t")
    }
})