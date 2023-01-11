import $ from 'jquery'
import axios from 'axios'

class MyNotes {
  constructor() {
    this.events()
  }

  events() {
    document
      .querySelector('#myNotes')
      .addEventListener('click', '.delete-note', e => this.deleteNote(e))
    document
      .querySelector('#myNotes')
      .addEventListener('click', '.edit-note', e => this.editNote(e))
    document
      .querySelector('#myNotes')
      .addEventListener('click', '.update-note', e => this.updateNote(e))
    document
      .querySelector('.create-note')
      .addEventListener('click', () => this.createNote())
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
        console.log('Sorry')
        console.log(response)
      }
    })
  }
  editNote(e) {
    let thisNote = $(e.target).parents('li')

    if (thisNote.data('state') == 'editable') {
      // Make read only
      this.makeNoteReadOnly(thisNote)
    } else {
      // Make editable
      this.makeNoteEditable(thisNote)
    }
  }

  makeNoteReadOnly(thisNote) {
    thisNote
      .find('.note-title, .note-body')
      .attr('readonly', 'readonly')
      .addClass('form-control-plaintext resize-none')
      .removeClass('form-control')

    thisNote.find('.update-note').addClass('d-none').removeClass('d-block')

    thisNote.find('.edit-note').html('Edit')
    thisNote.data('state', 'cancel')
  }
  makeNoteEditable(thisNote) {
    thisNote
      .find('.note-title, .note-body')
      .removeAttr('readonly')
      .addClass('form-control')
      .removeClass('form-control-plaintext resize-none')

    thisNote.find('.update-note').addClass('d-block').removeClass('d-none')

    thisNote.find('.edit-note').html('Cancel')
    thisNote.data('state', 'editable')
  }
  // async deleteNote() {
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
