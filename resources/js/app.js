import './bootstrap';
import axios from 'axios';

const search = document.getElementById('search')
const codeSearch = document.getElementById('code-search')

search.addEventListener('click', async function () {
    const input = document.getElementById('searchInput').value

    let response = await axios.get(`books`, {
        data: {
            keyword: input
        }
    })
    
    if (response.data.success) {
        codeSearch.textContent = JSON.stringify(response.data, null, "\t")
    }
})

const create = document.getElementById('create')
const codeCreate = document.getElementById('code-create')

create.addEventListener('click', async function () {
    let name = document.getElementById('name').value
    let isbn = document.getElementById('isbn').value
    let price = document.getElementById('price').value

    if (name == '' || isbn == '' || price == '') {
        alert('Please fill all fields')
        return
    }

    let response = await axios.post(`books`, {
        name: name,
        isbn: isbn,
        price: price
    })

    if (response.data.success) {
        codeCreate.textContent = JSON.stringify(response.data, null, "\t")
    }
})

const update = document.getElementById('update')
const codeUpdate = document.getElementById('code-update')

update.addEventListener('click', async function () {
    let id = document.getElementById('update-id').value
    let name = document.getElementById('update-name').value
    let isbn = document.getElementById('update-isbn').value
    let price = document.getElementById('update-price').value

    if (id == '') {
        alert('Please insert an ID')
        return
    }

    let response = await axios.patch(`books/${id}`, {
        name: name,
        isbn: isbn,
        price: price
    })

    if (response.data.success) {
        codeUpdate.textContent = JSON.stringify(response.data, null, "\t")
    }
})

const deleteBtn = document.getElementById('delete')
const codeDelete = document.getElementById('code-delete')

deleteBtn.addEventListener('click', async function () {
    let id = document.getElementById('delete-id').value

    if (id == '') {
        alert('Please insert an ID')
        return
    }

    let response = await axios.delete(`books/${id}`)

    if (response.data.success) {
        codeDelete.textContent = JSON.stringify(response.data, null, "\t")
    }
})