import $ from 'jquery'
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
    // this.myNotes.addEventListener('click', '.delete-note', e =>
    //   this.deleteNote(e)
    // )
    // this.myNotes.addEventListener('click', '.edit-note', e => this.editNote(e))
    // this.myNotes.addEventListener('click', '.update-note', e =>
    //   this.updateNote(e)
    // )
    // document
    //   .querySelector('.create-note')
    //   .addEventListener('click', () => this.createNote())
    $('#my-notes').on('click', '.delete-note', this.deleteNote)
    $('#my-notes').on('click', '.edit-note', this.editNote.bind(this))
    $('#my-notes').on('click', '.update-note', this.updateNote.bind(this))
    $('.create-note').on('click', this.createNote.bind(this))
  }

  // Methods
  createNote() {
    let newPost = {
      title: $('.create-title').val(),
      content: $('.create-body').val(),
      status: 'publish'
    }
    $.ajax({
      beforeSend: xhr => xhr.setRequestHeader('X-WP-Nonce', data.nonce), // xhr = xml http request
      url: data.root_url + '/wp-json/wp/v2/note/',
      type: 'POST',
      data: newPost,
      success: response => {
        $('.create-title, .create-body').val('')
        $(`<li data-id="${response.id}" class="note-item">
        <input class="note-title form-control-plaintext" readonly value="${response.title.raw}">
        <div class="mt-3">
          <span class="btn btn-success edit-note">Edit</span>
          <span class="btn btn-danger delete-note">Delete</span>
        </div>
        <textarea class="note-body form-control-plaintext mt-3 resize-none" readonly name="" id="">${response.content.raw}</textarea>
        <span class="btn btn-success update-note d-none mt-3">Save</span>
      </li>`)
          .prependTo('#myNotes')
          .hide()
          .slideDown()
        console.log('Congrats')
        console.log(response)
      },
      error: response => {
        if (
          response.responseText == 'Você atingiu o limite de criação de notas.'
        ) {
          document
            .querySelector('.limit-message-note')
            .classList.remove('d-none')
        }
        console.log('Sorry')
        console.log(response)
      }
    })
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
  // async deleteNote(e) {
  //   axios({
  //     method: 'delete',
  //     url: data.root_url + '/wp-json/wp/v2/note/103',
  //     headers: {
  //       'X-WP-Nonce': data.nonce
  //     }
  //   });
  // }

  deleteNote(e) {
    let thisNote = $(e.target).parents('li')
    $.ajax({
      beforeSend: xhr => xhr.setRequestHeader('X-WP-Nonce', data.nonce), // xhr = xml http request
      url: data.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
      type: 'DELETE',
      success: response => {
        if (response.userNoteCount < 5) {
          document.querySelector('.limit-message-note').classList.add('d-none')
        }
        thisNote.slideUp()
        console.log('Congrats')
        console.log(response)
      },
      error: response => {
        console.log('Sorry')
        console.log(response)
      }
    })
  }

  updateNote(e) {
    let thisNote = $(e.target).parents('li')

    let updatedPost = {
      title: thisNote.find('.note-title').val(),
      content: thisNote.find('.note-body').val()
    }
    $.ajax({
      beforeSend: xhr => xhr.setRequestHeader('X-WP-Nonce', data.nonce), // xhr = xml http request
      url: data.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
      type: 'POST',
      data: updatedPost,
      success: response => {
        this.makeNoteReadOnly(thisNote)
        console.log('Congrats')
        console.log(response)
      },
      error: response => {
        console.log('Sorry')
        console.log(response)
      }
    })
  }
}

export default MyNotes
