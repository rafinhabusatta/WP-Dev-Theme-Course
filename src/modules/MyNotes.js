import axios from 'axios'

class MyNotes {
  constructor() {
    if (document.querySelector('#myNotes')) {
      axios.defaults.headers.common['X-WP-Nonce'] = data.nonce
      this.myNotes = document.querySelector('#myNotes')
      this.events()
    }
  }

  events() {
    this.myNotes.addEventListener('click', '.delete-note', e =>
      this.deleteNote(e)
    )
    this.myNotes.addEventListener('click', '.edit-note', e => this.editNote(e))
    this.myNotes.addEventListener('click', '.update-note', e =>
      this.updateNote(e)
    )

    document
      .querySelector('.create-note')
      .addEventListener('click', () => this.createNote())
  }

  // Methods
  async createNote() {
    let newPost = {
      title: document.querySelector('.create-title').value,
      content: document.querySelector('.create-body').value,
      status: 'publish'
    }

    try {
      const response = await axios.post(
        data.root_url + '/wp-json/wp/v2/note/',
        newPost
      )
      if (response.data != 'Você atingiu o limite de criação de notas.') {
        document.querySelector('.create-title').value = ''
        document.querySelector('.create-body').value = ''
        document.querySelector('#myNotes').insertAdjacentHTML(
          'afterbegin',
          `<li data-id="${response.id}" class="note-item">
            <input class="note-title form-control-plaintext" readonly value="${response.title.raw}">
            <div class="mt-3">
              <span class="btn btn-success edit-note">Edit</span>
              <span class="btn btn-danger delete-note">Delete</span>
            </div>
            <textarea class="note-body form-control-plaintext mt-3 resize-none" readonly name="" id="">${response.content.raw}</textarea>
            <span class="btn btn-success update-note d-none mt-3">Save</span>
          </li>`
        )
      }
    } catch (e) {
      if (
        response.responseText == 'Você atingiu o limite de criação de notas.'
      ) {
        document.querySelector('.limit-message-note').classList.remove('d-none')
      }
      console.log('Sorry', e)
    }
  }

  editNote(e) {
    let thisNote = this.findNearestParentLi(e.target)

    if (thisNote.getAttribute('data-state') == 'editable') {
      // Make read only
      this.makeNoteReadOnly(thisNote)
    } else {
      // Make editable
      this.makeNoteEditable(thisNote)
    }
  }

  makeNoteReadOnly(thisNote) {
    thisNote
      .querySelector('.note-title')
      .setAttribute('readonly', 'readonly')
      .classList.add('form-control-plaintext resize-none')
      .classList.remove('form-control')

    thisNote
      .querySelector('.note-body')
      .setAttribute('readonly', 'readonly')
      .classList.add('form-control-plaintext resize-none')
      .classList.remove('form-control')

    thisNote
      .querySelector('.update-note')
      .classList.add('d-none')
      .classList.remove('d-block')

    thisNote.querySelector('.edit-note').html('Edit')
    thisNote.setAttribute('state', 'cancel')
  }

  makeNoteEditable(thisNote) {
    thisNote
      .querySelector('.note-title')
      .removeAttribute('readonly')
      .classList.add('form-control')
      .classList.remove('form-control-plaintext resize-none')

    thisNote
      .querySelector('.note-body')
      .removeAttribute('readonly')
      .classList.add('form-control')
      .classList.remove('form-control-plaintext resize-none')

    thisNote
      .querySelector('.update-note')
      .classList.add('d-block')
      .classList.remove('d-none')

    thisNote.querySelector('.edit-note').html('Cancel')
    thisNote.setAttribute('data-state', 'editable')
  }

  async deleteNote(e) {
    let thisNote = this.findNearestParentLi(e.target)
    try {
      const response = await axios({
        method: 'delete',
        url:
          data.root_url +
          '/wp-json/wp/v2/note/103' +
          thisNote.getAttribute('data-id')
      })
      if (response.data.userNoteCount < 5) {
        document.querySelector('.limit-message-note').classList.add('d-none')
      }
    } catch (e) {
      console.log(e)
    }
  }

  async updateNote(e) {
    let thisNote = this.findNearestParentLi(e.target)

    let updatedPost = {
      title: thisNote.querySelector('.note-title').value,
      content: thisNote.querySelector('.note-body').value
    }

    try {
      const response = await axios({
        method: 'post',
        url:
          data.root_url +
          '/wp-json/wp/v2/note/' +
          thisNote.getAttribute('data-id'),
        data: updatedPost
      })
      this.makeNoteReadOnly(thisNote)
    } catch (e) {
      console.log(e)
    }
  }
}

export default MyNotes
